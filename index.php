<?php
include 'counter_logic.php';
include 'header.php';
include 'Connection.php';
include 'chatbot.php';
$count_res = $conn->query("SELECT COUNT(DISTINCT session_id) as total FROM visitor_logs");
$visitor_count = $count_res->fetch_assoc()['total'];

$ip = $_SERVER['REMOTE_ADDR'];
$session_id = session_id();

// 1. Get Country via IP (using a free API)
$details = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
$country = ($details && $details->status == 'success') ? $details->country : 'Unknown';

// 2. Check if this session is already logged for today
$check = $conn->prepare("SELECT id FROM visitor_logs WHERE session_id = ? AND DATE(visit_time) = CURDATE()");
$check->bind_param("s", $session_id);
$check->execute();
$result = $check->get_result();

if ($result->num_rows == 0) {
    // 3. Insert new visitor record
    $insert = $conn->prepare("INSERT INTO visitor_logs (ip_address, country, session_id) VALUES (?, ?, ?)");
    $insert->bind_param("sss", $ip, $country, $session_id);
    $insert->execute();
}

// 4. Get Total Global Visitors Count
$count_query = $conn->query("SELECT COUNT(DISTINCT ip_address) as total FROM visitor_logs");
$visitor_count = $count_query->fetch_assoc()['total'];

// Set variable for the footer card
$current_visitor_country = $country;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dry Root Rot Portal (DRoP)</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>

        .hero-section {
            background: linear-gradient(135deg, #E8F8FF, #96c5e0);
            padding: 3rem 0;
        }

        .hover-underline:hover {
            text-decoration: underline;
            cursor: help;
            color: #198754 !important;
        }

        .custom-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(3px);
            z-index: 1040;
            display: none;
        }

        .custom-modal-overlay.active {
            display: block;
        }

        .custom-modal-card {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            width: 95%;
            /* Increased screen area utilization on tablets/laptops */
            max-width: 900px;
            /* Allows the card to expand much wider */
            background: #ffffff;
            z-index: 1050;
            padding: 2rem;
            display: none;
            opacity: 0;
            transition: all 0.3s ease-in-out;
        }

        .custom-modal-card.active {
            display: block;
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }

        #closeBtn:hover {
            color: #dc3545 !important;
        }

        .carousel-inner {
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .carousel-item img {
            height: 380px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .carousel-item:hover img {
            transform: scale(1.05);
        }

        .carousel-item .p-2 {
            min-height: 70px;
            background: #f8f9fa;
        }

        /* ===== CARDS ===== */
        .card {
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: white;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
        }

        .sidebar-menu {
            transition: all 0.3s ease;
            background: white;
        }

        .sidebar-menu:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .sidebar-menu a {
            text-decoration: none;
            color: #555;
            transition: all 0.3s ease;
            padding: 0.5rem;
            border-radius: 6px;
            display: flex;
            align-items: center;
        }

        .sidebar-menu a:hover {
            color: #198754;
            background-color: rgba(39, 174, 96, 0.1);
            padding-left: 1rem;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>

<body>

    <section class="hero-section py-4">
        <div class="container-fluid px-3">
            <div class="row align-items-stretch">

                <div class="col-lg-5 mb-3 fade-in-up">
                    <div class="h-100 p-3 shadow-sm rounded-4 border bg-white position-relative" style="font-size: 0.95rem;">
                        <h2 class="fw-bold mb-2 text-primary" style="font-size: 1.6rem;">Dry Root Rot Portal</h2>

                        <div class="p-3 bg-light rounded border-start border-success border-4 mb-2">
                            <p class="mb-2" style="text-align: justify; line-height: 1.5; color: #212529;">
                                Dry root rot (DRR) is an emerging and highly destructive root disease affecting a wide range of crops, primarily legumes like chickpea, soybean, mung bean, pigeon pea, groundnut etc., especially in drought-prone regions and low-rainfall seasons. This disease is caused by hemibiotrophic fungus <em>Macrophomina phaseolina</em>, which eventually leads to straw-yellow leaves, root necrosis, severe root loss, and ultimately plant death (<a href="https://doi.org/10.1094/MPMI-07-21-0195-FI" target="_blank">Irulappan et al., 2022;</a> <a href="https://doi.org/10.1038/s41598-019-41463-z" target="_blank">Sinha et al. 2019;</a> <a href="https://doi.org/10.1038/s41598-021-85928-6" target="_blank">Sinha et al. 2021</a>). In farm fields, the disease typically occurs as small patches of dead plants, resulting in huge yield losses (<a href="https://doi.org/10.1007/s40011-023-01451-w" target="_blank">Mirchandani et al. 2023</a>).
                            </p>
                            <p class="mb-0" style="text-align: justify; line-height: 1.5; color: #212529;">
                                Currently, critical information related to this disease-including its host range, pathogen biology, disease epidemiology, host germplasm availability, environmental drivers, management strategies, mechanisms of host resistance, pathogen virulence, and advanced research strategies is scattered across disparate sources, while a significant amount of information remains unavailable. Hence, there is a need for a consolidated repository where all these resources and information can be systematically assembled and made accessible to the scientific community....
                            </p>
                        </div>

                        <button type="button" id="openPopupBtn" class="btn btn-link text-success fw-bold p-0 mt-1 text-decoration-none">
                            Read More <i class="fas fa-arrow-right ms-1 small"></i>
                        </button>

                        <div id="modalOverlay" class="custom-modal-overlay"></div>
                        <div id="popup" class="custom-modal-card shadow-lg rounded-4 border">
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                <h5 class="fw-bold text-success mb-0"><i class="fas fa-book-open me-2"></i>DRoP - emphasis on chickpea</h5>
                                <span id="closeBtn" style="cursor: pointer; font-size: 1.25rem; color: #888;">&times;</span>
                            </div>

                            <div id="tableContainer" style="max-height: 450px; max-width: 100%; overflow-y: auto; padding-right: 5px;">
                                <p class="mb-3" style="text-align: justify; line-height: 1.5; color: #212529;">
                                    Dry root rot is an emerging and highly destructive root disease affecting a wide range of crops, primarily legumes like chickpea, soybean, mung bean, pigeon pea, groundnut etc., especially in drought-prone regions and low-rainfall seasons. This disease is caused by hemibiotrophic fungus <em>Macrophomina phaseolina</em>, which eventually leads to straw-yellow leaves, root necrosis, severe root loss, and ultimately plant death (<a href="https://doi.org/10.1094/MPMI-07-21-0195-FI" target="_blank">Irulappan et al., 2022;</a> <a href="https://doi.org/10.1038/s41598-019-41463-z" target="_blank">Sinha et al. 2019;</a> <a href="https://doi.org/10.1038/s41598-021-85928-6" target="_blank">Sinha et al. 2021</a>). In farm fields, the disease typically occurs as small patches of dead plants, resulting in huge yield losses (<a href="https://doi.org/10.1007/s40011-023-01451-w" target="_blank">Mirchandani et al. 2023</a>).
                                </p>
                                <p class="mb-3" style="text-align: justify; line-height: 1.5; color: #212529;">
                                    Currently, critical information related to this disease-including its host range, pathogen biology, disease epidemiology, host germplasm availability, environmental drivers, management strategies, mechanisms of host resistance, pathogen virulence, and advanced research strategies is scattered across disparate sources, while a significant amount of information remains unavailable. Hence, there is a need for a consolidated repository where all these resources and information can be systematically assembled and made accessible to the scientific community.
                                </p>
                                <p class="mb-3" style="text-align: justify; line-height: 1.5; color: #212529;">
                                    Addressing this disease and expanding pathogen effectively requires a multi-pronged approach integrating innovative, out-of-the-box strategies and intelligence-driven interventions. Drought and adverse environmental and edaphic factors drive pathogen spread and host susceptibility, due to which the pathogen infects a wide host range exceeding over 97 plant species (<a href="https://doi.org/10.1094/PHYTO-05-23-0154-R" target="_blank">Pennerman et al. 2024;</a>). Consequently, the broad host range is posing an escalating threat to several economically vital crops like chickpea (<a href="https://doi.org/10.1007/s40011-023-01451-w" target="_blank">Mirchandani et al. 2023;</a> <a href="https://doi.org/10.1094/pdis-07-21-1410-fe" target="_blank">Rai et al. 2022</a>).
                                </p>
                                <p class="mb-3" style="text-align: justify; line-height: 1.5; color: #212529;">
                                    To address this, the primary objective is to identify moderately resistant sources within host germplasm and wild relatives. The first step towards achieving this involves proper diagnosis of the disease, epidemiology mapping, and determining the influence of environmental and edaphic factors on host susceptibility through artificial intelligence and machine learning-assisted interventions (<a href="https://doi.org/10.1016/j.tplants.2020.07.010" target="_blank">Singh et al. 2021</a>). Simultaneously, non-host plants must be explored, and genetic variation should be induced in host lines through mutagenesis for development of resistant cultivars. Long-term management also hinges on identifying suitable non-host plants for crop rotation, as well as the discovery of novel genes and metabolite pools that can be utilized for engineering host resistance and developing sustainable, effective, and durable biofungicides (<a href="https://doi.org/10.1016/j.envexpbot.2025.106197" target="_blank">Mirchandani et al. 2025</a>).
                                </p>
                                <p class="mb-3" style="text-align: justify; line-height: 1.5; color: #212529;">
                                    Sustainable management strategies aimed at the reduction of pathogen inoculum and improvement of soil health can be achieved through rhizosphere microbiome engineering (<a href="https://doi.org/10.1038/s41579-024-01079-1" target="_blank">Compant et al. 2025;</a> <a href="https://doi.org/10.1038/s41579-020-00446-y" target="_blank">Singh et al. 2020</a>). However, implementation of these approaches requires diverse array of tools, technologies, and experimental systems. This underscores the importance of identifying, cataloguing and curating key research information and infrastructures such as controlled laboratory, greenhouse, and field screening facilities for disease development and plant-pathogen studies within a centralized platform. Moreover, a thorough investigation and molecular understanding of plant responses to the fungus, along with fungal pathogenicity and virulence strategies is essential for the development of transgenic and gene-edited plants, as well as other targeted crop protection interventions (<a href="https://doi.org/10.1094/MPMI-07-21-0195-FI" target="_blank">Irulappan et al. 2022;</a> <a href="https://doi.org/10.1186/1471-2164-13-493" target="_blank">Islam et al. 2012</a>).
                                </p>
                                <p class="mb-3" style="text-align: justify; line-height: 1.5; color: #212529;">
                                    Important resources include field disease hotspots for evaluating developed lines under natural farm conditions across different agroclimatic zones, research plots for large-scale screening and sample collection, and facilities that enable translation of laboratory findings into field applications. In addition, controlled DRR screening facilities are essential for standardized phenotyping and disease evaluation. Information related to these facilities and resources also needs to be assembled and made available at the comprehensive repository.
                                </p>
                                <p class="mb-3" style="text-align: justify; line-height: 1.5; color: #212529;">
                                    To address this gap, we developed the Dry Root Rot Portal (DRoP), a centralized, publicly accessible knowledge repository that compiles, curates, and integrates critical information related to DRR research and management. The portal is designed to transform complex and scattered datasets into actionable intelligence, thereby facilitating advanced research and effective disease management, particularly in chickpea. The portal further curates diverse datasets and provides integrated solutions, including information on environmental determinants influencing disease development, thereby making research resources more accessible to the scientific community. This portal compiles validated and widely accepted disease management strategies and offers neural networks based predictive models for disease risk scoring, image-based diagnosis, and decision-support systems. It also provides validated protocols, methodologies, pathogen strain records, germplasm datasets, and image datasets, along with several other research resources.
                                </p>
                                <p class="mb-3" style="text-align: justify; line-height: 1.5; color: #212529;">
                                    In addition, the portal consolidates access to multi-omics datasets, including genomics, transcriptomics, metagenomics, metabolomics, proteomics, and phenomics, and presents this information in a visually engaging, user-friendly interface accessible to researchers without computational expertise. Interactive visualizations of geospatial disease distribution, disease intensity, hotspot locations, and field-level metadata are also incorporated into the repository. A key strength of this portal lies in the extensive expertise of our laboratory in disease epidemiology, infection biology, and DRR management strategies. The knowledge and research experience accumulated over the past 15 years have formed the foundation of DRoP, making it a reliable and authoritative platform for the global research community.
                                </p>

                                <div class="col-md-12 text-center mt-3">
                                    <img src="Images/Home_readmore.png" alt="Integrated approaches for DRR disease management" class="img-fluid mb-2" style="max-height: 500px; object-fit: contain;">
                                    <p class="text-dark fw-bold mb-1 text-start" style="font-size: 0.85rem; color: #198754 !important;">
                                        <i class=" me-1"></i>Figure: Integrated approaches for DRR disease management.
                                    </p>
                                    <p class="text-dark mb-0 small" style="line-height: 1.3; text-align: justify;">
                                        The figure illustrates different strategies for managing DRR disease. This includes the identification of donor parents and gene-specific markers from the host, transgenic approaches, nonhost resistance, and rhizosphere engineering. (a) The development of tools and resources for improving the prediction and assessment of combined stress. This includes developing and training machine learning models image datasets and simulation models that exploits environmental and edaphic factors as data points such as weather parameters, pathogen load, soil nutrients. (b) Development of transgenics by incorporating an antifungal gene that provides tolerance against DRR. (c) The identification of a nonhost and understanding the molecular basis of NHR through a multi-omics approach. This will lead to the discovery of antimicrobial metabolites for direct use as a biopesticide in the host, or the transfer of molecular determinants to the host plant to generate resistant varieties. Further, the identified nonhost can be used in crop rotation to reduce the pathogen load in the native soil. (d) Screening for the identification of resistant donors and the identification of a gene-specific marker through GWAS, which can then be utilized in gene editing strategies to provide resistance in host. (e) Rhizosphere engineering, a sustainable approach harnesses beneficial microbes to provide protection against biotic stress and improve plant productivity. This is achieved through various mechanisms such as improved water and nutrient uptake, improved root architecture, production of antimicrobial compounds, activation of plant immune responses, phytohormone signaling. (f) The figure illustrates the field-to-lab-field iterative cycle of identifying the problem in the field, understanding it under laboratory conditions, validating the findings under greenhouse and environmentally controlled mini fields and deploying the solutions in the field (Mirchanandani et al., 2026).
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 mb-3 fade-in-up">
                    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="Images/home2.jpg" class="d-block w-100" alt="Image 2">
                                <div class="p-2 text-center border-top bg-light">
                                    <h6 class="mb-0 text-dark" style="font-size:0.9rem; line-height: 1.3;">Left-View from farm field showing DRR plant disease, Right-Sample collection for scientific studies from DRR infected farmer field (14.4673° N, 78.8242° E)</h6>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="Images/home3.jpg" class="d-block w-100" alt="Image 3">
                                <div class="p-2 text-center border-top bg-light">
                                    <h6 class="mb-0 text-dark" style="font-size:0.9rem; line-height: 1.3;">Sick pot experiment under greenhouse conditions</h6>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="Images/home4.jpg" class="d-block w-100" alt="Image 4">
                                <div class="p-2 text-center border-top bg-light">
                                    <h6 class="mb-0 text-dark" style="font-size:0.9rem; line-height: 1.3;">RGB image showing typical symptom of straw-yellow coloured leaves in fields</h6>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="Images/home11.jpg" class="d-block w-100" alt="Image 11">
                                <div class="p-2 text-center border-top bg-light">
                                    <h6 class="mb-0 text-dark" style="font-size:0.9rem; line-height: 1.3;">Research plot @(15.4589° N, 75.0078° E) showing severe disease at early stages of chickpea growth</h6>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="Images/home12.jpg" class="d-block w-100" alt="Image 12">
                             <div class="p-2 text-center border-top bg-light">
                                    <h6 class="mb-0 text-dark" style="font-size:0.9rem; line-height: 1.3;">Irrigating research plot DRR field @ (28.9845° N, 77.7064° E), Uttar Pradesh</h6>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="Images/home14.jpg" class="d-block w-100" alt="Image 14">
                                <div class="p-2 text-center border-top bg-light">
                                    <h6 class="mb-0 text-dark" style="font-size:0.9rem; line-height: 1.3;">Chickpea genotypes for DRR resistance at hotspot @ (14.4673° N, 78.8242° E)</h6>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="Images/home5.jpg" class="d-block w-100" alt="Image 5">
                                <div class="p-2 text-center border-top bg-light">
                                    <h6 class="mb-0 text-dark" style="font-size:0.9rem; line-height: 1.3;">Typical symptoms of DRR including straw-yellow leaves, brittle tap root, lack of lateral roots</h6>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="Images/home6.jpg" class="d-block w-100" alt="Image 6">
                                <div class="p-2 text-center border-top bg-light">
                                    <h6 class="mb-0 text-dark" style="font-size:0.9rem; line-height: 1.3;">Split open root image showing microsclerotia in the pith region of infected chickpea</h6>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="Images/Home7.png" class="d-block w-100" alt="Image 7">
                                <div class="p-2 text-center border-top bg-light">
                                    <h6 class="mb-0 text-dark" style="font-size:0.9rem; line-height: 1.3;">Left-<em>M. phaseolina</em> microseelotria in media plate, Right-Microscopic image showing multinucleate hyphae</h6>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="Images/home8.jpg" class="d-block w-100" alt="Image 8">
                                <div class="p-2 text-center border-top bg-light">
                                    <h6 class="mb-0 text-dark" style="font-size:0.9rem; line-height: 1.3;">Confocal-imaging of a transverse section of the chickpea root shows the chronology of colonization by Macrophomina. Ep-epidermis, C-cortex, DAI-days after infection</h6>
                                    </h6>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="Images/Sprout2.png" class="d-block w-100" alt="Image 9">
                                <div class="p-2 text-center border-top bg-light">
                                    <h6 class="mb-0 text-dark" style="font-size:0.9rem; line-height: 1.3;">SPROUT - platform for high-throughput DRR disease phenotyping and accelerated resistance breeding</h6>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="Images/home10.jpg" class="d-block w-100" alt="Image 10">
                                <div class="p-2 text-center border-top bg-light">
                                    <h6 class="mb-0 text-dark" style="font-size:0.9rem; line-height: 1.3;">UAV-based hyperspectral imaging of experimental plots showing the impact of rhizosphere microbiome engineering for combating DRR under drought</h6>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>

                    <div class="row g-2 mt-2">
                        <div class="col-6">
                            <a href="https://drr.nipgr.ac.in/map" target="_blank" class="text-decoration-none">
                                <div class="card h-100 shadow-sm text-center p-3 border-0 bg-light">
                                    <i class="fas fa-map-marked-alt fa-xl text-primary mb-2"></i>
                                    <h4 class="fw-bold mb-0 text-dark" style="font-size: 0.85rem;">Geospatial/Stress map</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="sitemap.php" class="text-decoration-none">
                                <div class="card h-100 shadow-sm text-center p-3 border-0 bg-light">
                                    <i class="fas fa-sitemap fa-xl text-success mb-2"></i>
                                    <h4 class="fw-bold mb-0 text-dark" style="font-size: 0.85rem;">Sitemap</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mb-3 fade-in-up">
                    <div class="sidebar-menu h-100 border rounded shadow-sm p-3 flex-column" style="font-size: 0.9rem;">
                        <h5 class="fw-bold border-bottom pb-2 mb-3" style="font-size: 1.05rem;">
                            <i class="fas fa-external-link-alt me-2 text-success"></i> Quick links
                        </h5>

                        <ul class="list-unstyled flex-grow-1 mb-0">
   				<li class="mb-2">
                                <a href="drrothercrops.php" class="fw-bold text-dark sidebar-link d-flex align-items-center">
                                    <i class="fas fa-seedling text-success me-3" style="width: 16px;"></i><span>Root/Charcoal Rot in other crops</span>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="authorrepository.php" class="fw-bold text-dark sidebar-link d-flex align-items-center">
                                    <i class="fas fa-chalkboard-teacher text-success me-3" style="width: 16px;"></i><span>Author repository</span>
                                </a>
                            </li>
 			     <li class="mb-2">
                                <a href="download.php" class="fw-bold text-dark sidebar-link d-flex align-items-center">
                                    <i class="fas fa-file-arrow-down text-secondary me-3" style="width: 16px;"></i><span>Data download hub</span>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="OtherResources.php" class="fw-bold text-dark sidebar-link d-flex align-items-center">
                                    <i class="fas fa-link text-warning me-3" style="width: 16px;"></i><span>Related links</span>
                                </a>
                            </li>                                                     
			    <li class="mb-2">
                                <a href="https://github.com/scipdatabase" target="_blank" class="fw-bold text-dark sidebar-link d-flex align-items-center">
                                    <i class="fab fa-github me-3" style="width: 16px;"></i><span>Github resources</span>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="https://scholar.google.com/citations?user=vmbK4UMAAAAJ&hl=en&oi=ao" target="_blank" class="fw-bold text-dark sidebar-link d-flex align-items-center">
                                    <i class="fas fa-book text-danger me-3" style="width: 16px;"></i><span>Lab publications</span>
                                </a>
                            </li>
                            <li class="mb-0">
                                <a href="feedback.php" class="fw-bold text-dark sidebar-link d-flex align-items-center">
                                    <i class="fas fa-comment-medical text-dark me-3" style="width: 16px;"></i><span>Feedback</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openBtn = document.getElementById('openPopupBtn');
            const closeBtn = document.getElementById('closeBtn');
            const popup = document.getElementById('popup');
            const overlay = document.getElementById('modalOverlay');

            // Toggle visibility handlers
            openBtn.addEventListener('click', function() {
                popup.classList.add('active');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });

            const closeBox = () => {
                popup.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            };

            closeBtn.addEventListener('click', closeBox);
            overlay.addEventListener('click', closeBox);
        });
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>
