<?php 
include 'counter_logic.php';
include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FAQs</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <Style>
        :root {
            --faq-bg: #fdfdfd;
        }

        .accordion-item {
            background-color: var(--faq-bg);
            border-radius: 12px !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .accordion-item:hover {
            transform: translateX(5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .accordion-button {
            padding: 1.25rem;
            border-radius: 12px !important;
            background-color: white !important;
            color: #333 !important;
        }

        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #f8fbff, #eef5ff) !important;
            color: var(--primary-blue) !important;
            box-shadow: none;
        }

        .accordion-button::after {
            background-size: 1rem;
            transition: transform 0.3s ease;
        }

        .accordion-body {
            line-height: 1.7;
            font-size: 0.95rem;
            padding-top: 0;
        }
    </Style>
</head>
<div class="ack-section py-5">
    <div class="container-fluid">
        <div class="ack-header bg-primary bg-opacity-10 py-4 mb-5 rounded-3 text-center">
            <h2 class="text-primary display-4 mb-2">
                <i class="me-3"></i><strong>Frequently Asked Questions<span class="badge bg-primary fs-6 align-middle"></span></strong>
            </h2>
            <p class="lead text-muted mb-0">Comprehensive guide to the DROP Portal, RootRotAI, and Multi-Omics datasets</p>
        </div>


        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="accordion accordion-flush" id="faqAccordion">

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-drr-definition">
                                <i class="fas fa-leaf me-3 text-success"></i> What is Dry Root Rot (DRR)?
                            </button>
                        </h2>
                        <div id="faq-drr-definition" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Dry Root Rot is a destructive soil-borne disease caused by <em>Macrophomina phaseolina</em>, affecting crops such as chickpea, soybean, groundnut, and other legumes, particularly under drought and high-temperature conditions.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-portal-purpose">
                                <i class="fas fa-info-circle me-3 text-success"></i> What is the purpose of the DRR Portal?
                            </button>
                        </h2>
                        <div id="faq-portal-purpose" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                The DRR Portal is a centralized platform that provides integrated information on disease biology, pathogen characteristics, management strategies, germplasm resources, and multi-omics datasets, along with AI-based diagnostic tools.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-symptoms">
                                <i class="fas fa-eye me-3 text-success"></i> How can I identify DRR symptoms using the portal?
                            </button>
                        </h2>
                        <div id="faq-symptoms" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Users can access the image repository or use the AI-based detection module to upload images of infected plants and receive predictions along with confidence scores.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-early-warning">
                                <i class="fas fa-exclamation-triangle me-3 text-success"></i> Does the portal provide disease prediction or early warning?
                            </button>
                        </h2>
                        <div id="faq-early-warning" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Yes, the portal integrates environmental data and predictive models to assess disease risk and provide early warning for potential outbreaks.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-ai-feature">
                                <i class="fas fa-robot me-3 text-success"></i> What is the AI-based disease detection feature?
                            </button>
                        </h2>
                        <div id="faq-ai-feature" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                The portal uses machine learning models to analyze plant images and detect DRR infection, helping in rapid and accurate diagnosis under field conditions.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-omics-access">
                                <i class="fas fa-dna me-3 text-success"></i> Can I access molecular and omics data through the portal?
                            </button>
                        </h2>
                        <div id="faq-omics-access" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Yes, the portal integrates genomics, transcriptomics, proteomics, metabolomics, and metagenomics datasets to support advanced research and integratome analysis.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-data-reliability">
                                <i class="fas fa-check-circle me-3 text-success"></i> How reliable is the information provided?
                            </button>
                        </h2>
                        <div id="faq-data-reliability" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                All data in the portal are curated from validated research studies, experimental datasets, and reputed scientific sources to ensure accuracy and reliability.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-tech-stack">
                                <i class="fas fa-code me-3 text-success"></i> What technologies are used to develop the DRR Portal?
                            </button>
                        </h2>
                        <div id="faq-tech-stack" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                The portal is developed using web technologies such as HTML5, CSS3, and JavaScript for the frontend, with backend support from PHP/Python and a relational database (MySQL/PostgreSQL).
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-model-accuracy">
                                <i class="fas fa-bullseye me-3 text-success"></i> How accurate is the RootRotAI detection model?
                            </button>
                        </h2>
                        <div id="faq-model-accuracy" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                RootRotAI 2.2 utilizes a specialized CNN architecture trained on 10,000+ validated chickpea root images, maintaining an accuracy rate of 94% across different environmental conditions.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-ml-framework">
                                <i class="fas fa-brain me-3 text-success"></i> Which machine learning framework is used?
                            </button>
                        </h2>
                        <div id="faq-ml-framework" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                The AI module is developed using TensorFlow and deployed using TensorFlow Lite for efficient, real-time inference on both web and mobile platforms.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-model-training">
                                <i class="fas fa-microscope me-3 text-success"></i> How are the AI models trained and validated?
                            </button>
                        </h2>
                        <div id="faq-model-training" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Models are trained using annotated datasets of healthy and infected plant images. Validation techniques like train-test split, cross-validation, and metrics (precision, recall, F1-score) ensure reliability.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-gis-viz">
                                <i class="fas fa-map-marked-alt me-3 text-success"></i> How is geospatial data visualized?
                            </button>
                        </h2>
                        <div id="faq-gis-viz" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                The portal uses GIS-based tools such as Leaflet and optionally Google Maps API to visualize disease hotspots and geographic distribution.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-update-freq">
                                <i class="fas fa-sync-alt me-3 text-success"></i> How frequently are AI models and datasets updated?
                            </button>
                        </h2>
                        <div id="faq-update-freq" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                AI models and datasets are periodically updated with new data to improve prediction accuracy and incorporate the latest research findings.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <div class="p-4 bg-light rounded-4 d-inline-block border">
                <p class="mb-2">Didn't find what you were looking for?</p>
                <a href="mailto:scipdb@nipgr.ac.in" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-paper-plane me-2"></i>Contact Support
                </a>
            </div>
        </div>
    </div>
    <script>
        function filterFAQs() {
            let input = document.getElementById('faqSearch');
            let filter = input.value.toLowerCase();
            let accordionItems = document.querySelectorAll('.accordion-item');

            accordionItems.forEach(item => {
                let text = item.innerText.toLowerCase();
                if (text.includes(filter)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        }
    </script>
    <?php include 'footer.php' ?>
    </body>

</html>