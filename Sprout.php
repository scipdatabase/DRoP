<?php
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DRR screening facility</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="styles.css">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <style>
            .ack-section {
                padding: 4rem 0;
                background: transparent;
            }

            .ack-header h2 {
                font-weight: 400;
                font-size: 2.5rem;
                text-align: center;
                position: relative;
                margin-bottom: 3rem;
            }

            .ack-header h2::after {
                content: '';
                width: 80px;
                height: 4px;
                position: absolute;
                bottom: -15px;
                left: 50%;
                transform: translateX(-50%);
                border-radius: 10px;
            }

            .sprout-card {
                object-fit: cover;
                min-height: 350px;
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

<body>
    <section class="ack-section">
        <div class="container-fluid my-1">
            <div class="ack-header bg-primary bg-opacity-10 py-2 mb-3 rounded-3">
                <h2 class="text-primary display-4 text-center mb-0">
                    <i class="me-2"></i>Next-generation screening facilities for DRR phenotyping and chickpea improvement
                </h2>
            </div>

            <div class="row g-3">
                <div class="col-lg-12">
                    <p class="lead mb-1" text-center style="line-height: 1.8; text-align: justify;">
                        SPROUT (SpeedSeed Phenotyping and Resource Optimization for Unified Trait-analysis) is one such robust, season-independent, low-cost, field-mimicking precision phenotyping facility integrated with RGA (<a href="https://doi.org/10.1016/j.stress.2026.101426" target="_blank">Dulla et al. 2026</a>). The platform combines the RGA protocol called SpeedSeed with precision environmental control, irrigation, and non-invasive RGB and thermal imaging to enable real-time, high-throughput, trait-based phenotyping under uniform and reproducible conditions. By realistically simulating field-like environments, including optimal light quality and intensity, air movement, temperature, relative humidity, CO₂ regulation, and balanced red-to-far-red ratios, SPROUT bridges the gap between controlled-environment studies and field performance.
                    </p>
                    <input type="checkbox" id="readMoreToggle" class="read-more-state" />

                    <div class="read-more-wrap">
                        <div class="read-more-target mt-3 text-dark">
                            <hr>
                            <h5 class="fw-bold text-center text-primary">SPROUT: An integrated platform for rapid generation advancement and trait-based phenotyping for chickpea improvement</h5>

                            <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                                Crop improvement activities face severe bottlenecks due to the long maturation period (90-160 days) and seasonal dependencies of chickpea, which traditionally limit breeding to a single generation per year and prolong the development of resistant cultivars to 7-9 years (<a href="https://doi.org/10.1016/j.tplants.2017.08.011" target="_blank">Crossa et al. 2017</a>). While speed breeding protocols have shortened these timelines, they are genotype-specific and developed in pot-based, controlled systems, which often fail to replicate complex field environments for DRR screening (<a href="https://doi.org/10.1186/s12934-022-01959-2" target="_blank">Araus and Cairns 2014; <a href="https://doi.org/10.1016/j.pbi.2019.12.004" target="_blank">Varshney et al. 2020</a>). To overcome these constraints, there is a pressing need to develop and validate rapid generation advancement (RGA) protocols under field-mimicking conditions (<a href="https://doi.org/10.1016/j.tibtech.2025.04.011" target="_blank">Kabade et al. 2025</a>) to ensure the identification of true-resistant DRR lines. Furthermore, the establishment of robust, flexible, and season-independent facilities integrated with a high-throughput precision phenotyping system is essential (<a href="https://doi.org/10.1038/s41587-019-0152-9" target="_blank">Hickey et al. 2019</a>). Equipped with advanced sensors, including RGB, thermal, and hyperspectral imaging, these facilities enable non-invasive, real-time tracking of disease symptoms across all growth stages. The deployment of such next-generation facilities offers unique advantages by allowing for a drastic reduction of screening duration, rigorous trait dissection under disease pressure, maximizing selection accuracy, and generating large, phenotypically mapped populations crucial for genomics. Crucially, these infrastructures bridge the gap between controlled greenhouse experiments and open-field conditions, significantly improving the translational success of identified resistant lines (<a href="https://doi.org/10.1016/j.tplants.2018.02.001" target="_blank">Araus et al. 2018</a>). Reflecting this global transition, various sophisticated facilities have emerged worldwide, though many still struggle with direct field-level scalability. For instance, facilities like the International Rice Research Institute (IRRI)’s IRRI South Asia Regional Centre (ISARC) and the International Crops Research Institute for the Semi-Arid Tropics (ICRISAT)'s RapidGen focus on high-throughput, crop-specific protocol optimization for staples like legumes, while centers like the Queensland Alliance for Agriculture and Food Innovation (QAAFI) and the International Center for Agricultural Research in the Dry Areas (ICARDA) pioneer integrated field validation. However, such infrastructures for robust DRR screening and chickpea improvement remain scarce.
                            </p>

                            <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                                This integrated platform was validated across multiple applications, including mutant population screening, large-scale germplasm evaluation, transgenic line advancement, wild accession progression, and large-scale explant production for tissue culture. Furthermore, SPROUT enables rigorous and reproducible screening of genotypes for DRR and facilitates rapid and accurate disease screening, reducing DRR disease screening duration to 21–25 days (a 53% reduction compared to conventional methods), and enables the reliable identification of true positive mutants through uniform pathogen inoculation combined with image-based precision phenotyping (<a href="https://doi.org/10.1016/j.stress.2026.101426" target="_blank">Dulla et al. 2026</a>).
                            </p>

                            <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                                In addition, ICRISAT has recently established a state-of-the-art Dry root rot phenotyping facility (<a href="https://pressroom.icrisat.org/icrisat-celebrates-its-foundation-day-marking-55-years-of-science-driven-impact" target="_blank">https://pressroom.icrisat.org/icrisat-celebrates-its-foundation-day-marking-55-years-of-science-driven-impact</a>) to screen and identify DRR-resistant genotypes. This platform enables high-throughput, large-scale screening of germplasm and breeding lines and accelerates the deployment of resistant donor lines for targeted breeding.
                            </p>
                            <div class="col-md-12 text-center mt-3">
                                    <img src="Images/Sprout_readmore.jpg" alt="ICRISAT" class="img-fluid mb-2" style="max-height: 500px; object-fit: contain;">
                                    <p class= mb-1" style="font-size: 1.0rem;">
                                        <i class=" me-1"></i>DRR phenotyping facility at ICRISAT.
                                    </p>
                            </div>

                            <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                                To effectively translate these discoveries into regional field solutions, these infrastructures are complemented by the extensive network of the All India Coordinated Research Project (AICRP) (<a href="https://icar.org.in/sites/default/files/2025-10/ICAR%20Eng%20Annual%20Report_2024-25.pdf" target="_blank">https://icar.org.in/sites/default/files/2025-10/ICAR%20Eng%20Annual%20Report_2024-25.pdf; <a href="http://www.aicrpchickpea.res.in/" target="_blank">http://www.aicrpchickpea.res.in/</a>). While individual AICRP centers traditionally rely on localized field sick plots and controlled bioassays, the network increasingly collaborates with national facilities like the Nanaji Deshmukh Plant Phenomics Centre (NDPPC) (<a href="https://ndppc.iari.res.in/" target="_blank">https://ndppc.iari.res.in/</a>) at ICAR-Indian Agricultural Research Institute (IARI), New Delhi. With automated climate control and non-destructive imaging sensors, NDPPC allows for precise, large-scale quantification of disease traits over time. This coordinated framework serves as the primary deployment unit, ensuring that elite, DRR-resistant germplasm identified through high-throughput phenotyping is scaled into commercial seed pipelines across diverse agri-climatic zones.
                            </p>

                            <p style="text-align:justify; line-height: 1.6; font-size: 1.0rem;">
                                Collectively, such next generation facilities will advance the development of climate-resilient varieties and promotes sustainable disease management solutions to contribute to chickpea improvement.
                            </p>
                        </div>
                        <label for="readMoreToggle" class="read-more-trigger"></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="container my-4">
            <div class="row align-items-stretch g-3">

                <div class="col-lg-6">
                    <div class="row g-3 h-100">
                        <div class="col-6 col-md-3">
                            <div class="p-3 border rounded-4 bg-light h-100 d-flex flex-column justify-content-center text-center shadow-sm hover-up">
                                <h3 class="fw-bold text-success mb-1">60-70%</h3>
                                <small class="text-dark lh-sm">Reduction in seed-to-seed duration</small>
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <div class="p-3 border rounded-4 bg-light h-100 d-flex flex-column justify-content-center text-center shadow-sm hover-up">
                                <h3 class="fw-bold text-primary mb-1">37±2 days</h3>
                                <small class="text-dark lh-sm">Optimized Growth Cycle</small>
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <div class="p-3 border rounded-4 bg-light h-100 d-flex flex-column justify-content-center text-center shadow-sm hover-up">
                                <h3 class="fw-bold text-warning mb-1">8-10</h3>
                                <small class="text-dark lh-sm">Generations Per Year</small>
                            </div>
                        </div>

                        <div class="col-6 col-md-3">
                            <div class="p-3 border rounded-4 bg-light h-100 d-flex flex-column justify-content-center text-center shadow-sm hover-up">
                                <h3 class="fw-bold text-danger mb-1">53%</h3>
                                <small class="text-dark lh-sm">Faster DRR Screening</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="list-group shadow-sm h-100 w-100 rounded-4 overflow-hidden">
                        <div class="list-group-item list-group-item-action d-flex align-items-center py-3 border-0 bg-white">
                            <i class="fas fa-microchip me-3 text-primary fa-lg"></i>
                            <span><strong>Precision Control:</strong> Light, Humidity, Soil moisture, Temperature, & CO₂ regulation</span>
                        </div>
                        <div class="list-group-item list-group-item-action d-flex align-items-center py-3 border-0 bg-white border-top">
                            <i class="fas fa-camera-retro me-3 text-success fa-lg"></i>
                            <span><strong>Non-Invasive Imaging:</strong> RGB & Thermal Phenotyping</span>
                        </div>
                        <div class="list-group-item list-group-item-action d-flex align-items-center py-3 border-0 bg-white border-top">
                            <i class="fas fa-vial me-3 text-warning fa-lg"></i>
                            <span><strong>Stress Simulation:</strong> Abiotic, Biotic and Combined stresses</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="sprout-card overflow-hidden rounded-4 shadow hover-zoom position-relative">
                    <div class="ratio ratio-16x9">
                        <img src="Images/Sprout1.png" class="object-fit-cover w-100 h-100" alt="SPROUT Facility View">
                    </div>
                    <div class="sprout-overlay p-3 text-center">
                        <h5 class="mb-0">SPROUT facility</h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="sprout-card overflow-hidden rounded-4 shadow hover-zoom position-relative">
                    <div class="ratio ratio-16x9">
                        <img src="Images/Sprout2.png" class="object-fit-cover w-100 h-100" alt="Phenotyping Process">
                    </div>
                    <div class="sprout-overlay p-3 text-center">
                        <h5 class="mb-0">Field-mimicking mini plots</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="ui-left-bordered-title-card bg-white p-4 shadow-sm border-start border-4 border-success">
                    <div class="ui-left-bordered-title mb-3">
                        <h5 class="fw-bold">How to cite: </h5>
                    </div>
                    <p class="mb-2 text-muted" style="word-break:break-word; line-height: 1.6;">
                        Araus JL, Cairns JE (2014) Field high-throughput phenotyping: the new crop breeding frontier. Trends in Plant Science 19: 52-61.
                        DOI: <a href="https://doi.org/10.1016/j.tplants.2013.09.008" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1016/j.tplants.2013.09.008</a>
                        <i aria-hidden="true"
                            title="Copy Citation"
                            class="fas fa-copy cursor-pointer ms-2 text-primary"
                            style="font-size:16px;"
                            onclick="navigator.clipboard.writeText('Araus JL, Cairns JE (2014) Field high-throughput phenotyping: the new crop breeding frontier. Trends in Plant Science 19: 52-61.; DOI: https://doi.org/10.1016/j.tplants.2013.09.008'); alert('Citation copied!');">
                        </i>
                    </p>

                    <p class="mb-2 text-muted" style="word-break:break-word; line-height: 1.6;">
                        Araus JL, Kefauver SC, Zaman-Allah M, Olsen MS, Cairns JE (2018) Translating High-Throughput Phenotyping into Genetic Gain. Trends Plant Sci 23: 451-466.
                        DOI: <a href="https://doi.org/10.1016/j.tplants.2018.02.001" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1016/j.tplants.2018.02.001</a>
                        <i aria-hidden="true"
                            title="Copy Citation"
                            class="fas fa-copy cursor-pointer ms-2 text-primary"
                            style="font-size:16px;"
                            onclick="navigator.clipboard.writeText('Araus JL, Kefauver SC, Zaman-Allah M, Olsen MS, Cairns JE (2018) Translating High-Throughput Phenotyping into Genetic Gain. Trends Plant Sci 23: 451-466.; DOI: https://doi.org/10.1016/j.stress.2026.101426'); alert('Citation copied!');">
                        </i>
                    </p>

                    <p class="mb-2 text-muted" style="word-break:break-word; line-height: 1.6;">
                        Crossa J, Pérez-Rodríguez P, Cuevas J, Montesinos-López O, Jarquín D, de Los Campos G, Burgueño J, González-Camacho JM, Pérez-Elizalde S, Beyene Y, Dreisigacker S, Singh R, Zhang X, Gowda M, Roorkiwal M, Rutkoski J, Varshney RK (2017) Genomic Selection in Plant Breeding: Methods, Models, and Perspectives. Trends Plant Sci 22: 961-975.
                        DOI: <a href="https://doi.org/10.1016/j.tplants.2017.08.011" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1016/j.tplants.2017.08.011</a>
                        <i aria-hidden="true"
                            title="Copy Citation"
                            class="fas fa-copy cursor-pointer ms-2 text-primary"
                            style="font-size:16px;"
                            onclick="navigator.clipboard.writeText('Crossa J, Pérez-Rodríguez P, Cuevas J, Montesinos-López O, Jarquín D, de Los Campos G, Burgueño J, González-Camacho JM, Pérez-Elizalde S, Beyene Y, Dreisigacker S, Singh R, Zhang X, Gowda M, Roorkiwal M, Rutkoski J, Varshney RK (2017) Genomic Selection in Plant Breeding: Methods, Models, and Perspectives. Trends Plant Sci 22: 961-975.; DOI: https://doi.org/10.1016/j.tplants.2017.08.011'); alert('Citation copied!');">
                        </i>
                    </p>

                    <p class="mb-2 text-muted" style="word-break:break-word; line-height: 1.6;">
                        Dulla S, Durgadevi A, Chilakala AR, Mukherjee S, Pandey P, Bariha B, Parida SK, Senthil-Kumar M (2026) SPROUT: Rapid generation advancement enabled phenotyping platform for chickpea improvement. Plant Stress: 101426.
                        DOI: <a href="https://doi.org/10.1016/j.stress.2026.101426" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1016/j.fcr.2023.108965</a>
                        <i aria-hidden="true"
                            title="Copy Citation"
                            class="fas fa-copy cursor-pointer ms-2 text-primary"
                            style="font-size:16px;"
                            onclick="navigator.clipboard.writeText('Dulla S, Durgadevi A, Chilakala AR, Mukherjee S, Pandey P, Bariha B, Parida SK, Senthil-Kumar M (2026) SPROUT: Rapid generation advancement enabled phenotyping platform for chickpea improvement. Plant Stress: 101426.; DOI: https://doi.org/10.1016/j.stress.2026.101426'); alert('Citation copied!');">
                        </i>
                    </p>

                    <p class="mb-2 text-muted" style="word-break:break-word; line-height: 1.6;">
                        Hickey LT, N. Hafeez A, Robinson H, Jackson SA, Leal-Bertioli SCM, Tester M, Gao C, Godwin ID, Hayes BJ, Wulff BBH (2019) Breeding crops to feed 10 billion. Nature Biotechnology 37: 744-754.
                        DOI: <a href="https://doi.org/doi: 10.1038/s41587-019-0152-9" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/doi: 10.1038/s41587-019-0152-9</a>
                        <i aria-hidden="true"
                            title="Copy Citation"
                            class="fas fa-copy cursor-pointer ms-2 text-primary"
                            style="font-size:16px;"
                            onclick="navigator.clipboard.writeText('Hickey LT, N. Hafeez A, Robinson H, Jackson SA, Leal-Bertioli SCM, Tester M, Gao C, Godwin ID, Hayes BJ, Wulff BBH (2019) Breeding crops to feed 10 billion. Nature Biotechnology 37: 744-754.; DOI: https://doi.org/doi: 10.1038/s41587-019-0152-9'); alert('Citation copied!');">
                        </i>
                    </p>

                    <p class="mb-2 text-muted" style="word-break:break-word; line-height: 1.6;">
                        Kabade PG, Kumar S, Kohli A, Singh UM, Sinha P, Singh VK (2025) Speed breeding 3.0: mainstreaming light-driven plant breeding for sustainable genetic gains. Trends Biotechnol.
                        DOI: <a href="https://doi.org/10.1016/j.tibtech.2025.04.011" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1016/j.tibtech.2025.04.011</a>
                        <i aria-hidden="true"
                            title="Copy Citation"
                            class="fas fa-copy cursor-pointer ms-2 text-primary"
                            style="font-size:16px;"
                            onclick="navigator.clipboard.writeText('Kabade PG, Kumar S, Kohli A, Singh UM, Sinha P, Singh VK (2025) Speed breeding 3.0: mainstreaming light-driven plant breeding for sustainable genetic gains. Trends Biotechnol.; DOI: https://doi.org/10.1016/j.tibtech.2025.04.011'); alert('Citation copied!');">
                        </i>
                    </p>

                    <p class="mb-2 text-muted" style="word-break:break-word; line-height: 1.6;">
                        Varshney RK, Sinha P, Singh VK, Kumar A, Zhang Q, Bennetzen JL (2020) 5Gs for crop genetic improvement. Current Opinion in Plant Biology 56: 190-196.
                        DOI: <a href="https://doi.org/10.1016/j.pbi.2019.12.004" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1016/j.pbi.2019.12.004</a>
                        <i aria-hidden="true"
                            title="Copy Citation"
                            class="fas fa-copy cursor-pointer ms-2 text-primary"
                            style="font-size:16px;"
                            onclick="navigator.clipboard.writeText('Varshney RK, Sinha P, Singh VK, Kumar A, Zhang Q, Bennetzen JL (2020) 5Gs for crop genetic improvement. Current Opinion in Plant Biology 56: 190-196.; DOI: https://doi.org/10.1016/j.pbi.2019.12.004'); alert('Citation copied!');">
                        </i>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#literatureTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                order: [
                    [0, "asc"]
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Bioprojects, genotypes, or locations..."
                }
            });
        });
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>
