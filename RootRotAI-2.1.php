<?php
include 'counter_logic.php';
include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>RootRotAI-2.1</title>
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

        .status-healthy {
            background-color: #d1e7dd;
            color: #0f5132;
            padding: 0.35em 0.65em;
            border-radius: 50rem;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .status-drr {
            background-color: #f8d7da;
            color: #842029;
            padding: 0.35em 0.65em;
            border-radius: 50rem;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .status-invalid {
            background-color: #fff3cd;
            color: #664d03;
            padding: 0.35em 0.65em;
            border-radius: 50rem;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .loader-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            z-index: 9999;
            color: #fff;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--primary-blue);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="bg-light">

    <header class="py-2">
        <div class="container-fluid px-lg-2">
            <div class="ack-header py-2 rounded-4 d-flex align-items-center justify-content-between px-2 shadow-sm">
                <div class="logo-wrapper d-none d-md-block">
                    <a href="#">
                        <img src="Images/RootRotAI_2.1.png" alt="RootRotAI Logo" class="header-logo">
                    </a>
                </div>

                <div class="text-center flex-grow-1 mx-3">
                    <h1 class="text-primary display-6 mb-1 fw-bold">
                        RootRotAI <span class="badge bg-primary fs-6 align-middle px-3 rounded-pill shadow-sm">v2.1</span>
                    </h1>
                    <p class="lead text-secondary mb-0 fw-semibold fs-6">
                        A web-based platform for high-throughput Dry Root Rot detection and assessment
                        <img src="https://cdn-icons-png.flaticon.com/512/3067/3067260.png" alt="Interactive Computer" class="ms-1" style="width: 50px; height: 50px;">
                    </p>
                </div>

                <div class="logo-wrapper d-none d-md-block">
                    <a href="#">
                        <img src="Images/RootRotAI_2.1.png" alt="RootRotAI Logo" class="header-logo">
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
                    <p class="text-dark mb-3">
                        <strong>RootRotAI-2.1</strong> detects <em>Macrophomina phaseolina</em> infection in chickpea images. The system utilizes two multitask transformer-based TensorFlow Lite models—one optimized for camera and root scanner modalities, and another specialized for microscopic pathogen detection.
                    </p>
                    <div>
                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3" type="button" data-bs-toggle="collapse" data-bs-target="#moreInfo">
                            <i class="fa-solid fa-layer-group me-1"></i> View Model Architecture Details
                        </button>
                        <div id="moreInfo" class="collapse mt-3 text-muted small">
                            <ul class="mb-0 ps-3">
                                <li><strong>Model 1:</strong> Optimized for whole-plant camera acquisitions and high-resolution root scanner images.</li>
                                <li><strong>Model 2:</strong> Optimized for microscopic imaging for fine-grained pathogen identification.</li>
                                <li><strong>Multitask Learning:</strong> Simultaneously predicts disease presence and calculates severity scores (0–5).</li>
                            </ul>
                        </div>
                    </div>
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

                        <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-image text-warning me-2"></i>Imaging Guidelines</h6>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2 d-flex align-items-start">
                                <i class="fa-solid fa-square text-danger mt-1 me-2"></i>
                                <span><strong>Red Background:</strong> Standard Camera Images</span>
                            </li>
                            <li class="mb-2 d-flex align-items-start">
                                <i class="fa-solid fa-square text-primary mt-1 me-2"></i>
                                <span><strong>Blue Background:</strong> Flatbed Root Scanner</span>
                            </li>
                            <li class="mb-2 d-flex align-items-start">
                                <i class="fa-solid fa-square text-secondary mt-1 me-2"></i>
                                <span><strong>White Background:</strong> Microscopic Imaging</span>
                            </li>
                            <li class="mb-2 d-flex align-items-start">
                                <i class="fa-solid fa-circle-check text-success mt-1 me-2"></i>
                                <span>Backgrounds should be clean and free of unassociated objects.</span>
                            </li>
                        </ul>

                        <h6 class="fw-bold text-dark mb-2"><i class="fa-solid fa-chart-simple text-primary me-2"></i>Model Benchmarks</h6>
                        <div class="table-responsive mb-3">
                            <table class="table table-sm table-bordered text-center align-middle mb-0 small">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Modality</th>
                                        <th>Accuracy</th>
                                        <th>RMSE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Camera</td>
                                        <td><span class="badge bg-success">94%</span></td>
                                        <td class="text-muted">0.87</td>
                                    </tr>
                                    <tr>
                                        <td>Scanner</td>
                                        <td><span class="badge bg-success">85%</span></td>
                                        <td class="text-muted">1.49</td>
                                    </tr>
                                    <tr>
                                        <td>Microscope</td>
                                        <td><span class="badge bg-success">93%</span></td>
                                        <td class="text-muted">1.21</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="p-2 bg-light rounded-3 border text-center mb-3" style="font-size: 0.78rem;">
                            <em>Outputs: 1. DRR Detection | 2. Severity Score (0-5, where 0 = Healthy)</em>
                        </div>

                        <a href="https://github.com/scipdatabase/DRR_Disease_Prediction/tree/main/Images" target="_blank" class="btn btn-outline-primary btn-sm w-100 rounded-pill">
                            <i class="fa-brands fa-github me-2"></i>Download Sample Datasets
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-7 col-xl-8">
                <div class="card shadow-sm border-0 rounded-4 h-100 glass-card">
                    <div class="card-header bg-primary bg-gradient text-white py-3 text-center border-0 rounded-top-4">
                        <h4 class="mb-0 fw-bold"><i class="fa-solid fa-microchip me-2"></i>RootRotAI-2.1 Workspace</h4>
                    </div>

                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark mb-2">
                                    <i class="fa-solid fa-sliders text-primary me-2"></i>1. Select Image Modality
                                </label>
                                <select id="modeSelect" class="form-select form-select-lg">
                                    <option value="camera">Camera (Red Background)</option>
                                    <option value="root_scanner">Root Scanner (Blue Background)</option>
                                    <option value="microscope">Microscope (White Background)</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark mb-2">
                                    <i class="fa-solid fa-file-arrow-up text-primary me-2"></i>2. Upload Plant Images (Batch Mode Supported)
                                </label>
                                <input type="file" id="imageUpload" class="form-control form-control-lg" multiple accept="image/*">
                            </div>

                            <button class="btn btn-success btn-lg w-100 py-2 fw-bold shadow-sm" id="analyzeBtn" onclick="runAnalysis()">
                                <i class="fa-solid fa-wand-magic-sparkles me-2"></i>Run AI Diagnosis & Score
                            </button>
                        </div>

                        <div id="resultsSection" class="mt-4 d-none">
                            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                                <h5 class="fw-bold mb-0 text-primary"><i class="fa-solid fa-square-poll-vertical me-2"></i>Analysis Results</h5>
                                <a id="downloadLink" href="#" class="btn btn-sm btn-success rounded-pill px-3">
                                    <i class="fa-solid fa-file-csv me-1"></i> Export Report (.csv)
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle border">
                                    <thead class="table-light">
                                        <tr class="small text-uppercase">
                                            <th>Image Name</th>
                                            <th>AI Prediction</th>
                                            <th>Severity (0–5)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="resultsBody"></tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </main>

    <div id="loader" class="loader-overlay">
        <div class="spinner mb-3"></div>
        <div class="fw-bold fs-5" id="loaderText">Processing Images...</div>
    </div>

    <script>
        const API_ENDPOINT = "https://drr.nipgr.ac.in/imgapi";

        async function runAnalysis() {
            const fileInput = document.getElementById('imageUpload');
            const mode = document.getElementById('modeSelect').value;
            const resultsBody = document.getElementById('resultsBody');
            const resultsSection = document.getElementById('resultsSection');
            const downloadLink = document.getElementById('downloadLink');
            const loader = document.getElementById('loader');
            const loaderText = document.getElementById('loaderText');
            const btn = document.getElementById('analyzeBtn');

            if (fileInput.files.length === 0) {
                alert("Please select at least one image file to process.");
                return;
            }

            loader.style.display = "flex";
            loaderText.innerText = `Analyzing ${fileInput.files.length} image(s)...`;
            btn.disabled = true;
            resultsSection.classList.add('d-none');

            const formData = new FormData();
            formData.append("mode", mode);
            for (let i = 0; i < fileInput.files.length; i++) {
                formData.append("files", fileInput.files[i]);
            }

            try {
                const response = await fetch(`${API_ENDPOINT}/predict_batch`, {
                    method: "POST",
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`Server returned status ${response.status}: ${response.statusText}`);
                }

                const data = await response.json();
                resultsBody.innerHTML = "";

                data.display_data.forEach(res => {
                    let badgeClass = "status-healthy";
                    const pred = res.Prediction.toUpperCase();

                    if (pred.includes("DRR")) {
                        badgeClass = "status-drr";
                    } else if (pred.includes("INVALID")) {
                        badgeClass = "status-invalid";
                    }

                    const row = `
                        <tr>
                            <td class="fw-semibold text-secondary">${res["Image Name"]}</td>
                            <td><span class="${badgeClass}">${res.Prediction}</span></td>
                            <td><strong class="fs-6">${res["Severity Score"]}</strong></td>
                        </tr>`;
                    resultsBody.insertAdjacentHTML('beforeend', row);
                });

                downloadLink.href = `${API_ENDPOINT}${data.download_url}`;
                resultsSection.classList.remove('d-none');

            } catch (error) {
                console.error("Analysis Error:", error);
                alert("Connection failed! Please verify that your Python server is accessible at " + API_ENDPOINT);
            } finally {
                loader.style.display = "none";
                btn.disabled = false;
            }
        }
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>