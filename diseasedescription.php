<?php
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Disease description</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --soft-bg: #f8fafc;
            --primary-blue: #0d6efd;
        }

        html,
        body {
            height: 100vh;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: var(--soft-bg);
            font-family: 'Inter', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        header,
        .navbar,
        footer {
            flex-shrink: 0;
        }

        .main-viewport-content {
            flex-grow: 1;
            min-height: 0;
        }

        .equal-height-card {
            background: white;
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            height: 100%;
            width: 100%;
            min-height: 500px;
            overflow: hidden;
        }

        .scrollable-body {
            overflow-y: auto;
            flex: 1 1 auto;
            padding-right: 4px;
            min-height: 0;
        }

        .scrollable-body::-webkit-scrollbar {
            width: 5px;
        }

        .scrollable-body::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .scrollable-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .lead-text {
            font-family: 'Cambria', serif;
            line-height: 1.6;
            color: #334155;
            font-size: 1.05rem;
            text-align: justify;
        }

        .symptom-highlight {
            background: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 1rem;
            font-style: italic;
            font-size: 0.95rem;
        }

        #mainCarousel {
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 0;
        }

        .carousel-inner {
            flex: 1 1 auto;
            min-height: 0;
            border-radius: 12px;
            overflow: hidden;
            background: #f1f5f9;
        }

        .carousel-item,
        .carousel-container {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* Automated fluid sizing wrapper for images */
        .zoom-container {
            flex: 1 1 auto;
            height: 0;
            min-height: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .img-zoomable {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.5s ease;
        }

        .zoom-container:hover .img-zoomable {
            transform: scale(1.05);
        }

        /* Balanced captions area with layout protection caps */
        .caption-box {
            flex: 0 0 auto;
            max-height: 85px;
            overflow-y: auto;
            padding: 10px 15px;
            background: #fff;
            font-size: 0.85rem;
            border-top: 1px solid #e2e8f0;
        }

        .caption-box::-webkit-scrollbar {
            width: 3px;
        }

        .caption-box::-webkit-scrollbar-thumb {
            background: #cbd5e1;
        }

        #scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: var(--primary-blue);
            z-index: 9999;
        }

        /* Custom Modern Modal Overlay Style Context */
        .custom-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 1040;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .custom-modal-overlay.active {
            display: block;
            opacity: 1;
        }

        .custom-modal-card {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.95);
            width: 90%;
            max-width: 800px;
            background: white;
            z-index: 1050;
            display: none;
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .custom-modal-card.active {
            display: block;
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    </style>
</head>

<body>

    <div id="scroll-progress"></div>

    <div class="container-fluid main-viewport-content py-5">
        <div class="row h-100 g-3 align-items-stretch">

            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card equal-height-card p-3">

                    <div class="border-bottom pb-1 mb-2">
                        <h2 class="text-primary fw-bold mb-0" style="font-size: 1.4rem;">
                            <i class="fas fa-seedling me-2"></i>Dry Root Rot (DRR)
                        </h2>
                    </div>

                    <div class="scrollable-body">
                        <p class="lead-text mb-2">
                            Dry root rot disease, caused by <em>Macrophomina phaseolina</em>, is a significant threat to global crop productivity. It is capable of causing up to 100% yield loss.
                        </p>
                        <br>
                        <h4 class="text-primary fw-bold mb-2" style="font-size: 1.1rem;">Morphological Symptoms</h4>
                        <ul class="lead-text mb-3" style="padding-left: 1.25rem;">
                            <li>Affected plants are easily uprooted due to root rot and often leave behind broken primary roots in the soil.</li>
                            <li>Straw-yellowing of leaves followed by sudden premature drying.</li>
                            <li>Visible black microsclerotia within root tissues (bark, cortex, and pith).</li>
                            <li>Vascular bundles blockage impairing water and nutrient transport.</li>
                        </ul>

                        <div class="mb-2 p-2 bg-light rounded border-start border-primary border-4">
                            <h6 class="fw-bold text-primary mb-2"><i class="fa-solid fa-clock me-1"></i>Infection Timeline</h6>
                            <div class="row text-center g-2">
                                <div class="col-4">
                                    <div class="badge bg-primary mb-1" style="font-size: 0.7rem;">Phase 1</div>
                                    <p class="small mb-0 fw-bold" style="font-size: 0.75rem;">Seedling<br><span class="text-muted fw-normal" style="font-size: 0.7rem;">Latent</span></p>
                                </div>
                                <div class="col-4 border-start">
                                    <div class="badge bg-warning text-dark mb-1" style="font-size: 0.7rem;">Phase 2</div>
                                    <p class="small mb-0 fw-bold" style="font-size: 0.75rem;">60-80 DAS<br><span class="text-muted fw-normal" style="font-size: 0.7rem;">Drying</span></p>
                                </div>
                                <div class="col-4 border-start">
                                    <div class="badge bg-success mb-1" style="font-size: 0.7rem;">Phase 3</div>
                                    <p class="small mb-0 fw-bold" style="font-size: 0.75rem;">90-120 DAS<br><span class="text-muted fw-normal" style="font-size: 0.7rem;">Senescence</span></p>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="openPopupBtn" class="btn btn-link text-success fw-bold p-0 mt-1 text-decoration-none">
                            Read More <i class="fas fa-arrow-right ms-1 small"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card equal-height-card p-3">

                    <div class="border-bottom pb-1 mb-2">
                        <h3 class="fw-bold text-primary mb-0" style="font-size: 1.4rem; text-align: center;">
                            <i class="me-2"></i>Prevalence and epidemiology of DRR disease
                        </h3>
                    </div>

                    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Dd1.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Global map illustrating the distribution of DRR disease, overlaid with country-specific data depicting 10-year average annual chickpea production, localized disease incidence, and drought stress indices across major cultivation zones
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Dd2.jpg" class="img-zoomable" alt="Yield Loss">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            India map depicting state-wise average annual chickpea production, dry root rot disease incidence, and meteorological subdivision-wise winter season rainfall
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Dd3.jpg" class="img-zoomable" alt="Aerial View">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Yield loss (kilograms per hectare) observed under DRR disease (pathogen) and its combination with drought stress
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Dd4.jpg" class="img-zoomable" alt="Typical Symptoms">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Aerial view of a chickpea field moderately infected with DRR at the reproductive stage
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Dd5.jpg" class="img-zoomable" alt="Farmer Field">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Detailed view of the field shows chickpea plants with typical symptoms
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Dd6.jpg" class="img-zoomable" alt="Genotype Screening">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Chickpea genotype screening under sick plot
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Pd14.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Disease cycle of dry root rot. The disease cycle begins with (A) microsclerotia surviving in the soil, which (B) germinate and attach to the root epidermis upon sensing host exudates. The mycelia then form (C) appressoria to penetrate cells, causing local necrosis, before (D) growing intercellularly to establish the infection. As the plant matures, (E) secondary inoculum causes lateral root loss and foliar yellowing, leading to (F) extensive root necrosis and total foliage yellowing. The cycle ends with (G) premature drying and the formation of new daughter microsclerotia within the brittle, rotted roots.
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Dd7.jpg" class="img-zoomable" alt="Disease Cycle">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            DRR disease cycle and symptom development
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Dd8.jpg" class="img-zoomable" alt="Deficient Tap Root">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Typical symptoms of straw-yellow-colored leaves and tap root devoid of lateral roots
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Dd9.jpg" class="img-zoomable" alt="Microsclerotia Vasculature">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Typical black punctate structures known as microsclerotia in the vasculature
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Dd10.jpg" class="img-zoomable" alt="Transverse Section">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Transverse section showing microsclerotia in the cortex and vasculature
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Dd11.jpg" class="img-zoomable" alt="Confocal Imaging">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Confocal imaging depicting <em>Macrophomina phaseolina</em> induced tissue necrosis in the transverse section of chickpea root
                                        </h6>
                                    </div>
                                </div>
                            </div>
			</div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true" style="width: 2rem; height: 2rem;"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true" style="width: 2rem; height: 2rem;"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalOverlay" class="custom-modal-overlay"></div>
    <div id="popup" class="custom-modal-card shadow-lg rounded-4 border p-3">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
            <h5 class="fw-bold text-success mb-0"><i class="fas fa-book-open me-2"></i>Disease description</h5>
            <span id="closeBtn" style="cursor: pointer; font-size: 1.5rem; color: #888;">&times;</span>
        </div>

        <div id="tableContainer" style="max-height: 65vh; overflow-y: auto; padding-right: 5px;">
            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                DRR disease, caused by <em>Macrophomina phaseolina (Tassi) Goid</em>. is a significant threat to global crop productivity, capable of causing up to 100% yield loss in susceptible cultivars under favourable conditions (<a href="https://doi.org/10.4236/ajps.2013.44116" target="_blank">Ghosh et al., 2013; <a href=" https://doi.org/10.1080/03235408.2016.1140564" target="_blank">Sharma & Kumar, 2015; <a href="https://doi.org/10.1007/s40011-023-01451-w" target="_blank">Mirchandani et al., 2023; <a href="https://doi.org/10.1094/PDIS-07-21-1410-FE" target="_blank">Rai et al., 2021</a>). It is particularly widespread in chickpea-growing regions and is aggravated under environmental stressors like drought and high-temperature (<a href="https://doi.org/10.1094/PDIS-07-21-1410-FE" target="_blank">Rai et al., 2021; <a href="https://doi.org/10.3389/fpls.2022.890551" target="_blank">Chilakala et al., 2022; <a href="https://api.semanticscholar.org/CorpusID:4058687" target="_blank">Singh & Kumar, 2013;</a>).
            </p>
            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                Under field conditions, DRR in chickpea is characterized by straw-yellowing of leaves followed by sudden premature drying of plants, typically occurring after flowering. In the field, DRR-affected plants appear in irregularly shaped patches of straw-colored, dried plants unevenly distributed across the field, as revealed by UAV-based imaging. Symptom severity ranges from small, localized patches under mild infection to extensive coalescing patches under moderate infection, and complete field-wide drying under severe infection (<a href="https://doi.org/10.1094/PDIS-07-21-1410-FE" target="_blank">Rai et al., 2021</a>). Although infection may occur at the seedling stage, visible foliar symptoms usually appear during the reproductive phase, beginning with progressive yellowing from the lower to upper leaves during the transition from vegetative to flowering stages. Unlike Fusarium wilt, DRR-affected plants do not wilt but remain upright with straw-colored shoots and a brownish shoot base.
            </p>
            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                Typical root symptoms include brownish to black lesions on the taproot and lateral roots, followed by progressive necrosis caused by <em>Macrophomina phaseolina</em>. As the infection advances, necrosis leads to the shedding of lateral and finer roots, resulting in brittle, rotten primary roots and a near-complete absence of lateral roots under severe infection. Affected plants are easily uprooted due to root rot and often leave behind broken primary roots in the soil. Advanced DRR is characterized by dark, asymmetric lesions on the root epidermis, with the taproot remaining blackish-brown but structurally intact, while the bark, cortex, and finer roots are destroyed. Numerous black microsclerotia are visible within the root tissues, including the bark, cortex, and pith (<a href="https://doi.org/10.1038/s41598-019-41463-z" target="_blank">Sinha et al., 2019</a>). The accumulation of fungal microsclerotia and mycelia likely blocks the stele and vascular bundles, impairing water and nutrient transport and causing sudden premature foliar yellowing and drying (<a href="https://doi.org/10.1094/MPMI-07-21-0195-FI" target="_blank">Irulappan et al., 2022</a>). Premature drying occurs at 60–80 days after sowing with underdeveloped pods, in contrast to healthy plants that senesce only at physiological maturity (90–120 DAS), allowing clear differentiation between DRR infection and normal plant aging (<a href="https://doi.org/10.1094/PDIS-07-21-1410-FE" target="_blank">Rai et al., 2021</a>).
            </p>
            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                Under controlled laboratory conditions where artificial inoculation is carried out the symptoms include root necrosis, which progresses to full root discoloration, while new roots free from infection are often observed in moderately resistant genotypes (<a href="https://doi.org/10.3791/61702" target="_blank">Irulappan & Senthil-Kumar, 2021</a>). Under sick pot conditions, symptoms include root necrosis and straw yellow-colored leaves.
            </p>
            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                Currently, DRR disease assessment relies on manual methods, involving visual scoring of root symptoms based on the degree of disease expression (<a href="https://doi.org/10.1094/MPMI-07-21-0195-FI" target="_blank">Irulappan et al., 2021; <a href="https://doi.org/10.3791/61702" target="_blank">Irulappan & Senthil-Kumar, 2021</a>). However, manual disease scoring is highly subjective, prone to bias, and cumbersome for early disease detection and for assessing large plant populations. Furthermore, it is often prone to diagnostic errors, given that multiple other biotic and abiotic stress factors cause similar phenotypes. These limitations hamper large-scale disease screening projects, such as screening the entire germplasm collections for DRR resistance. To overcome these constraints in disease identification, image-based approaches leveraging computer vision and deep learning architectures offer a transformative solution for accurate prediction of DRR. The intervention of AI/ML frameworks can accurately differentiate complex DRR phenotypes from other stresses with high precision and serve as a convenient and high-throughput means for disease assessment, warranting a framework for DRR disease detection and assessment through digital image analysis (<a href="https://spj.science.org/doi/abs/0010.34133/plantphenomics.30049" target="_blank">Deng et al., 2023; <a href="https://doi.org/https://doi.org/10.1016/j.neucom.2017.06.023" target="_blank">Yang et al., 2017; <a href="https://www.mdpi.com/2073-4395/12/11/2784" target="_blank">Yang et al., 2022</a>). This approach enables automated, objective, and high-throughput disease assessment, establishing a vital digital framework for rapid, non-destructive detection and assessment, and accelerates the selection of resistant varieties.
            </p>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialization of Scroll Progress Indicator
            const scrollProgress = document.getElementById('scroll-progress');
            const scrollableBody = document.querySelector('.scrollable-body');

            if (scrollableBody) {
                scrollableBody.addEventListener('scroll', () => {
                    const totalScroll = scrollableBody.scrollHeight - scrollableBody.clientHeight;
                    const scrollPercentage = (scrollableBody.scrollTop / totalScroll) * 100;
                    scrollProgress.style.width = scrollPercentage + '%';
                });
            }

            // Modal Interactivity Handlers
            const openBtn = document.getElementById('openPopupBtn');
            const closeBtn = document.getElementById('closeBtn');
            const popup = document.getElementById('popup');
            const overlay = document.getElementById('modalOverlay');

            const openBox = () => {
                popup.style.display = 'block';
                overlay.style.display = 'block';
                setTimeout(() => {
                    popup.classList.add('active');
                    overlay.classList.add('active');
                }, 10);
            };

            const closeBox = () => {
                popup.classList.remove('active');
                overlay.classList.remove('active');
                setTimeout(() => {
                    popup.style.display = 'none';
                    overlay.style.display = 'none';
                }, 300);
            };

            openBtn.addEventListener('click', openBox);
            closeBtn.addEventListener('click', closeBox);
            overlay.addEventListener('click', closeBox);

            // Escape Key Trigger context
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && popup.classList.contains('active')) {
                    closeBox();
                }
            });

            // Initialize Animations
            AOS.init({
                duration: 800,
                once: true
            });
        });
    </script>
</body>

</html>
