<?php
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pathogen description</title>
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
            max-width: 100%;            
            width: auto;
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

    <div class="container-fluid main-viewport-content py-5">
        <div class="row h-100 g-3 align-items-stretch">
            
            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card equal-height-card p-3">

                    <div class="border-bottom pb-1 mb-2">
                        <h5 class="text-primary fw-bold mb-0" style="font-size: 1.4rem;">
                            <i class="fa-solid fa-microscope me-1"></i>Pathogen Profile
                        </h5>
                    </div>

                    <div class="scrollable-body">
                        <div class="pathogen-intro mb-2">
                            <h6 class="text-secondary mb-0" style="font-size: 0.95rem; line-height: 1.5;">
                                <em>Macrophomina phaseolina</em> (Tassi) Goid, a soil-borne, necrotrophic ascomycete, is the primary driver of dry root rot across a wide range of host plants.
                            </h6>
                        </div>

                        <h6 class="fw-bold mb-2 text-dark mt-3" style="font-size: 1.05rem;">
                            <i class="text-primary me-1"></i>Salient morphological features
                        </h6>
                        
                        <div class="row g-2 mb-3">
                            <div class="col-md-4">
                                <div class="p-2 border rounded bg-light h-100">
                                    <span class="fw-bold text-success d-block" style="font-size: 0.85rem;">Microsclerotia</span>
                                    <p class="text-muted mb-0" style="font-size: 0.8rem; line-height: 1.4;">Dark, resilient structures (50–150 µm) built for multi-season soil survival.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-2 border rounded bg-light h-100">
                                    <span class="fw-bold text-success d-block" style="font-size: 0.85rem;">Hyphal branching</span>
                                    <p class="text-muted mb-0" style="font-size: 0.8rem; line-height: 1.4;">Characteristic 90° right-angle branching layout; mycelia are septate and multinucleate.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="p-2 border rounded bg-light h-100">
                                    <span class="fw-bold text-success d-block" style="font-size: 0.85rem;">Melanin barrier</span>
                                    <p class="text-muted mb-0" style="font-size: 0.8rem; line-height: 1.4;">Acts as a free radical scavenger shielding hyphae against host-derived ROS defense.</p>
                                </div>
                            </div>
                        </div>

                        <h6 class="fw-bold mb-2 text-dark" style="font-size: 1.05rem;">
                            <i class="me-1 text-primary"></i>Molecular vs Environment
                        </h6>
                        <div class="table-responsive mb-3">
                            <table class="table table-sm table-hover border align-middle mb-0" style="font-size: 0.8rem;">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="py-1">Environment</th>
                                        <th class="py-1">Host defense status</th>
                                        <th class="py-1">Fungal progression</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold text-info py-1">Well-watered</td>
                                        <td class="py-1">Upregulation of <em>ESB1</em> & <em>LACS2</em></td>
                                        <td class="text-success fw-bold py-1">Restricted to cortex</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold text-warning py-1">Drought stress</td>
                                        <td class="py-1">Downregulation of ROS/JA signaling</td>
                                        <td class="text-danger fw-bold py-1">Vascular invasion</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="p-2 timeline-mini shadow-sm mb-2 border rounded bg-light">
                            <h6 class="fw-bold mb-2 text-primary text-center" style="font-size: 0.95rem;">Infection Chronology Summary</h6>
                            <div class="row text-center g-1">
                                <div class="col-3">
                                    <div class="fw-bold text-primary" style="font-size: 0.85rem;">01. Attach</div>
                                    <div class="text-muted" style="font-size: 0.7rem;">Germ-tubes grow</div>
                                </div>
                                <div class="col-3">
                                    <div class="fw-bold text-primary" style="font-size: 0.85rem;">02. Penetrate</div>
                                    <div class="text-muted" style="font-size: 0.7rem;">Appressorium entry</div>
                                </div>
                                <div class="col-3">
                                    <div class="fw-bold text-primary" style="font-size: 0.85rem;">03. Colonize</div>
                                    <div class="text-muted" style="font-size: 0.7rem;">Cortical run</div>
                                </div>
                                <div class="col-3">
                                    <div class="fw-bold text-primary" style="font-size: 0.85rem;">04. Systemic</div>
                                    <div class="text-muted" style="font-size: 0.7rem;">Vascular breach</div>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="openPopupBtn" class="btn btn-link text-success fw-bold p-0 mt-2 text-decoration-none">
                            Read More <i class="fas fa-arrow-right ms-1 small"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card equal-height-card p-3">

                    <div class="border-bottom pb-1 mb-2">
                        <h3 class="fw-bold text-primary mb-0" style="font-size: 1.4rem; text-align: center;">
                            Pathogen morphology and post-colonization
                        </h3>
                    </div>

                    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Pd1.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            <em>Macrophomina phaseolina</em> growing on a PDA plate
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Pd2.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Microscopic images of <em>Macrophomina phaseolina</em> hyphae
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Pd3.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Microscopic characterization of <em>Macrophomina phaseolina</em> illustrating multinucleate nature of fungi
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Pd4.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Confocal image showing the initiation of hyphal extension (yellow arrows) and a complete hyphal fusion (white arrow) on the root surface
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Pd5.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Microscopic view of microsclerotia
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Pd6.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Scanning electron microscopy images representing mature microsclerotia in chickpea roots
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Pd7.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Surface view of <em>Macrophomina phaseolina</em> infection stages in the chickpea root epidermis
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Pd8.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Transverse section showing the attachment of microsclerotia
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Pd9.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Transverse section of a chickpea root showing intercellular colonization of cortex cells by <em>Macrophomina phaseolina</em>
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Pd10.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Transverse section of chickpea root illustrating hyphal branching and intracellular colonization
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Pd11.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Formation of microsclerotia in the chickpea root transverse section
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Pd12.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Confocal laser scanning micrograph showing complete colonization of the root cortex by <em>Macrophomina phaseolina</em>. Ep-Epidermis, C-Cortex, En-Endodermis, S-Stele 
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <div class="carousel-container">
                                    <div class="zoom-container">
                                        <img src="Images/Pd13.jpg" class="img-zoomable" alt="Disease Map">
                                    </div>
                                    <div class="caption-box">
                                        <h6 class="mb-0 text-center text-dark fw-normal">
                                            Endodermal breaching during <em>Macrophomina phaseolina</em> colonization of chickpea roots. C-Cortex, En-Endodermis, S-Stele
                                        </h6>
                                    </div>
                                </div>
                            </div>

                        </div> <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
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
            <h5 class="fw-bold text-success mb-0"><i class="fas fa-book-open me-2"></i><em>Macrophomina phaseolina (Tassi) Goid</em></h5>
            <span id="closeBtn" style="cursor: pointer; font-size: 1.5rem; color: #888;">&times;</span>
        </div>

        <div id="tableContainer" style="max-height: 65vh; overflow-y: auto; padding-right: 5px;">
            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                <em>Macrophomina phaseolina</em> (Tassi) Goid. is a soil-borne, hemi-biotrophic ascomycete fungal pathogen with a broad host range, infecting more than 97 crops (<a href="https://doi.org/https://doi.org/10.1111/j.1439-0434.2012.01884.x" target="_blank">Gupta et al., 2012; <a href="https://doi.org/10.1186/1471-2164-13-493" target="_blank">Islam et al., 2012; <a href="https://doi.org/10.3109/1040841X.2011.640977" target="_blank">Kaur et al., 2012</a>). Classified under the division Ascomycota based on the morphology and sequence data, the fungus exists as mycelia and microsclerotia within the soil and chickpea plants. The fungus reproduces primarily through fragmentation of vegetative structures since neither pycnidia nor a sexual stage has been reported to date in chickpea. While the fungus causes several diseases across a diverse range of crop species, ranging from conifers to angiosperms, DRR remains the only major disease where the sporulating stage has not yet been observed (<a href="https://doi.org/10.1080/03235408.2016.1140564" target="_blank">Mamta Sharma & Suresh, 2015</a>). The primary source of infection is microsclerotia, black punctate structure present in the soil, capable of withstanding extreme environmental conditions for several months, the primary cause for a wide distribution and host range (<a href="https://doi.org/10.1080/03235408.2016.1140564" target="_blank">Mamta Sharma & Suresh, 2015</a>).
            </p>
            <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                The typical morphological features of <em>M. phaseolina</em> are hyphae, microsclerotia, mycelia, right-angle mycelial branching, multinucleate septate mycelia, cross-wall formation at the beginning of new branching mycelia, and partial hyphal fusion (<a href="https://doi.org/10.1094/MPMI-07-21-0195-FI" target="_blank">Irulappan et al., 2022</a>). The hyphae are thin, highly variable in morphology ranging from dark brown to dark grey or black and microsclerotial distribution. The hyphal branching occurs at right angles and a constricts at the branching points to form mycelium which progress darker with age (<a href="https://doi.org/10.3389/fpls.2021.634397" target="_blank">Marquez et al., 2021</a>). Microsclerotia are hardened mass of cells that serve as the primary, dormant infection structures by which M. phaseolina maintains its viability under harsh conditions such as winter, drought, and flood (<a href="https://doi.org/10.1080/03235408.2016.1140564" target="_blank">Mamta Sharma & Suresh, 2015; <a href="https://doi.org/10.3389/fpls.2021.634397" target="_blank">Marquez et al., 2021</a>). They are the major resting structures and can survive in the soil for several years (<a href="https://doi.org/https://doi.org/10.1111/j.1439-0434.2012.01884.x" target="_blank">Gupta et al., 2012</a>). Scanning electron micrographs demonstrated that it produces a rindless type of microsclerotium, in which all of the cells have a thick cell wall. Because the microsclerotia are cemented together by a dark-pigmented gelatinous matrix, they appear rigid and dark in color. The pigmentation is most intense at the center of a microsclerotium and least at the periphery. The diameter of microsclerotia of <em>M. phaseolina</em> ranges from 50 to 150 µm (<a href="https://doi.org/10.1094/MPMI-07-21-0195-FI" target="_blank">Irulappan et al., 2022</a>).
                    <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                        Under in vitro conditions, the hyphae originating from germinating microsclerotia are hyaline, branched, and septate, forming mycelia that are usually fluffy and gray before turning dark at an advanced growth stage. The characteristic dark melanin pigments of microsclerotia are antioxidant substances that serve as free radical scavengers to reduce the concentration of intracellular reactive oxygen species. Hyphae of myceliogenic origin anastomose frequently and generally branch at a 90° angle.
                    </p>
                    <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                        The infection process begins with the attachment of microsclerotia to the root epidermis, followed by the emergence of germ-tube like structures and the formation of appressorium for penetration. During the initial biotrophic phase, the fungus colonizes the first few layers of the root cortex with minimal necrosis. As the infection progresses, the hyphae branch extensively, moving intracellularly and intercellularly, eventually colonizing all cortical cell layers (<a href="https://doi.org/10.1094/MPMI-07-21-0195-FI" target="_blank">Irulappan et al., 2022</a>). Under well-watered conditions, the pathogen’s inward progression is typically arrested at this layer due to the presence of Casparian strip, suberin deposition in the endodermal layers and pathogen-induced hyperplasia (<a href="https://doi.org/10.1094/MPMI-07-21-0195-FI" target="_blank">Irulappan et al., 2022</a>). Further, the cortical cells maintain cellular turgidity which in turn the apoplastic junction and prevent the pathogen progression to further cell layers. However, drought aggravates the pathogen progression which become systemic and breaches the endodermal barrier and invade the vasculature. This invasion of the stele is facilitated by the softening of endodermis through hypertrophy and necrosis due to the cell-wall-degrading enzymes secreted by the pathogen. The microsclerotia formed in the vasculature arrest the movement of water and nutrients to the aerial parts of the plant, ultimately leading to the death of the plant (<a href="https://doi.org/10.1094/MPMI-07-21-0195-FI" target="_blank">Irulappan et al., 2022; <a href="https://doi.org/10.1016/j.envexpbot.2025.106197" target="_blank">Mirchandani et al., 2025</a>).
                    </p>
                    <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                        The infection progression of <em>Macrophomina phaseolina</em> in chickpea is highly spatiotemporal, following a distinct movement through the root's concentric cell layers. Under well-watered conditions, the rate of colonization is slow and typically remains restricted to the root cortex. This resistance is supported by the upregulation of defense-related genes such as PER72 in the cortex and ESB1 (Enhanced Suberin 1) and LACS2 in the endodermis (<a href="https://doi.org/10.1094/MPMI-07-21-0195-FI" target="_blank">Irulappan et al., 2022; <a href="https://doi.org/10.1111/pce.14666" target="_blank">Sharma et al., 2023</a>). These genes reinforce the endodermal barrier by promoting suberin deposition and the formation of the Casparian strip, which effectively restricts the fungus in the cortical cell layers.
                    </p>
                    <p class="mb-3 text-dark" style="text-align: justify; line-height: 1.5;">
                        While wet soils reduce the survivability of microsclerotia due to the high moisture sensitivity of the pathogen (<a href="https://doi.org/https://doi.org/10.1111/j.1439-0434.2012.01884.x" target="_blank">Olaya & Abawi, 1996</a>), drought stress fundamentally alters the virulence and survivability of <em>M. phaseolina</em>, where reducing the osmotic potentials to certain level induce microsclerotia germination and mycelial growth (<a href="https://doi.org/https://doi.org/10.1146/annurev.py.10.090172.002025" target="_blank">Cook & Papendick, 1972; <a href="https://doi.org/https://doi.org/10.1111/j.1365-3059.1995.tb02729.x" target="_blank">Diourte et al., 1995; <a href="https://doi.org/10.14601/Phytopathol_Mediterr-2613" target="_blank">Odvody & Dunkle, 2006</a>), though beyond a threshold leads to subsequent decline (<a href="https://doi.org/10.14601/Phytopathol_Mediterr-2613" target="_blank">Goudarzi et al., 2008</a>). On Potato Dextrose Agar (PDA) media plates, the growth of mycelia significantly increased from -0.5 MPa water stress to -1 MPa water stress treatment compared to the control (-0.2 MPa), with maximum growth occurring at -0.7 MPa matric potential and -1 MPa osmotic potential. At this optimum -0.7 MPa treatment, mean fungal morphology diameter, mycelial weight in liquid medium, and aerial mycelia density were highest, with increased number of mature microsclerotia; Conversely, severe water stress treatments beyond -2 MPa act as a strict limiting factor, causing mycelial density, microsclerotia number, and semi dry weight to be drastically and significantly reduced (Mali Komal., 2024). Drought alters pathogen virulence by inducing extensive transcriptional reprogramming that weakens the host’s innate immunity. Under water-deficient conditions, the pathogen exploits the stress to trigger a systemic downregulation of critical defense genes involved in Reactive Oxygen Species (ROS) production and Jasmonic Acid (JA) and Ethylene (ET) signaling. This dampening of hormonal and chemical alarms allows the fungus to breach the once-impenetrable endodermis, leading to extensive colonization of the xylem, phloem, and pith regions (Mali Komal., 2024).
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

            if (openBtn) openBtn.addEventListener('click', openBox);
            if (closeBtn) closeBtn.addEventListener('click', closeBox);
            if (overlay) overlay.addEventListener('click', closeBox);

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
