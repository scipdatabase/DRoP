<?php
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Transgenic and gene editing</title>
    
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
            <div class="card content-card p-4 shadow-sm mb-2">

                <h2 class="text-primary fw-bold mb-3 border-bottom pb-2">
                    <i class="fas fa-shield-virus me-2"></i>Transgenics & Gene Editing
                </h2>

                <p class="lead-text mb-2">
                    DRR, caused by <em>Macrophomina phaseolina</em>, worsens with heat and drought. Because <em>Cicer arietinum</em> lacks natural genetic resistance, antifungal proteins (AFPs) like novel eBg_9562 are being used to engineer durable defense.
                </p>

                <h4 class="text-primary fw-bold mt-1 mb-1">The eBg_9562 Mechanism</h4>
                <ul class="lead-text ps-3">
                    <li class="mb-1"><strong>Growth Inhibition:</strong> Arrests <em>M. phaseolina</em> development at concentrations from 5 to 30 μg/mL.</li>
                    <li class="mb-1"><strong>Structural Damage:</strong> Deflates hyphae and deforms microsclerotia to block plant tissue colonization.</li>
                    <li class="mb-1"><strong>Membrane Disruption:</strong> Directly targets and compromises plasma membrane integrity.</li>
                </ul>

                <input type="checkbox" id="readMoreToggle" class="read-more-state" />

                <div class="mt-1 p-2 bg-light rounded-3 border-start border-success border-4">
                    <h6 class="fw-bold text-success mb-3">Defense Overview</h6>
                    <div class="row text-center g-2">
                        <div class="col-4">
                            <span class="badge bg-success mb-1">Protein Source</span>
                            <p class="small mb-0"><em>Burkholderia gladioli</em> <span class="text-muted">(NGJ1)</span></p>
                        </div>
                        <div class="col-4 border-start">
                            <span class="badge bg-success mb-1">System</span>
                            <p class="small mb-0">Hairy Root <span class="text-muted">Expression</span></p>
                        </div>
                        <div class="col-4 border-start">
                            <span class="badge bg-success mb-1">Outcome</span>
                            <p class="small mb-0">Reduced Disease Severity Index <span class="text-muted">(Severity)</span></p>
                        </div>
                    </div>
                </div>

                <div class="read-more-wrap">
                    <div class="read-more-target mt-3 text-dark">
                        <hr>
                        <h5 class="fw-bold text-center text-primary">Transgenics and gene editing</h5>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            The cultivation of disease-resistant cultivars is an effective strategy for disease management, but chickpea lacks the resistant genetic stocks in its natural germplasm (<a href="https://doi.org/10.9734/acri/2025/v25i91540" target="_blank">Talekar et al., 2021</a>). Due to the lack of natural resistance sources within chickpea germplasm, a transgenic and gene editing approach offers a viable pathway to introduce resistance traits or eliminate susceptibility factors from diverse biological sources.
                        </p>
                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            Various microbes and plants express antifungal proteins, commonly referred to as antifungal peptides or antimicrobial peptides, as a defence mechanism against fungal infections. These antifungal proteins have a modest size and range of activity, possessing strong fungicidal properties that may limit the development of phytopathogenic fungi by disrupting the integrity of fungal cell membranes (<a href="https://doi.org/10.1038/srep32121" target="_blank">Vriens et al., 2016</a>). Although a wide range of antifungal compounds is available, only a few are ideal for plant expression, making antifungal proteins and peptides a potential source of resistance.
                        </p>
                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            Evidence for the successful deployment of antifungal proteins in developing DRR tolerance remains limited to a few case studies (<a href="https://doi.org/10.1007/s12033-012-9603-y" target="_blank">Acharya et al., 2013; <a href="https://doi.org/10.3389/fpls.2018.00920" target="_blank">Majumder et al., 2018</a>). The transgenic approach primarily focuses on the expression of pathogenesis-related (PR) proteins, such as chitinases and beta-1,3-glucanases, which actively degrade the fungal cell walls upon contact. Recently, a novel prophage tail-like antifungal protein (Bg_9562) was identified in the bacterium Burkholderia gladioli strain NGJ1 and shown to play a role in mycophagy and broad-spectrum antifungal activity against various phytopathogenic fungi (<a href="https://doi.org/10.1038/s41467-017-00529-0" target="_blank">Swain et al., 2017</a>). A modified version of the Bg_9562 protein (eBg_9562) was subsequently patented for its broad-spectrum antifungal activity over the original protein (<a href="https://doi.org/10.1186/s12934-022-01959-2" target="_blank">Swain et al., 2018</a>).
                        </p>
                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            This novel antifungal protein, eBg_9562, can be a potential candidate for the transgenic approach to protect against the DRR pathogen under both in vitro and in vivo conditions. Under in vitro conditions, application of various concentrations of purified protein to the pathogen <em>Macrophomina phaseolina</em> resulted in fungal growth inhibition at a minimum concentration of 5 μg/mL, with concentrations above 30 μg/mL exhibiting substantial inhibition within 24 hours. This inhibition could be attributed to reduced metabolic activity of the fungus, as observed by decreased acidification of the surrounding media, suggesting a potential disruptive effect on the plasma membrane components of the fungus. Further, eBg_9562 protein serves as a viable candidate for enhancing plant tolerance through the development of stable transgenics.
                        </p>
                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            Beyond direct antifungal activity, transgenic lines can also be engineered to target the abiotic factors that aggravate infection to protect from combined stress. For instance, lines overexpressing osmotin genes have been developed to enhance the plant’s osmotic adjustment during drought conditions. This is critical because DRR is notoriously triggered by drought stress; by maintaining hydraulic conductance and cellular stability under drought, these transgenic plants indirectly suppress the stress window that the pathogen exploits for colonization (<a href="https://doi.org/10.1186/s12934-022-01959-2" target="_blank">Rocha et al., 2023</a>).
                        </p>
                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            Finally, the latest frontier in DRR management moves beyond the traditional transgenic approach to CRISPR/Cas9 gene editing, enabling precision resilience without introducing foreign DNA. This approach allows researchers to perform targeted mutagenesis of susceptibility genes, which are endogenous host genes that the fungus subverts to facilitate infection. By knocking out these specific genomic targets, the edited chickpea plant becomes effectively unresponsive to the pathogen’s invasion signals. Additionally, gene editing is being utilized to upregulate endogenous defense pathways, such as phenylpropanoid and flavonoid pathways. By precisely modulating transcription factors, scientists can prime the plant to accumulate metabolites such as naringenin, which are essential for establishing the metabolic lockdown required to halt fungal progression into the root cortex.
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
                Acharya, K., Pal, A. K., Gulati, A., Kumar, S., Singh, A. K. and Ahuja, P. S. (2013) Overexpression of Camellia sinensis Thaumatin-Like Protein, CsTLP in Potato Confers Enhanced Resistance to Macrophomina phaseolina and Phytophthora infestans Infection. Molecular Biotechnology, 54, 609-622.
                <a href="https://doi.org/10.1007/s12033-012-9603-y" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Majumder, S., Datta, K., Sarkar, C., Saha, S. C. and Datta, S. K. (2018) The Development of Macrophomina phaseolina (Fungus) Resistant and Glufosinate (Herbicide) Tolerant Transgenic Jute. Frontiers in Plant Science, 9.
                <a href="https://doi.org/10.3389/fpls.2018.00920" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Swain, D. M., Yadav, S. K., Tyagi, I., Kumar, R., Kumar, R., Ghosh, S., et al. (2017) A prophage tail-like protein is deployed by Burkholderia bacteria to feed on fungi. Nature Communications, 8, 404.
                <a href="https://doi.org/10.1038/s41467-017-00529-0" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Talekar, S., Viswanatha, K. and Lohithasawa, H. (2021) Screening chickpea genotypes for resistance to rhizoctonia bataticola in controlled conditions. Legume Res, 44, 101-108.
                <a href="https://doi.org/10.18805/LR-4061" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Vriens, K., Peigneur, S., De Coninck, B., Tytgat, J., Cammue, B. P. A. and Thevissen, K. (2016) The antifungal plant defensin AtPDF2.3 from Arabidopsis thaliana blocks potassium channels. Scientific Reports, 6, 32121.
                <a href="https://doi.org/10.1038/srep32121" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>

        </div>
    </div>
</div>
</div>
</div> <?php include 'footer.php'; ?>

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
