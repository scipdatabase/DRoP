<?php
include 'counter_logic.php';
include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SiteMap</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <Style>
        :root {
            --faq-bg: #fdfdfd;
        }

        .accordion-item {
            background-color: var(--faq-bg);
            border-radius: 12px !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .accordion-item:hover {
            transform: translateX(5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .accordion-button {
            padding: 1.25rem;
            border-radius: 12px !important;
            background-color: white !important;
            color: #333 !important;
        }

        .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #f8fbff, #eef5ff) !important;
            color: var(--primary-blue) !important;
            box-shadow: none;
        }

        .accordion-button::after {
            background-size: 1rem;
            transition: transform 0.3s ease;
        }

        .accordion-body {
            line-height: 1.7;
            font-size: 0.95rem;
            padding-top: 0;
        }
    </Style>
</head>

<section class="ack-section py-3">
    <div class="container-fluid">
        <div class="ack-header bg-primary bg-opacity-10 py-2 mb-4 rounded-3 text-center">
            <h2 class="text-primary display-5 mb-2">
                <i class="me-5"></i>DRoP Navigation Map
            </h2>
<p class="lead text-muted mx-auto" style="max-width: 700px;">
                Directory path access to dry root rot database tools and resources
            </p>
        </div>

        <div class="card border-2 rounded-4 overflow-hidden mb-2">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="text-dark fw-bold">
                        <tr>
                            <th scope="col" style="width: 35%;" class="ps-4 py-3 text-uppercase">Navigation Link</th>
                            <th scope="col" style="width: 65%;" class="py-3 text-uppercase">Description</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- HOME SECTION -->
                        <tr style="background-color: #b8d6b8; border-left: 4px solid #1e4620;">
                            <td colspan="2" class="ps-4 py-3 fw-bold text-uppercase tracking-wide" style="background-color: transparent !important; color: #1e4620; font-size: 0.95rem;">
                                <i class="fas fa-home me-2"></i> Home
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="index.php" target="_blank">What is Dry Root Rot Portal</a>
                            </td>
                            <td class="text-muted">
                                Brief introduction about the database and its objectives.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="index.php" target="_blank">Slider banner</a>
                            </td>
                            <td class="text-muted">
                                Representative images illustrating the effect of DRR stress on plants.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="https://github.com/scipdatabase" target="_blank">Github resources</a>
                            </td>
                            <td class="text-muted">
                                Open-source development repositories hosting machine learning models and curated databases.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="OtherResources.php" target="_blank">Related links</a>
                            </td>
                            <td class="text-muted">
                                External secondary links and biological databases curated to assist your research in Dry Root Rot disease.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="drrothercrops.php" target="_blank">Root/Charcoal Rot in other crops</a>
                            </td>
                            <td class="text-muted">
                                Description of Dry Root Rot disease in other crops like mungbean, blackgram, piegonpea, groundnut etc.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="download.php" target="_blank">Data download hub</a>
                            </td>
                            <td class="text-muted">
                                Users can download genome datasets, protocols, publications and models related to Dry Root Rot disease.
                            </td>
                        </tr>

                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="authorrepository.php" target="_blank">Author repository</a>
                            </td>
                            <td class="text-muted">
                                Foster national and international research collaborations.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="index.php" target="_blank">Lab publication</a>
                            </td>
                            <td class="text-muted">
                                Hosts important scientific literature, peer-reviewed publications, and their hyperlinks pertaining to DRR stress in plants.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="feedback.php" target="_blank">Feedback</a>
                            </td>
                            <td class="text-muted">
                                Researchers can contribute new datasets and provide valuable feedback through DRoP.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="Images/copyright.pdf" target="_blank">Copyright</a>
                            </td>
                            <td class="text-muted">
                                Licensing frameworks, policies, and legal parameters for data reuse and sharing.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="geospatialmap.html" target="_blank">Geospatial/Stress map</a>
                            </td>
                            <td class="text-muted">
                                Visualization of global geographical distribution and epidemiological variations of DRR stress data.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="index.php" target="_blank">DRoP Assistant</a>
                            </td>
                            <td class="text-muted">
                                Acts as a digital assistant to instantly interpret your queries, process information, and provide a helpful response.
                            </td>
                        </tr>

                        <!-- ABOUT SECTION -->
                        <tr style="background-color: #b8d6b8; border-left: 4px solid #1e4620;">
                            <td colspan="2" class="ps-4 py-3 fw-bold text-uppercase tracking-wide" style="background-color: transparent !important; color: #1e4620; font-size: 0.95rem;">
                                <i class="fas fa-circle-info me-2"></i> About
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="diseasedescription.php" target="_blank">Disease description</a>
                            </td>
                            <td class="text-muted">
                                Comprehensive symptoms, etiology, and global epidemiological effects of Dry Root Rot.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="pathogendescription.php" target="_blank">Pathogen description</a>
                            </td>
                            <td class="text-muted">
                                Morphological characteristics, lifecycle, and virulence factors of <i>Macrophomina phaseolina</i>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="pathogendescription.php" target="_blank">Management systems</a>
                            </td>
                            <td class="text-muted">
                                Information about strategic crop security and control measures.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <i class="fas fa-angle-right me-2 text-secondary"></i><a href="croprotation.php" target="_blank">Agronomy practices</a>
                            </td>
                            <td class="text-muted">
                                Traditional control mechanisms and field routines including crop rotation.
                            </td>
                        </tr>
                        <tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <i class="fas fa-angle-right me-2 text-secondary"></i><a href="fungicides.php" target="_blank">Chemical control</a>
                            </td>
                            <td class="text-muted">
                                The use of chemical substances emerging as a cornerstone of Integrated Disease Management (IDM).
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <i class="fas fa-angle-right me-2 text-secondary"></i><a href="consortium.php" target="_blank">Biological control</a>
                            </td>
                            <td class="text-muted">
                                Microbial consortium creates a robust defense system that outperforms individual bioinoculants.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <i class="fas fa-angle-right me-2 text-secondary"></i><a href="antifungalprotein.php" target="_blank">Transgenics and gene editing</a>
                            </td>
                            <td class="text-muted">
				Anti-fungal proteins offer strong fungicidal properties by disrupting fungal cell membranes and reducing metabolic acidification.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="rootrotcomplex.php" target="_blank">Root rot complex</a>
                            </td>
                            <td class="text-muted">
                                Root rot complex represents a significant and escalating threat to global productivity.
                            </td>
                        </tr>

                        <!-- TOOLS SECTION -->
                        <tr style="background-color: #b8d6b8 !important; border-left: 4px solid #1e4620;">
                            <td colspan="2" class="ps-4 py-3 fw-bold text-uppercase tracking-wide" style="background-color: transparent !important; color: #1e4620; font-size: 0.95rem;">
                                <i class="fas fa-screwdriver-wrench me-2"></i> Tools
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="index.php" target="_blank">Disease identification & assessment</a>
                            </td>
                            <td class="text-muted">
                                Integrated deep learning validation tools and diagnostic pipelines.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="index.php" target="_blank">Numerical data based</a>
                            </td>
                            <td class="text-muted">
                                Artificial neural network framework tracking environmental factors to assess probability of the disease.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <i class="fas fa-angle-right me-2 text-secondary"></i><a href="RootRotAI-1.0.php" target="_blank">RootRotAI v1.0</a>
                            </td>
                            <td class="text-muted">
                                Artificial Neural Network (ANN)-based prediction system developed to forecast the incidence of dry root rot using weather data.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="RootRotAI-2.0.php" target="_blank">Image data based</a>
                            </td>
                            <td class="text-muted">
                                Deep-learning vision diagnostics built for multi-stage symptom evaluation from image scans.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <i class="fas fa-angle-right me-2 text-secondary"></i><a href="RootRotAI-2.0.php" target="_blank">RootRotAI v2.0</a>
                            </td>
                            <td class="text-muted">
                                A multitask vision transformer designed for simultaneous binary classification (DRR vs. Control) and regression-based severity estimation (1–5).
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <i class="fas fa-angle-right me-2 text-secondary"></i><a href="RootRotAI-2.1.php" target="_blank">RootRotAI v2.1</a>
                            </td>
                            <td class="text-muted">
                                Utilizes two multitask transformer-based tensorFlow lite models, one optimized for camera and root scanner modalities, and another for microscope images.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <i class="fas fa-angle-right me-2 text-secondary"></i><a href="RootRotAI-2.2.php" target="_blank">RootRotAI v2.2</a>
                            </td>
                            <td class="text-muted">
                                Supports three modalities: camera, root scanner, and microscope to determines whether a plant is infected with DRR while also assigning a disease severity score ranging from 1 to 5, where 5 is highly susceptible.
                            </td>
                        </tr>

                        <!-- RESOURCES SECTION -->
                        <tr style="background-color: #b8d6b8; border-left: 4px solid #1e4620;">
                            <td colspan="2" class="ps-4 py-3 fw-bold text-uppercase tracking-wide" style="background-color: transparent !important; color: #1e4620; font-size: 0.95rem;">
                                <i class="fas fa-folder-open me-2"></i> Resources
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="protocols.php" target="_blank">Protocols</a>
                            </td>
                            <td class="text-muted">
                                Standard Operating Procedures (SOPs) for isolation, cultural growth, and seedling validation.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="pathogenstrains.php" target="_blank">Pathogen strains</a>
                            </td>
                            <td class="text-muted">
                                Detailed information about pathogen strains pertaining to DRR stress in plants.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="literature.php" target="_blank">Literature</a>
                            </td>
                            <td class="text-muted">
                                Curated referencing and links pertaining to DRR stress in plants.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="index.php" target="_blank">Germplasm</a>
                            </td>
                            <td class="text-muted">
                                Genebank variations providing structural resilience windows against pathogenic attack.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <i class="fas fa-angle-right me-2 text-secondary"></i><a href="https://genebank.icrisat.org/IND/Passport?Crop=Chickpea" target="_blank">Passport collection data</a>
                            </td>
                            <td class="text-muted">
                                Detailed information about accessions related to chickpea.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <i class="fas fa-angle-right me-2 text-secondary"></i><a href="minicore.php" target="_blank">Mini-core collection</a>
                            </td>
                            <td class="text-muted">
                                Classifications assigned based on the severity of the DRR disease observed.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="photos.php" target="_blank">Images</a>
                            </td>
                            <td class="text-muted">
                                High-resolution image visualizing Dry Root Rot (DRR) progression through multiple imaging techniques.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="videos.php" target="_blank">Videos</a>
                            </td>
                            <td class="text-muted">
                                A curated list of videos from the DROP database focusing on the impact of Dry Root Rot disease.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="Sprout.php" target="_blank">DRR screening facility (SPROUT)</a>
                            </td>
                            <td class="text-muted">
                                An integrated platform for rapid generation advancement and trait-based phenotyping for chickpea improvement.
                            </td>
                        </tr>

                        <!-- OMICS SECTION -->
                        <tr style="background-color: #b8d6b8; border-left: 4px solid #1e4620;">
                            <td colspan="2" class="ps-4 py-3 fw-bold text-uppercase tracking-wide" style="background-color: transparent !important; color: #1e4620; font-size: 0.95rem;">
                                <i class="fas fa-dna me-2"></i> OMICS
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <i class="me-2"></i><a href="genomics.php" target="_blank">Genomics</a>
                            </td>
                            <td class="text-muted">
                                Studies performed using a chickpea reference core plant genomics and pathogen genomics collection data.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="metagenomics.php" target="_blank">Metagenomics</a>
                            </td>
                            <td class="text-muted">
                                Profiling of chickpea rhizosphere to reveal complex shifts in microbial community dynamics under dry root rot and drought stress.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="transcriptomics.php" target="_blank">Transcriptomics</a>
                            </td>
                            <td class="text-muted">
                                Functional genomics studies aimed at identifying key genes, pathways, and regulatory networks involved in dry root rot pathogenesis and resistance.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="proteomics.php" target="_blank">Proteomics</a>
                            </td>
                            <td class="text-muted">
                                Quantitative analysis mapping protein level accumulation profiles across stress boundaries.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="metabolomics.php" target="_blank">Metabolomics</a>
                            </td>
                            <td class="text-muted">
                                Provide mechanistic insight into hormone-mediated resistance responses and secondary pathways in chickpea.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="https://db.nipgr.ac.in/cdpdb/Germplasm.php" target="_blank">Phenomics</a>
                            </td>
                            <td class="text-muted">
                                Represents a database presents the phenotypic characteristics and comprises several traits studied under DRR.
                            </td>
                        </tr>

                        <!-- HELP SECTION -->
                        <tr style="background-color: #b8d6b8; border-left: 4px solid #1e4620;">
                            <td colspan="2" class="ps-4 py-3 fw-bold text-uppercase tracking-wide" style="background-color: transparent !important; color: #1e4620; font-size: 0.95rem;">
                                <i class="fas fa-circle-question me-2"></i> Help
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="userguide.php" target="_blank">User guide</a>
                            </td>
                            <td class="text-muted">
                                Step-by-step query navigation mapping of the content.
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <a href="FAQs.php" target="_blank">FAQs</a>
                            </td>
                            <td class="text-muted">
                                Frequently Asked Questions regarding the portal's databases and tools.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </section>
    <?php include 'footer.php' ?>
    </body>

</html>
