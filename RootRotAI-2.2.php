<?php
include 'counter_logic.php';
include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">



<head>

    <title>RootRotAI-2.2</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">

    <style>
        :root {
            --primary-blue: #0d6efd;
            --hover-blue: #0b5ed7;
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

        .app-preview-img {
            max-height: 380px;
            width: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .app-preview-img:hover {
            transform: translateY(-5px);
        }

        .download-btn {
            transition: all 0.3s ease;
        }

        .download-btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="bg-light">

    <header class="py-2">
        <div class="container-fluid px-lg-2">
            <div class="ack-header py-2 rounded-4 d-flex align-items-center justify-content-between px-2 shadow-sm">
                <div class="logo-wrapper d-none d-md-block">
                    <a href="#">
                        <img src="Images/RootRotAI_2.2.png" alt="RootRotAI Logo" class="header-logo">
                    </a>
                </div>

                <div class="text-center flex-grow-1 mx-3">
                    <h1 class="text-primary display-6 mb-1 fw-bold">
                        RootRotAI <span class="badge bg-primary fs-6 align-middle px-3 rounded-pill shadow-sm">v2.2</span>
                    </h1>
                    <p class="lead text-secondary mb-0 fw-semibold fs-6">
                        A mobile application for rapid Dry Root Rot detection and assessment
                        <img src="Images/mobileapp.jpg" alt="Interactive Computer" class="ms-1 align-text-bottom" style="width: 30px; height: 60px; object-fit: cover;">
                    </p>
                </div>

                <div class="logo-wrapper d-none d-md-block">
                    <a href="#">
                        <img src="Images/RootRotAI_2.2.png" alt="RootRotAI Logo" class="header-logo">
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="container-fluid px-lg-4 pb-5">
        <!-- Overview Section -->
        <section class="row mb-4">
            <div class="col-12">
                <div class="card overview-card shadow-sm border-0 rounded-4 p-4">
                    <h3 class="fw-bold text-primary mb-2">
                        <i class="fa-solid fa-mobile-screen-button me-2"></i>RootRotAI 2.2 Overview
                    </h3>
                    <p class="text-dark mb-3 lead">
                        <strong>RootRotAI 2.2</strong> is an image-based, ML-powered mobile application designed for Dry Root Rot detection and assessment in chickpea research environments. The mobile app executes model inferences 100% locally on your device without requiring an active internet connection.
                    </p>
                    <div>
                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3" type="button" data-bs-toggle="collapse" data-bs-target="#appHighlights" aria-expanded="false" aria-controls="appHighlights">
                            <i class="fa-solid fa-circle-nodes me-1"></i> View Mobile Features
                        </button>
                        <div id="appHighlights" class="collapse mt-3 text-muted small">
                            <ul class="mb-0 ps-3">
                                <li><strong>Offline Processing:</strong> Executes TensorFlow Lite models locally on-device.</li>
                                <li><strong>In-App Capture:</strong> Integrated real-time camera interface for quick field acquisitions.</li>
                                <li><strong>Multi-Modality Support:</strong> Processes camera photos, root scanner captures, and microscopic imagery.</li>
                                <li><strong>Instant Severity Scoring:</strong> Classifies infection status and computes severity scores from 1 to 5.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content Section: Technical Requirements & Downloads Side-by-Side -->
        <section class="row g-4">
            <!-- Technical Requirements Card -->
            <div class="col-12 col-lg-5 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 glass-card">
                    <div class="card-header bg-warning bg-gradient text-dark text-center py-3 border-0 rounded-top-4">
                        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-list-check me-2"></i>Technical Requirements</h5>
                    </div>
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="mb-4">
                                <h6 class="fw-bold text-dark"><i class="fa-solid fa-camera text-danger me-2"></i>1. Camera Modality</h6>
                                <p class="text-muted small ms-4 mb-2">Capture whole-plant tissue samples against a clean, non-reflective <strong>Red Background</strong>.</p>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold text-dark"><i class="fa-solid fa-print text-primary me-2"></i>2. Root Scanner Modality</h6>
                                <p class="text-muted small ms-4 mb-2">Acquire flatbed root scans against a standardized <strong>Blue Background</strong>.</p>
                            </div>

                            <div class="mb-4">
                                <h6 class="fw-bold text-dark"><i class="fa-solid fa-microscope text-secondary me-2"></i>3. Microscope Modality</h6>
                                <p class="text-muted small ms-4 mb-2">Microscopic slides for cellular/pathogen assessment against a clear <strong>White Background</strong>.</p>
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded-3 border">
                            <div class="d-flex align-items-center mb-1">
                                <i class="fa-solid fa-shield-halved text-success me-2"></i>
                                <span class="fw-bold text-dark">Local Privacy & Performance</span>
                            </div>
                            <p class="text-muted small mb-0">
                                Image processing is executed entirely on-device using optimized TensorFlow Lite inference engines. No image data is transmitted to external servers.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- App Download Section -->
            <div class="col-12 col-lg-7 col-xl-8">
                <div class="card border-0 shadow-sm rounded-4 h-100 glass-card text-center p-4 d-flex flex-column justify-content-between">
                    <div>
                        <h4 class="fw-bold text-dark mb-3">
                            <i class="fa-solid fa-circle-down text-primary me-2"></i>Download RootRotAI Mobile App
                        </h4>

                        <div class="my-3">
                            <a href="https://github.com/scipdatabase/RootRotAI/releases/tag/v2.2" target="_blank" rel="noopener noreferrer">
                                <img src="Images/mobileapp.jpg" alt="RootRotAI Mobile App Interface" class="img-fluid rounded-4 shadow-sm app-preview-img" style="max-height: 280px; object-fit: contain;">
                            </a>
                        </div>

                        <p class="text-muted small mb-4">
                            Available for Android devices. Supports offline inference and direct camera captures.
                        </p>
                    </div>

                    <div>
                        <div class="d-grid gap-2 col-md-10 col-lg-8 mx-auto mb-4">
                            <a href="https://github.com/scipdatabase/RootRotAI/releases/tag/v2.2" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-lg rounded-pill download-btn shadow-sm">
                                <i class="fa-brands fa-github me-2"></i>Download Direct APK (v2.2)
                            </a>
                            <a href="https://play.google.com/store/apps/details?id=com.rootrot_ai.app" target="_blank" rel="noopener noreferrer" class="btn btn-outline-success btn-lg rounded-pill download-btn">
                                <i class="fa-brands fa-google-play me-2"></i>Get it on Google Play
                            </a>
                        </div>

                        <div class="pt-3 border-top d-flex flex-column flex-sm-row gap-2">
                            <a href="https://github.com/scipdatabase/DRR_Disease_Prediction/tree/main/Images" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary w-100 rounded-pill">
                                <i class="fa-solid fa-database me-2"></i>Sample Datasets
                            </a>
                            <a href="https://github.com/scipdatabase/RootRotAI" target="_blank" rel="noopener noreferrer" class="btn btn-dark w-100 rounded-pill">
                                <i class="fa-brands fa-github me-2"></i>Model Repository
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>
</body>

</html>