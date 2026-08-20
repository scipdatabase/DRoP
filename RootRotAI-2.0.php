<?php
include 'counter_logic.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>RootRotAI-2.0</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript"
        src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=OabXHS8gl7H6EwEOLiRHQQE4IUCYSRWS4Jq8Z3hT_vWCHtNqnqVRnTCX22f3G4rUMmba0pH8b3fP4d29RbroXhipTclP8gMdv2JbXdL-aU7PZsOj_RUmThfz7mEyIIsJcvNkNS4Sy8TIonpxkvqVrYhdslYWSYYJCy7P5i1BrmxNtqe4Lmn-gf6s_a1CsCznY9x9bHWE8Yn4CU1n4nNGAKmntdp-jnAzmumudtBsmsl93ZxRSiua8aN00vQDOmHvV3wzs_yB7qCjmvOlAv4CiETU0f6GQFXXO3JezUfW0dxr-BCopHjv43jbiajsNpDg89n7jCeD_08Whv1kv8kOEguvgXKtc_rFRuGwzEBBbOp7CmxGIt-7aEvNCZAJHtFDxAO4OJJTj6xZPFpEnlOv-Ry9ta-l-lP6zWXexffWVgKzlbGsY_BrvcvJDGpAe4_HWLwtP6U576IHlKmdO_WLIhMY-VZGOZwp91g9ocR2sOflK4xofyOF-zN7Bj1YKTh6L9ZZzENSEfj8PpFsOlJCLEymlhk60sZguxb8p42ICAUPqpRfz-7j5QrLv_2BSHkHwpQL1AeoNmdhsUd_m_ZpDPZK6r9YGjVg2Kjc3TwnMAaEgtdRaLpfIxjsACLV7NKvUF3J2Ty8lco5rHy-swjb3lQ1GJ5g3f41AymlGbfoNCqeX_CA3JqRWjtkpPAhu0eW-kVTOp_0nCZoQY43Ic9YPfoYVJ5AVuYx5rYmD0jlPNPjHr7jCaRc_lOQbtK5FQyG3Q7O5BzAgamdxe0aqDjgrcDVl7oAw_4yAhwhIeTN8cEGbantMrTzP8r-oARsKMlA-Lll1qCCax4GT8XyS08V1_P3vs--TyYiijwHT7OAznCoUOidm1cVE81AaRE3chshpNZxXhmsrDuxJyrNL7LMolQbdUtDUwdWsLREUh69I2U_zgD1DQUPKHqQexP6WrcFSR3NU7YPD0lY0E8l-0HFx4Fr9UgTkSBCJ7j7GQG3NBuQhIiRRdArBE1uFVoqfFnmFaSxMhNeDrx5S6xE663uMy__uUgP8kg2PvHpm2J69rq6w5c9YIGIQ4_3Uu6Oy5HQG4b9WDh8oPz09EUSDE48qerNjFm7mwEFu9iH-IMFxk2f4PzIR7NCyw3aVNXD7OJEG41ISwNWWXkCrY0kUy4hEiQ_5BIk-BVDIeeWARDlxIpF--aJJO6VjTI7qSkD1uQ9nc_GUvh2Q7XNX0Wv9dM6aIUQfWKZMsvGf7AmyjTv07NT9t2PKSyiG1XhVZ780pewUuVS8Amq5RbVTFJIKm-NCt2HON23-WkyvwUcsY7aNTThcHpF4E1Ba30uH0Fttm_mXwQfsG6sEFahLiewYUSeFu4LzNxO92EftasHFm6k8jONdYE_tGqnEfLOreHavhYtZhksMfXmc4FqoXDMwJVnR8iaf2M8GCDYN6UaWBJnScFMYmvVHy0r78ghJ_cnrQSW2EyrL_fJ-5gEhgnGrOUE7U7eEtNkud5qCg9umh1S1HKbZ3rUnJ7_6DmPb3iDtlZGFCgbLtkaaO3gYyNNyQboSiLovsv1TI_lClFYVs5tZu40FkxWt9ORGXZXaOwI7xP9c6JCJBc9Cb6afw9pi9WcbwYCytAFiS1Q1xLBABfwT5IQch2chlEI5AcyL6idb89qj1WR7SAhjGWJc4BbD3h-ducB5hxZkR2M6mGbENCHRByCCz2uE9nRR-b0fiPUq40sUZkVhBREV3FaF8hf7v05og"
        nonce="9b53d6cffafd52e0670b1c189974ff46" charset="UTF-8"></script>
    <link rel="stylesheet" crossorigin="anonymous"
        href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly9tYWlsLWF0dGFjaG1lbnQuZ29vZ2xldXNlcmNvbnRlbnQuY29tL2F0dGFjaG1lbnQvdS8wLz91aT0yJmlrPThjMDJiOWE0ZjcmYXR0aWQ9MC4yJnBlcm1tc2dpZD1tc2ctZjoxODU0NjcyMTczOTU4NzgxNzgzJnRoPTE5YmQxZTg0MDc5ZDViNTcmdmlldz1hdHQmZGlzcD1zYWZlJnJlYWxhdHRpZD1mX21ra3F5czd1MSZ6dyZzYWRkYmF0PUFOR2pkSl9PMHB4MTR5ektLRHdTY010clNpVmM3NWxzMlRoNS1sbk9wa1BnTktZSGh3TmVDTVZMamRzclZYdWJuWDJma1ZFaGJyRjhyYlFFcGRteDV3UkZUdmFZOEQ2ZmpYcVJyMF8yRGtJMlRnR3lwdU5iQXdZWVdLdlI3X1FYclVEMUhZeXAycGJUY1hXaDNrbkMwbkFGOHZmLVZxUHJWRnUtdnVOblpQWlFSWXNvdjRXZjZGQzZVVk95U09CZWtuN2ppSUFWbEk3QTdfeHBMTnNqYXNvSXF0TWNHLXhWRVZ1MmxtQU9EazhSaTFLNkd1d29NT1ZSUHN3MUh1endpTV8wbFBxUDRNWm1rT2xwZzlQZ0lvQ3g3Z0hlQi1aemZ0ZkRTU2xmMzVPTU9ZZk9zemZhd0F5RUpIZ2ZrMm5kdmpnVXJHWXRTYk84YUJBQzFvd3JnSTJHbGhUZm5EbDJVQkpQWk5FNVdoZXZqN042LXlSaHk2d0N5MUVsSlVQUTdyUV9BYU9jOEhlT1lndFphZl9abmpiTUp1Wk9tTjdFT0QtTGhuV3BIYUF3NjFjemtnaDFoeVBLVzZkSlAxOVd0WXNjY2VTeElOWDBFTDlscWRtbDZDN256dFRIRW1SNWRDX0plM1dTTnl6WDVxVjE1Zzg4ODk4YXV4TmNWUnpTRExzWGo5Wkl5c3QtRmR0RHhKZFFYdDJsUUJrbF9HWTVnOXJZNE9KWnR2S1gtb1RWUWdOdmNvUmNRa244WmdOOWNIb3JkR2VhMTBaZWFNUWQ5QXZEUmIxZ3NPeEFBNlVFekE4MHRRdUxqR2pDR3ZZbDhneVB6QjlaLVBjM0QwdEswaWoyd003V0JTMDREMkFxbU9kVjJ2VzNudnNxTGhXdGg2YzR3R25vLU9ybW9LUUl5TGpyUVJwZnI3LWVFWmd2eUhlWTdvT3JzT2tHSHV0MGwtbnRsdUQ0bUJQZk9CZjVEWGtfanBjbVpGSlNVX3cwTkFrV3R0RjAxa0dVdzNGR1pHQmI1N09WWERHbzlja0x4bHBaWkh3QV9xV3RaN0tLR1ZFbGlDQkxyYUZKTlJzOEI4LUswU2NWVTFMQ19NNTh5UWJxaDUwNFVSWDcwTlpjU1hjX0RQZ0NqM3ZOVTdNWTBQYS1DYjIxbnl2RUpYaFZXQ3dJSlUwZHFuQ3ptYUNTY3hMczNqa21sN0dHYmcwOEt3TldZN2RmS1FqNVJ1TjQ4WU5SQ29UM1Ffb3ktaFZJTnhOYXlqMUdiMS12U0FlR180RGxzMmU3LUpIWDB5cEdveVFwdjhpaXNOZlp5Y1hEbnZxVHllREpqTmhYMmVMMnRUSzJoYVJnS2RrTGgwbFk2aTlfVXBOUmdpeTNseDFGVWZhVTNEZkI3Y003cThpYjFGSlh4MzhhYkN3bXhmcEpEV3BfbUpielVaWURHWmM" />

    <style>
        :root {
            --primary-blue: #0d6efd;
            --success-green: #198754;
            --glass-bg: rgba(255, 255, 255, 0.95);
        }

        .ack-section {
            padding: 4rem 0;
            background: transparent;
        }

        .ack-header h2 {
            font-weight: 400;
            font-size: 2.5rem;
            text-align: center;
            position: relative;
            margin-bottom: 3rem;
        }

        .ack-header h2::after {
            content: '';
            width: 80px;
            height: 4px;
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 10px;
        }

        .header-logo {
            height: 150px;
            width: 150px;
            object-fit: contain;
            background-color: transparent !important;
            transition: transform 0.3s ease;
        }

        .header-logo:hover {
            transform: scale(1.05);
        }

        .logo-wrapper {
            min-width: 120px;
        }

        .ack-header {
            border: 1px solid rgba(13, 110, 253, 0.1);
            background: linear-gradient(90deg, rgba(13, 110, 253, 0.05) 0%, rgba(13, 110, 253, 0.1) 50%, rgba(13, 110, 253, 0.05) 100%);
        }

        .glass-card {
            border-radius: 16px;
            background: var(--glass-bg);
            backdrop-filter: blur(6px);
            border: none;
            transition: transform 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
        }

        .computer-trigger {
            width: 150px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.1));
            animation: floating 3s ease-in-out infinite;
        }

        .computer-trigger:hover {
            transform: scale(1.1);
            filter: drop-shadow(0 15px 25px rgba(0, 123, 255, 0.3));
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        #next-section {
            display: none;
            opacity: 0;
            transition: opacity 0.8s ease-in;
        }

        .section-show {
            display: block !important;
            opacity: 1 !important;
        }

        .instruction-text {
            font-size: 0.85rem;
            color: var(--primary-blue);
            font-weight: 600;
            letter-spacing: 1px;
        }

        .transition-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: default;
        }

        .transition-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }
    </style>
</head>

<body>
    <section class="ack-section py-2">
        <div class="container-fluid px-lg-2">
            <div class="ack-header bg-primary bg-opacity-10 py-2 mb-5 rounded-4 d-flex align-items-center justify-content-between px-2 shadow-sm">
                <div class="logo-wrapper d-none d-md-block">
                    <a href="#">
                        <img src="Images/RootRotAI_2.0.png" alt="RootRotAI Logo" class="header-logo">
                    </a>
                </div>

                <div class="text-center flex-grow-1 mx-3">
                    <h2 class="text-primary display-5 mb-2 fw-bold">
                        RootRotAI <span class="badge bg-primary fs-6 align-middle px-3 rounded-pill shadow-sm">v2.0</span>
                    </h2>
                    <p class="lead text-muted mb-0 fw-semibold" style="font-size: 1.1rem;">
                        Online System for Detecting and Assessing Dry Root Rot in Chickpea
                    </p>
                </div>

                <div class="logo-wrapper d-none d-md-block">
                    <a href="#">
                        <img src="Images/RootRotAI_2.0.png" alt="RootRotAI Logo" class="header-logo">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-1 mb-3">
        <div class="description-box text-justify shadow-lg p-5 rounded-4 bg-white">
            <h2 class="fw-bold mb-4 text-secondary">Deep Learning Models for DRR Diagnosis</h2>

            <p class="text-muted mb-4 px-lg-5">
                This repository hosts trained models for a deep learning tool designed to automate both the detection and severity assessment of DRR in chickpea roots, utilising image-based data collected in laboratory settings.
            </p>

            <div class="text-muted mb-4 px-lg-5">
                <h5 class="text-dark fw-bold mb-2">Key Features:</h5>
                <ul class="list-unstyled ps-3">
                    <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i><strong>Multi-Task Learning (MTL):</strong> Simultaneously detects DRR (classification) and assesses severity (regression).</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i><strong>High Performance:</strong> The top-performing ViT MTL model achieves 94% diagnostic accuracy and an RMSE of 1 for severity prediction.</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i><strong>Architectural Diversity:</strong> Features both CNN and Vision Transformer (ViT) model implementations.</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i><strong>Data Generalisation:</strong> Trained and validated on three distinct image modalities (camera, root scanner, and microscope) using a comprehensive in-house dataset of 10,800 images.</li>
                </ul>
                <p class="mt-3">Access the best-performing models for each modality via the links below.</p>
            </div>

            <p class="text-muted mb-5 px-lg-5">
                Developed by Priya et al., these vision-based models identify Dry Root Rot and assign severity scores (1–5).
                The high-performing architectures were quantized for the RootRot-AI portal and mobile application.
            </p>

            <div class="row g-4 px-lg-5">
                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm transition-hover border-start border-primary border-4">
                        <div class="card-header bg-primary text-white py-3">
                            <h4 class="mb-0">ViT 2cls-1R E</h4>
                            <span class="badge bg-light text-primary">Universal Modality</span>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-around mb-3 text-secondary text-center">
                                    <span><i class="fas fa-camera fa-2x"></i><br><small>Camera</small></span>
                                    <span><i class="fas fa-print fa-2x"></i><br><small>Scanner</small></span>
                                </div>
                                <p class="card-text text-start">
                                    A multitask Vision Transformer designed for simultaneous binary classification (DRR vs. Control) and regression-based severity estimation (1–5).
                                </p>
                            </div>

                            <div class="text-end mt-3">
                                <a href="https://github.com/scipdatabase/DRR_Disease_Prediction/tree/main/new_2cls_1R_trained_ViT_E_7_eps_500_bs_32_onlyControlDRR"
                                    class="btn btn-outline-primary btn-sm"
                                    target="_blank"
                                    rel="noopener noreferrer">
                                    <i class="fab fa-github me-1"></i> View Model
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 border-0 shadow-sm transition-hover border-start border-primary border-4">
                        <div class="card-header bg-primary text-white py-3">
                            <h4 class="mb-0">ViT 2cls-1R A3</h4>
                            <span class="badge bg-light text-primary">Microscope Specialized</span>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-around mb-3 text-secondary text-center">
                                    <span><i class="fas fa-microscope fa-2x"></i><br><small>Microscope</small></span>
                                </div>
                                <p class="card-text text-start">
                                    Optimized exclusively for microscopic inputs. This TensorFlow-based model delivers high-precision binary classification and severity grading for cellular-level pathology.
                                </p>
                            </div>

                            <div class="text-end mt-3">
                                <a href="https://github.com/scipdatabase/DRR_Disease_Prediction/tree/main/new_2cls_1R_trained_ViT_A3_eps_200_bs_32_onlyControlDRR"
                                    class="btn btn-outline-primary btn-sm"
                                    target="_blank"
                                    rel="noopener noreferrer">
                                    <i class="fab fa-github me-1"></i> View Model
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="https://github.com/scipdatabase/DRR_Disease_Prediction"
                    target="_blank"
                    class="btn btn-primary btn-lg px-5 rounded-pill shadow">
                    <i class="fab fa-github me-2"></i> Access Model Repository
                </a>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>