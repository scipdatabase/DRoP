<?php
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Crop Rotation</title>

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

         .read-more-state {
            display: none;
        }

         .read-more-target {
            opacity: 0;
            max-height: 0;
            font-size: 0;
            transition: all 0.4s ease;
            overflow: hidden;
        }

         .read-more-state:checked~.read-more-wrap .read-more-target {
            opacity: 1;
            max-height: 2000px;
            /* Large enough for long text */
            font-size: 1rem;
        }

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

         .read-more-state:checked~.read-more-wrap .read-more-trigger::before {
            content: "Read Less [-]";
        }
    </style>
</head>

<div class="container-fluid my-3">
    <div class="row g-5">
        <div class="col-lg-12">
            <div class="card content-card p-2 p-md-3 mb-3 shadow-sm">
 
                <h2 class="text-primary fw-bold mb-4 border-bottom pb-2">
                    <i class="fas fa-sync-alt me-2"></i>Strategic Crop Rotation
                </h2>

                <p class="lead-text">
                    DRR remains a significant threat to chickpea productivity. While traditional management relies on chemical fungicides, the use of strategic crop rotation serves as a foundational cultural practice to disrupt pathogen life cycles. Crop rotation acts as the primary tool for biotic diversification, disrupting the life cycle of soil-borne pathogens through planned sequences of non-host species.
                </p>

                <h3 class="text-primary mt-3 mb-2">Pathogen Suppression & Inoculum Decline</h3>
                <ul class="lead-text mt-3">
                    <li><strong>Microsclerotia Management:</strong> Rotating with non-host cereals, starves the survival structures of <em>M. phaseolina</em>.</li>
                    <li><strong>Rhizosphere Shift:</strong> Different crop exudates alter the microbiome, encouraging antagonistic bacteria that outcompete the pathogen.</li>
                    <li><strong>Natural Suppressants:</strong> Crops like mustard release volatile isothiocyanates that reduce the viability of fungal resting structures.</li>
                </ul>

                <input type="checkbox" id="readMoreToggle" class="read-more-state" />

                <div class="read-more-wrap">
                    <div class="read-more-target mt-3 text-dark">
                        <hr>
                        <h5 class="fw-bold text-center text-primary">Crop Rotation</h5>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            The management of dry root rot through strategic crop rotation is the primary tool for biotic diversification, acting as a foundational agronomic and cultural practice that disrupts the life cycle of soil-borne pathogens through planned sequences of non-host species. Unlike monocropping, which fosters a specialized and often pathogenic soil environment, the efficacy of rotation in managing DRR stems from its ability to reduce the virulence and abundance of <em>Macrophomina phaseolina</em> over time.
                        </p>
                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            The causal agent persists in the soil via resilient microsclerotia that remain viable for several years; however, their population dynamics are highly sensitive to specific host exudates. Continuous chickpea cultivation allows the pathogen to persist in the soil for extended periods and maintain high virulence. Conversely, a 2-to-3-year rotation with non-host crops effectively starves the microsclerotia. Since these survival structures rely on host-specific signals to germinate, crop rotation naturally reduces soil inoculum levels (<a href="https://http://dx.doi.org/10.1094/PD-74-0812" target="_blank">Singh et al., 1990; <a href="https://doi.org/10.1111/jph.12854" target="_blank">Lodha & Mawar, 2020</a>). Further, a study reported 36 weed species and 18 intercrops/rotated crops as non-hosts in the host species’ fields, providing a broader rotation option (<a href="https://doi.org/10.1016/j.envexpbot.2025.106197" target="_blank">Mirchandani et al., 2025</a>). Intercropping and mixed cropping of chickpea with non-host species, including major oilseeds, barley, lentil, maize, and wheat, would reduce the pathogen inoculum in the soil.
                        </p>
                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            The success of this approach is largely attributed to the rotation effect, which encompasses profound shifts in the soil’s chemical, physical, and biological properties. Different crop families exude distinct patterns of organic acids and signaling molecules. Rotating legumes with brassicas or small grains alters the rhizosphere microbiome, encouraging the growth of antagonistic bacteria and fungi that outcompete <em>M. phaseolina</em> for space and nutrients (<a href="https://doi.org/10.1016/j.soilbio.2007.03.005" target="_blank">Larkin, 2008</a>). Furthermore, specific rotation crops act as natural suppressants—mustard and marigold, for example, release volatile isothiocyanates and allelopathic compounds that actively reduce the viability of fungal resting structures (<a href="https://doi.org/10.1080/07352680600611543" target="_blank">Matthiessen & Kirkegaard, 2006</a>).
                        </p>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            Beyond direct pathogen suppression, crop rotation is a vital tool for moisture-stress resilience. Since DRR is notoriously triggered by high soil temperatures and drought, rotating deep-rooted crops with shallow-rooted ones improves soil structure and organic matter content. This modification of the root zone enhances water infiltration and retention, preventing the physiological tipping point that allows <em>M. phaseolina</em> to transition from a dormant state to an aggressive, necrotic infection (<a href="https://doi.org/10.18805/LR-5149" target="_blank">Sunkad et al., 2023</a>). By maintaining higher soil moisture and cooler canopy temperatures, rotation stabilizes the plant's defense system.
                        </p>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            In conclusion, integrated management reports emphasize that crop rotation is not a standalone solution but a foundational strategy that complements biological interventions. This multifaceted approach reduces selection pressure on any single management tool, slows the development of pathogen resistance, and ensures long-term yield stability (<a href="https://doi.org/10.1038/nature01014" target="_blank">Tilman et al., 2002; <a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank">Khaliq et al., 2020</a>). By breaking the cycle of continuous host availability, crop rotation remains one of the most cost-effective and sustainable methods for mitigating soil-borne diseases in modern climate-resilient agriculture.
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
                Singh, S., Nene, Y. L., & Reddy, M. V. (1990). Influence of cropping systems on Macrophomina phaseolina populations in soil. Plant Disease, 74(11), 812-814.
                <a href="http://dx.doi.org/10.1094/PD-74-0812" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Larkin, R. P. (2008). Relative effects of biological amendments and crop rotations on soil microbial communities and soilborne diseases of potato. Soil Biology and Biochemistry, 40(6), 1341-1351.
                <a href="https://doi.org/10.1016/j.soilbio.2007.03.005" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Lodha, S., & Mawar, R. (2020). Population dynamics of Macrophomina phaseolina in relation to disease management. Journal of Phytopathology, 168(1), 1-17.
                <a href="https://doi.org/10.1111/jph.12854" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Matthiessen, J. N., & Kirkegaard, J. A. (2006). Biofumigation and enhanced biodegradation: Opportunity and challenge in soilborne pest and disease management. Critical Reviews in Plant Sciences, 25(3), 235-265.
                <a href="https://doi.org/10.1080/07352680600611543" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Sunkad, G., et al. (2023). Identification of resistant genotypes and integrated management of dry root rot of chickpea. Legume Research, 46(8), 1064-1072.
                <a href="https://doi.org/10.18805/LR-5149" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Tilman, D., et al. (2002). Agricultural sustainability and intensive production practices. Nature, 418, 671–677.
                <a href="https://doi.org/10.1038/nature01014" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Khaliq, A., et al. (2020). Integrated control of dry root rot of chickpea under natural field conditions. Biotechnology Reports, 25, e00423.
                <a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
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
