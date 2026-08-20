<?php
include 'counter_logic.php';
include 'header.php';

$pdfResources = [
    [
        "id" => 1,
        "title" => "Dry root rot disease assays in chickpea: A detailed methodology",
        "description" => "This study presents methodologies such as blotting paper method and sick pot-based method to screen for DRR resistance and to study the pathomorphological and molecular mechanisms underlying chickpea – <em>Macrophomina phaseolina</em> interaction.",
        "pdf_url" => "documents/Protocols/Dry root rot disease assays in chickpea a detailed methodology.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 2,
        "title" => "A sick plot–based protocol for dry root rot disease assessment in field‐grown chickpea plants.",
        "description" => "A comprehensive protocol for establishing a sick plot for DRR to enable disease assessment of a large number of chickpea plants under natural environment.",
        "pdf_url" => "documents/Protocols/A sick plot–based protocol for dry root rot disease assessment in field‐grown chickpea plants.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 3,
        "title" => "A blotting paper technique for the screening of chickpea genotypes against dry root rot disease.",
        "description" => "An improved, high-throughput blotting paper technique for the large-scale screening of chickpea genotypes for DRR resistance.",
        "pdf_url" => "documents/Protocols/A blotting paper technique for the screening of chickpea genotypes against dry root rot disease.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 4,
        "title" => "Novel method for rapid screening of chickpea for combined dry root rot disease and osmotic stress.",
        "description" => "A novel phenotyping methodology to investigate the interaction between osmotic stress and DRR disease in chickpea within controlled laboratory conditions.",
        "pdf_url" => "documents/Protocols/Novel method for rapid screening of chickpea for combined dry root rot disease and osmotic stress.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 5,
        "title" => "Extracellular acidification assay to evaluate the effectiveness of antifungal agents on the pathogenicity of <em>Macrophomina phaseolina</em>.",
        "description" => "A rapid and sensitive method to evaluate antifungal agents by measuring changes in extracellular pH levels, allowing researchers to determine the exact concentrations needed to inhibit <em>M. phaseolina</em>.",
        "pdf_url" => "documents/Protocols/Extracellular acidification assay to evaluate the effectiveness of antifungal agents on the pathogenicity of Macrophomina phaseolina.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 6,
        "title" => "In vitro evaluation of effectiveness of antifungal agents against <em>Macrophomina Phaseolina</em>.",
        "description" => "A rapid and cost-effective protocol for assessing the activity of antifungal agents against <em>M. phaseolina</em>.",
        "pdf_url" => "documents/Protocols/In vitro evaluation of effectiveness of antifungal agents against Macrophomina Phaseolina.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 7,
        "title" => "An RGB image-based phenotyping framework for dry root rot disease assessment.",
        "description" => "A novel phenotyping method for rapid identification of plant responses to disease and facilitates high-throughput screening of genotypes.",
        "pdf_url" => "documents/Protocols/An RGB image-based phenotyping framework for dry root rot disease assessment.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 8,
        "title" => "Spatial localization and quantitative determination of lignin in chickpea root cell wall in response to disease.",
        "description" => "A rapid and sensitive method to evaluate plant defense responses by measuring localized lignin deposition, allowing researchers to determine the physiological changes associated with enhanced resistance against the pathogen.",
        "pdf_url" => "documents/Protocols/Spatial localization and quantitative determination of lignin in chickpea root cell wall in response to disease.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 9,
        "title" => "A novel method for high-throughput phenotyping for dry root rot disease.",
        "description" => "An objective and high-throughput phenotyping method that integrates multi-dimensional canopy imaging with automated digital color analysis, allow early disease detection and precise quantification of DRR disease severity.",
        "pdf_url" => "documents/Protocols/A novel method for high-throughput phenotyping for dry root rot disease.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 10,
        "title" => "Rapid detection of <em>Macrophomina phaseolina</em> in common bean seeds using a visual loop-mediated isothermal amplification assay.",
        "description" => "A rapid and sensitive method for the visual detection of the pathogen by targeting the targeting a species-specific SCAR marker.",
        "pdf_url" => "documents/Protocols/Rapid detection of Macrophomina phaseolina in common bean seeds using a visual loop-mediated isothermal amplification assay.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 11,
        "title" => "A quantitative PCR method for in planta fungal DNA quantification in chickpea roots",
        "description" => "A robust qPCR-based protocol for the precise quantification of fungal biomass within chickpea root tissues, enabling early disease detection.",
        "pdf_url" => "documents/Protocols/A quantitative PCR method for in planta fungal DNA quantification in chickpea roots.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 12,
        "title" => "An advanced microscopy for characterization and visualization of <em>M. phaseolina</em> in chickpea roots.",
        "description" => "A comprehensive microscopy and GIMP-based digital quantification method to systematically visualize and measure fungal colonization in plant root tissues under stress.",
        "pdf_url" => "documents/Protocols/An advanced microscopy for characterization and visualization of emM. phaseolinaem in chickpea roots.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 13,
        "title" => "A protocol for plant and soil water relation measurements in chickpea.",
        "description" => "A method outlining the experimental procedures to determine tissue relative water content (RWC), vapor pressure deficit (VPD), and components of water potential (Ψ) in soil, root, and leaf tissues under stress conditions.",
        "pdf_url" => "documents/Protocols/A protocol for plant and soil water relation measurements in chickpea.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 14,
        "title" => "Development of SSR Markers and Characterization of Different Isolates of <em>Macrophomina phaseolina</em> Causing Dry Root Rot of Chickpea (<em>Cicer arietinum L.</em>).",
        "description" => "A novel method utilizing custom-designed, contig-derived SSR markers to accurately differentiate genetic diversity and streamline the molecular characterization of <em>Macrophomina phaseolina</em> isolates causing dry root rot in chickpea.",
        "pdf_url" => "documents/Protocols/Development of SSR Markers and Characterization of Different Isolates of Macrophomina phaseolina Causing Dry Root Rot of Chickpea Cicer arietinum L.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 15,
        "title" => "Molecular characterization of <em>Macrophomina phaseolina</em> and Fusarium species by a single primer RAPD technique.",
        "description" => "A high-resolution diagnostic method using a single 10-mer primer to simultaneously characterize genetic variation within <em>Macrophomina phaseolina</em> isolates and differentiate them from co-occurring Fusarium wilt species and races irrespective of host origin",
        "pdf_url" => "documents/Protocols/Molecular characterization of Macrophomina phaseolina and Fusarium species by a single primer RAPD technique.pdf",
        "badge" => "Lab Protocol"
    ],
    [
        "id" => 16,
        "title" => "Evaluation of a polyclonal antibody immunoassay for detection and quantiﬁcation of <em>Macrophomina phaseolina</em>.",
        "description" => "A polyclonal antibody-based DAS-ELISA immunoassay designed to detect and quantify <em>Macrophomina phaseolina</em> on chickpea roots under varying environmental and biocontrol conditions.",
        "pdf_url" => "documents/Protocols/Evaluation of a polyclonal antibody immunoassay for detection and quantiﬁcation of Macrophomina phaseolina.pdf",
        "badge" => "Lab Protocol"
    ],

];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>protocols</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
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

        .protocol-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
        }

        .protocol-card:hover {
            transform: translateY(-6px);
            border-color: #0d9488;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.03);
        }

        .pdf-link-title {
            color: #1e293b;
            font-size: 1.25rem;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s ease;
            display: inline-block;
        }

        .protocol-card:hover .pdf-link-title {
            color: #0d9488;
        }

        .protocol-badge {
            background-color: #f0fdf4;
            color: #166534;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 30px;
            border: 1px solid #bbf7d0;
        }

        .custom-icon-box {
            width: 55px;
            height: 55px;
            background: #f1f5f9;
            color: #1e3a8a;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .protocol-card:hover .custom-icon-box {
            background: #0d9488;
            color: #ffffff;
        }

        .action-indicator {
            font-size: 0.85rem;
            font-weight: 600;
            color: #0d9488;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: auto;
        }
    </style>
</head>

<body>

    <div class="ack-section py-5">
        <div class="container-fluid">
            <div class="ack-header bg-primary bg-opacity-10 py-4 mb-5 rounded-3 text-center">
                <h2 class="text-primary display-4 mb-2">
                    <i class="me-3"></i><strong>Protocols<span class="badge bg-primary fs-6 align-middle"></span></strong>
                </h2>
            </div>

            <div class="row g-4">
                <?php foreach ($pdfResources as $resource): ?>
                    <div class="col-100 col-lg-6">
                        <div class="card h-100 protocol-card p-4">
                            <div class="card-body p-0 d-flex flex-column">

                                <div class="d-flex align-items-start justify-content-between mb-4">
                                    <span class="protocol-badge"><?php echo $resource['badge']; ?></span>
                                </div>

                                <h4 class="mb-3">
                                    <a href="<?php echo $resource['pdf_url']; ?>" target="_blank" class="pdf-link-title">
                                        <?php echo $resource['title']; ?>
                                        <i class="fas fa-external-link-alt ms-1 fs-6 text-muted opacity-50"></i>
                                    </a>
                                </h4>

                                <p class="text-muted small lh-relaxed mb-4">
                                    <?php echo $resource['description']; ?>
                                </p>

                                <div class="action-indicator mt-auto">
                                    <a href="<?php echo $resource['pdf_url']; ?>" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                        <i class="far fa-file-pdf me-2 text-danger"></i>Open Protocol Manual
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>
