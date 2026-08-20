<?php
include 'counter_logic.php';
include 'Connection.php';
include 'header.php';

$sql = "SELECT * FROM metabolome_data";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Metabolomics</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        #literatureTable {
            table-layout: fixed;
            word-wrap: break-word;
        }

        .table-bordered {
            border: 2px solid #192087 !important;
        }

        #literatureTable thead th {
            background-color: #2980b9;
            color: white;
            text-align: center;
            vertical-align: middle;
            font-size: 13px;
            padding: 8px 4px;
        }

        #literatureTable tbody td {
            font-size: 14px;
        }

        .dataTables_filter input {
            width: 250px;
            border: 2px solid #2980b9 !important;
            background: #f1f5ff;
            padding: 8px 18px;
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
                        <h2 class="display-6 text-center mb-0"><b>Metabolomics</b></h2>
                    </div>
                    <div class="card-body px-4 py-4">
                        <p class="lead mx-auto mb-3" style="max-width: 1500px; text-align:justify; font-size: 1.2rem; line-height: 1.7;">
                            The metabolomics datasets presented here were generated to comprehensively characterize metabolic reprogramming associated with DRR and related stress conditions. Phytohormone profiling of chickpea roots was performed using LC-MS/MS to quantify key defence and stress-related hormones, including salicylic acid (SA), jasmonic acid (JA), abscisic acid (ABA), jasmonic acid-isoleucine (JA-Ile), 12-oxo-phytodienoic acid (OPDA), indole acetic acid (IAA), trans-zeatin, and gibberellic acids (GA4, GA7, and GA8). Metabolic profiles were generated across vegetative, flowering, and podding growth stages under six treatments: control, drought (D), <em>M. phaseolina</em> infection (DRR), disease complex (DC), DRR under drought (DRR+D), and disease complex under drought (DC+D), with five biological replicates per treatment per growth stage, and <em>M. phaseolina</em> and <em>F. oxysporum</em> concentrations (ng/µl) recorded alongside metabolite levels for each sample (<a href="https://doi.org/10.1016/j.fcr.2023.108965" target="_blank">Chilakala et al. 2023</a>). Additionally, the portal incorporates the targeted flavonoid profiling and untargeted GC-MS metabolomics datasets generated from chickpea and <em>Parthenium hysterophorus</em> root samples inoculated with <em>M. phaseolina</em> at 2 and 4 days after inoculation (DAI). These datasets provide valuable insights into metabolic pathways, defence-related secondary metabolites and the biochemical mechanisms underlying host and non-host resistance to DRR (<a href="https://doi.org/10.1016/j.envexpbot.2025.106197" target="_blank">Mirchandani et al. 2025</a>).
                        </p>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header bg-primary bg-opacity-10 py-3 d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <h3 class="h4 mb-0 text-dark">
                            <i class="fa-solid fa-database me-2"></i><b>Metabolomics data</b>
                        </h3>
                        <a href="download_data/metabolome_data.csv" class="btn btn-success btn-sm px-3 rounded-pill shadow-sm d-inline-flex align-items-center fw-semibold text-white">
                            <i class="fa-solid fa-file-excel me-2"></i> Export to .csv format
                        </a>
                    </div>

                    <div class="card-body">
                        <p class="mb-4 text-muted" style="font-size:18px; font-family:cambria; text-align:justify;">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>
                            Use the <b>Search</b> box to filter metabolome data by keyword. Click on the column headers to sort results.
                        </p>

                        <div class="table-responsive">
                            <table id="literatureTable" class="table table-hover table-bordered table-striped align-middle w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 3%;">S.No.</th>
                                        <th style="width: 7%;">Treatments</th>
                                        <th style="width: 7%;">Growth stages</th>
                                        <th style="width: 7%;">Salicylic acid (ng/g)</th>
                                        <th style="width: 7%;">Jasmonic acid (ng/g)</th>
                                        <th style="width: 7%;">Abscisic acid (ng/g)</th>
                                        <th style="width: 8%;">Jasmonic acid-isoleucine (ng/g)</th>
                                        <th style="width: 8%;">12-oxo-phytodienoic acid (ng/g)</th>
                                        <th style="width: 7%;">Indole acetic acid (ng/g)</th>
                                        <th style="width: 6%;">Trans-zeatin (ng/g)</th>
                                        <th style="width: 6%;">Gibberellic acid 4 (ng/g)</th>
                                        <th style="width: 6%;">Gibberellic acid 7 (ng/g)</th>
                                        <th style="width: 6%;">Gibberellic acid 8 (ng/g)</th>
                                        <th style="width: 9%;"><em>M. phaseolina</em> conc. (ng/µl)</th>
                                        <th style="width: 9%;"><em>F. oxysporum</em> conc. (ng/µl)</th>
                                        <th style="width: 7%;">Reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result && $result->num_rows > 0) {
                                        $count = 1;
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td class="text-center"><?php echo $count++; ?></td>
                                                <td><?= htmlspecialchars($row['Treatments'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Growth_stages'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Salicylic_acid'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Jasmonic_acid'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Abscisic_acid'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Jasmonic_acid_isoleucine'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['12_oxo_phytodienoic_acid'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Indole_acetic_acid'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Trans_zeatin'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Gibberellic_acid_4'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Gibberellic_acid_7'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Gibberellic_acid_8'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Macrophomina_phaseolina_concentration'] ?: 'N/A'); ?></td>
                                                <td><?= htmlspecialchars($row['Fusarium_oxysporum_concentration'] ?: 'N/A'); ?></td>
                                                <td>
                                                    <?php
                                                    $links = [
                                                        'chilakala' => 'https://doi.org/10.1016/j.fcr.2023.108965',
                                                        'mirchandani' => 'https://doi.org/10.1016/j.envexpbot.2025.106197'
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
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='16' class='text-center text-muted py-5'>No data found in the metabolomics repository</td></tr>";
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
                    <p class="mb-3 text-muted" style="word-break:break-word; line-height: 1.6;">
                        Mirchandani R., Kandpal M., Ranjan A., Sinharoy S., Senthil-Kumar M (2025). Induced post-invasive defenses in the nonhost plant <em>Parthenium hysterophorus</em> L. prevent root cortical colonization by <em>Macrophomina phaseolina</em> and impart resistance to dry root rot.
                        <strong>Environmental and Experimental Botany</strong> Volume 237, 106197.;
                        DOI: <a href="https://doi.org/10.1016/j.envexpbot.2025.106197" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1016/j.envexpbot.2025.106197</a>
                        <i aria-hidden="true" title="Copy Citation" class="fas fa-copy cursor-pointer ms-2 text-primary" style="font-size:16px;" onclick="navigator.clipboard.writeText('Mirchandani R., Kandpal M., Ranjan A., Sinharoy S., Senthil-Kumar M (2025). Induced post-invasive defenses in the nonhost plant Parthenium hysterophorus L. prevent root cortical colonization by Macrophomina phaseolina and impart resistance to dry root rot. Environmental and Experimental Botany Volume 237, 106197. DOI: https://doi.org/10.1016/j.envexpbot.2025.106197'); alert('Citation copied!');"></i>
                    </p>
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
                    searchPlaceholder: "Search treatments, stages, or values..."
                },
                autoWidth: false
            });
        });
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>