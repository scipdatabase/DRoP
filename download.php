<?php
include 'counter_logic.php';
include 'header.php';

$scientificAssets = [
    "genomics" => [
        [
            "title" => "Chickpea Reference Genome (Cicer arietinum)",
            "description" => "Genome assembly Cicar.CDCFrontier_v2.0",
            "file_type" => "FASTA / GFF3",
            "url" => "https://ftp.ncbi.nlm.nih.gov/genomes/all/GCF/000/331/145/GCF_000331145.2_Cicar.CDCFrontier_v2.0/",
            "icon" => "fa-dna",
            "badge" => "Host Genome"
        ],
        [
            "title" => "<em>Macrophomina phaseolina</em> Draft Genome (Strain MS6)",
            "description" => "Fungal structural database scaffold detailing pathomorphological genomic markers for Dry Root Rot etiology.",
            "file_type" => "FASTA Track",
            "url" => "https://ftp.ncbi.nlm.nih.gov/genomes/all/GCA/055/691/165/GCA_055691165.1_ASM5569116v1/",
            "icon" => "fa-bacteria",
            "badge" => "Pathogen Genome"
        ]
    ],
    "protocols_literature" => [
        [
            "title" => "Methodologies, Protocols and Manuals related to Dry Root Rot",
            "description" => "Detailed procedures covering blotting paper systems and sick pot methodology optimizations.",
            "file_type" => "PDF Manual",
            "url" => "documents/.pdf",
            "icon" => "fa-file-invoice",
            "badge" => "Protocol"
        ],
        [
            "title" => "Publications related to DRR",
            "description" => "A collection of high-impact literature in DRR virulence across chickpea and other crops.",
            "file_type" => "ZIP Archive",
            "url" => "download/drr_literature_bundle.zip",
            "icon" => "fa-book-open",
            "badge" => "Literature"
        ]
    ],
    "media" => [
        [
            "title" => "High-resolution image repository",
            "description" => "Images of Dry root rot disease through camera, microscope and root scanner.",
            "file_type" => "JPG Package",
            "url" => "https://github.com/scipdatabase/DRR_Disease_Prediction/tree/main/Images",
            "icon" => "fa-images",
            "badge" => "Images"
        ],
        [
            "title" => "Tutorial videos",
            "description" => "Step-by-step video guide to under stand the disease.",
            "file_type" => "MP4 Video",
            "url" => "https://www.youtube.com/channel/UCamQH8rGtNMBvjuyNiSVyCw",
            "icon" => "fa-video",
            "badge" => "Video Guide"
        ]
    ],
    "computational" => [
        [
            "title" => "DRR disease classification and Scoring systems",
            "description" => "Pre-trained deep learning predictive ANN and CNN models to recognize and grade visual root decay scores automatically.",
            "file_type" => "H5 / ONNX",
            "url" => "https://github.com/scipdatabase/DRR_Disease_Prediction",
            "icon" => "fa-brain",
            "badge" => "AI Model"
        ],
        [
            "title" => "Author code & scripts repository",
            "description" => "Curated programmatic analytical algorithms, variant analysis code snippets, and custom processing execution frameworks.",
            "file_type" => "GitHub / ZIP",
            "url" => "https://github.com/scipdatabase",
            "icon" => "fa-code-branch",
            "badge" => "Author Repo"
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data download hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: #f8fafc;
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

        .category-header {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .category-header span {
            flex-grow: 1;
            height: 2px;
            background: #e2e8f0;
        }

        .hub-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hub-card:hover {
            transform: translateY(-4px);
            border-color: #2563eb;
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.04);
        }

        .clickable-title {
            color: #1e293b;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .hub-card:hover .clickable-title {
            color: #2563eb;
        }

        .hub-icon-container {
            width: 48px;
            height: 48px;
            background: #f1f5f9;
            color: #475569;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }

        .hub-card:hover .hub-icon-container {
            background: #2563eb;
            color: white;
        }

        .type-badge {
            background: #f8fafc;
            color: #64748b;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .category-pill {
            background: #eff6ff;
            color: #2563eb;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 50px;
        }

        .btn-hub-download {
            background-color: #2563eb;
            color: #ffffff;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 10px 16px;
            border-radius: 10px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
            margin-top: auto;
        }

        .btn-hub-download:hover {
            background-color: #1d4ed8;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .btn-hub-repo {
            background-color: #0f172a;
        }

        .btn-hub-repo:hover {
            background-color: #1e293b;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2);
        }
    </style>
</head>

<body>

    <section class="ack-section">
        <div class="container-fluid">
            <div class="ack-header bg-primary bg-opacity-10 p-3 mb-3 rounded-3 text-center">
                <h2 class="text-primary display-5 mb-2">
                    <i class="fas fa-cloud-arrow-down me-2"></i>Data download hub
                </h2>
                <p class="lead mb-0 text-muted mx-auto" style="max-width: 650px;">
                    Access fully annotative datasets
                </p>
            </div>

            <div class="container">            
             <div class="mb-4">
                <h3 class="category-header"><i class="fas fa-helix text-primary"></i> Genomic data libraries <span></span></h3>
                <div class="row g-4">
                    <?php foreach ($scientificAssets['genomics'] as $asset): ?>
                        <div class="col-md-6">
                            <div class="card h-100 hub-card p-4">
                                <div class="d-flex flex-column h-100">
                                    <div class="d-flex align-items-start gap-3 mb-4">
                                        <div class="hub-icon-container"><i class="fas <?= htmlspecialchars($asset['icon']); ?>"></i></div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <span class="category-pill"><?= htmlspecialchars($asset['badge']); ?></span>
                                                <span class="type-badge"><?= htmlspecialchars($asset['file_type']); ?></span>
                                            </div>
                                            <h5 class="fw-bold mb-2">
                                                <a href="<?= htmlspecialchars($asset['url']); ?>" target="_blank" class="clickable-title"><?= $asset['title']; ?></a>
                                            </h5>
                                            <p class="text-muted small mb-0"><?= htmlspecialchars($asset['description']); ?></p>
                                        </div>
                                    </div>
                                    <a href="<?= htmlspecialchars($asset['url']); ?>" target="_blank" class="btn-hub-download w-100">
                                        <i class="fas fa-cloud-arrow-down"></i> Download data set
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mb-4">
                <h3 class="category-header"><i class="fas fa-graduation-cap text-success"></i> Protocols & Literature <span></span></h3>
                <div class="row g-4">
                    <?php foreach ($scientificAssets['protocols_literature'] as $key => $asset): ?>
                        <div class="col-md-6">
                            <div class="card h-100 hub-card p-4">
                                <div class="d-flex flex-column h-100">
                                    <div class="d-flex align-items-start gap-3 mb-4">
                                        <div class="hub-icon-container"><i class="fas <?= htmlspecialchars($asset['icon']); ?>"></i></div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <span class="category-pill" style="background:#f0fdf4; color:#166534;"><?= htmlspecialchars($asset['badge']); ?></span>
                                                <span class="type-badge"><?= htmlspecialchars($asset['file_type']); ?></span>
                                            </div>
                                            <h5 class="fw-bold mb-2" style="color: #333;">
                                                <?= $asset['title']; ?>
                                            </h5>
                                            <p class="text-muted small mb-0"><?= htmlspecialchars($asset['description']); ?></p>
                                        </div>
                                    </div>

                                    <div class="mt-auto">
                                        <a href="viewprotocol.php?asset_id=<?= $key; ?>" class="btn-hub-download w-100 text-center" style="background-color: #166534; color: white; text-decoration: none;">
                                            <i class="fas fa-folder-open me-2"></i> Download .pdf files
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mb-4">
                <h3 class="category-header"><i class="fas fa-photo-film text-warning"></i> Images & Multi-media Assets <span></span></h3>
                <div class="row g-4">
                    <?php foreach ($scientificAssets['media'] as $asset): ?>
                        <div class="col-md-6">
                            <div class="card h-100 hub-card p-4">
                                <div class="d-flex flex-column h-100">
                                    <div class="d-flex align-items-start gap-3 mb-4">
                                        <div class="hub-icon-container"><i class="fas <?= htmlspecialchars($asset['icon']); ?>"></i></div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <span class="category-pill" style="background:#fff7ed; color:#c2410c;"><?= htmlspecialchars($asset['badge']); ?></span>
                                                <span class="type-badge"><?= htmlspecialchars($asset['file_type']); ?></span>
                                            </div>
                                            <h5 class="fw-bold mb-2">
                                                <a href="<?= is_array($asset['url']) ? '#' : htmlspecialchars($asset['url']); ?>" target="_blank" class="clickable-title"><?= $asset['title']; ?></a>
                                            </h5>
                                            <p class="text-muted small mb-0"><?= htmlspecialchars($asset['description']); ?></p>
                                        </div>
                                    </div>
                                    <a href="<?= is_array($asset['url']) ? '#' : htmlspecialchars($asset['url']); ?>" target="_blank" class="btn-hub-download w-100" style="background-color: #ea580c;">
                                        <i class="fas fa-download"></i> <?= ($asset['badge'] == 'Video Guide') ? 'View YouTube Channel' : 'Download Images'; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mb-4">
                <h3 class="category-header"><i class="fas fa-gears text-info"></i> Machine Models & Code Repositories <span></span></h3>
                <div class="row g-4">
                    <?php foreach ($scientificAssets['computational'] as $asset): ?>
                        <div class="col-md-6">
                            <div class="card h-100 hub-card p-4">
                                <div class="d-flex flex-column h-100">
                                    <div class="d-flex align-items-start gap-3 mb-4">
                                        <div class="hub-icon-container"><i class="fas <?= htmlspecialchars($asset['icon']); ?>"></i></div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <span class="category-pill" style="background:#f0f9ff; color:#0369a1;"><?= htmlspecialchars($asset['badge']); ?></span>
                                                <span class="type-badge"><?= htmlspecialchars($asset['file_type']); ?></span>
                                            </div>
                                            <h5 class="fw-bold mb-2">
                                                <a href="<?= htmlspecialchars($asset['url']) ? '#' : htmlspecialchars($asset['url']); ?>" target="_blank" class="clickable-title"><?= $asset['title']; ?></a>
                                            </h5>
                                            <p class="text-muted small mb-0"><?= htmlspecialchars($asset['description']); ?></p>
                                        </div>
                                    </div>
                                    <a href="<?= htmlspecialchars($asset['url']); ?>" target="_blank" class="btn-hub-download w-100 <?= ($asset['badge'] == 'Author Repo') ? 'btn-hub-repo' : ''; ?>">
                                        <i class="<?= ($asset['badge'] == 'Author Repo') ? 'fab fa-github' : 'fas fa-brain'; ?>"></i>
                                        <?= ($asset['badge'] == 'Author Repo') ? 'Open Source Repository' : 'Download Models and code'; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
              </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>

</html>
