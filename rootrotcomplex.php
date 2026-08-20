<?php
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Root rot complex</title>
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
        .navbar {
            flex-shrink: 0;
            z-index: 1030;
            position: relative;
        }

        footer {
            flex-shrink: 0;
        }

        .main-viewport-content {
            flex-grow: 1;
            min-height: 0;
            overflow: hidden;
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
            min-height: 0;
            /* Changed from 500px to allow scaling on smaller screen viewports */
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

    <div class="container-fluid main-viewport-content py-2">
        <div class="row h-100 g-3 align-items-stretch">

            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card equal-height-card p-2">

                    <div class="border-bottom pb-1 mb-2">
                        <h2 class="text-primary fw-bold mb-0" style="font-size: 1.4rem;">
                            <i class="fas fa-seedling me-2"></i>Root Rot Complex
                        </h2>
                        </div>
                        <p class="lead mb-2 small">
                            The DRR–wilt complex is a synergistic interaction of multiple soil-borne pathogens, primarily <em>Macrophomina phaseolina</em> and <em>Fusarium oxysporum</em>.
                        </p>

                    <div class="scrollable-body">
                        <div class="row g-3 mb-2 text-center">
                            <div class="col-6 col-md-3">
                                <div class="p-2 border rounded bg-light shadow-sm"><strong>Dry Root Rot</strong><br><small class="text-muted"><em>Macrophomina phaseolina</em></small></div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-2 border rounded bg-light shadow-sm"><strong>Wilt</strong><br><small class="text-muted"><em>Fusarium oxysporum</em></small></div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="p-2 border rounded bg-light shadow-sm"><strong>Black Root Rot</strong><br><small class="text-muted"><em>Fusarium solani</em></small></div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="p-2 border rounded bg-light shadow-sm"><strong>Wet Rot</strong><br><small class="text-muted"><em>Rhizoctonia solani</em></small></div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="p-2 border rounded bg-light shadow-sm"><strong>Collar Rot</strong><br><small class="text-muted"><em>Sclerotium rolfsii</em></small></div>
                            </div>
                        </div>
			<br>
                        <h6 class="fw-bold mb-2">Phytohormonal Defense Trade-offs</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered align-middle small mb-1">
                                <thead class="table-light">
                                    <tr>
                                        <th>Hormone Group</th>
                                        <th>Effect</th>
                                        <th>Impact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Defense (JA/SA)</strong></td>
                                        <td>Immunity against necrotrophs.</td>
                                        <td class="text-success fw-bold">Upregulated</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Growth (Auxins)</strong></td>
                                        <td>Lateral root development.</td>
                                        <td class="text-danger fw-bold">Suppressed</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <button type="button" id="openPopupBtn" class="btn btn-link text-success fw-bold p-0 mt-1 text-decoration-none small">
                            Read More <i class="fas fa-arrow-right ms-1 small"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card equal-height-card p-3">

                    <div class="border-bottom pb-1 mb-2">
                        <h3 class="fw-bold text-primary mb-0" style="font-size: 1.4rem; text-align: center;">
                            DRR associated disease complex
                        </h3>
                    </div>

                    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/RRC1.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            An UAV drone image of an open chickpea field infected with DRR associated disease complex
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/RRC2.jpg" class="img-zoomable" alt="Yield Loss">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            The field images show a progression from healthy green chickpea plants to highly infected areas with disease complex. Detailed views distinguish specific symptoms of of the disease complex
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/RRC3.jpg" class="img-zoomable" alt="Aerial View">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Percent contribution of each disease complex in the diseased plots as obtained from survey of two open fields (Location 5) during summer (2021-22)
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/RRC4.jpg" class="img-zoomable" alt="Aerial View">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Characteristic symptoms of chickpea plants affected by the root rot complex
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
            <h5 class="fw-bold text-success mb-0"><i class="fas fa-book-open me-2"></i>Root Rot Complex</h5>
            <span id="closeBtn" style="cursor: pointer; font-size: 1.5rem; color: #888;">&times;</span>
        </div>

        <div id="tableContainer" style="max-height: 65vh; overflow-y: auto; padding-right: 5px;">
            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                The DRR wilt disease complex represents a significant and escalating threat to global chickpea productivity. Unlike individual diseases, the DRR–wilt complex is characterized by a collection of symptoms driven by the synergistic interaction of multiple soil-borne fungal pathogens. The primary causal agents are <em>Macrophomina phaseolina</em> and <em>Fusarium oxysporum</em>, which cause DRR and Fusarium wilt, respectively. However, field environments frequently harbor a broader spectrum of pathogens, including <em>Rhizoctonia solani</em> (wet root rot), <em>Fusarium solani</em> (black root rot), and <em>Sclerotium rolfsii</em> (collar rot), all of which may contribute to progressive root system deterioration (<a href="https://doi.org/10.1016/j.fcr.2023.108965" target="_blank">Chilakala et al., 2023</a>).
            </p>
            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                Infected plants exhibit diverse yet interrelated symptoms that require careful differentiation from those caused by individual root rot pathogens. Aboveground symptoms generally include erect, desiccated stalks bearing straw-colored leaves, characteristic of DRR, or wilted, prostrate plants with chlorotic foliage, typical of Fusarium wilt. Belowground damage is severe and includes browning, tissue discoloration, and extensive loss of lateral roots. Upon longitudinal sectioning, vascular discoloration attributable to the wilt pathogen is often observed, accompanied by dark microsclerotia embedded within the root cortex and pith—hallmark features of DRR. The co-occurrence of these typical symptoms confirms the presence of a disease complex rather than a single-pathogen infection (<a href="https://doi.org/10.1016/j.fcr.2023.108965" target="_blank">Chilakala et al., 2023</a>).
            </p>
            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                Environmental stress, particularly drought, acts as a critical modulator, exacerbating the incidence and severity of the root rot complex. Although certain pathogens, such as S. rolfsii, are favored by high soil moisture, drought conditions intensify the DRR–wilt complex. Under drought conditions, <em>M. phaseolina</em> frequently emerges as the predominant pathogen, as DRR symptoms and pathogen load increase, vascular discoloration typically associated with wilt may decline in relative prominence. Thus, drought shifts the composition of the disease complex toward DRR dominance, which becomes the principal determinant of disease severity (<a href="https://doi.org/10.1016/j.fcr.2023.108965" target="_blank">Chilakala et al., 2023</a>). Drought also alters the rhizosphere microbial community, leading to a pathogen-dominated community. Metagenomic analyses indicate that drought conditions enhance fungal populations, particularly pathotrophic taxa, while suppressing beneficial symbiotrophs, including nitrogen-fixing bacteria, thereby further compromising host resilience. The combined pressure of drought stress and multi-pathogen infection creates a more susceptible environment than either factor alone.
            </p>
            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                The association between <em>M. phaseolina</em> and <em>F. oxysporum</em> intensifies as the plant matures, with pathogen loads increasing until stabilization following flowering. Disease severity typically peaks during the podding stage, a critical period for yield determination. Combined infection induces a severe physiological drought. Even in the presence of residual soil moisture, the compromised root system becomes functionally impaired and unable to efficiently transport water to aerial tissues due to the clogging of xylem vessels by the mycelia and microsclerotia of <em>M. phaseolina</em>, leading to complete hydraulic failure that halts upward water transport and triggers rapid vascular collapse. This internal water deficit is reflected in canopy temperature measurements, wherein infected plants exhibit lower canopy temperature depression (CTD) relative to plants subjected to drought stress alone. Elevated canopy temperatures indicate that pathogen-induced vascular dysfunction imposes a more severe limitation on water regulation than drought stress alone (<a href="https://doi.org/10.1016/j.fcr.2023.108965" target="_blank">Chilakala et al., 2023</a>). Consequently, photosynthetic efficiency declines and pod weight is reduced, resulting in substantial yield loss. In susceptible genotypes such as JG 62, drought conditions may exacerbate yield reductions from approximately 35% to as high as 60% (<a href="https://doi.org/10.1016/j.fcr.2023.108965" target="_blank">Chilakala et al., 2023</a>).
            </p>
            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                Chickpea responses to the root rot complex are mediated through intricate phytohormonal signaling networks, where the jasmonic acid (JA), and salicylic acid (SA) pathways drive defense against necrotrophic pathogens, with SA-mediated signaling critical under combined pathogen stress. However, activation of these pathways imposes a substantial growth–defense trade-off, where the suppression of growth-promoting hormones, including auxins, cytokinins, and gibberellins limits root recovery by negatively affecting lateral root development and rhizobial colonization, limiting root system recovery and functional resilience. This suggests that the physiological disruption commences during the vegetative stage before visible symptoms peak later during reproductive development.
            </p>
            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                Management of the DRR–wilt complex remains challenging, as fungicidal strategies optimized for individual pathogens often fail to address the multifaceted microbial interactions present under field conditions. A pragmatic approach to crop improvement involves incorporating drought-tolerant germplasm into breeding programs to enhance resilience to concurrent biotic and abiotic stresses. Additionally, early detection technologies, including hyperspectral and multispectral imaging, provide promising tools for identifying disease onset during the vegetative stage, thereby enabling timely intervention prior to irreversible damage during the reproductive phase.
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
                    const scrollPercentage = totalScroll > 0 ? (scrollableBody.scrollTop / totalScroll) * 100 : 0;
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

            if (openBtn) openBtn.addEventListener('click', openBox);
            if (closeBtn) closeBtn.addEventListener('click', closeBox);
            if (overlay) overlay.addEventListener('click', closeBox);

            // Escape Key Trigger context
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && popup.classList.contains('active')) {
                    closeBox();
                }
            });

            AOS.init({
                duration: 800,
                once: true
            });
        });
    </script>
</body>

</html>
