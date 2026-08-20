<?php
include 'counter_logic.php';
include 'header.php';

$scientificAssets = [
    "protocols_literature" => [
        [
            "title" => "Methodologies, Protocols and Manuals related to Dry Root Rot",
            "description" => "Detailed procedures covering blotting paper systems and sick pot methodology optimizations.",
            "file_type" => "PDF Manual",
            "url" => [
                "documents/Protocols/Dry root rot disease assays in chickpea a detailed methodology.pdf",
                "documents/Protocols/A sick plot–based protocol for dry root rot disease assessment in field‐grown chickpea plants.pdf",
                "documents/Protocols/A blotting paper technique for the screening of chickpea genotypes against dry root rot disease.pdf",
                "documents/Protocols/Novel method for rapid screening of chickpea for combined dry root rot disease and osmotic stress.pdf",
                "documents/Protocols/Extracellular acidification assay to evaluate the effectiveness of antifungal agents on the pathogenicity of Macrophomina phaseolina.pdf",
                "documents/Protocols/In vitro evaluation of effectiveness of antifungal agents against Macrophomina Phaseolina.pdf",
                "documents/Protocols/An RGB image-based phenotyping framework for dry root rot disease assessment.pdf",
                "documents/Protocols/Spatial localization and quantitative determination of lignin in chickpea root cell wall in response to disease.pdf",
                "documents/Protocols/A novel method for high-throughput phenotyping for dry root rot disease.pdf",
                "documents/Protocols/Rapid detection of Macrophomina phaseolina in common bean seeds using a visual loop-mediated isothermal amplification assay.pdf",
                "documents/Protocols/A quantitative PCR method for in planta fungal DNA quantification in chickpea roots.pdf",
                "documents/Protocols/An advanced microscopy for characterization and visualization of M. phaseolina in chickpea roots.pdf",
                "documents/Protocols/A protocol for plant and soil water relation measurements in chickpea.pdf",
                "documents/Protocols/Development of SSR Markers and Characterization of Different Isolates of Macrophomina phaseolina Causing Dry Root Rot of Chickpea Cicer arietinum L.pdf",
                "documents/Protocols/Molecular characterization of Macrophomina phaseolina and Fusarium species by a single primer RAPD technique.pdf",
                "documents/Protocols/Evaluation of a polyclonal antibody immunoassay for detection and quantiﬁcation of Macrophomina phaseolina.pdf"
            ],
            "icon" => "fa-file-invoice",
            "badge" => "Protocol"
        ],
        [
            "title" => "Publications related to DRR",
            "description" => "A collection of high-impact literature in DRR virulence across chickpea and other crops.",
            "file_type" => "PDF Portfolio",
            "url" => [
                "documents/Publications/RootRotAI A deep learning-based mobile and web application for dry root rot disease identification and assessment in chickpea under research environment.pdf",
                "documents/Publications/A multi-task deep learning–based approach to identify and assess dry root rot disease in chickpea.pdf",
                "documents/Publications/Novel Method for Rapid Screening of Chickpea for Combined Dry Root Rot Disease and Osmotic Stress.pdf",
                "documents/Publications/Dry root rot disease Current status and future implications for chickpea production.pdf",
                "documents/Publications/Combined drought and heat stress influences the root water relation and determine the dry root rot disease development under field conditions A study using contrasting chickpea genotypes.pdf",
                "documents/Publications/Dry Root Rot Disease Assays in Chickpea a Detailed Methodology.pdf",
                "documents/Publications/A Blotting Paper Technique for the Screening of Chickpea Genotypes Against Dry Root Rot Disease.pdf",
                "documents/Publications/Drought attenuates plant responses to multiple rhizospheric pathogens A study on a dry root rot-associated disease complex in chickpea fields.pdf",
                "documents/Publications/Low soil moisture predisposes field-grown chickpea plants to dry root rot disease evidence from simulation modeling and correlation analysis.pdf",
                "documents/Publications/Navigating towards dry root rot resistance in mungbean impacts mechanisms and management strategies.pdf",
                "documents/Publications/Dry Root Rot of Chickpea A Disease Favored by Drought.pdf",
                "documents/Publications/A sick plot–based protocol for dry root rot disease assessment in field grown chickpea plants.pdf",
                "documents/Publications/Drought stress exacerbates fungal colonization and endodermal invasion and dampens defense responses to increase dry root rot in chickpea.pdf",
                "documents/Publications/Stress Combinations and their Interactions in Plants Database A one-stop resource on combined stress responses in plants.pdf",
                "documents/Publications/An artificial neural network-based deep learning model to predict combined stress impact and interaction in plants.pdf",
                "documents/Publications/Identification of Sources Resistant to Dry Root Rot Caused by Macrophomina phaseolina (Tassi) in Chickpea (Cicer arietinum L).pdf",
                "documents/Publications/Variability studies on Macrophomina phaseolina (Tassi) Goid Causing Dry Root Rot of Chickpea (Cicer arietinum L) and its management.pdf",
                "documents/Publications/Studies on dry root rot [Rhizoctonia bataticola (Taub) Butler of Chickpea (Cicer arietinum L).pdf",
                "documents/Publications/An artificial neural network-based deep learning model to predict combined stress impact and interaction in plants.pdf",
                "documents/Publications/Epidemiology and Management of Chickpea (Cicer arietinum L) Dry Root Rot Induced by Rhizoctonia bataticola (Taub) Butler Macrophomina phaseolina (Tassi) Goid).pdf",
                "documents/Publications/Studies on variability of Rhiizocttoniia battattiicolla (Taub) Buttller causing dry root rot of chickpea and its management.pdf",
                "documents/Publications/Molecular mapping of dry root rot resistance gene(s) in chickpea (Cicer arietinum L).pdf",
                "documents/Publications/Pathological Studies on the dry root rot of chickpea.pdf",
                "documents/Publications/Integrated management of dry root rot of chickpea and molecular characterization of potential biocontrol agents.pdf",
                "documents/Publications/Studies on integrated managemnet of Rhizoctonia bataticola (Taub.) Butler causing dry root rot of chickpea.pdf",
                "documents/Publications/Application technology of fungicides for the management of dry root rot of chickpea.pdf",
                "documents/Publications/Effect on herbicide on root rot of chickpea caused by Rhizoctonia bataticola.pdf",
                "documents/Publications/Studies on dry root rot (Macrophomina phaseolina (Tassi) Goid) disease of chickpea (Cicer arietinum L) and its management under middle Gujrat conditions.pdf",
                "documents/Publications/Mycorrhizal effect on root rot of chickpea caused by Rhizoctonia bataticola.pdf",
                "documents/Publications/Status, variability and management of dry root rot of chickpea caused by Rhizoctonia bataticola (Taub) Butler with changing climate.pdf",
                "documents/Publications/Physiological and molecular characterization of drought tolerant biocontrol agents for management of dry root rot of Chickpea (Cicer arietinum L) caused by Rhizoctonia bataticola.pdf",
                "documents/Publications/Morphological varialbility in Rhizoctonia bataticola (Taub.) Butler isolates causing dry root rot of chickpea in Western Maharashtra.pdf",
                "documents/Publications/Succession of soil borne diseases of chickpea and their management through host plant resistance.pdf",
                "documents/Publications/Resistant sources of chickpea against dry root rot at high temperature environment.pdf",
                "documents/Publications/Biochemical basis of resistance in chickpea (Cicer arietinum L) against dry root rot caused by Macrophomina phaseolina(Tassi) Goid and its management.pdf",
            ],
            "icon" => "fa-book-open",
            "badge" => "Literature"
        ]
    ]
];

$assetId = isset($_GET['asset_id']) ? $_GET['asset_id'] : null;

if ($assetId === null || !isset($scientificAssets['protocols_literature'][$assetId])) {
    echo "<div class='container mt-5 alert alert-danger'>
            <h4 class='alert-heading'><i class='fas fa-exclamation-triangle me-2'></i>Asset Not Found</h4>
            <p>The requested data folder index does not exist or is invalid.</p>
            <hr>
            <a href='javascript:history.back()' class='btn btn-danger btn-sm'>Go Back</a>
          </div>";
    include 'footer.php';
    exit;
}

$selectedAsset = $scientificAssets['protocols_literature'][$assetId];
$totalFiles = is_array($selectedAsset['url']) ? count($selectedAsset['url']) : 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($selectedAsset['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f1f5f9;
            color: #334155;
        }

        .dashboard-container {
            max-width: 1300px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .sticky-panel {
            position: sticky;
            top: 1.5rem;
        }

        .meta-card {
            background: #ffffff;
            border: none;
            border-top: 5px solid #166534;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
        }

        .back-btn {
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            color: #64748b;
            transition: color 0.2s;
        }

        .back-btn:hover {
            color: #0f172a;
        }

        .catalog-card {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
        }

        .file-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid #e2e8f0;
            transition: background-color 0.2s ease;
            gap: 1.5rem;
        }

        .file-row:last-child {
            border-bottom: none;
        }

        .file-row:hover {
            background-color: #f8fafc;
        }

        .file-info {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            min-width: 0;
            /* Prevents text overflow */
        }

        .file-icon-wrapper {
            color: #ef4444;
            font-size: 1.5rem;
            margin-top: 0.125rem;
            flex-shrink: 0;
        }

        .file-title {
            font-size: 0.925rem;
            font-weight: 600;
            color: #1e293b;
            line-height: 1.4;
            margin-bottom: 0;
            word-break: break-word;
        }

        .dl-btn {
            background-color: #166534;
            color: #ffffff;
            font-weight: 600;
            font-size: 0.825rem;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.2s;
            text-decoration: none;
        }

        .dl-btn:hover {
            background-color: #14532d;
            color: #ffffff;
        }

        @media (max-width: 767.98px) {
            .sticky-panel {
                position: relative;
                top: 0;
                margin-bottom: 1.5rem;
            }

            .file-row {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }

            .dl-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>

    <div class="container dashboard-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="javascript:history.back()" class="back-btn">
                <i class="fas fa-arrow-left me-2"></i>Return to Directory
            </a>
        </div>

        <div class="row g-4">

            <div class="col-12 col-md-10">
                <div class="card catalog-card">
                    <div class="card-header bg-white border-bottom py-3 px-4">
                        <h4 class="fw-bold text-dark mb-3"><?= htmlspecialchars($selectedAsset['title']); ?></h4>
                        <p class="text-muted small mb-4"><?= htmlspecialchars($selectedAsset['description']); ?></p>
                    </div>
                    <div class="card-body p-0">
                        <?php if (is_array($selectedAsset['url'])): ?>
                            <?php foreach ($selectedAsset['url'] as $fileUrl): ?>
                                <?php
                                $filenameWithExtension = basename($fileUrl);
                                $rawPaperTitle = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
                                $cleanPaperTitle = preg_replace('/^\d+/', '', $rawPaperTitle);
                                ?>
                                <div class="file-row">
                                    <div class="file-info">
                                        <div class="file-icon-wrapper">
                                            <i class="fas fa-file-pdf"></i>
                                        </div>
                                        <div>
                                            <h6 class="file-title"><?= htmlspecialchars($cleanPaperTitle); ?></h6>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="<?= htmlspecialchars($fileUrl); ?>" download="<?= htmlspecialchars($filenameWithExtension); ?>" class="dl-btn">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>

                            <div class="p-5 text-center">
                                <div class="text-success display-5 mb-3"><i class="fas fa-file-zipper"></i></div>
                                <h5 class="fw-bold">Consolidated Literature Archive</h5>
                                <p class="text-muted small mx-auto mb-4" style="max-width: 480px;">All documentation layers compiled directly inside a master distribution package.</p>
                                <a href="<?= htmlspecialchars($selectedAsset['url']); ?>" download class="dl-btn px-4 py-2">
                                    <i class="fas fa-download"></i> Download Complete Package (.zip)
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>