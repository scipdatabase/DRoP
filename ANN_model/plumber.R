library(plumber)
library(neuralnet)

# =====================================================
# LOAD SAVED ANN MODEL
# =====================================================
saved_model <- readRDS("models/Final_ANN_DI_Model.rds")

nn_model <- saved_model$model
min_vals <- saved_model$min_vals
max_vals <- saved_model$max_vals

# =====================================================
# ENABLE CORS
# =====================================================
#* @filter cors
function(req, res) {
  res$setHeader("Access-Control-Allow-Origin", "*")
  res$setHeader("Access-Control-Allow-Headers", "*")
  res$setHeader("Access-Control-Allow-Methods", "GET, POST, OPTIONS")

  if (req$REQUEST_METHOD == "OPTIONS") {
    return(list())
  }

  forward()
}

# =====================================================
# API INFO
# =====================================================
#* @apiTitle DRR Prediction API
#* @apiDescription Dry Root Rot Disease ANN Prediction API

# =====================================================
# 1. SINGLE PREDICTION
# =====================================================
#* Predict Disease Index (Single Input)
#* @get /predict
#* @param RainF
#* @param MaxT
#* @param MinT
function(RainF, MaxT, MinT, res) {
  tryCatch(
    {
      df <- data.frame(
        RainF = as.numeric(RainF),
        MaxT  = as.numeric(MaxT),
        MinT  = as.numeric(MinT)
      )

      if (any(is.na(df))) {
        stop("Invalid numeric values provided.")
      }

      # Scale
      for (col in c("RainF", "MaxT", "MinT")) {
        df[[col]] <- (df[[col]] - min_vals[col]) / (max_vals[col] - min_vals[col])
      }

      # Predict
      pred_scaled <- compute(nn_model, df)$net.result

      # Unscale DI
      DI_unscaled <- pred_scaled * (max_vals["DI"] - min_vals["DI"]) + min_vals["DI"]

      list(DiseaseScore = round(as.numeric(DI_unscaled), 4))
    },
    error = function(e) {
      res$status <- 500
      list(error = e$message)
    }
  )
}

# =====================================================
# 2. BULK CSV PREDICTION
# =====================================================
#* Upload CSV and Predict DI
#* @post /predict_csv
#* @parser multi
function(req, res) {
  tryCatch(
    {
      file_obj <- req$body$file

      if (is.null(file_obj)) {
        res$status <- 400
        res$setHeader("Content-Type", "application/json")
        return(list(error = "No file uploaded."))
      }

      # The @parser multi parser can wrap a single file upload in an extra
      # list layer (i.e. file_obj may be list(list(name=, filename=, value=))
      # instead of list(name=, filename=, value=)). Unwrap that case first.
      if (is.list(file_obj) && is.null(file_obj$datapath) && is.null(file_obj$value) &&
        length(file_obj) >= 1 && is.list(file_obj[[1]])) {
        file_obj <- file_obj[[1]]
      }

      # Handle structures plumber gives us via multipart parser
      if (is.list(file_obj) && !is.null(file_obj$datapath)) {
        csv_path <- file_obj$datapath
        df_orig <- read.csv(csv_path, header = TRUE, stringsAsFactors = FALSE)
      } else if (is.list(file_obj) && !is.null(file_obj$value)) {
        # This is the shape returned by the modern `multi` body parser:
        # list(name=, filename=, content_type=, value=<raw bytes>)
        raw_val <- file_obj$value
        csv_text <- if (is.raw(raw_val)) rawToChar(raw_val) else as.character(raw_val)
        df_orig <- read.csv(text = csv_text, header = TRUE, stringsAsFactors = FALSE)
      } else if (is.character(file_obj)) {
        if (file.exists(file_obj)) {
          df_orig <- read.csv(file_obj, header = TRUE, stringsAsFactors = FALSE)
        } else {
          df_orig <- read.csv(text = file_obj, header = TRUE, stringsAsFactors = FALSE)
        }
      } else if (is.raw(file_obj)) {
        csv_text <- rawToChar(file_obj)
        df_orig <- read.csv(text = csv_text, header = TRUE, stringsAsFactors = FALSE)
      } else {
        stop(paste("Cannot handle file of type:", class(file_obj)))
      }

      colnames(df_orig) <- trimws(gsub("^\ufeff", "", colnames(df_orig)))
      required_cols <- c("RainF", "MaxT", "MinT")

      if (!all(required_cols %in% colnames(df_orig))) {
        res$status <- 400
        res$setHeader("Content-Type", "application/json")
        return(list(error = "CSV must contain columns: RainF, MaxT, MinT"))
      }

      for (col in required_cols) {
        df_orig[[col]] <- as.numeric(df_orig[[col]])
      }

      if (any(is.na(df_orig[, required_cols]))) {
        res$status <- 400
        res$setHeader("Content-Type", "application/json")
        return(list(error = "CSV contains invalid numeric values."))
      }

      # Scaling processing
      df_scaled <- df_orig
      for (col in required_cols) {
        df_scaled[[col]] <- (df_orig[[col]] - min_vals[col]) / (max_vals[col] - min_vals[col])
      }

      input_data <- as.data.frame(df_scaled[, required_cols])

      # Predict
      pred_scaled <- compute(nn_model, input_data)$net.result
      DI_unscaled <- pred_scaled * (max_vals["DI"] - min_vals["DI"]) + min_vals["DI"]

      df_orig$DiseaseScore <- round(as.numeric(DI_unscaled), 4)

      # Return as an attached clean CSV stream
      tmp_out <- tempfile(fileext = ".csv")
      write.csv(df_orig, tmp_out, row.names = FALSE)

      csv_bytes <- readBin(tmp_out, what = "raw", n = file.info(tmp_out)$size)
      res$setHeader("Content-Type", "text/csv")
      res$setHeader("Content-Disposition", 'attachment; filename="DI_Predictions_Result.csv"')
      res$body <- csv_bytes
      res$status <- 200
      res
    },
    error = function(e) {
      res$status <- 500
      res$setHeader("Content-Type", "application/json")
      list(error = e$message)
    }
  )
}
