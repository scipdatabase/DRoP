<?php
include 'counter_logic.php';
include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>RootRotAI-1.0</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    
    <style>
        :root {
            --primary-blue: #0d6efd;
            --success-green: #198754;
            --glass-bg: rgba(255, 255, 255, 0.95);
        }

        .ack-header {
            border: 1px solid rgba(13, 110, 253, 0.15);
            background: linear-gradient(90deg, rgba(13, 110, 253, 0.05) 0%, rgba(13, 110, 253, 0.1) 50%, rgba(13, 110, 253, 0.05) 100%);
        }

        .header-logo {
            height: 150px;
            width: 150px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .header-logo:hover {
            transform: scale(1.05);
        }

        .overview-card {
            background: linear-gradient(135deg, #ffffff, #f4f8ff);
            border-left: 5px solid var(--primary-blue);
        }

        .glass-card {
            border-radius: 16px;
            background: var(--glass-bg);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .glass-card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
        }

        .section-divider {
            border-top: 2px dashed #dee2e6;
        }
    </style>
</head>

<body class="bg-light">

    <header class="py-2">
        <div class="container-fluid px-lg-2">
            <div class="ack-header py-2 rounded-4 d-flex align-items-center justify-content-between px-2 shadow-sm">
                <div class="logo-wrapper d-none d-md-block">
                    <a href="#">
                        <img src="Images/RootRotAI_1.0.png" alt="RootRotAI Logo" class="header-logo">
                    </a>
                </div>

                <div class="text-center flex-grow-1 mx-3">
                    <h1 class="text-primary display-6 mb-1 fw-bold">
                        RootRotAI <span class="badge bg-primary fs-6 align-middle px-3 rounded-pill shadow-sm">v1.0</span>
                    </h1>
                    <p class="lead text-secondary mb-0 fw-semibold fs-6">
                        Online System for Detecting and Assessing Dry Root Rot in Chickpea
                    </p>
                </div>

                <div class="logo-wrapper d-none d-md-block">
                    <a href="#">
                        <img src="Images/RootRotAI_1.0.png" alt="RootRotAI Logo" class="header-logo">
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="container-fluid px-lg-4 pb-5">
        <section class="row mb-4">
            <div class="col-12">
                <div class="card overview-card shadow-sm border-0 rounded-4 p-4">
                    <h3 class="fw-bold text-primary mb-2">
                        <i class="me-2"></i>RootRotAI Overview
                    </h3>
                    <p class="text-dark mb-0">
                        <strong>RootRotAI-1.0</strong> is an online artificial neural network (ANN)-based prediction system developed to forecast the incidence of dry root rot using weather data. The model utilizes key climatic parameters—specifically rainfall, minimum temperature, and maximum temperature to estimate the probability of disease occurrence during the crop season by mapping non-linear environmental dynamics.
                    </p>
                </div>
            </div>
        </section>

        <section class="row g-4">
            <div class="col-12 col-lg-5 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 glass-card">
                    <div class="card-header bg-warning bg-gradient text-dark text-center py-3 border-0 rounded-top-4">
                        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-list-check me-2"></i>Technical Requirements</h5>
                    </div>
                    <div class="card-body p-4">

                        <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-lightbulb text-warning me-2"></i>General Usage Guidelines</h6>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2 d-flex align-items-start">
                                <i class="fa-solid fa-circle-check text-success mt-1 me-2"></i>
                                <span>Enter actual weather data for the crop location. Avoid entering "0" for all parameters.</span>
                            </li>
                            <li class="mb-2 d-flex align-items-start">
                                <i class="fa-solid fa-circle-check text-success mt-1 me-2"></i>
                                <span>Output produces a severity score ranging from 0–5 (<strong>0 = Healthy</strong>).</span>
                            </li>
                            <li class="mb-2 d-flex align-items-start">
                                <i class="fa-solid fa-triangle-exclamation text-danger mt-1 me-2"></i>
                                <span>AI estimation only: Should be used as decision support, not the sole basis for fungicide intervention.</span>
                            </li>
                        </ul>

                        <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-file-csv text-primary me-2"></i>Bulk File Specifications</h6>
                        <ul class="list-unstyled mb-3 text-secondary small">
                            <li class="mb-1"><strong>1. Case-Sensitive Headers:</strong> <code>RainF</code>, <code>MaxT</code>, <code>MinT</code></li>
                            <li class="mb-1"><strong>2. File Format:</strong> Standard <code>.csv</code> file extension</li>
                            <li class="mb-1"><strong>3. Data Integrity:</strong> Ensure no empty cells or string indicators (e.g., 'N/A').</li>
                        </ul>

                        <div class="p-3 bg-light rounded-3 border">
                            <small class="d-block mb-2 text-muted fw-bold">
                                <i class="fa-solid fa-table me-1"></i> Example CSV Structure:
                            </small>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered text-center mb-0 font-monospace small">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>RainF</th>
                                            <th>MaxT</th>
                                            <th>MinT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>12.5</td>
                                            <td>35.0</td>
                                            <td>22.0</td>
                                        </tr>
                                        <tr>
                                            <td>8.0</td>
                                            <td>33.5</td>
                                            <td>20.5</td>
                                        </tr>
                                        <tr>
                                            <td>0.0</td>
                                            <td>38.2</td>
                                            <td>25.1</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <small class="d-block mt-2 text-muted text-center" style="font-size: 0.72rem;">
                                * Note: Predictions generated by RootRotAI 1.0 are probabilistic in nature.
                            </small>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-7 col-xl-8">
                <div class="card shadow-sm border-0 rounded-4 h-100 glass-card">
                    <div class="card-header bg-primary bg-gradient text-white py-3 text-center border-0 rounded-top-4">
                        <h4 class="mb-0 fw-bold"><i class="fa-solid fa-microchip me-2"></i>RootRotAI-1.0 Workspace</h4>
                    </div>

                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="fw-bold mb-3 text-success">
                                <i class="fa-solid fa-sliders me-2"></i>Individual Assessment
                            </h5>
                            <div class="row g-3 mb-4">
                                <div class="col-12 col-md-4">
                                    <label class="form-label fw-bold">Rainfall (mm)</label>
                                    <input type="number" step="any" id="rainf" class="form-control" placeholder="e.g. 10.5">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label fw-bold">Max. Temp. (°C)</label>
                                    <input type="number" step="any" id="maxt" class="form-control" placeholder="e.g. 35.0">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label fw-bold">Min. Temp. (°C)</label>
                                    <input type="number" step="any" id="mint" class="form-control" placeholder="e.g. 22.0">
                                </div>
                            </div>

                            <button class="btn btn-success w-100 mb-4 py-2 fw-bold shadow-sm" onclick="getPrediction()">
                                <i class="fa-solid fa-calculator me-2"></i>Submit for Scoring
                            </button>

                            <div class="section-divider mb-4"></div>

                            <h5 class="fw-bold mb-3 text-primary">
                                <i class="fa-solid fa-file-arrow-up me-2"></i>Bulk Prediction (CSV)
                            </h5>
                            <p class="text-muted small mb-2">Upload a CSV dataset containing parameters: <b>RainF, MaxT, MinT</b></p>

                            <div class="input-group mb-3">
                                <input type="file" id="csvFile" class="form-control" accept=".csv">
                                <button class="btn btn-dark px-4" type="button" onclick="uploadCSV()">Process CSV</button>
                            </div>
                            <div id="csvStatus" class="fw-bold text-success mb-3"></div>
                        </div>

                        <div>
                            <div class="p-3 bg-light rounded-3 border text-center my-3">
                                <span id="displayResult" class="fw-bold fs-5 text-primary">Awaiting parameters...</span>
                            </div>

                            <div class="text-center">
                                <a id="downloadLink" class="btn btn-sm btn-outline-primary d-none" href="#">
                                    <i class="fa-solid fa-download me-1"></i>Download Report (.xlsx)
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="resultsSection" class="row mt-4 d-none">
            <div class="col-12">
                <div class="card p-4 shadow-sm border-0 rounded-4 glass-card">
                    <h5 class="fw-bold text-primary border-bottom pb-2">
                        <i class="fa-solid fa-chart-line me-2"></i>Detailed Analysis Results
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mt-3">
                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Source</th>
                                    <th>Class</th>
                                    <th>Severity Score</th>
                                </tr>
                            </thead>
                            <tbody id="resultsBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <script>
        const API_BASE_URL = "https://drr.nipgr.ac.in/ann";

        async function getPrediction() {
            const rain = document.getElementById('rainf').value;
            const max = document.getElementById('maxt').value;
            const min = document.getElementById('mint').value;
            const resultDisplay = document.getElementById('displayResult');

            if (rain === "" || max === "" || min === "") {
                alert("Please fill in all parameter fields.");
                return;
            }

            resultDisplay.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i>Processing parameters...';

            try {
                const response = await fetch(`${API_BASE_URL}/predict?RainF=${rain}&MaxT=${max}&MinT=${min}`);
                if (!response.ok) throw new Error(await response.text());
                const data = await response.json();

                if (data.error) {
                    throw new Error(data.error);
                }
                resultDisplay.innerHTML = `<span class="text-success"><i class="fa-solid fa-circle-check me-2"></i>Predicted Disease Index (DI): <strong>${data.DiseaseScore}</strong></span>`;
            } catch (error) {
                console.error(error);
                resultDisplay.innerHTML = `<span class="text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i>Error: ${error.message}</span>`;
            }
        }

        async function uploadCSV() {
            const fileInput = document.getElementById('csvFile');
            const status = document.getElementById('csvStatus');

            if (fileInput.files.length === 0) {
                alert("Please select a CSV file first.");
                return;
            }

            const formData = new FormData();
            formData.append("file", fileInput.files[0]);

            status.innerText = "Processing file... Please wait.";

            try {
                const response = await fetch(`${API_BASE_URL}/predict_csv`, {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error(errorText || "Server error running bulk prediction.");
                }

                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);

                const a = document.createElement('a');
                a.href = url;
                a.download = "DI_Predictions_Result.csv";
                document.body.appendChild(a);
                a.click();
                a.remove();

                status.innerText = "Success! Your result file has been downloaded.";
            } catch (error) {
                console.error(error);
                status.innerText = "Error processing file: " + error.message;
            }
        }
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>