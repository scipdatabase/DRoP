<?php
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Biopesticides</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --soft-bg: #f8fafc;
            --primary-blue: #0d6efd;
        }

        body {
            background-color: var(--soft-bg);
            font-family: 'Inter', sans-serif;
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

        .content-card {
            background: white;
            border-radius: 20px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .lead-text {
            font-family: 'Cambria', serif;
            line-height: 1.8;
            color: #334155;
            font-size: 1.15rem;
            text-align: justify;
        }

        .carousel-inner {
            border-radius: 15px;
            overflow: hidden;
        }

        .zoom-container {
            overflow: hidden;
            height: 500px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .img-zoomable {
            max-width: 100%;
            max-height: 100%;
            width: auto !important;
            height: auto !important;
            object-fit: contain;
            transition: transform 0.5s ease;
        }

        /* Mobile adjustments */
        @media (max-width: 768px) {
            .zoom-container {
                height: 300px;
                /* Shorter for mobile */
            }
        }

        .zoom-container:hover .img-zoomable {
            transform: scale(1.1);
        }

        .caption-box {
            padding: 15px;
            background: #fff;
            font-size: 0.9rem;
        }

        .symptom-highlight {
            background: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 1.5rem;
            margin: 1.5rem 0;
            font-style: italic;
        }

        .citation-item {
            font-size: 0.85rem;
            border-left: 3px solid var(--primary-blue);
            padding-left: 12px;
            margin-bottom: 15px;
            color: #475569;
        }

        /* Hide the checkbox */
        .read-more-state {
            display: none;
        }

        /* Initially hide the content */
        .read-more-target {
            opacity: 0;
            max-height: 0;
            font-size: 0;
            transition: all 0.4s ease;
            overflow: hidden;
        }

        /* Expand content when checkbox is checked */
        .read-more-state:checked~.read-more-wrap .read-more-target {
            opacity: 1;
            max-height: 2000px;
            /* Large enough for long text */
            font-size: 1rem;
        }

        /* Default state of the button (Read More) */
        .read-more-trigger {
            cursor: pointer;
            display: inline-block;
            padding: 10px 0;
            color: #198754;
            /* Success green */
            font-weight: bold;
        }

        .read-more-trigger::before {
            content: "Read More [+]";
        }

        /* Swapped state when checkbox is checked (Read Less) */
        .read-more-state:checked~.read-more-wrap .read-more-trigger::before {
            content: "Read Less [-]";
        }
    </style>
</head>

<div id="scroll-progress"></div>

<div class="container-fluid my-5">
    <div class="row g-5">

        <div class="col-lg-12">
            <div class="card content-card p-2 p-md-3 mb-3 shadow-sm">
                <h2 class="text-primary fw-bold mb-4 border-bottom pb-2">
                    <i class="me-2"></i>Biopesticides
                </h2>

                <p class="lead-text">
                    DRR is one of the most devastating diseases and a significant threat to chickpea productivity globally. While traditional management relies on chemical fungicides, the use of metabolites and bioagents is emerging as a cornerstone of Integrated Disease Management (IDM). Non-host plants like <em>Parthenium hysterophorus L.</em> arrest fungal progression within the initial layers of root cortex, providing a robust alternative to host resistance.
                </p>

                <h3 class="text-primary fw-bold mt-3 mb-2">Metabolic Defense & NHR</h3>
                <ul class="lead-text mt-2">
                    <li><strong>Flavonoid Mediation:</strong> Naringenin acts as a primary mediator, significantly inhibiting <em>M. phaseolina</em> growth at 50-100 μg/mL.</li>
                    <li><strong>Virulence Attenuation:</strong> Naringenin exposure restricts the fungus's ability to colonize host tissues effectively.</li>
                    <li><strong>Complex Barriers:</strong> Untargeted profiles reveal terpenoids and fatty acids acting as chemical shields against cortical invasion.</li>
                </ul>

                <h3 class="text-primary fw-bold mt-3 mb-2">Microbial Biopesticides</h3>
                <p class="lead-text">
                    Beneficial rhizobacteria (<em>Bacillus subtilis</em> and <em>B. velezensis</em>) function as biochemical factories, producing:
                </p>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="p-3 border rounded text-center bg-white shadow-sm">
                            <span class="badge bg-info mb-2">Lipopeptides</span>
                            <p class="small mb-0">Iturin, Surfactin, Fengycin</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded text-center bg-white shadow-sm">
                            <span class="badge bg-info mb-2">Bio-fumigants</span>
                            <p class="small mb-0">Volatile Organic Compounds (VOCs) and Hydrogen Cyanide (HCN)</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded text-center bg-white shadow-sm">
                            <span class="badge bg-info mb-2">Induced Systemic Resistance(ISR) Trigger</span>
                            <p class="small mb-0">Superoxide dismutase(SOD), Catalase(CAT), and Peroxidase(POX) Enzymes</p>
                        </div>
                    </div>
                </div>

                <input type="checkbox" id="readMoreToggle" class="read-more-state" />
                <div class="mt-2 p-2 bg-light rounded-4 border-start border-success border-4">
                    <h5 class="fw-bold text-success mb-3">The Resistance Mechanism (ISR)</h5>
                    <div class="row text-center g-2">
                        <div class="col-4">
                            <div class="badge bg-success mb-2">Activation</div>
                            <p class="small mb-0 fw-bold">Phenylpropanoid<br><span class="text-muted fw-normal">Pathway</span></p>
                        </div>
                        <div class="col-4 border-start border-2">
                            <div class="badge bg-success mb-2">Accumulation</div>
                            <p class="small mb-0 fw-bold">Phenols/Kaempferol<br><span class="text-muted fw-normal">Cell Wall Reinforcement</span></p>
                        </div>
                        <div class="col-4 border-start border-2">
                            <div class="badge bg-success mb-2">Result</div>
                            <p class="small mb-0 fw-bold">Hydraulic Conductance<br><span class="text-muted fw-normal">Climate Resilience</span></p>
                        </div>
                    </div>
                </div>

                <div class="read-more-wrap">
                    <div class="read-more-target mt-3 text-dark">
                        <hr>
                        <h5 class="fw-bold text-center text-primary">Biopesticides</h5>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            While traditional management practices rely on chemical fungicides and cultural practices, the use of metabolites and bioagents is emerging as a major approach in integrated disease management practices. This approach leverages bioactive metabolites, effectively preventing the systemic colonization that leads to vascular collapse. Recent studies suggest that non-host resistance (NHR) can be a viable and robust alternative to host resistance due to the pathogen’s broad host range. Non-host plants like <em>Parthenium hysterophorus L.</em>, <em>Triticum turgidum</em>, <em>Triticum monococcum</em>, <em>Cyperus rotundus</em>, and <em>Tridax procumbens</em> arrest fungal progression within the initial layers of root cortex. By characterizing the induced post-invasive defenses of non-host plants, studies have identified a range of metabolites that can be used for disease control (<a href="https://doi.org/10.1016/j.envexpbot.2025.106197" target="_blank">Mirchandani et al., 2025; <a href="https://doi.org/10.9734/mrji/2025/v35i121666" target="_blank">Rehman et al., 2025</a>).
                        </p>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            The resistance in Parthenium is driven by a targeted surge in secondary metabolites. Targeted LC/MS/MS analysis identified the flavonoid naringenin as a primary mediator, showing significant upregulation at 2 days after inoculation (DAI), while kaempferol and cyanidin did not exhibit significant upregulation. Experimental evidence confirms that naringenin acts as a potent metabolite, significantly inhibiting <em>M. phaseolina</em> growth at concentrations of 50 and 100 μg/mL. Furthermore, exposure to naringenin results in virulence attenuation, effectively restricting the fungus’s ability to effectively colonize host tissues. Additionally, untargeted analysis reveals an extensive profile of terpenoids and fatty acids under pathogen treatment, acting as a complex chemical barrier to prevent cortical invasion (<a href="https://doi.org/10.1016/j.envexpbot.2025.106197" target="_blank">Mirchandani et al., 2025</a>). Beyond Parthenium, other distinct non-host species utilize specialized metabolites to similarly halt <em>M. phaseolina</em> progression, particularly cereals such as <em>Oryza sativa</em> and <em>Hordeum vulgare</em> produce diterpenoid phytoalexins like momilactones A and B alongside hordunines that disrupt fungal cell membranes, while Brassicaceae like Arabidopsis and <em>Brassica juncea</em> synthesize camalexin and break down glucosinolates into toxic isothiocyanates (<a href="https://doi.org/10.3389/fpls.2023.1264569" target="_blank">Shirai & Eulgem, 2023</a>). Furthermore, metabolites isolated from <em>Monotheca buxifolia</em>, such as lupeol acetate, betulin, vanillic acid, protocatechuic acid, β-amyrin and oleanolic acid, were found to have the highest antifungal against <em>M. phaseolina</em>, with fungal biomass suppression rates of 79–81%, 77–79%, 74–79%, 67–72%, 68–71% and 68–71%, respectively. Other metabolites, including lupeol, β-sitosterol, kaempferol and quercetin, also showed considerable antifungal activity, reducing <em>M. phaseolina</em> biomass by 41–64%. In addition, methanol and n-hexane leaf, stem, root and inflorescence extracts of three Chenopodium species (family Chenopodiaceae), namely <em>Chenopodium album L.</em>, <em>Chenopodium murale L.</em> and <em>Chenopodium ambrosioides L.</em>, significantly suppressed <em>M. phaseolina</em> growth (<a href="https://doi.org/10.1080/14786410802617433" target="_blank">Javaid and Amin 2009</a>).
                        </p>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            This metabolic approach is operationalized via microbial biopesticides like antifungal lipopeptides such as iturin, surfactin, and fengycin. These compounds disrupt the structural integrity of the pathogen's hyphae. Furthermore, these biopesticides create a suppressive soil environment by secreting volatile organic compounds (VOCs) and hydrogen cyanide (HCN), which act as localized bio-fumigants to reduce the initial soil-borne inoculum (<a href="https://doi.org/10.18805/LR-4976" target="_blank">Sunkad et al., 2025; <a href="https://doi.org/10.3389/fmicb.2022.994847" target="_blank">Mageshwaran et al., 2022</a>).
                        </p>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            The integration of these microbial agents triggers induced systemic resistance (ISR). By activating the phenylpropanoid and flavonoid biosynthesis pathways, these agents induce the upregulation of defense-related enzymes (SOD, CAT, and POX). This leads to a rapid accumulation of total phenols, kaempferol, and cyanidin, facilitating the lignification of cell wall barriers. This reinforcement physically replicates the barrier, ensuring that the plant maintains hydraulic conductance even under dual pressure from disease and drought (<a href="https://doi.org/10.1016/j.envexpbot.2025.106197" target="_blank">Karande, 2021; <a href="https://doi.org/10.1016/j.envexpbot.2025.106197" target="_blank">Sunkad et al., 2023</a>).
                        </p>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            As a sustainable alternative to synthetic inputs, the metabolite-based approach offers an eco-friendly framework for crop protection. By focusing on the regulation of flavonoid pathways—specifically involving naringenin—this strategy imparts long-term climate resilience and stable grain yields in emerging agricultural landscapes (<a href="https://doi.org/10.1016/j.envexpbot.2025.106197" target="_blank">Rocha et al., 2023</a>).
                        </p>
                    </div>
                    <label for="readMoreToggle" class="read-more-trigger"></label>
                </div>
            </div>
        </div>
    </div>


    <div class="card content-card border-0 shadow-sm" data-aos="fade-up">
        <div class="card-header bg-primary text-white py-3 text-center">
            <h5 class="fw-bold mb-0"><i class="fas fa-book me-2"></i>Scientific References</h5>
        </div>
        <div class="card-body p-4">
            <div class="citation-item">
                Mirchandani, R., Kandpal, M., Ranjan, A., Sinharoy, S., & Senthil-Kumar, M. (2025). Induced post-invasive defenses in the nonhost plant Parthenium hysterophorus L. prevent root cortical colonization by Macrophomina phaseolina and impart resistance to dry root rot. Environmental and Experimental Botany, 237, 106197.
                <a href="https://doi.org/10.1016/j.envexpbot.2025.106197" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Rehman, S. V., et al. (2025). Functional Characterization and In vitro Efficacy of Chickpea Rhizobacteria against Collar Rot and Dry Root Rot. Microbiology Research Journal International, 35(12), 20-39.
                <a href="https://doi.org/10.9734/mrji/2025/v35i121666" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Sunkad, G., et al. (2025). Metabolic Profiling of Plant Growth Promoting Microorganisms (PGPMs) from Chickpea Rhizosphere and Their Antagonistic Activity against Dry Root Rot Pathogen Rhizoctonia bataticola. Legume Research-An International Journal, 1, 7.
                <a href="https://doi.org/10.18805/LR-4976" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Mageshwaran, V., et al. (2022). Endophytic Bacillus subtilis antagonize soil-borne fungal pathogens and suppress wilt complex disease in chickpea plants (Cicer arietinum L.). Frontiers in Microbiology, 13, 994847.
                <a href="https://doi.org/10.3389/fmicb.2022.994847" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Sunkad, G., et al. (2023). Bacillus valezensis: A New PGPR for Inhibition of Rhizoctonia bataticola for the Management of Dry Root Rot of Chickpea. Legume Research, 46(10).
            </div>
            <div class="citation-item">
                Karande, S. A. (2021). Induction of systemic resistance and management of dry root rot disease in chickpea caused by Macrophomina phaseolina. Doctoral dissertation, VNMKV.
            </div>
            <div class="citation-item">
                Rocha, F. S., et al. (2023). Diseases of chickpea. In Handbook of vegetable and herb diseases (pp. 1-44). Springer International Publishing.
            </div>
            <div class="citation-item">
                Shirai, M., & Eulgem, T. (2023). Molecular interactions between the soilborne pathogenic fungus Macrophomina phaseolina and its host plants. Frontiers in Plant Science, 14, 1264569.
                <a href="https://doi.org/10.3389/fpls.2023.1264569" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Javaid A, Amin M (2009) Antifungal activity of methanol and n-hexane extracts of three Chenopodium species against Macrophomina phaseolina. Natural Product Research 23: 1120-1127.
                <a href="https://doi.org/10.1080/14786410802617433" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
        </div>

    </div>
</div>
</div>
</div>
</div>
<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
    window.onscroll = function() {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = (winScroll / height) * 100;
        document.getElementById("scroll-progress").style.width = scrolled + "%";
    };
</script>
</body>

</html>
