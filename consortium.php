<?php
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Microbial Consortium</title>

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

<div class="container-fluid my-4">
    <div class="row g-2">
        <div class="col-lg-12">
            <div class="card content-card p-2 p-md-3 mb-2 shadow-sm">

                <h2 class="text-primary fw-bold mb-4 border-bottom pb-2">
                    <i class="fas fa-microscope me-2"></i>Microbial Consortium
                </h2>

                <p class="lead-text">
                    DRR management is shifting from traditional chemical fungicides toward rhizosphere engineering. By utilizing targeted microbial consortia, we can modulate the soil microbiome to protect chickpeas against <em>M. phaseolina</em> while simultaneously improving plant productivity. The targeted reintroduction of symbiotic microorganisms like AMF, <em>Mesorhizobium sp.</em>, and <em>Rhodopseudomonas palustris</em> creates a robust defense system that outperforms individual bioinoculants.
                </p>

                <h3 class="text-primary fw-bold mt-2 mb-1">The Multi-Kingdom Defense Approach</h3>
                <ul class="lead-text mt-1">
                    <li><strong>Pathogen Displacement:</strong> Reintroducing <em>Rhizobium</em> and <em>Rhizophagus</em> species restores the microbial balance often lost under disease conditions.</li>
                    <li><strong>Bio-irrigation:</strong> AMF facilitates the targeted delivery of water to root cortical cells, maintaining cell turgor and preventing fungal colonization.</li>
                    <li><strong>Induced Resistance:</strong> Priming of SA defense and phenylpropanoid pathways strengthens cell walls against vascular invasion.</li>
                </ul>

                <input type="checkbox" id="readMoreToggle" class="read-more-state" />

                <div class="mt-2 p-1 bg-light rounded-4 border-start border-success border-4">
                    <h5 class="fw-bold text-success mb-3">Mechanism of Resilience</h5>
                    <div class="row text-center g-1">
                        <div class="col-4">
                            <div class="badge bg-success mb-2">Bio-Irrigation</div>
                            <p class="small mb-0 fw-bold">Hydraulic Lift<br><span class="text-muted fw-normal">Via AMF Networks</span></p>
                        </div>
                        <div class="col-4 border-start border-2">
                            <div class="badge bg-success mb-2">Nutrients</div>
                            <p class="small mb-0 fw-bold">P-Mobilization<br><span class="text-muted fw-normal">Pathogen Deprivation</span></p>
                        </div>
                        <div class="col-4 border-start border-2">
                            <div class="badge bg-success mb-2">Priming</div>
                            <p class="small mb-0 fw-bold">SA Pathway<br><span class="text-muted fw-normal">Systemic Defense</span></p>
                        </div>
                    </div>
                </div>

                <div class="read-more-wrap">
                    <div class="read-more-target mt-3 text-dark">
                        <hr>
                        <h5 class="fw-bold text-center text-primary">Microbial consortium</h5>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            Sustainable approaches using beneficial microbes pave the way to manage DRR while maintaining long-term soil health. While studies have reported the efficacy of individual and combinations of microbes in protecting against various root rot diseases (<a href="https://doi.org/10.1007/s43621-025-02356-6" target="_blank">Kashyap et al. 2026</a>), recent shifts toward rhizosphere engineering utilize beneficial microbes to modulate microbial community and protect against biotic and abiotic stresses while simultaneously improving plant growth and productivity.
                        </p>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            The influence of drought on the rhizosphere microbiome poses an escalating threat to crop productivity. A study investigated the impact of drought on soil fungal communities across 24 species and reported an increase in the relative abundance and richness of saprotrophs, a significant decrease in symbiotrophs, without any changes in pathogenic fungi (<a href="https://doi.org/10.1111/nph.17707" target="_blank">Lozano et al. 2021</a>). However, a recent study revealed a drought-mediated increase in the abundance of pathotrophs and a decline in the colonization of saprotrophs and symbiotrophs in both soil and root microbiome under combined drought and DRR-associated disease complex (<a href="https://doi.org/10.1016/j.fcr.2023.108965" target="_blank">Chilakala et al. 2023</a>). Further, it reported significant inhibition of endosymbiotic nitrogen-fixing bacteria, highlighting the importance of rhizosphere engineering to exploit beneficial microbes for resilience against combined drought and DRR disease.
                        </p>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            Studies reported a positive shift in the rhizosphere microbiome and the suppression of soil-borne pathogens following the application of plant-associated microbes (<a href="https://doi.org/10.3389/fpls.2023.1232288" target="_blank">Behr et al. 2023</a>). Agronomic and cultural practices like crop rotation, biocontrol and resistance breeding can impact stress resistance by altering the rhizosphere microbiome. However, rhizosphere engineering leverages the interactions between plants and beneficial microbes to improve crop productivity while minimizing adverse environmental impacts.
                        </p>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            The complex and interdependent interactions between plants and microbial communities involve several key mechanisms. For instance, plant-associated microbiomes confer resistance against pathogens through direct pathogen inhibition, activation of plant immune responses and competition for nutrients (<a href="https://doi.org/10.1007/s10327-024-01204-1" target="_blank">Du et al. 2025</a>). Furthermore, they provide protection against abiotic stresses by improving water and nutrient acquisition, accumulation of osmoprotectants and antioxidant enzymes and by modulating phytohormone signaling (<a href="10.1016/j.tplants.2020.03.014" target="_blank">Liu et al. 2020</a>).
                        </p>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            Synthetic microbial consortia are gaining importance over individual microbes in crop disease management (<a href="https://doi.org/10.1186/s12934-022-01959-2" target="_blank">Hao et al. 2022</a>). Cross-kingdom (fungi and bacteria) consortia have been shown to be more effective at disease protection than fungal or bacterial consortia alone (<a href="https://doi.org/10.1038/s41467-022-35452-6" target="_blank">Zhou et al. 2022</a>). Studies have shown the potential of synthetic microbial consortia in sustaining plant productivity under nutrient-depleted soil (<a href="https://doi.org/10.1111/jam.14645" target="_blank">Wang et al. 2024</a>). However, no microbial consortia formulations have been shown to impart resistance against combined biotic and abiotic stresses.
                        </p>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            A sustainable solution involves combining distinct microbial groups with complementary functions, for example, arbuscular mycorrhizal fungi (AMF) and plant-growth-promoting bacteria (PGPR). AMF are obligate symbiont are highly effective in low-phosphorus soils, boosting a plant's ability to acquire water and nutrients, which directly improves drought tolerance. They also protect against root rot diseases by competing with pathogens for colonization sites and altering the root system to create a less favourable environment for disease (<a href="https://doi.org/10.1016/j.rhisph.2019.100172" target="_blank">Eke et al. 2019; <a href="https://doi.org/10.1016/j.rhisph.2021.100369" target="_blank">Spagnoletti et al. 2021</a>). To enhance plant vitality and nutrient access, PGPRs such as Rhizobium and Pseudomonas that can fix atmospheric nitrogen can be utilized for recycling nutrients like nitrogen and phosphorus, making them directly available to the plants (<a href="https://doi.org/10.3389/fmicb.2022.945127" target="_blank">Jing et al. 2022</a>). Simultaneously, the diazotrophs promote lateral root formation and nodulation through auxin production and improved photosynthetic activity (<a href="https://doi.org/10.3389/fpls.2021.573634" target="_blank">Hsu et al. 2021</a>). The combination of AMF and PGPR is a potential solution due to their established synergistic relationship (<a href="https://doi.org/10.1080/23311932.2024.2366384" target="_blank">Mugabo et al. 2024</a>). Furthermore, these individual microbes have established synergistic interactions and the ability to control pathogens (<a href="https://doi.org/10.1094/PHYTO-05-24-0169-R" target="_blank">Chen et al. 2024; <a href="https://doi.org/10.1111/jam.14645" target="_blank">Wang et al. 2020</a>). Their combined effect is greater than the sum of their individual contributions, enhancing overall plant health and promoting a more diverse and resilient microbial community in the soil. These versatile microbes are metabolic powerhouses, capable of using diverse carbon sources and even detoxifying harmful compounds. They act as biofertilizers by fixing nitrogen and producing plant hormones that promote growth. Crucially, these bacteria also provide tolerance against abiotic stresses, such as freezing and heavy metals, and possess antifungal properties that make them effective against specific plant diseases (<a href="https://doi.org/10.1016/j.micres.2021.126910" target="_blank">Xiao et al. 2022</a>).
                        </p>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            Formulating a consortium of these diverse microbial groups provides a multifaceted solution that enables a plant to withstand both environmental and pathogenic threats, leading to improved crop productivity and resilience. This strategy moves beyond single-strain applications to create an integrated solution for modern agriculture. The long-term success of this strategy can be enhanced by understanding the shift in the rhizosphere microbiome, which will eventually shape the rhizosphere microbial community and reduce the pathogen load in the soil. Furthermore, this will provide insights into the establishment of the introduced microbes and the microbial community response in the rhizosphere, revealing the interactions between individual components of the microbial consortia and the native microorganisms. The identification and characterization of new beneficial microbes through this approach will lead to more effective and precisely targeted formulations for sustainable agriculture. Collectively, this approach can be successfully utilized to protect chickpea plants against DRR, significantly increasing plant biomass and stabilizing yield.
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
                Büttner H, Niehs SP, Vandelannoote K, Cseresnyés Z, Dose B, Richter I, Gerst R, Figge MT, Stinear TP, Pidot SJ, Hertweck C (2021) Bacterial endosymbionts protect beneficial soil fungus from nematode attack. Proceedings of the National Academy of Sciences 118: e2110669118.
                <a href="https://doi.org/10.1073/pnas.2110669118" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Chen C, Wu X, Huang Q, Qin Y, Li C, Zhang X, Wang P, Tan X, Liu Y, Chen Y, Zhang D (2024) Rhodopseudomonas palustris Atp2 Protein Exerts Antifungal Effects by Targeting the Ribosomal Protein MoRpl12 in Magnaporthe oryzae. Phytopathology® 114: 2235-2243.
                <a href="https://doi.org/10.1094/PHYTO-05-24-0169-R" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Chilakala AR, Pandey P, Durgadevi A, Kandpal M, Patil BS, Rangappa K, Reddy PCO, Ramegowda V, Senthil-Kumar M (2023) Drought attenuates plant responses to multiple rhizospheric pathogens: A study on a dry root rot-associated disease complex in chickpea fields. Field Crops Research 298: 14.
                <a href="https://doi.org/10.1016/j.fcr.2023.108965" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Cui Y, Tao Y, Luo Y, Sun R, Han S, Yang Y, Dai Z, Zhang Y (2025) Harnessing synthetic microbial communities for sustainable agriculture: Enhancing soil health and crop yields. Critical Reviews in Environmental Science and Technology 55: 1479-1505.
                <a href="https://doi.org/10.1080/10643389.2025.2543793" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Du Y, Han X, Tsuda K (2025) Microbiome-mediated plant disease resistance: recent advances and future directions. Journal of General Plant Pathology 91: 1-17.
                <a href="https://doi.org/10.1007/s10327-024-01204-1" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Egerton-Warburton LM, Querejeta JI, Allen MF (2007) Common mycorrhizal networks provide a potential pathway for the transfer of hydraulically lifted water between plants. J Exp Bot 58: 1473-1483.
                <a href="https://doi.org/10.1093/jxb/erm009" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Eke P, Wakam LN, Fokou PVT, Ekounda TV, Sahu KP, Wankeu THK, Boyom FF (2019) Improved nutrient status and Fusarium root rot mitigation with an inoculant of two biocontrol fungi in the common bean (<i>Phaseolus vulgaris</i> L.). Rhizosphere 12.
                <a href="https://doi.org/10.1016/j.rhisph.2019.100172" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Hsu SH, Shen MW, Chen JC, Lur HS, Liu CT (2021) The Photosynthetic Bacterium <i>Rhodopseudomonas palustris</i> Strain PS3 Exerts Plant Growth-Promoting Effects by Stimulating Nitrogen Uptake and Elevating Auxin Levels in Expanding Leaves. Frontiers in Plant Science 12: 18.
                <a href="https://doi.org/10.3389/fpls.2021.573634" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Irulappan V, Kandpal M, Saini K, Rai A, Ranjan A, Sinharoy S, Senthil-Kumar M (2022) Drought Stress Exacerbates Fungal Colonization and Endodermal Invasion and Dampens Defense Responses to Increase Dry Root Rot in Chickpea. Molecular Plant-Microbe Interactions® 35: 583-591.
                <a href="https://doi.org/10.1094/MPMI-07-21-0195-FI" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Irulappan V, Mali KV, Patil BS, Manjunatha H, Muhammad S, Senthil-Kumar M (2021) A sick plot–based protocol for dry root rot disease assessment in field-grown chickpea plants. Applications in Plant Sciences 9: e11445.
                <a href="https://doi.org/10.1002/aps3.11445" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Kashyap AS, Kannojia P, Manzar N, Srivastava D, Malaviya D, Singh UB, Sharma PK (2026) Development of a Trichoderma–Bacillus biofilm inoculant for plant growth promotion and biocontrol of Sclerotium and Fusarium in chickpea. Discover Sustainability 7: 301.
                <a href="https://doi.org/10.1007/s43621-025-02356-6" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Khaliq A, Alam S, Khan IU, Khan D, Naz S, Zhang Y, Shah AA (2020) Integrated control of dry root rot of chickpea caused by Rhizoctonia bataticola under the natural field condition. Biotechnology Reports 25: e00423.
                <a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Liu H, Brettell LE, Qiu Z, Singh BK (2020) Microbiome-mediated stress resistance in plants. Trends in plant science 25: 733-743.
                <a href="https://doi.org/10.1016/j.tplants.2020.03.014" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Lozano YM, Aguilar-Trigueros CA, Roy J, Rillig MC (2021) Drought induces shifts in soil fungal communities that can be linked to root traits across 24 plant species. The New Phytologist 232: 1917-1929.
                <a href="https://doi.org/10.1111/nph.17707" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Moreno Jimenez E, Ferrol N, Corradi N, Penalosa JM, Rillig MC (2024) The potential of arbuscular mycorrhizal fungi to enhance metallic micronutrient uptake and mitigate food contamination in agriculture: prospects and challenges. New Phytol 242: 1441-1447.
                <a href="https://doi.org/10.1111/nph.19269" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Op S, Kumari M (2017) Management of dry root rot disease [Rhizoctonia bataticola] of chickpea through fungicides. 45-47.
                <a href="https://doi.org/10.1111/nph.19269" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Palmieri D, Vitullo D, De Curtis F, Lima G (2017) A microbial consortium in the rhizosphere as a new biocontrol approach against fusarium decline of chickpea. Plant and Soil 412: 425-439.
                <a href="https://doi.org/10.1007/s11104-016-3080-1" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Sakarika M, Spanoghe J, Sui YX, Wambacq E, Grunert O, Haesaert G, Spiller M, Vlaeminck SE (2020) Purple non-sulphur bacteria and plant production: benefits for fertilization, stress resistance and the environment. Microbial Biotechnology 13: 1336-1365.
                <a href="https://doi.org/10.1111/1751-7915.13474" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Sidharthan VK, Pothiraj G, Suryaprakash V, Singh AK, Aggarwal R, Shanmugam V (2023) A synergic and compatible microbial-based consortium for biocontrol of Fusarium wilt of tomato. Phytopathol Mediterr 62: 183-197.
                <a href="https://doi.org/10.36253/phyto-13055" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Singh D, Mathimaran N, Boller T, Kahmen A (2019) Bioirrigation: a common mycorrhizal network facilitates the water transfer from deep-rooted pigeon pea to shallow-rooted finger millet under drought. Plant and Soil 440: 277-292.
                <a href="https://doi.org/10.1007/s11104-019-04082-1" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Sinha R, Irulappan V, Patil BS, Reddy PCO, Ramegowda V, Mohan-Raju B, Rangappa K, Singh HK, Bhartiya S, Senthil-Kumar M (2021) Low soil moisture predisposes field-grown chickpea plants to dry root rot disease: evidence from simulation modeling and correlation analysis. Scientific Reports 11: 6568.
                <a href="https://doi.org/10.1038/s41598-021-85928-6" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Spagnoletti FN, Carmona M, Balestrasse K, Chiocchio V, Giacometti R, Lavado RS (2021) The arbuscular mycorrhizal fungus Rhizophagus intraradices reduces the root rot caused by Fusarium pseudograminearum in wheat. Rhizosphere 19: 100369.
                <a href="https://doi.org/10.1016/j.rhisph.2021.100369" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Wang X, Ding T, Li Y, Guo Y, Li Y, Duan T (2020) Dual inoculation of alfalfa (Medicago sativa L.) with Funnelliformis mosseae and Sinorhizobium medicae can reduce Fusarium wilt. J Appl Microbiol 129: 665-679.
                <a href="https://doi.org/10.1111/jam.14645" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
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
