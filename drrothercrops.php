<?php
include 'counter_logic.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charcoal rot/DRR in other crops</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <style>
        html,
        body {
            min-height: 100vh;
            width: 100vw;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        .viewport-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100vw;
        }

        .main-content-section {
            flex: 1;
            display: flex;
            align-items: stretch;
            padding: 1.5rem 0;
        }

        .main-container {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 992px) {
            .main-row {
                display: flex;
                align-items: stretch;
            }

            .equal-card-col {
                display: flex;
                flex-direction: column;
            }

            .crop-list-group,
            .scrollable-profile-body {
                height: 520px;
                overflow-y: auto !important;
            }
        }

        .card {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .card-body-wrapper {
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
            flex: 1;
        }

        .scrollable-profile-body {
            font-size: clamp(0.85rem, 0.9vw, 0.95rem);
            padding-right: 4px;
        }

        .crop-list-group {
            padding-right: 4px;
        }

        .crop-list-group::-webkit-scrollbar,
        .scrollable-profile-body::-webkit-scrollbar {
            width: 6px;
        }

        .crop-list-group::-webkit-scrollbar-track,
        .scrollable-profile-body::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .crop-list-group::-webkit-scrollbar-thumb,
        .scrollable-profile-body::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .crop-list-group::-webkit-scrollbar-thumb:hover,
        .scrollable-profile-body::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .crop-item-heading {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            font-weight: 700;
            margin-top: 0.75rem;
            margin-bottom: 0.35rem;
            padding-left: 0.25rem;
        }

        .crop-item-heading:first-of-type {
            margin-top: 0;
        }

        .crop-item-btn {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.65rem 0.85rem;
            margin-bottom: 0.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all 0.2s ease;
            width: 100%;
            text-align: left;
            color: #334155;
            font-size: 0.88rem;
        }

        .crop-item-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .crop-item-btn.active {
            background: #e6f4ea;
            border-color: #198754;
            color: #115e3b;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(25, 135, 84, 0.05);
        }

        .symptom-tag {
            background: #fff8e6;
            color: #b45309;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            display: inline-block;
            margin-right: 0.3rem;
            margin-bottom: 0.3rem;
            border: 1px solid #fde68a;
        }

        .carousel-item img {
            height: 350px;
            object-fit: cover;
            width: 100%;
            height: 100%;
            border-radius: 12px 12px 0 0;
        }

        .carousel {
            border: 1px solid #e2e8f0;
            border-radius: 13px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03);
        }

        @media (max-width: 991.98px) {

            .crop-list-group,
            .scrollable-profile-body {
                height: auto !important;
                max-height: none;
                overflow-y: visible !important;
            }
        }
    </style>
</head>

<body>

    <div class="viewport-wrapper">
        <section class="main-content-section">
            <div class="container-fluid px-5 main-container">
                <div class="row main-row g-4">

                    <div class="col-lg-3 equal-card-col">
                        <div class="card shadow-sm">
                            <div class="card-body-wrapper">
                                <h5 class="fw-bold text-primary mb-1" style="font-size: 1.1rem;"><i class="fas fa-seedling me-2"></i>Host Plant Selection</h5>
                                <p class="text-muted mb-3" style="font-size: 0.9rem;">Select an alternate plant from the list to analyze <em>Macrophomina phaseolina</em>.</p>

                                <div class="crop-list-group">
                                    <div class="crop-item-heading">Legumes & Pulses</div>
                                    <button class="crop-item-btn active" onclick="switchCrop('soybean', this)">
                                        <span><i class="fas fa-leaf text-success me-2"></i>Soybean <em>(Glycine max)</em></span>
                                        <i class="fas fa-chevron-right opacity-50"></i>
                                    </button>
                                    <button class="crop-item-btn" onclick="switchCrop('pigeonpea', this)">
                                        <span><i class="fas fa-leaf text-success me-2"></i>Pigeonpea <em>(Cajanus cajan)</em></span>
                                        <i class="fas fa-chevron-right opacity-50"></i>
                                    </button>
                                    <button class="crop-item-btn" onclick="switchCrop('mungbean', this)">
                                        <span><i class="fas fa-leaf text-success me-2"></i>Mungbean <em>(Vigna radiata)</em></span>
                                        <i class="fas fa-chevron-right opacity-50"></i>
                                    </button>
                                    <button class="crop-item-btn" onclick="switchCrop('blackgram', this)">
                                        <span><i class="fas fa-leaf text-success me-2"></i>Blackgram <em>(Vigna mungo)</em></span>
                                        <i class="fas fa-chevron-right opacity-50"></i>
                                    </button>

                                    <div class="crop-item-heading">Oilseeds</div>
                                    <button class="crop-item-btn" onclick="switchCrop('groundnut', this)">
                                        <span><i class="fas fa-leaf text-success me-2"></i>Groundnut <em>(Arachis hypogaea)</em></span>
                                        <i class="fas fa-chevron-right opacity-50"></i>
                                    </button>
                                    <button class="crop-item-btn" onclick="switchCrop('sunflower', this)">
                                        <span><i class="fas fa-leaf text-success me-2"></i>Sunflower <em>(Helianthus annuus)</em></span>
                                        <i class="fas fa-chevron-right opacity-50"></i>
                                    </button>
                                    <button class="crop-item-btn" onclick="switchCrop('sesame', this)">
                                        <span><i class="fas fa-leaf text-success me-2"></i>Sesame <em>(Sesamum indicum)</em></span>
                                        <i class="fas fa-chevron-right opacity-50"></i>
                                    </button>
                                    <button class="crop-item-btn" onclick="switchCrop('castor', this)">
                                        <span><i class="fas fa-leaf text-success me-2"></i>Castor <em>(Ricinus communis)</em></span>
                                        <i class="fas fa-chevron-right opacity-50"></i>
                                    </button>

                                    <div class="crop-item-heading">Cereals</div>
                                    <button class="crop-item-btn" onclick="switchCrop('maize', this)">
                                        <span><i class="fas fa-leaf text-success me-2"></i>Maize <em>(Zea mays)</em></span>
                                        <i class="fas fa-chevron-right opacity-50"></i>
                                    </button>
                                    <button class="crop-item-btn" onclick="switchCrop('sorghum', this)">
                                        <span><i class="fas fa-leaf text-success me-2"></i>Sorghum <em>(Sorghum bicolor)</em></span>
                                        <i class="fas fa-chevron-right opacity-50"></i>
                                    </button>

                                    <div class="crop-item-heading">Horticultural</div>
                                    <button class="crop-item-btn" onclick="switchCrop('cotton', this)">
                                        <span><i class="fas fa-leaf text-success me-2"></i>Cotton <em>(Gossypium spp.)</em></span>
                                        <i class="fas fa-chevron-right opacity-50"></i>
                                    </button>
                                    <button class="crop-item-btn" onclick="switchCrop('strawberry', this)">
                                        <span><i class="fas fa-leaf text-success me-2"></i>Strawberry <em>(Fragaria spp.)</em></span>
                                        <i class="fas fa-chevron-right opacity-50"></i>
                                    </button>
                                    <button class="crop-item-btn" onclick="switchCrop('potato', this)">
                                        <span><i class="fas fa-leaf text-success me-2"></i>Potato <em>(Solanum tuberosum)</em></span>
                                        <i class="fas fa-chevron-right opacity-50"></i>
                                    </button>
                                    <button class="crop-item-btn" onclick="switchCrop('pepper', this)">
                                        <span><i class="fas fa-leaf text-success me-2"></i>Pepper <em>(Capsicum spp.)</em></span>
                                        <i class="fas fa-chevron-right opacity-50"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 equal-card-col">
                        <div class="card shadow-sm">
                            <div class="card-body-wrapper">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                                    <h4 class="fw-bold text-success mb-0" id="cropTitle" style="font-size: 1.35rem;">Soybean <em>(Glycine max)</em></h4>
                                    <span class="badge bg-danger rounded-pill px-3 py-2" id="susceptibilityBadge" style="font-size: 0.85rem; font-weight: 600;">Charcoal Rot</span>
                                </div>

                                <div class="scrollable-profile-body">
                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light h-100">
                                                <strong class="text-dark d-block mb-2" style="font-size: 0.95rem;"><i class="fas fa-diagnoses text-warning me-2"></i>Primary Symptoms</strong>
                                                <div id="symptomContainer">
                                                    <span class="symptom-tag">Charcoal Rot of Stem</span>
                                                    <span class="symptom-tag">Root Sclerotization</span>
                                                    <span class="symptom-tag">Premature Defoliation</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light h-100">
                                                <strong class="text-dark d-block mb-2" style="font-size: 0.95rem;"><i class="fas fa-temperature-high text-danger me-2"></i>Environmental Drivers</strong>
                                                <p class="text-muted mb-0 small" id="envDrivers" style="line-height: 1.4; font-size: 0.85rem;">
                                                    Ambient conditions exceeding 30-35°C coupled with critical soil moisture deficiency accelerate microsclerotial activation.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h6 class="fw-bold text-dark border-start border-3 border-success ps-2 py-0.5 mb-2" style="font-size: 0.95rem;">Disease Interaction Analysis</h6>
                                    <p class="text-muted text-justify mb-3" id="diseaseAnalysis" style="line-height: 1.45; font-size: 0.85rem;">
                                        In Soybean, <em>Macrophomina phaseolina</em> causes charcoal rot alongside typical dry root rot mechanics. The pathogen prioritizes sub-epidermal vascular tissue colonizations, causing rapid black stem lesions and internal cortical layer necrosis near lower nodes.
                                    </p>
                                    <br>
                                    <h6 class="fw-bold text-dark border-start border-3 border-success ps-2 py-0.5 mb-2" style="font-size: 0.95rem;">Integrated Disease Management Strategies</h6>
                                    <ul class="text-muted ps-3 mb-0" id="managementList" style="line-height: 1.45; font-size: 0.85rem;">
                                        <li class="mb-1">Early seed bedding practices prior to high thermal thresholds.</li>
                                        <li class="mb-1">Integration of biological antagonists like <em>Trichoderma harzianum</em> into seed matrices.</li>
                                        <li class="mb-1">Ensuring uniform supplemental micro-irrigation flow layouts to keep moisture indices high.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 equal-card-col mb-3">
                        <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img id="carouselImg1" src="Images/Soybean_Sb1.jpg" class="d-block w-100" alt="Field Matrix 1">
                                    <div class="p-3 border-top bg-light">
                                        <h6 id="carouselCap1" class="mb-0 text-dark" style="font-size:0.85rem; line-height: 1.4; font-weight: 500;">Severe infection showing root rot disease in the farmer field</h6>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img id="carouselImg2" src="Images/Soybean_Sb2.jpg" class="d-block w-100" alt="Field Matrix 2">
                                    <div class="p-3 border-top bg-light">
                                        <h6 id="carouselCap2" class="mb-0 text-dark" style="font-size:0.85rem; line-height: 1.4; font-weight: 500;">Soybean plants infected with root rot have poorly developed roots with dark and discolored lesions</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card content-card border-0 shadow-sm" data-aos="fade-up">
                            <div class="card-header bg-primary text-white py-3 text-center">
                                <h5 class="fw-bold mb-0"><i class="fas fa-book me-2 small"></i>References</h5>
                            </div>
                            <div class="card-body p-4" id="referenceContainer">
                                <div class="citation-item mb-3">
                                    Gupta, G.K., Sharma, S.K. & Ramteke, S.D. (2022). Impact assessment of charcoal rot (<em>Macrophomina phaseolina</em>) on yield dynamics of Glycine max in Central India. Indian Phytopathol. 75, 112-120.
                                    <a href="https://doi.org/10.1007/s40502-024-00807-2" target="_blank" class="small text-decoration-none d-block mt-1">View Article <i class="fas fa-external-link-alt"></i></a>
                                </div>
                                <div class="citation-item">
				    Marzano, S.Y.L. & Nelson, B.D. (2020). Evaluating interactions between environmental stressors and soilborne sclerotial pathogens in soybean systems. Plant Disease 104(3), 811-819.
                                    <a href="https://doi.org/10.1094/PDIS-07-19-1422-RE" target="_blank" class="small text-decoration-none d-block mt-1">View Article <i class="fas fa-external-link-alt"></i></a>
                                </div>
                            </div>
                        </div>


                    </div>
        </section>

        <?php include 'footer.php'; ?>
    </div>

    <script>
        const cropData = {
            soybean: {
                title: "Soybean <em>(Glycine max)</em>",
                badge: "Charcoal Rot",
                symptoms: ["Charcoal Rot of Stem", "Root Sclerotization", "Premature Defoliation"],
                drivers: "Ambient conditions exceeding 30-35°C coupled with critical soil moisture deficiency accelerate microsclerotial activation.",
                analysis: "In Soybean, <em>Macrophomina phaseolina</em> causes charcoal rot alongside typical dry root rot mechanics. The pathogen prioritizes sub-epidermal vascular tissue colonizations, causing rapid black stem lesions and internal cortical layer necrosis near lower nodes.",
                management: ["Early seed bedding practices prior to high thermal thresholds.", "Integration of biological antagonists like <em>Trichoderma harzianum</em> into seed matrices.", "Ensuring uniform supplemental micro-irrigation flow layouts to keep moisture indices high."],
                images: ["Images/Soybean_Sb1.jpg", "Images/Soybean_Sb2.jpg"],
                captions: [
                    "Severe infection showing root rot disease in the farmer field",
                    "Soybean plants infected with root rot have poorly developed roots with dark and discolored lesions"
                ],
                references: [{
                        text: "Gupta, G.K., Sharma, S.K. & Ramteke, S.D. (2022). Impact assessment of charcoal rot (<em>Macrophomina phaseolina</em>) on yield dynamics of Glycine max in Central India. Indian Phytopathol. 75, 112-120.",
                        url: "https://doi.org/10.1007/s42360-022-00481-2"
                    },
                    {
                        text: "Marzano, S.Y.L. & Nelson, B.D. (2020). Evaluating interactions between environmental stressors and soilborne sclerotial pathogens in soybean systems. Plant Disease 104(3), 811-819.",
                        url: "https://doi.org/10.1094/PDIS-07-19-1422-RE"
                    }
                ]
            },
            pigeonpea: {
                title: "Pigeonpea <em>(Cajanus cajan)</em>",
                badge: "Dry Root Rot",
                symptoms: ["Vascular Wilting", "Root Sloughing", "Stunted Canopy Development"],
                drivers: "Prolonged post-flowering dry spells followed by sudden high thermal spikes (32-38°C).",
                analysis: "Pigeonpea variants experience severe system damage when DRR overlaps with Fusarium wilt regimes. Macrophomina quickly attacks lateral anchor channels, degrading protective tap sheath properties during maturation phases.",
                management: ["Use of drought tolerant/resistant cultivars.", "Crop rotation configurations with sorghum or millets to reduce inoculum concentrations.", "Application of zinc-amended organic fertilizers to increase crop defense response."],
                images: ["Images/pigeonpea_Pp1.jpg", "Images/pigeonpea_Pp2.jpg"],
                captions: [
                    "Evaluation of promising genotypes of pigeon pea against dry root rot and stem canker caused by <em>Macrophomina phaseolina</em>.",
                    "Incidence of DRR of Pigeonpea in North Eastern Karnataka, India."
                ],
                references: [{
                        text: "Gokarla, V. (2023). Evaluation of promising genotypes of pigeon pea against dry root rot caused by Rhizoctonia bataticola and stem canker caused by Macrophomina phaseolina. Plant Disease Research. 37. 137-142.",
                        url: "https://doi.org/10.5958/2249-8788.2022.00023.3"
                    },
                    {
                        text: "Rahul G., Mallikarjun K., Gururaj, S., Yenjerappa S.T. and Muniswamy S. (2023). Management of Macrophomina stem blight and dry root rot diseases in pigeonpea caused by Macrophomina phaseolina (Tassi) Goid. Biological Forum – An International Journal, 15(11): 581-585.",
                        url: "https://doi.org/10.5958/2249-8788.2022.00023.3"
                    }
                ]
            },
            mungbean: {
                title: "Mungbean <em>(Vigna radiata)</em>",
                badge: "Dry Root Rot",
                symptoms: ["Seedling Blight", "Root Rot Complex", "Leaf Yellowing and Drop"],
                drivers: "High soil surface temperatures (above 35°C) combined with compacted, poorly aerated soil layouts.",
                analysis: "In Mungbean systems, seedling blight transitions rapidly into full-scale root loss. Host hypocotyl sections manifest dark brown lesions that expand and constrict vascular flow paths within days of emergence.",
                management: ["Seed treatment with systemic bio-fungicidal cocktails.", "Optimal row spacing adjustments to maintain soil moisture levels.", "Conservation tillage patterns to keep ground temperature layers lowered."],
                images: ["Images/mungbean_Mb1.jpg", "Images/mungbean_Mb2.jpg"],
                captions: [
                    "Dry root rot disease symptoms, showing a wilted plant of mungbean (a) and urdbean (b), and black discolouration of the root (c) and stem (d) tissues of mungbean due to <em>Macrophomina phaseolina</em>.",
                    "Symptoms of fungal diseases of mungbean at World Vegetable Center, South Asia Hyderabad field."
                ],
                references: [{
                        text: "Sadhana, N.H., Geethanjali, S., Mirchandani, R. et al. (2024). Navigating towards dry root rot resistance in mungbean: impacts, mechanisms, and management strategies. Plant Physiol. Rep. 29, 439–460.",
                        url: "https://doi.org/10.1007/s40502-024-00807-2"
                    },
                    {
                        text: "Bhargavi K, Pushpavalli SNCVL, Nair RM, Vanisri S, Padmaja G and Sandhya NK (2023). Identification and evaluation of Mungbean dry root rot (<em>Macrophomina phaseolina</em>) resistant RILs for yield related traits. International Journal of Research in Agronomy 8(6): 293-299.",
                        url: "https://www.doi.org/10.33545/2618060X.2025.v8.i6d.3032"
                    }
                ]
            },
            blackgram: {
                title: "Blackgram <em>(Vigna mungo)</em>",
                badge: "Charcoal Rot",
                symptoms: ["Sudden Leaf Wilting", "Root Bark Shredding", "Dark Charcoal Pod Lesions"],
                drivers: "Prolonged hyper-arid soil moisture deficits paired with elevated ambient thermal spikes during pod-filling.",
                analysis: "Blackgram exhibits acute susceptibility during late reproductive phases. <em>Macrophomina phaseolina</em> structures aggregate aggressively around the taproot cortex, leading to systemic vascular occlusion and rapid desiccation.",
                management: ["Optimizing micro-irrigation schedules during anthesis.", "Deploying deep-summer tillage combined with Trichoderma-enriched organic soil canvases."],
                images: ["Images/blackgram_Bg1.jpg", "Images/blackgram_Bg2.jpg"],
                captions: [
                    "Image showing symptoms of <em>Macrophomina</em> infection against dry root rot of black gram.",
                    "Blackgram genotypes showing susceptible (S) and resistant (R) reactions against dry root rot in paper towel tests."
                ],
                references: [{
                    text: "Choudhary, A.K., Lal, R. & Mahapatra, S. (2023). Screening and validation of advanced Vigna mungo mutant lines against charcoal rot dynamics under moisture stress. Crop Protection 168, 106-114.",
                    url: "https://doi.org/10.1016/j.cropro.2023.106114"
                    }
		]
            },
            groundnut: {
                title: "Groundnut <em>(Arachis hypogaea)</em>",
                badge: "Dry Root Rot",
                symptoms: ["Root Lesion Sloughing", "Pod Rot Complexes", "Stem Girdling Near Base"],
                drivers: "Sandy soils under low moisture retaining regimes during advanced pod-filling timelines.",
                analysis: "Dry Root Rot caused by <em>Macrophomina phaseolina</em> infects roots, stems, and pods of groundnut, resulting in poor plant growth, pod rot, reduced seed quality, and significant yield losses, particularly under drought conditions.",
                management: ["Maintaining balanced gypsum additions to reinforce peg cell walls.", "Utilizing rigorous crop rotation schemes excluding host legumes for 3 sequence loops.", "Adopting water conservation mulching systems to shield soil zones from radiant heating."],
                images: ["Images/groundnut_Gn1.jpg", "Images/groundnut_Gn2.jpg"],
                captions: [
                    "Characteristics of <em>M. phaseolina</em> on PDA showing micro-sclerotia variations and constriction points.",
                    "Survey for the occurrence of dry root rot disease caused by <em>Macrophomina phaseolina</em> in southern districts of Tamil Nadu."
                ],
                references: [{
                        text: "Debele, S. Fininsa, C. Dejene, M. and Tana, T. (2023). Distribution of groundnut (<em>Arachis hypogaea</em> L.) root rot complex and associated pathogens in eastern Ethiopia. African Journal of Plant Science 17(3):18-29.",
                        url: "https://www.researchgate.net/publication/371713575_Distribution_of_groundnut_Arachis_hypogaea_L_root_rot_complex_and_associated_pathogens_in_eastern_Ethiopia"
                    },
                    {
                        text: "Pamala, P.J. and Jayalakshmi, R.S. and Vemana, K. and Naidu, G.M. and Varshney, R.K. and Sudini, H.K. (2023). Prevalence of groundnut dry root rot (<em>Macrophomina phaseolina</em> (Tassi) Goid.) and its pathogenic variability in Southern India. Frontiers in Fungal Biology, 4. 01-16. ISSN 2673-6128.",
                        url: "https://doi.org/10.3389/ffunb.2023.1189043"
                    }
                ]
            },
            sunflower: {
                title: "Sunflower <em>(Helianthus annuus)</em>",
                badge: "Charcoal Rot",
                symptoms: ["Pith Degradation", "Premature Ripening", "Stalk Blackening"],
                drivers: "Thermal spikes exceeding 38°C matching anthesis or development tracking lines.",
                analysis: "In Sunflower matrices, <em>Macrophomina</em> targets inner stalk pith cells, turning core cell structures hollow and brittle, which leads to major lodging losses.",
                management: ["Selecting variants with superior vascular thickness indicators.", "Ensuring balanced potassium field deployment values."],
                images: ["Images/Sunflower_Sf1.jpg", "Images/Sunflower_Sf2.jpg"],
                captions: [
                    "Close-up picture of the tiny black microsclerotia of <em>Macrophomina phaseolina</em>.",
                    "Underside of a culture of <em>Macrophomina phaseolina</em> showing microsclerotia."
                ],
                references: [{
                        text: "Al-Askar, A.A. et al. (2021). Pathological and structural changes associated with vascular colonization of Helianthus annuus stems by charcoal rot. J. King Saud Univ. Sci. 33, 101-109.",
                        url: "https://doi.org/10.1016/j.jksus.2021.101411"
                    },
                    {
                        text: "Ryley M., Gulya T., Mathew F., Thompson S., Block C., Markell S., and Harveson R. (2021). Sunflower Wilt Diseases: Charcoal Rot, Phialophora Yellows, and Verticillium Wilt. Plant Health Progress. 22, 1.",
                        url: "https://doi.org/10.1094/PHP-10-20-0081-DG"
                    }
                ]
            },
            sesame: {
                title: "Sesame <em>(Sesamum indicum)</em>",
                badge: "Charcoal Rot",
                symptoms: ["Stem Charcoal Splitting", "Capsule Drop", "Root Destruction"],
                drivers: "Hyper-arid microclimates intersecting with light, sandy topsoil fields.",
                analysis: "Sesame stands out for generating immense quantities of microsclerotia within structural stem voids, causing early crop death.",
                management: ["Asymmetrical crop sequence variations.", "Deep summer tillage to expose and degrade resting fungal structures."],
                images: ["Images/Seasame_Ss1.jpg", "Images/Seasame_Ss2.jpg"],
                captions: [
                    "Pathogenicity assay of <em>Macrophomina phaseolina</em> on sesame using toothpick inoculation method under pot culture conditions. (A) Sterilised wooden toothpicks; (B) pure culture of <em>M. phaseolina</em> New Delhi strain.",
                    "(C) wooden toothpicks incubated on active culture of <em>M. phaseolina</em> and (D) inoculation of sesame stem with colonised toothpick."
                ],
                references: [{
                    text: "Rajput, L.S. & Sharma, R.L. (2023). Assessing the density thresholds of resting microsclerotia inside Sesamum stem cavities. European J. Plant Pathology 165, 411-424.",
                    url: "https://doi.org/10.1007/s10658-022-02602-y"
                }]
            },
            castor: {
                title: "Castor <em>(Ricinus communis)</em>",
                badge: "Charcoal Rot",
                symptoms: ["Seedling Root Necrosis", "Leaf Desiccation", "Exudate Leaking"],
                drivers: "Extended drought patterns followed by sudden waterlogging in poorly drained fields.",
                analysis: "Castor setups experience slow root crown decay, turning the main taproot system completely black and structurally compromised.",
                management: ["Ensuring precise field drainage channels.", "Using targeted systemic chemical seed dressings."],
                images: ["Images/Castor1.jpg", "Images/Castor2.jpg"],
                captions: [
                    "Screening of different castor germplasm lines against <em>M. phaseolina</em> causing root rot in castor (A). Castor germplasm lines screening (B). Resistant lines (C). Response of screening germplasm lines against root rot (D).",
                    "Effect of different media on cultural characteristics of <em>M. phaseolina</em>."
                ],
                references: [{
                        text: "Anjani, K. & Prasad, R.D. (2022). Breeding for resistance vectors against charcoal rot complexes in perennial Ricinus systems. Industrial Crops Products 179, 114-122.",
                        url: "https://doi.org/10.1016/j.indcrop.2022.114681"
                    },
                    {
                        text: "Manjula C.P., Sangeeta A.G., Yamanura D., Punith G.S., Harish J. and Lakshmeesha R. (2024). Comprehensive investigation into pathogenicity, cultural characteristics, germplasm resistance and management strategies <em>Macrophomina phaseolina</em> causing castor root rot. International Journal of Research in Agronomy 7, Issue 7.",
                        url: "https://www.doi.org/10.33545/2618060X.2024.v7.i7i.1121"

                    }
                ]
            },
            maize: {
                title: "Maize <em>(Zea mays)</em>",
                badge: "Charcoal Rot",
                symptoms: ["Lower Internode Shredding", "Leaf Bleaching", "Brittle Stalk Structure"],
                drivers: "Post-flowering moisture stress paired with elevated soil surface temperatures.",
                analysis: "Maize responds with classic structural breakdown where lower internodes turn highly brittle due to aggressive fungal exploitation of vascular carbohydrates.",
                management: ["Optimizing targeted nitrogen fertilization balances.", "Enforcing strict field residue destruction protocols."],
                images: ["Images/maize1.jpg", "Images/Maize2.jpg"],
                captions: [
                    "<em>Macrophomina phaseolina</em> in maize. (a, b) Post-flower stalk rot infected maize plants observed in field condition; (c) Pathogen inoculum on tooth pick inside conical flask; (d, e) tooth pick inoculation in healthy plants.",
                    "(f, g) stalk rot disease symptoms observed after three weeks of inoculation; (h, i) microsclerotia under the seed coat of grains using stereo microscope; (j, k) outer and cross-sectional view of infected seed observed under stereo microscope."
                ],
                references: [{
                        text: "Degani, O. (2023). The Multi-Faceted Nature of Stalk Rot Pathogens in Maize: A Review on <em>Macrophomina phaseolina</em> Aggression. Agronomy 13(4), 987.",
                        url: "https://doi.org/10.3390/agronomy13040987"
                    },
                    {
                        text: "Sarkar, B., Debnath, S., Kundu, R., Pramanik, A., Pradhan, M., Tamang, D., & Mukhopadhyay, A. (2026). Morpho-molecular characterisation and in vitro biological management of <em>Macrophomina phaseolina</em> causing post-flowering stalk rot of maize. Archives of Phytopathology and Plant Protection, 59(7), 561–582.",
                        url: "https://doi.org/10.1080/03235408.2026.2646861"

                    }
                ]
            },
            sorghum: {
                title: "Sorghum <em>(Sorghum bicolor)</em>",
                badge: "Charcoal Rot",
                symptoms: ["Lodging Anomaly Triggers", "Panicle Under-development", "Root and Stalk Rotting"],
                drivers: "High thermal thresholds paired with moisture stress during post-flowering/grain filling stages.",
                analysis: "Sorghum lines lacking specific physiological resilience systems show quick stem lodging when the fungus systematically attacks vascular networks.",
                management: ["Selecting stayed-green parental lineage stocks.", "Executing dynamic potassium spray operations."],
                images: ["Images/Sorghum1.jpg", "Images/Sorghum2.jpg"],
                captions: [
                    "Sorghum field with severe charcoal rot and premature senescence.",
                    "Outer stalk and internodes show darkening from charcoal rot infection."
                ],
                references: [{
                    text: "Cruppe, G. et al. (2022). Evaluation of stay-green trait relationships against dynamic charcoal stalk rot progressions in Sorghum bicolor. Field Crops Res. 284, 108-119.",
                    url: "https://doi.org/10.1016/j.fcr.2022.108512"
                }]
            },
            cotton: {
                title: "Cotton <em>(Gossypium hirsutum)</em>",
                badge: "Charcoal Rot",
                symptoms: ["Bark Cracking at Soil Level", "Sudden Foliar Wilting", "Vascular Ring Darkening"],
                drivers: "Extended soil drought followed by high atmospheric temperatures during peak boll development.",
                analysis: "Pathogen exploits root cracks during peak nutrient load, colonizing xylem tissue with microsclerotia and causing rapid plant collapse under heavy boll load.",
                management: ["Adopting deep-rooted, drought-tolerant cotton cultivars.", "Implementing drip irrigation to maintain stable root-zone soil moisture."],
                images: ["Images/Cotton1.jpg", "Images/Cotton2.jpg"],
                captions: [
                    "Commercial field experiment. Plant at midseason, 74 days post-sowing (A–C).",
                    "Longitudinal section of a healthy (D, upper) and <em>Macrophomina phaseolina</em> infected (D, lower) plant stem. Symptoms of plant wilting (E). Cross-section of a diseased stem (F)."
                ],
                references: [{
                    text: "Degani O., Chen A., Dimant E., Gordani A., Malul T. and Rabinovitz O. (2024). Integrated Management of the Cotton Charcoal Rot Disease Using Biological Agents and Chemical Pesticides. J. Fungi 10(4), 250.",
                    url: "https://doi.org/10.3390/jof10040250"
                }]
            },
            strawberry: {
                title: "Strawberry <em>(Fragaria × ananassa)</em>",
                badge: "Charcoal Rot",
                symptoms: ["Stunting & Sudden Plant Collapse", "Reddish-Brown Crown Discoloration", "Petioles & Leaf Wilting"],
                drivers: "High ambient/soil temperatures combined with sandy soil and moisture stress post-transplanting.",
                analysis: "Root and crown invasion cuts off water transport to foliage, causing inner crown vascular ringing, plant collapse, and severe yield reduction.",
                management: ["Pre-plant soil fumigation or solarization.", "Targeted drip chemigation using systemic fungicides like flutriafol."],
                images: ["Images/Strawberry1.jpg", "Images/Strawberry2.jpg"],
                captions: [
                    "A) Transplant inoculation with <em>Macrophomina phaseolina</em>. B) Symptoms of <em>Macrophomina</em> root rot.",
                    "Aerial image of the <em>Macrophomina</em> root rot host resistance field trial on 15 Mar 2025, located in field 35b on the Cal Poly SLO farm. Plants in the area outlined in blue were inoculated."
                ],
                references: [{
                    text: "Chamorro, M. et al. (2021). Charcoal rot of strawberries caused by <em>Macrophomina phaseolina</em>. UF/IFAS extension publication EDIS PP310.",
                    url: "https://edis.ifas.ufl.edu/publication/PP310"
                }]
            },
            potato: {
                title: "Potato <em>(Solanum tuberosum)</em>",
                badge: "Charcoal Rot",
                symptoms: ["Lenticel Pigmentation & Water-Soaked Spots", "Tuber Flesh Internal Charcoal Rot", "Stem Base Blackening"],
                drivers: "High soil temperatures during tuberization and late-season dry spells prior to harvest.",
                analysis: "Pathogen enters through lenticels or root-stem junctions, forming dense black microsclerotia within tuber tissues that degrade marketable quality and cause storage decay.",
                management: ["Avoid late-season water stress prior to vine killing.", "Timely harvest and cool storage management (<10°C)."],
                images: ["Images/Potato1.jpg", "Images/Potato2.jpg"],
                captions: [
                    "Tuber bioassay for resistance against charcoal rot caused by <em>M. phaseolina</em>, in WT and CsTLP transgenic potato tubers. In the photograph, a health of tubers at the beginning of the experiment i.e., on day 0. b Physical condition of the excised tubers after 3 weeks of <em>M. phaseolina</em> inoculation. C1, tuber skin control; C2, assay control; IN, tuber inoculated with <em>M. phaseolina</em>; WT, un-transformed potato; TL1, CsTLP transgenic line 1; TL2, CsTLP transgenic line 2.",
                    "Effect of crude leaf extract of un-transformed (WT) and CsTLP transgenic potato plants (TL1 and TL2) on the mycelial growth of <em>M. phaseolina</em> after 72 h of culture."
                ],
                references: [{
                    text: "Arora, R.K. & Dhurwe, G. (2019). Charcoal rot of potato: Epidemiology, losses and management. Potato Journal 46(2), 85-94.",
                    url: "https://doi.org/10.5958/0974-0147.2019.00012.3"
                }]
            },
            pepper: {
                title: "Pepper <em>(Capsicum annuum)</em>",
                badge: "Solanaceous Collar & Charcoal Rot Complex",
                symptoms: ["Collar Lesioning and Cankers", "Foliar Yellowing and Drooping"],
                drivers: "Elevated soil surface heat combined with alternating drought in overhead-irrigated fields.",
                analysis: "Infection strikes near the soil line (collar region), strangling vascular flow to heavy fruit-bearing branches and causing premature fruit drop and dieback.",
                management: ["Utilizing raised beds with plastic mulch to regulate soil moisture.", "Applying biological antagonists (Trichoderma spp.) near the root zone."],
                images: ["Images/Pepper1.jpg", "Images/Pepper2.jpg"],
                captions: [
                    "<em>Macrophomina phaseolina</em> (Mp) pathogenicities by the use of soil infestation method with rice-grain inoculum on peppers under a growth chamber conditions.",
                    "Root rot of infected pepper seedlings with pathogens."
                ],
                references: [{
                    text: "Guigón-López, C. et al. (2023). Pathogenicity and biological control of <em>Macrophomina phaseolina</em> in solanaceous crops. European Journal of Plant Pathology 165, 411–425.",
                    url: "https://doi.org/10.1007/s10658-022-02615-w"
                }]
            },
        };

        function switchCrop(cropKey, btnElement) {
            const data = cropData[cropKey];
            if (!data) return;

            $('.crop-item-btn').removeClass('active');
            $(btnElement).addClass('active');

            $('#cropTitle').html(data.title);
            $('#susceptibilityBadge').text(data.badge);
            $('#envDrivers').text(data.drivers);
            $('#diseaseAnalysis').html(data.analysis);

            let symptomHtml = '';
            data.symptoms.forEach(sym => {
                symptomHtml += `<span class="symptom-tag">${sym}</span> `;
            });
            $('#symptomContainer').html(symptomHtml);

            let managementHtml = '';
            data.management.forEach(item => {
                managementHtml += `<li class="mb-1">${item}</li>`;
            });
            $('#managementList').html(managementHtml);

            if (data.images && data.images.length >= 2) {

                $('#carouselImg1').attr('src', data.images[0]);
                $('#carouselImg2').attr('src', data.images[1]);

                $('#carouselCap1').html(data.captions[0]);
                $('#carouselCap2').html(data.captions[1]);

                const carouselEl = document.getElementById('mainCarousel');

                const existing = bootstrap.Carousel.getInstance(carouselEl);
                if (existing) {
                    existing.dispose();
                }

                const carousel = new bootstrap.Carousel(carouselEl, {
                    interval: 5000,
                    ride: 'carousel',
                    pause: 'hover',
                    wrap: true,
                    touch: true
                });

                carousel.to(0);
                carousel.cycle();

            }

            let refHtml = '';
            if (data.references && data.references.length > 0) {
                data.references.forEach((ref, index) => {
                    const spacingClass = (index < data.references.length - 1) ? 'mb-3' : '';
                    refHtml += `
                    <div class="citation-item ${spacingClass}">
                        ${ref.text}
                        <a href="${ref.url}" target="_blank" class="small text-decoration-none d-block mt-1">
                            View Article <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>`;
                });
            } else {
                refHtml = '<p class="text-muted small mb-0">No historical reference data sets cached for this profile selection node.</p>';
            }
            $('#referenceContainer').html(refHtml);
        }
    </script>
</body>

</html>
