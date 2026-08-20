<?php
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Common Practices</title>
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

        @media (max-width: 768px) {
            .zoom-container {
                height: 300px;
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
            font-size: 1rem;
        }

        .read-more-trigger {
            cursor: pointer;
            display: inline-block;
            padding: 10px 0;
            color: #198754;
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
            <div class="card content-card p-4 p-md-4 mb-4 shadow-sm">
                <h2 class="text-primary fw-bold mb-4 border-bottom pb-2">
                    <i class="fas fa-shield-virus me-2"></i>Common Practices
                </h2>
                <h3 class="text-primary fw-bold mt-3 mb-2">Chemical Management</h3>
                <p class="lead-text">
                    Chemical management remains the frontline defense for immediate control of <em>Macrophomina phaseolina</em> inoculum, primarily through targeted seed treatments and early-stage applications. Because the pathogen is soil-borne and attacks the root system directly, <strong>systemic fungicides</strong> are prioritized over foliar sprays to ensure early-stage protection, as they can spread efficiently throughout the root system well in time to provide wider coverage against infection (Khaliq et al. 2020).
                </p>

                <div class="row my-3 g-2">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border-start border-primary border-4 h-100">
                            <h5 class="fw-bold text-primary mb-2"><i class="fas fa-vial me-2"></i>Fungicide Application</h5>
                            <p class="small text-muted mb-0">
                                Common traditional fungicides include <strong>Carbendazim</strong> and <strong>Mancozeb</strong> (applied at 2–3 g/kg of seed). Specialized systemic formulations like <strong>Bavistin®</strong> (Thiophanate Methyl) and <strong>Aliette®</strong> suppress fungal growth and colony diameter in vitro and in field conditions (Khaliq et al. 2020). Combinations like <strong>Xelora</strong> (Thiophanate methyl 45% + Pyraclostrobin 5%), <strong>Carboxin (Vitavax)</strong>, and <strong>Tebuconazole</strong> inhibit mycelial growth and reduce microsclerotia viability (Kulkarni & Ashtaputre, 2020).
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded-3 border-start border-info border-4 h-100">
                            <h5 class="fw-bold text-info mb-2"><i class="fas fa-leaf me-2"></i>Integrated & Biological Control</h5>
                            <p class="small text-muted mb-0">
                                Timely applications at early disease stages prevent resistance and protect non-target microbes (Khaliq et al. 2020). Integrating chemicals with biological agents like <em>Trichoderma spp.</em> or <em>Bacillus</em> consortia creates a synergistic shield against infection (Sharma et al., 2020; Malagi et al., 2024). However, purely biological controls may yield inconsistent results if local environmental conditions are suboptimal for microbe proliferation.
                            </p>
                        </div>
                    </div>
                </div>

                <h3 class="text-primary fw-bold mt-2 mb-3">Physical Soil Disinfestation</h3>
                <p class="lead-text">
                    Physical soil disinfestation practices are crucial for reducing primary soil inoculum load, as the pathogen perpetuates through infected debris (Khaliq et al. 2020):
                </p>
                <ul class="lead-text mt-1 mb-2">
                    <li><strong>Soil Solarization:</strong> An eco-friendly method covering field soil with transparent polyethylene sheets during high-temperature summer months. Trapped solar radiation elevates soil temperatures to kill sclerotia and mycelia in upper soil layers, significantly reducing viable pathogen populations before sowing.</li>
                    <li><strong>Chemical Biofumigation:</strong> Application of volatile biofumigants in high-incidence hotspots to rapidly disrupt resting structures deep within the soil profile. Combined with moderately resistant cultivars, this provides a cost-effective management strategy (Khaliq et al. 2020).</li>
                </ul>

                <div class="symptom-highlight p-3 bg-light border-start border-warning border-4 my-4">
                    While these common practices offer immediate pathogen suppression, their indiscriminate mode of action non-selectively depletes the beneficial rhizosphere microbiome. This ecological disruption impairs long-term soil health and natural disease suppressiveness, rendering conventional methods ineffective over time and warranting a sustainable solution.
                </div>

                <h2 class="text-primary fw-bold mb-3 border-bottom pb-2">
                    <i class="fas fa-dna me-2"></i>Engineered Resistance & Antifungal Proteins
                </h2>
                <p class="lead-text">
                    DRR, caused by the necrotrophic pathogen <em>Macrophomina phaseolina</em>, is exacerbated by drought and high temperatures. As <em>Cicer arietinum</em> lacks natural resistant genetic stocks, <strong>antifungal proteins (AFPs)</strong> are emerging as a vital source of engineered resistance.
                </p>

                <div class="symptom-highlight p-3 bg-light border-start border-primary border-4 my-3">
                    Antifungal proteins like the novel eBg_9562 offer strong fungicidal properties by disrupting fungal cell membranes and reducing metabolic acidification.
                </div>

                <h3 class="text-primary fw-bold mt-3 mb-2">The eBg_9562 Mechanism</h3>
                <ul class="lead-text mt-3">
                    <li><strong>Growth Inhibition:</strong> Purified eBg_9562 inhibits <em>M. phaseolina</em> at concentrations as low as 5 μg/mL, with substantial arrest at 30 μg/mL.</li>
                    <li><strong>Morphological Disruption:</strong> Exposure leads to deflated hyphae and malformed microsclerotia, preventing effective tissue colonization.</li>
                    <li><strong>Membrane Interference:</strong> Reduced acidification of surrounding media suggests a direct impact on the fungus’s plasma membrane components.</li>
                </ul>

                <input type="checkbox" id="readMoreToggle" class="read-more-state" />

                <div class="mt-3 p-3 bg-light rounded-4 border-start border-success border-4">
                    <h5 class="fw-bold text-success mb-3 text-uppercase">Protein-Based Defense</h5>
                    <div class="row text-center g-2">
                        <div class="col-4">
                            <div class="badge bg-success mb-2">Source</div>
                            <p class="small mb-0 fw-bold">B. gladioli<br><span class="text-muted fw-normal">Strain NGJ1</span></p>
                        </div>
                        <div class="col-4 border-start border-2">
                            <div class="badge bg-success mb-2">Application</div>
                            <p class="small mb-0 fw-bold">Hairy Root<br><span class="text-muted fw-normal">Transformation</span></p>
                        </div>
                        <div class="col-4 border-start border-2">
                            <div class="badge bg-success mb-2">Efficacy</div>
                            <p class="small mb-0 fw-bold">Lower DSI<br><span class="text-muted fw-normal">Disease Severity Index</span></p>
                        </div>
                    </div>
                </div>

                <div class="read-more-wrap">
                    <div class="read-more-target mt-3 text-dark">
                        <hr>
                        <h5 class="fw-bold text-center text-primary">Common Practices</h5>

                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            Chemical management remains the frontline defense for immediate control of <em>Macrophomina phaseolina</em> inoculum, primarily through targeted seed treatments and early-stage applications. Because the pathogen is soil-borne and attacks the root system directly, systemic fungicides are prioritized over foliar sprays to ensure early-stage protection, as they can spread efficiently throughout the root system well in time to provide wider coverage against infection (<a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank">Khaliq et al. 2020</a>).
                        </p>
                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            Common traditional fungicides include Carbendazim and Mancozeb, often applied at rates of 2–3 g/kg of seed. Modern specialized formulations and specific systemic fungicides have demonstrated superior bio-efficacy. For instance, Bavistin® (containing Thiophanate Methyl as an active ingredient) and Aliette® have proven highly effective in successfully suppressing fungal growth and reducing colony diameter under both in vitro and field conditions (<a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank">Khaliq et al. 2020</a>). Similarly, combination formulations like Xelora (Thiophanate methyl 45% + Pyraclostrobin 5%) have shown high efficiency in inhibiting mycelial growth and reducing microsclerotia viability under field conditions (<a href="https://doi.org/10.20546/ijcmas.2020.901.093" target="_blank">Kulkarni & Ashtaputre, 2020</a>). Other effective chemicals include Carboxin (Vitavax) and Tebuconazole, which provide systemic protection against the necrotrophic invasion of the vascular tissues.
                        </p>
                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            To prevent the development of pathogen resistance and protect non-target beneficial microorganisms, indiscriminate spraying should be avoided, while a single or few timely applications at early stages of disease development are recommended (<a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank">Khaliq et al. 2020</a>). Furthermore, integrating these chemicals with biological agents like Trichoderma spp. or Bacillus consortia creates a synergistic effect, providing a more robust shield against infection than synthetic inputs used in isolation (<a href="10.22271/j.ento.2020.v8.i5i.7571" target="_blank">Sharma et al., 2020; <a href="https://doi.org/10.18805/ag.D-5649" target="_blank">Malagi et al., 2024</a>). However, purely biological controls may yield poor or inconsistent results if local environmental conditions are not ideal for the proliferation of beneficial microbes (<a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank">Khaliq et al. 2020</a>).
                        </p>
                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            In addition, physical soil disinfestation practices are crucial for reducing the primary soil inoculum load, as the pathogen perpetuates through infected debris, which leads to host susceptibility (<a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank">Khaliq et al. 2020</a>). Soil solarization is an eco-friendly method that involves covering the field soil with transparent polyethylene sheets during high-temperature summer months. The trapped solar radiation elevates soil temperatures to levels that could kill the sclerotia and mycelia of <em>M. phaseolina</em> in upper soil layers, which significantly reduces the viable pathogen population before sowing. For high-incidence hotspots and heavily infested fields, chemical fumigation offers a rapid reduction of the soil-borne inoculum. Application of volatile biofumigants disrupts the fungus's resting structures deep within the soil profile. These practices, integrated with host resistance such as the utilization of moderately resistant cultivars, offer a cost-effective management strategy (<a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank">Khaliq et al. 2020</a>).
                        </p>
                        <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                            While these common practices offer immediate pathogen suppression, their indiscriminate mode of action non-selectively depletes the beneficial rhizosphere microbiome. This ecological disruption impairs long-term soil health and natural disease suppressiveness, rendering conventional methods ineffective over time and warranting a sustainable solution.
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
                Khaliq, A., Alam, S., Khan, I.U., Khan, D., Naz, S., Zhang, Y., Shah, A.A. (2020) Integrated control of dry root rot of chickpea caused by Rhizoctonia bataticola under the natural field condition. Biotechnology Reports 25: e00423.
                <a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Kulkarni, V. R. and Ashtaputre, S. A. (2020). Evaluation of Bio- efficacy and Phytotoxicity of Thiophenate Methyl 450g/l + Pyreclostrobin 50g/l (Xelora 500g/l FS) against Dry Root Rot of Chickpea. Int.J.Curr.Microbiol.App.Sci. 9(1): 848-852.
                <a href="https://doi.org/10.20546/ijcmas.2020.901.093" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Malagi, N. C., et al. (2024). Screening of different bioagents and fungicides against dry root rot of chickpea. Agricultural Science Digest, 44(3), 398-405.
                <a href="https://doi.org/10.18805/ag.D-5649" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Rocha, F. S., Sharma, M., et al. (2023). Diseases of chickpea. In Handbook of vegetable and herb diseases (pp. 1-44). Springer International Publishing.
                <a href="https://doi.org/10.3389/fmicb.2020.582779" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
            </div>
            <div class="citation-item">
                Sharma, O. P., et al. (2020). Effect of different soil amendments and bio agents on development of dry root rot of chickpea. Journal of Entomology and Zoology Studies, 8(5), 637-639.
                <a href="10.22271/j.ento.2020.v8.i5i.7571" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
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
