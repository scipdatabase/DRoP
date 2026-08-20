import io
import os
import uuid
import numpy as np
import pandas as pd
from PIL import Image
from typing import List
from fastapi import FastAPI, File, UploadFile, BackgroundTasks, Form
from fastapi.responses import FileResponse
from fastapi.middleware.cors import CORSMiddleware
import tensorflow.lite as tflite

app = FastAPI(title="RootRot-AI 2.1 API")

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_methods=["*"],
    allow_headers=["*"],
)

BASE_DIR = os.path.dirname(os.path.abspath(__file__))
MODELS_DIR = os.path.join(BASE_DIR, "models")
TEMP_DIR = os.path.join(BASE_DIR, "temp_reports")
os.makedirs(TEMP_DIR, exist_ok=True)

# --- LOAD MODELS ---
try:
    # Gatekeeper (224x224) [Raw 0-255]
    gatekeeper = tflite.Interpreter(model_path=os.path.join(MODELS_DIR, "plant_non_classifier.tflite"))
    gatekeeper.allocate_tensors()

    # Disease Models (288x288) [Normalized 0-1]
    interp_camera = tflite.Interpreter(model_path=os.path.join(MODELS_DIR, "camera.tflite"))
    interp_camera.allocate_tensors()
    
    interp_micro = tflite.Interpreter(model_path=os.path.join(MODELS_DIR, "microscope.tflite"))
    interp_micro.allocate_tensors()
    print("✅ SUCCESS: Models Loaded & Optimized.")
except Exception as e:
    print(f"❌ ERROR: {e}")

# UPDATED LABELS
CLASS_LABELS = ['Healthy', 'DRR Detected', 'DRR Detected']

@app.post("/predict_batch")
async def predict_batch(files: List[UploadFile] = File(...), mode: str = Form(...)):
    results = []
    # Select interpreter once to avoid check inside loop
    disease_interp = interp_micro if mode == "microscope" else interp_camera
    
    # Pre-allocate tensors indices to save lookup time
    gk_in_idx = gatekeeper.get_input_details()[0]['index']
    gk_out_idx = gatekeeper.get_output_details()[0]['index']
    
    dz_in_idx = disease_interp.get_input_details()[0]['index']
    dz_out0_idx = disease_interp.get_output_details()[0]['index']
    dz_out1_idx = disease_interp.get_output_details()[1]['index']

    # Check output shapes once
    dz_out0_shape = disease_interp.get_output_details()[0]['shape']
    is_class_first = dz_out0_shape[1] > 1

    for file in files:
        contents = await file.read()
        raw_img = Image.open(io.BytesIO(contents)).convert('RGB')

        # --- GATEKEEPER (Fast Check) ---
        gk_img = raw_img.resize((224, 224), Image.BILINEAR)
        gk_input = np.expand_dims(np.array(gk_img, dtype=np.float32), axis=0)
        
        gatekeeper.set_tensor(gk_in_idx, gk_input)
        gatekeeper.invoke()
        
        prob_plant = gatekeeper.get_tensor(gk_out_idx)[0][0]
        
        # If Invalid, skip heavy disease processing
        if prob_plant < 0.7: 
            results.append({
                "Image Name": file.filename,
                "Prediction": "Invalid Image",
                "Severity Score": 0
            })
            continue

        # --- DISEASE ANALYSIS ---
        dz_img = raw_img.resize((288, 288), Image.BICUBIC)
        dz_input = np.expand_dims(np.array(dz_img, dtype=np.float32) / 255.0, axis=0)
        
        disease_interp.set_tensor(dz_in_idx, dz_input)
        disease_interp.invoke()
        
        out0 = disease_interp.get_tensor(dz_out0_idx)
        out1 = disease_interp.get_tensor(dz_out1_idx)
        
        if is_class_first:
            cls_output, raw_score = out0[0], out1[0][0]
        else:
            cls_output, raw_score = out1[0], out0[0][0]
            
        pred_idx = np.argmax(cls_output)
        status = CLASS_LABELS[pred_idx]
        
        # Force Healthy to Score 0
        score = 0 if pred_idx == 0 else int(abs(np.round(raw_score, 0)))

        results.append({
            "Image Name": file.filename,
            "Prediction": status,
            "Severity Score": score
        })

    # CLEAN CSV GENERATION (Only 3 columns)
    csv_name = f"Report_{uuid.uuid4().hex[:6]}.csv"
    csv_path = os.path.join(TEMP_DIR, csv_name)
    
    # Save only the columns user asked for
    df = pd.DataFrame(results)
    df = df[["Image Name", "Prediction", "Severity Score"]]
    df.to_csv(csv_path, index=False)

    return {"display_data": results, "download_url": f"/download/{csv_name}"}

@app.get("/download/{file_id}")
async def download_file(file_id: str, bt: BackgroundTasks):
    path = os.path.join(TEMP_DIR, file_id)
    if os.path.exists(path):
        bt.add_task(lambda p: os.remove(p), path)
        return FileResponse(path, filename="RootRot_Report.csv")
    return {"error": "Not found"}

if __name__ == "__main__":
    import uvicorn
    # Use 0.0.0.0 for network access
    uvicorn.run(app, host="127.0.0.1", port=8000)
