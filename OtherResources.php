<?php
include 'counter_logic.php';
include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Other Resources</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Global Card Styling */
        .resource-card {
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.05) !important;
        }

        .resource-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        /* Icon Containers */
        .icon-wrapper {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            transition: 0.3s ease;
        }

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

        /* SCIPdb Specific Theme (Blue) */
        .scip-theme .icon-wrapper {
            background-color: #e7f1ff;
            color: #0d6efd;
        }

        .scip-theme .btn-action {
            background: transparent;
            color: #0d6efd;
            border: 2px solid #0d6efd;
            font-weight: 600;
        }

        .scip-theme .btn-action:hover {
            background: #0d6efd;
            color: white;
        }

        .cdp-theme .btn-action:hover {
            background: #690dfd;
            color: white;
        }

        .cdp-theme .icon-wrapper {
            background-color: #e7f1ff;
            color: #690dfd;
        }

        .cdp-theme .btn-action {
            background: transparent;
            color: #690dfd;
            border: 2px solid #690dfd;
            font-weight: 600;
        }

        .tnau-theme .icon-wrapper {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .tnau-theme .btn-action {
            background: transparent;
            color: #2e7d32;
            border: 2px solid #2e7d32;
            font-weight: 600;
        }

        .tnau-theme .btn-action:hover {
            background: #2e7d32;
            color: white;
        }

        .icpd-theme .icon-wrapper {
            background-color: #e8f5e9;
            color: #bfcc4b;
        }

        .icpd-theme .btn-action {
            background: transparent;
            color: #bfcc4b;
            border: 2px solid #bfcc4b;
            font-weight: 600;
        }

        .icpd-theme .btn-action:hover {
            background: #bfcc4b;
            color: white;
        }

        .phi-theme .btn-action:hover {
            background: #fd790d;
            color: white;
        }

        .phi-theme .icon-wrapper {
            background-color: #e7f1ff;
            color: #fd790d;
        }

        .phi-theme .btn-action {
            background: transparent;
            color: #fd790d;
            border: 2px solid #fd790d;
            font-weight: 600;
        }

        .icrisat-theme .btn-action:hover {
            background: #0dedfd;
            color: white;
        }

        .icrisat-theme .icon-wrapper {
            background-color: #e7f1ff;
            color: #0dedfd;
        }

        .icrisat-theme .btn-action {
            background: transparent;
            color: #0dedfd;
            border: 2px solid #0dedfd;
            font-weight: 600;
        }

        .genbank-theme .btn-action:hover {
            background: #764877;
            color: white;
        }

        .genbank-theme .icon-wrapper {
            background-color: #e7f1ff;
            color: #764877;
        }

        .genbank-theme .btn-action {
            background: transparent;
            color: #764877;
            border: 2px solid #764877;
            font-weight: 600;
        }

        .usda-theme .btn-action:hover {
            background: #50341a;
            color: white;
        }

        .usda-theme .icon-wrapper {
            background-color: #e7f1ff;
            color: #50341a;
        }

        .usda-theme .btn-action {
            background: transparent;
            color: #50341a;
            border: 2px solid #50341a;
            font-weight: 600;
        }

        .plad-theme .btn-action:hover {
            background: #fd0d5d;
            color: white;
        }

        .plad-theme .icon-wrapper {
            background-color: #e7f1ff;
            color: #fd0d5d;
        }

        .plad-theme .btn-action {
            background: transparent;
            color: #fd0d5d;
            border: 2px solid #fd0d5d;
            font-weight: 600;
        }

        .straininfo-theme .btn-action:hover {
            background: #250dfd;
            color: white;
        }

        .straininfo-theme .icon-wrapper {
            background-color: #e7f1ff;
            color: #250dfd;
        }

        .straininfo-theme .btn-action {
            background: transparent;
            color: #250dfd;
            border: 2px solid #250dfd;
            font-weight: 600;
        }

        .taxonomy-theme .btn-action:hover {
            background: #4a4a4b;
            color: white;
        }

        .taxonomy-theme .icon-wrapper {
            background-color: #e7f1ff;
            color: #4a4a4b;
        }

        .taxonomy-theme .btn-action {
            background: transparent;
            color: #4a4a4b;
            border: 2px solid #4a4a4b;
            font-weight: 600;
        }

        .scipio-theme .btn-action:hover {
            background: #8b5136;
            color: white;
        }

        .scipio-theme .icon-wrapper {
            background-color: #e7f1ff;
            color: #8b5136;
        }

        .scipio-theme .btn-action {
            background: transparent;
            color: #8b5136;
            border: 2px solid #8b5136;
            font-weight: 600;
        }

        .ensembl-theme .btn-action:hover {
            background: #073a1c;
            color: white;
        }

        .ensembl-theme .icon-wrapper {
            background-color: #e7f1ff;
            color: #073a1c;
        }

        .ensembl-theme .btn-action {
            background: transparent;
            color: #073a1c;
            border: 2px solid #073a1c;
            font-weight: 600;
        }

        .mycocosm-theme .btn-action:hover {
            background: #c759a2;
            color: white;
        }

        .mycocosm-theme .icon-wrapper {
            background-color: #e7f1ff;
            color: #c759a2;
        }

        .mycocosm-theme .btn-action {
            background: transparent;
            color: #c759a2;
            border: 2px solid #c759a2;
            font-weight: 600;
        }

        /* Status Badges */
        .status-badge {
            background: #f8f9fa;
            color: #6c757d;
            font-size: 0.7rem;
            padding: 5px 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Hover Icon Animation */
        .resource-card:hover .icon-wrapper {
            transform: rotate(15deg) scale(1.1);
        }
    </style>

    <div class="ack-section py-5">
        <div class="container-fluid">
            <div class="ack-header bg-primary bg-opacity-10 py-4 mb-5 rounded-3 text-center">
                <h2 class="text-primary display-4 mb-2">
                    <i class="me-3"></i><strong>External Resources<span class="badge bg-primary fs-6 align-middle"></span></strong>
                </h2>
                <p class="lead text-muted mb-0">Other high-impact databases to assist your research in DRR disease and its causative agent.</p>
            </div>

            <div class="row g-4" id="resourceGrid">

                <div class="col-md-6 col-lg-4 resource-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4 resource-card scip-theme">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-wrapper rounded-circle">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">SCIPdb</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                Stress Combinations and their Interactions in Plants (SCIP) Database. Focused on how multiple stressors affect plant health.
                            </p>
                            <div class="mt-auto">
                                <a href="https://db.nipgr.ac.in/plant_complete/index_orangesunset.php" target="_blank" class="btn btn-action w-100 rounded-pill">
                                    Explore SCIPdb <i class="fas fa-external-link-alt ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 resource-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4 resource-card cdp-theme">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-wrapper rounded-circle">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">CDPdb</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                Chickpea Dry Root Rot Disease Phenome Database (CDPdb). A Chickpea reference core germplasm characterization
                            </p>
                            <div class="mt-auto">
                                <a href="https://db.nipgr.ac.in/cdpdb/Germplasm.php" target="_blank" class="btn btn-action w-100 rounded-pill">
                                    Explore CDPdb <i class="fas fa-external-link-alt ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 resource-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4 resource-card tnau-theme">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-wrapper rounded-circle">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">TNAU</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                Tamil Nadu Agricultural University Portal. A comprehensive repository for crop production and protection technologies.
                            </p>
                            <div class="mt-auto">
                                <a href="http://www.agritech.tnau.ac.in/index.html" target="_blank" class="btn btn-action w-100 rounded-pill">
                                    Explore TNAU <i class="fas fa-external-link-alt ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 resource-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4 resource-card icpd-theme">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-wrapper rounded-circle">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">ICPD</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                Indian Crop Phenome Database, Empower the researchers with various digitization services for harnessing their crop phenotyping projects.
                            </p>
                            <div class="mt-auto">
                                <a href="https://ibdc.dbt.gov.in/icpd/" target="_blank" class="btn btn-action w-100 rounded-pill">
                                    Explore ICPD <i class="fas fa-share-from-square ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 resource-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4 resource-card phi-theme">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-wrapper rounded-circle">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">PHI-base</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                PHI-base, Pathogen-host interaction. The mission of PHI-base is to provide expertly curated molecular and biological information on genes proven to affect the outcome of pathogen-host interactions
                            </p>
                            <div class="mt-auto">
                                <a href="http://www.phi-base.org/" target="_blank" class="btn btn-action w-100 rounded-pill">
                                    Explore PHI-base <i class="fas fa-map-marked-alt ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 resource-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4 resource-card icrisat-theme">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-wrapper rounded-circle">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">ICRISAT</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                ICRISAT (International Crops Research Institute for the Semi-Arid Tropics). A primary source for research data on DRR in legumes (chickpea and groundnut), specifically regarding pathogen diagnostics, resistant screening, and epidemiological surveys.
                            </p>
                            <div class="mt-auto">
                                <a href="https://www.icrisat.org/" target="_blank" class="btn btn-action w-100 rounded-pill">
                                    Explore ICRISAT <i class="fas fa-sync-alt ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 resource-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4 resource-card genbank-theme">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-wrapper rounded-circle">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">Genbank-ICRISAT</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                The ICRISAT genbank serves as a world repository for the collection of 132,188 germplasm accessions assembled from 144 countries through donations and collection missions, it is one of the largest international genebanks.
                            </p>
                            <div class="mt-auto">
                                <a href="https://genebank.icrisat.org/" target="_blank" class="btn btn-action w-100 rounded-pill">
                                    Explore Genbank-ICRISAT <i class="fas fa-sync-alt ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 resource-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4 resource-card usda-theme">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-wrapper rounded-circle">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">USDA</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                The USDA National Plant Germplasm System (NPGS) maintains over 500,000 seed accessions, across 10,000 species, representing a wide variety of crops, including grains, vegetables, nuts, fruits, ornamental plants and even crop wild relative species.
                            </p>
                            <div class="mt-auto">
                                <a href="https://www.nal.usda.gov/plant-production-gardening/seeds-and-plants" target="_blank" class="btn btn-action w-100 rounded-pill">
                                    Explore USDA <i class="fas fa-sync-alt ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 resource-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4 resource-card plad-theme">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-wrapper rounded-circle">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">PlaD</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                A transcriptomics database for plant defence responses to pathogens.
                            </p>
                            <div class="mt-auto">
                                <a href="http://zzdlab.com/plad/index.php" target="_blank" class="btn btn-action w-100 rounded-pill">
                                    Explore PlaD <i class="fas fa-sync-alt ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 resource-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4 resource-card straininfo-theme">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-wrapper rounded-circle">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">StrainInfo</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                Access DSMZ Strain 161505 records.
                            </p>
                            <div class="mt-auto">
                                <a href="https://straininfo.dsmz.de/strain/161505" target="_blank" class="btn btn-action w-100 rounded-pill">
                                    Explore StrainInfo<i class="fas fa-sync-alt ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 resource-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4 resource-card taxonomy-theme">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-wrapper rounded-circle">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">NCBI Taxonomy</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                Taxonomic classification & lineage.
                            </p>
                            <div class="mt-auto">
                                <a href="https://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?mode=Info&id=35725" target="_blank" class="btn btn-action w-100 rounded-pill">
                                    Explore NCBI Taxonomy<i class="fas fa-sync-alt ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 resource-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4 resource-card scipio-theme">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-wrapper rounded-circle">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">Scipio</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                Eukaryotic gene identification tool.
                            </p>
                            <div class="mt-auto">
                                <a href="https://www.webscipio.org/search?species=Macrophomina+phaseolina+MS6" target="_blank" class="btn btn-action w-100 rounded-pill">
                                    Explore Scipio<i class="fas fa-sync-alt ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 resource-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4 resource-card ensembl-theme">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-wrapper rounded-circle">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">Ensembl Fungi</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                <em>M. phaseolina</em> genomic details.
                            </p>
                            <div class="mt-auto">
                                <a href="https://fungi.ensembl.org/Macrophomina_phaseolina_ms6_gca_000302655/Info/Index" target="_blank" class="btn btn-action w-100 rounded-pill">
                                    Explore Ensembl Fungi<i class="fas fa-sync-alt ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 resource-item">
                    <div class="card h-100 border-0 shadow-sm rounded-4 resource-card mycocosm-theme">
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="icon-wrapper rounded-circle">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold mb-2">MycoCosm</h5>
                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                JGI fungal genomic resource hub.
                            </p>
                            <div class="mt-auto">
                                <a href="https://mycocosm.jgi.doe.gov/mycocosm/home/releases?flt=M.+phaseolina&seq=all&pub=all&grp=fungi&srt=released&ord=desc" target="_blank" class="btn btn-action w-100 rounded-pill">
                                    Explore MycoCosm<i class="fas fa-sync-alt ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>
    </body>

</html>
