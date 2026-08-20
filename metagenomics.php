<?php
include 'counter_logic.php';
include 'Connection.php';
include 'header.php';

$sql = "SELECT * FROM metagenomics";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Metagenomics</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .table-bordered {
            border: 1px solid #dee2e6 !important;
        }

        #literatureTable thead th {
            background-color: #212529;
            color: white;
            text-align: center;
            vertical-align: middle;
        }

        .dataTables_filter input {
            width: 250px;
            border: 2px solid #2980b9 !important;
            background: #f1f5ff;
            padding: 6px 18px;
            border-radius: 20px;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="container-fluid pt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header bg-success bg-opacity-10 py-3">
                        <h2 class="display-6 text-center mb-0"><b>Metagenomics</b></h2>
                    </div>
                    <div class="card-body px-4 py-4">
                        <p class="lead text-black mx-auto" style="max-width: 1500px; text-align:justify; font-size: 1.2rem; line-height: 1.7;">
                            The metagenomic sequencing datasets presented here were generated to characterize
                            microbial community dynamics in the chickpea rhizosphere under dry root rot (DRR) and
                            drought stress conditions. These datasets originate from rhizosphere soil of the desi genotype
                            JG 62 grown at Dharwad, Karnataka, India (Latitude: 15.4589, Longitude: 75.0078), under three experimental conditions: combined
                            stress (disease complex and drought), pathogen stress, and a non-stressed control. All
                            sequencing libraries were prepared using paired-end sequencing and are curated here as
                            rhizosphere and root metagenomic samples. Each sample entry is linked to its corresponding
                            NCBI Sequence Read Archive (SRA) run accession, facilitating direct access to raw
                            sequencing data. The datasets generated in this study are publicly available under NCBI
                            BioProjects PRJNA871091 (soil whole-genome and metagenome sequencing) and
                            PRJNA895851 (root-associated 16S rRNA and ITS amplicon sequencing) (<a href="https://doi.org/10.1016/j.fcr.2023.108965" target="_blank">Chilakala et al., 2023</a>).
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-header bg-primary bg-opacity-10 py-3 d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <h3 class="h4 mb-0 text-dark">
                            <i class="fa-solid fa-database me-2"></i><b>Metagenomics data</b>
                        </h3>

                        <a href="download_data/metagenomics.csv" class="btn btn-success btn-sm px-3 rounded-pill shadow-sm d-inline-flex align-items-center fw-semibold text-white">
                            <i class="fa-solid fa-file-excel me-2"></i> Export to .csv format
                        </a>
                    </div>

                    <div class="card-body">
                        <p class="mb-4 text-muted" style="font-size:18px; font-family:cambria; text-align:justify;">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>
                            Use the <b>Search</b> box to filter metagenome data by keyword. Click on the column headers to sort results.
                        </p>

                        <div class="table-responsive">
                            <table id="literatureTable" class="table table-striped table-hover table-bordered table-sm align-middle w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Bioproject id</th>
                                        <th>Experiment id</th>
                                        <th>Host genotype</th>
                                        <th>Accession</th>
                                        <th>Location</th>
                                        <th>Stress treatment</th>
                                        <th>Library</th>
                                        <th>SRA accession</th>
                                        <th>Sample type</th>
                                        <th>Reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result && $result->num_rows > 0) {
                                        $count = 1;
                                        while ($row = $result->fetch_assoc()) {

                                            $Reference = !empty($row['Reference']) ? trim($row['Reference']) : 'N/A';
                                    ?>
                                            <tr>
                                                <td class="text-center"><?php echo $count++; ?></td>

                                                <td class="text-center">
                                                    <?php if (!empty($row['Bioproject_Id'])): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/bioproject/<?= urlencode($row['Bioproject_Id']); ?>" target="_blank">
                                                            <?= htmlspecialchars($row['Bioproject_Id']); ?>
                                                        </a>
                                                    <?php else: echo 'N/A';
                                                    endif; ?>
                                                </td>

                                                <td class="text-center">
                                                    <?php if (!empty($row['Experiment_Id'])): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/bioproject/<?= urlencode($row['Experiment_Id']); ?>" target="_blank">
                                                            <?= htmlspecialchars($row['Experiment_Id']); ?>
                                                        </a>
                                                    <?php else: echo 'N/A';
                                                    endif; ?>
                                                </td>
                                                <td><em><?= htmlspecialchars($row['Host_genotype'] ?: 'N/A'); ?></em></td>
                                                <td><?= htmlspecialchars($row['Accession'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Location'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Stress_treatment'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Library'] ?: 'N/A'); ?></td>
                                                <td class="text-center">
                                                    <?php if (!empty($row['SRA_accession'])): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/sra/<?= urlencode($row['SRA_accession']); ?>" target="_blank">
                                                            <?= htmlspecialchars($row['SRA_accession']); ?>
                                                        </a>
                                                    <?php else: echo 'N/A';
                                                    endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($row['Sample_type'] ?: 'N/A'); ?></td>

                                                <td>
                                                    <?php
                                                    $links = [
                                                        'chilakala' => 'https://doi.org/10.1016/j.fcr.2023.108965',
                                                    ];

                                                    $ref = trim($row['Reference'] ?? '');
                                                    $clean_ref = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $ref));

                                                    $matched_url = null;
                                                    foreach ($links as $key => $url) {
                                                        if (stripos($clean_ref, $key) !== false) {
                                                            $matched_url = $url;
                                                            break;
                                                        }
                                                    }

                                                    if ($matched_url) {
                                                        echo '<a href="' . htmlspecialchars($matched_url) . '" target="_blank" style="color: #1877F2; text-decoration: underline;">' . htmlspecialchars($ref) . '</a>';
                                                    } else {
                                                        echo htmlspecialchars($ref ?: 'N/A');
                                                    }
                                                    ?>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='11' class='text-center py-5 text-muted'>No data found in the repository.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="ui-left-bordered-title-card bg-white p-4 shadow-sm border-start border-4 border-success">
                    <div class="ui-left-bordered-title mb-3">
                        <h5 class="fw-bold mb-0">How to cite:</h5>
                    </div>
                    <p class="mb-0 text-muted" style="word-break:break-word; line-height: 1.6;">
                        Chilakala, A.R., Pandey, P., Durgadevi, A., Kandpal, M., Patil, B.S., Rangappa, K., Reddy, P.C.O., Ramegowda, V. and Senthil Kumar, M. Drought attenuates plant responses to multiple rhizospheric pathogens: A study on a dry root rot-associated disease complex in chickpea fields.
                        <strong>Field Crops Research (2023)</strong> 298, p.108965.;
                        DOI: <a href="https://doi.org/10.1016/j.fcr.2023.108965" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1016/j.fcr.2023.108965</a>

                        <i aria-hidden="true" title="Copy Citation" class="fas fa-copy cursor-pointer ms-2 text-primary" style="font-size:16px;" onclick="navigator.clipboard.writeText('Chilakala, A.R., Pandey, P., Durgadevi, A., Kandpal, M., Patil, B.S., Rangappa, K., Reddy, P.C.O., Ramegowda, V. and Senthil Kumar, M. Drought attenuates plant responses to multiple rhizospheric pathogens: A study on a dry root rot-associated disease complex in chickpea fields. Field Crops Research (2023) 298, p.108965.; DOI: https://doi.org/10.1016/j.fcr.2023.108965'); alert('Citation copied!');"></i>
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
