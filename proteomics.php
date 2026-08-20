<?php
include 'counter_logic.php';
include 'Connection.php';
include 'header.php';

$sql = "SELECT * FROM proteomics_data";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Proteomics</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        #literatureTable {
            table-layout: fixed;
            word-wrap: break-word;
        }

        .table-bordered {
            border: 1px solid #192087 !important;
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
                        <h2 class="display-6 text-center mb-0"><b>Proteomics</b></h2>
                    </div>
                    <div class="card-body px-4 py-4">
                        <p class="lead text-black mx-auto" style="max-width: 1500px; text-align:justify; font-size: 1.2rem; line-height: 1.7;">
                            Proteomic profiling of the soybean root apoplast was performed during infection by <em>Macrophomina phaseolina</em> to investigate infection-associated changes in the host-pathogen secretome. Comparative analysis of control and infected apoplastic samples enabled the identification of secreted pathogen proteins and differentially accumulated soybean proteins involved in host defense. The dataset is further complemented by AlphaFold2 and AlphaFold-Multimer structural annotations, facilitating the characterization of candidate pathogen effectors, host protease–inhibitor complexes, and other infection-related proteins. Together, these resources provide valuable insights into the molecular mechanisms underlying pathogen virulence, extracellular host responses, and protein–protein interactions during <em>M. phaseolina</em> infection. The proteomic datasets are publicly available through the ProteomeXchange Consortium under project accession PXD059244, while the corresponding AlphaFold structural prediction data are accessible through Zenodo at (<a href="https://zenodo.org/records/13779899" target="_blank">https://zenodo.org/records/13779899</a>) (<a href="https://doi.org/10.1111/pce.70302" target="_blank">Prakash et al., 2025</a>).
                        </p>
                        <div class="text-center py-2">
                            <a href="proteomics_heatmap.php" id="NextBtn" class="btn btn-primary px-5 py-3 rounded-pill shadow-sm hover-up text-decoration-none">
                                <strong class="me-2">Open Expression Profiler</strong>
                                <i class="fas fa-chart-line"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header bg-primary bg-opacity-10 py-3 d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <h3 class="h4 mb-0 text-dark">
                            <i class="fa-solid fa-database me-2"></i><b>Proteomics data</b>
                        </h3>
                        <a href="download_data/proteomics_data.csv" class="btn btn-success btn-sm px-3 rounded-pill shadow-sm d-inline-flex align-items-center fw-semibold text-white">
                            <i class="fa-solid fa-file-excel me-2"></i> Export to .csv format
                        </a>
                    </div>

                    <div class="card-body">
                        <p class="mb-4 text-muted" style="font-size:18px; font-family:cambria; text-align:justify;">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>
                            Use the <b>Search</b> box to filter proteomics data by keyword. Click on the column headers to sort results.
                        </p>

                        <div class="table-responsive">
                            <table id="literatureTable" class="table table-striped table-hover table-bordered table-sm align-middle w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 4%;">S.No.</th>
                                        <th style="width: 10%;">Accession</th>
                                        <th style="width: 6%;">Host/Pathogen</th>
                                        <th style="width: 7%;">Gene symbol</th>
                                        <th style="width: 9%;">Gene id</th>
                                        <th style="width: 7%;">dbCAN3/InterPro</th>
                                        <th style="width: 7%;">EffectorP</th>
                                        <th style="width: 7%;">Classes</th>
                                        <th style="width: 8%;">Pfam id</th>
                                        <th style="width: 10%;">Biological process</th>
                                        <th style="width: 10%;">Cellular component</th>
                                        <th style="width: 8%;">Molecular function</th>
                                        <th style="width: 8%;">Details</th>
                                        <th style="width: 8%;">Reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result && $result->num_rows > 0) {
                                        $count = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            $rowId          = (int)$row['id'];
                                            $accession      = !empty($row['Accession']) ? trim($row['Accession']) : 'N/A';
                                            $host_pathogen  = !empty($row['Host/ Pathogen']) ? trim($row['Host/ Pathogen']) : 'N/A';
                                            $gene_symbol    = !empty($row['Gene Symbol']) ? trim($row['Gene Symbol']) : 'N/A';
                                            $gene_id        = !empty($row['Gene ID']) ? trim($row['Gene ID']) : 'N/A';
                                            $interpro       = !empty($row['dbCAN3/InterPro']) ? trim($row['dbCAN3/InterPro']) : 'N/A';
                                            $effectorp      = !empty($row['EffectorP']) ? trim($row['EffectorP']) : 'N/A';
                                            $classes        = !empty($row['Classes']) ? trim($row['Classes']) : 'N/A';
                                            $pfam_ids       = !empty($row['Pfam ID']) ? trim($row['Pfam ID']) : 'N/A';
                                            $bio_process    = !empty($row['Biological Process']) ? trim($row['Biological Process']) : 'N/A';
                                            $cell_component = !empty($row['Cellular Component']) ? trim($row['Cellular Component']) : 'N/A';
                                            $mol_function   = !empty($row['Molecular Function']) ? trim($row['Molecular Function']) : 'N/A';
                                            $reference      = !empty($row['References']) ? trim($row['References']) : 'N/A';
                                    ?>
                                            <tr>
                                                <td class="text-center"><?php echo $count++; ?></td>
                                                <td>
                                                    <a href="https://www.uniprot.org/uniprotkb/<?= urlencode(trim($accession)); ?>"
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        class="text-primary fw-bold text-decoration-none accession-uniprot-link"
                                                        title="View <?= htmlspecialchars($accession); ?> on UniProt">
                                                        <?= htmlspecialchars($accession); ?>
                                                    </a>
                                                </td>
                                                <td><em><?= htmlspecialchars($host_pathogen); ?></em></td>
                                                <td><?= htmlspecialchars($gene_symbol); ?></td>
                                                <td><?= htmlspecialchars($gene_id); ?></td>
                                                <td><?= htmlspecialchars($interpro); ?></td>
                                                <td><?= htmlspecialchars($effectorp); ?></td>
                                                <td><?= htmlspecialchars($classes); ?></td>
                                                <td><?= htmlspecialchars($pfam_ids); ?></td>
                                                <td><?= htmlspecialchars($bio_process); ?></td>
                                                <td><?= htmlspecialchars($cell_component); ?></td>
                                                <td><?= htmlspecialchars($mol_function); ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-outline-success btn-sm rounded-pill px-3 shadow-sm hover-up" onclick="openDetails(<?= $rowId; ?>)">
                                                        <i class="fa-solid fa-square-poll-horizontal me-1"></i> View Sequence
                                                    </button>
                                                </td>
                                                <td>
                                                    <?php
                                                    $links = [
                                                        'Prakash et al., 2025' => 'https://doi.org/10.1111/pce.70302',
                                                    ];

                                                    if (array_key_exists($reference, $links)) {
                                                        echo '<a href="' . $links[$reference] . '" target="_blank">' . htmlspecialchars($reference) . '</a>';
                                                    } else {
                                                        echo htmlspecialchars($reference);
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='14' class='text-center text-muted py-5'>No proteomics data found in the repository</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="ui-left-bordered-title-card bg-white p-4 shadow-sm border-start border-4 border-success mb-4">
                    <div class="ui-left-bordered-title mb-3">
                        <h5 class="fw-bold mb-0">How to cite:</h5>
                    </div>
                    <p class="mb-0 text-muted" style="word-break:break-word; line-height: 1.6;">
                        Prakash, C. V. N., M. Sivaramakrishnan, D. Moser, et al. 2025. Proteome Analysis of Soybean Root Apoplast Combined With AlphaFold Prediction Reveals Macrophomina phaseolina Infection Strategies and Potential Targets for Engineering Resistance.
                        <strong>Plant, Cell & Environment </strong> 49: 4599–4625.;
                        DOI: <a href="https://doi.org/10.1111/pce.70302" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1111/pce.70302</a>
                        <i aria-hidden="true" title="Copy Citation" class="fas fa-copy cursor-pointer ms-2 text-primary" style="font-size:16px;" onclick="navigator.clipboard.writeText('Prakash, C. V. N., M. Sivaramakrishnan, D. Moser, et al. 2025. “ Proteome Analysis of Soybean Root Apoplast Combined With AlphaFold Prediction Reveals Macrophomina phaseolina Infection Strategies and Potential Targets for Engineering Resistance.” Plant, Cell & Environment 49: 4599–4625.; DOI: https://doi.org/10.1111/pce.70302'); alert('Citation copied!');"></i>
                    </p>
                    <br>
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
                    searchPlaceholder: "Search accessions, functions, or processes..."
                },
                autoWidth: false
            });
        });

        function openDetails(id) {
            const url = 'proteomicstableview.php?id=' + id;
            window.open(url, 'proteinDetails', 'width=800,height=650,scrollbars=yes,resizable=yes,status=no,location=no');
        }
    </script>
    <?php include 'footer.php'; ?>
</body>

</html>