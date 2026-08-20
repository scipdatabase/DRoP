<?php
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fungicides</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
            max-height: 2500px;
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

<body>
    <div id="scroll-progress"></div>

    <div class="container-fluid my-3">
        <div class="row g-3">
            <div class="col-lg-12">
                <div class="card content-card p-3 p-md-3 mb-2 shadow-sm">
                    <h2 class="text-primary fw-bold mb-3 border-bottom pb-2">
                        <i class="fas fa-flask me-2"></i>Fungicides
                    </h2>

                    <p class="lead-text">
                        Chemical intervention remains the frontline defense for immediate suppression of <em>Macrophomina phaseolina</em> inoculum. Because the pathogen targets the root vascular system directly, targeted systemic seed treatments and physical soil disinfestation serve as crucial early-stage safeguards. Systemic fungicides spread efficiently throughout the root system to provide wider early coverage, while physical practices like solarization eliminate primary soil-borne microsclerotia.
                    </p>

                    <h3 class="text-primary mt-3 mb-2">Key Management Pillars</h3>
                    <ul class="lead-text mt-2">
                        <li><strong>Targeted Seed Treatments:</strong> Standard applications of Carbendazim or Mancozeb (2–3 g/kg), as well as modern formulations like Xelora®, protect emerging roots.</li>
                        <li><strong>Systemic Protection:</strong> Fungicides like Bavistin® and Aliette® effectively inhibit mycelial growth and restrict vascular colonization.</li>
                        <li><strong>Soil Solarization:</strong> Polyethylene sheet mulching during high-temperature months heats topsoil to kill resting sclerotia naturally.</li>
                        <li><strong>Integrated Biocontrol:</strong> Combining chemical seed treatments with <em>Trichoderma spp.</em> or <em>Bacillus</em> consortia produces synergistic, long-lasting protection.</li>
                    </ul>

                    <input type="checkbox" id="readMoreToggle" class="read-more-state" />

                    <div class="mt-3 p-2 bg-light rounded-4 border-start border-success border-4">
                        <h5 class="fw-bold text-success mb-2">The Management Matrix</h5>
                        <div class="row text-center g-2">
                            <div class="col-4">
                                <div class="badge bg-success mb-2">Seed Care</div>
                                <p class="small mb-0 fw-bold">Systemic Fungicides<br><span class="text-muted fw-normal">Vascular Protection</span></p>
                            </div>
                            <div class="col-4 border-start border-2">
                                <div class="badge bg-success mb-2">Soil Health</div>
                                <p class="small mb-0 fw-bold">Solarization<br><span class="text-muted fw-normal">Inoculum Reduction</span></p>
                            </div>
                            <div class="col-4 border-start border-2">
                                <div class="badge bg-success mb-2">Synergy</div>
                                <p class="small mb-0 fw-bold">Bio-Chemical Integration<br><span class="text-muted fw-normal">Resilience & Safety</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="read-more-wrap">
                        <div class="read-more-target mt-2 text-dark">
                            <hr>
                            <h5 class="fw-bold text-center text-primary">Chemical & Soil Management Strategies</h5>

                            <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                                Chemical management remains the frontline defense for immediate control of <em>Macrophomina phaseolina</em> inoculum, primarily through targeted seed treatments and early-stage applications. Because the pathogen is soil-borne and attacks the root system directly, systemic fungicides are prioritized over foliar sprays to ensure early-stage protection, as they can spread efficiently throughout the root system well in time to provide wider coverage against infection (<a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank">Khaliq et al., 2020</a>).
                            </p>
                            <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                                Common traditional fungicides include Carbendazim and Mancozeb, often applied at rates of 2–3 g/kg of seed. Modern specialized formulations and specific systemic fungicides have demonstrated superior bio-efficacy. For instance, Bavistin® (containing Thiophanate Methyl as an active ingredient) and Aliette® have proven highly effective in successfully suppressing fungal growth and reducing colony diameter under both <em>in vitro</em> and field conditions (<a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank">Khaliq et al., 2020</a>). Similarly, combination formulations like Xelora (Thiophanate methyl 45% + Pyraclostrobin 5%) have shown high efficiency in inhibiting mycelial growth and reducing microsclerotia viability under field conditions (<a href="https://doi.org/10.20546/ijcmas.2020.901.093" target="_blank">Kulkarni & Ashtaputre, 2020</a>). Other effective chemicals include Carboxin (Vitavax) and Tebuconazole, which provide systemic protection against the necrotrophic invasion of vascular tissues.
                            </p>
                            <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                                To prevent the development of pathogen resistance and protect non-target beneficial microorganisms, indiscriminate spraying should be avoided, while single or few timely applications at early stages of disease development are recommended (<a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank">Khaliq et al., 2020</a>). Furthermore, integrating these chemicals with biological agents like <em>Trichoderma spp.</em> or <em>Bacillus</em> consortia creates a synergistic effect, providing a more robust shield against infection than synthetic inputs used in isolation (<a href="https://doi.org/10.18805/ag.D-5649" target="_blank">Malagi et al., 2024; <a href="https://doi.org/10.22271/j.ento.2020.v8.i5i.7571" target="_blank">Sharma et al., 2020</a>). However, purely biological controls may yield poor or inconsistent results if local environmental conditions are not ideal for beneficial microbial proliferation (<a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank">Khaliq et al., 2020</a>).
                            </p>
                            <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                                In addition, physical soil disinfestation practices are crucial to reduce the primary soil inoculum load, as the pathogen perpetuates through infected debris that leads to host susceptibility (<a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank">Khaliq et al., 2020</a>). Soil solarization is an eco-friendly method involving covering the field soil with transparent polyethylene sheets during high-temperature summer months. The trapped solar radiation elevates soil temperatures to levels that can kill the sclerotia and mycelia of <em>M. phaseolina</em> in upper soil layers, significantly reducing the viable pathogen population before sowing. For high-incidence hotspots and heavily infested fields, chemical fumigation offers a rapid reduction of soil-borne inoculum. Application of volatile biofumigants disrupts the resting structures of the fungus deep within the soil profile. These practices integrated with host resistance such as the utilization of moderately resistant cultivars offer a cost-effective management strategy (<a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank">Khaliq et al., 2020</a>).
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
                    Khaliq, A., Alam, S., Khan, I. U., Khan, D., Naz, S., Zhang, Y., & Shah, A. A. (2020). Integrated control of dry root rot of chickpea caused by Rhizoctonia bataticola under natural field conditions. <em>Biotechnology Reports</em>, 25, e00423.
                    <a href="https://doi.org/10.1016/j.btre.2020.e00423" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
                </div>
                <div class="citation-item">
                    Kulkarni, V. R., & Ashtaputre, S. A. (2020). Evaluation of bio-efficacy and phytotoxicity of Thiophanate Methyl 450g/l + Pyraclostrobin 50g/l (Xelora 500g/l FS) against dry root rot of chickpea. <em>International Journal of Current Microbiology and Applied Sciences</em>, 9(1), 848-852.
                    <a href="https://doi.org/10.20546/ijcmas.2020.901.093" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
                </div>
                <div class="citation-item">
                    Malagi, N. C., et al. (2024). Screening of different bioagents and fungicides against dry root rot of chickpea. <em>Agricultural Science Digest</em>, 44(3), 398-405.
                    <a href="https://doi.org/10.18805/ag.D-5649" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
                </div>
                <div class="citation-item">
                    Sharma, O. P., et al. (2020). Effect of different soil amendments and bio agents on development of dry root rot of chickpea. <em>Journal of Entomology and Zoology Studies</em>, 8(5), 637-639.
                    <a href="https://doi.org/10.22271/j.ento.2020.v8.i5i.7571" target="_blank" class="text-decoration-none">View Article <i class="fas fa-external-link-alt"></i></a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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