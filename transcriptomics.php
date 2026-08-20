<?php
include 'counter_logic.php';
include 'Connection.php';
include 'header.php';

$sql = "SELECT * FROM transcriptomics_data";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Transcriptomics</title>
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
                        <h2 class="display-6 text-center mb-0"><b>Transcriptomics</b></h2>
                    </div>
                    <div class="card-body px-4 py-4">
                        <p class="lead text-black mx-auto" style="max-width: 1500px; text-align:justify; font-size: 1.2rem; line-height: 1.7;">
                            Transcriptomic profiling provides valuable insights into regulatory and functional genes, enhancing our understanding of the molecular mechanisms governing plant-pathogen responses. The RNA-seq datasets presented here were generated to comprehensively characterize transcriptional responses of the host, the pathogen, and their interaction under drought stress, pathogen infection, disease complex, and their combined effects across different developmental stages. For example, chickpea root tissues were profiled under drought, disease complex, and combined drought-disease stress conditions at 3 and 6 days after sowing (DAS), enabling the temporal dynamics of combined stress-responsive gene expression (<a href="https://doi.org/10.1094/MPMI-07-21-0195-FI" target="_blank">Irulappan et al., 2022</a>; BioProject: PRJNA749609). In another study, PEG 8000-induced water stress was shown to alter <em>M. phaseolina</em> growth, morphology, and pathogenicity. Transcriptomic analysis of water-stressed and control <em>M. phaseolina</em> at 1h and 24 h post-treatment revealed pathways potentially associated with enhanced fungal invasion and pathogenicity under water-deficit conditions (Mali et al., unpublished data; Bioproject: PRJNA1510271). The portal also includes dual RNA-seq datasets generated from infected root tissues of <em>Parthenium hysterophorus</em> and the tolerant chickpea genotype ICC-4958, providing insights into the molecular basis of non-host resistance (<a href="https://doi.org/10.1016/j.envexpbot.2025.106197" target="_blank">Mirchandani et al. 2025</a>; BioProject: PRJNA888832).
                        </p>
                        <p class="lead text-black mx-auto" style="max-width: 1500px; text-align:justify; font-size: 1.2rem; line-height: 1.7;">
                            In addition, two datasets related to the antifungal activity of the eBg_9562 protein have been incorporated. The first dataset evaluates its in vitro antifungal activity against <em>Macrophomina phaseolina</em> (isolate ITCC 9499), wherein fungal mycelium was treated with purified eBg_9562 protein alongside a buffer-only control. Samples from both treated and control conditions were collected at 12h and 24 h post-treatment (Chilakala et al., unpublished data; BioProject: PRJNA1499468).The second dataset comprises a dual RNA-seq analysis of chickpea hairy roots overexpressing eBg_9562, compared with vector-control roots following infection with <em>M. phaseolina</em>. Both control and overexpression lines were generated for the cultivar JG 62, and samples were collected from 38-day-old hairy root tissues (Chilakala et al., unpublished data; BioProject: PRJNA1499921). In another study, a dual RNA-seq analysis performed on chickpea roots infected with M. phaseolina under combined drought–pathogen stress and pathogen-only conditions, with samples collected at 3 days post-inoculation to investigate host–pathogen transcriptional responses and fungal adaptive and virulence mechanisms under drought stress (Mali et al., unpublished data; BioProject: PRJNA1510273). 
                        </p>
                        <p class="lead text-black mx-auto mb-4" style="max-width: 1500px; text-align:justify; font-size: 1.2rem; line-height: 1.7;">
                            Furthermore, transcriptomic evidence supporting genome assembly and annotation of the strawberry-specific <em>M. phaseolina</em> isolate 11-12 under multiple culture growth conditions has been incorporated (<a href="https://doi.org/10.1186/s12864-019-6168-1" target="_blank">Burkhardt et al., 2019</a>; BioProject: PRJNA428521). Each dataset is linked to its corresponding NCBI Sequence Read Archive (SRA) accession, facilitating direct access to raw sequencing data for downstream analysis.
                        </p>
                        <div class="text-center py-2">
                            <a href="expression_profiler.php" id="NextBtn" class="btn btn-primary px-5 py-3 rounded-pill shadow-sm hover-up text-decoration-none">
                                <strong class="me-2">Open Expression Profiler</strong>
                                <i class="fas fa-chart-line"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header bg-primary bg-opacity-10 py-3 d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <h3 class="h4 mb-0 text-dark">
                            <i class="fa-solid fa-database me-2"></i><b>Transcriptomics data</b>
                        </h3>
                        <a href="download_data/transcriptomics_data.csv" class="btn btn-success btn-sm px-3 rounded-pill shadow-sm d-inline-flex align-items-center fw-semibold text-white">
                            <i class="fa-solid fa-file-excel me-2"></i> Export to .csv format
                        </a>
                    </div>

                    <div class="card-body">
                        <p class="mb-4 text-muted" style="font-size:18px; font-family:cambria; text-align:justify;">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>
                            Use the <b>Search</b> box to filter transcriptomics data by keyword. Click on the column headers to sort results.
                        </p>

                        <div class="table-responsive">
                            <table id="literatureTable" class="table table-striped table-hover table-bordered table-sm align-middle w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 5%;">S.No.</th>
                                        <th style="width: 10%;">Bioproject ID</th>
                                        <th style="width: 13%;">Host name</th>
                                        <th style="width: 8%;">Tissue</th>
                                        <th style="width: 10%;">Cultivar/Ecotype</th>
                                        <th style="width: 8%;">Stage</th>
                                        <th style="width: 10%;">Sample type</th>
                                        <th style="width: 10%;">Strain name</th>
                                        <th style="width: 11%;">Biosample accession</th>
                                        <th style="width: 8%;">SRA accession</th>
                                        <th style="width: 7%;">Reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result && $result->num_rows > 0) {
                                        $count = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            $bioproject = !empty($row['Bioproject_Id']) ? trim($row['Bioproject_Id']) : null;
                                            $biosample  = !empty($row['Biosample_accession']) ? trim($row['Biosample_accession']) : null;
                                            $sra        = !empty($row['SRA_accession']) ? trim($row['SRA_accession']) : null;
                                            $host_name   = !empty($row['Host_name']) ? $row['Host_name'] : 'N/A';
                                            $tissue      = !empty($row['Tissue']) ? $row['Tissue'] : 'N/A';
                                            $cultivar    = !empty($row['Cultivar_Ecotype']) ? $row['Cultiva_Ecotype'] : 'N/A';
                                            $stage       = !empty($row['Stage']) ? $row['Stage'] : 'N/A';
                                            $sample_type = !empty($row['Sample_type']) ? $row['Sample_type'] : 'N/A';
                                            $strain_name = !empty($row['Strain_name']) ? $row['Strain_name'] : 'N/A';
                                            $reference   = !empty($row['Reference']) ? trim($row['Reference']) : 'N/A';
                                    ?>
                                            <tr>
                                                <td class="text-center"><?php echo $count++; ?></td>
                                                <td>
                                                    <?php if ($bioproject): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/bioproject/<?= urlencode($bioproject); ?>" target="_blank">
                                                            <?= htmlspecialchars($bioproject); ?>
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="text-muted">N/A</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><em><?= htmlspecialchars($host_name); ?></em></td>
                                                <td><?= htmlspecialchars($tissue); ?></td>
                                                <td><?= htmlspecialchars($cultivar); ?></td>
                                                <td><?= htmlspecialchars($stage); ?></td>
                                                <td><?= htmlspecialchars($sample_type); ?></td>
                                                <td><?= htmlspecialchars($strain_name); ?></td>
                                                <td>
                                                    <?php if ($biosample): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/biosample/<?= urlencode($biosample); ?>" target="_blank">
                                                            <?= htmlspecialchars($biosample); ?>
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="text-muted">N/A</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($sra): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/sra/<?= urlencode($sra); ?>" target="_blank">
                                                            <?= htmlspecialchars($sra); ?>
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="text-muted">N/A</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $links = [
                                                        'Mirchandani et al. 2025' => 'https://doi.org/10.1016/j.envexpbot.2025.106197',
                                                        'Irulappan et al. 2022' => 'https://doi.org/10.1094/MPMI-07-21-0195-FI',
                                                        'Burkhardt et al. 2019' => 'https://doi.org/10.1186/s12864-019-6168-1'
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
                                        echo "<tr><td colspan='11' class='text-center text-muted py-5'>No transcriptomics data found in the repository</td></tr>";
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
                        Mirchandani R., Kandpal M., Ranjan A., Sinharoy S., Senthil-Kumar M (2025). Induced post-invasive defenses in the nonhost plant <em>Parthenium hysterophorus</em> L. prevent root cortical colonization by <em>Macrophomina phaseolina</em> and impart resistance to dry root rot.
                        <strong>Environmental and Experimental Botany</strong> Volume 237, 106197.;
                        DOI: <a href="https://doi.org/10.1016/j.envexpbot.2025.106197" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1016/j.envexpbot.2025.106197</a>

                        <i aria-hidden="true" title="Copy Citation" class="fas fa-copy cursor-pointer ms-2 text-primary" style="font-size:16px;" onclick="navigator.clipboard.writeText('Mirchandani R., Kandpal M., Ranjan A., Sinharoy S., Senthil-Kumar M (2025). Induced post-invasive defenses in the nonhost plant Parthenium hysterophorus L. prevent root cortical colonization by Macrophomina phaseolina and impart resistance to dry root rot. Environmental and Experimental Botany Volume 237, 106197.; DOI: https://doi.org/10.1016/j.envexpbot.2025.106197'); alert('Transcriptomics citation copied!');"></i>
                    </p>
                    <br>
                    <p class="mb-0 text-muted" style="word-break:break-word; line-height: 1.6;">
                        Irulappan, V., Kandpal, M., Saini, K., Rai, A., Ranjan, A., Sinharoy, S., & Senthil-Kumar, M. (2022). Drought Stress Exacerbates Fungal Colonization and Endodermal Invasion and Dampens Defense Responses to Increase Dry Root Rot in Chickpea.
                        <strong>Molecular Plant-Microbe Interactions®</strong> 35(7), 583-591.;
                        DOI: <a href="https://doi.org/10.1094/MPMI-07-21-0195-FI" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1094/MPMI-07-21-0195-FI</a>

                        <i aria-hidden="true" title="Copy Citation" class="fas fa-copy cursor-pointer ms-2 text-primary" style="font-size:16px;" onclick="navigator.clipboard.writeText('35(7), 583-591.; DOI: https://doi.org/10.1094/MPMI-07-21-0195-FI'); alert('Transcriptomics citation copied!');"></i>
                    </p>
                    <br>
                    <p class="mb-0 text-muted" style="word-break:break-word; line-height: 1.6;">
                        Burkhardt, A.K., Childs, K.L., Wang, J. et al. (2019). Assembly, annotation, and comparison of <em>Macrophomina phaseolina</em> isolates from strawberry and other hosts.
                        <strong>BMC Genomics</strong> 20, 802.;
                        DOI: <a href="https://doi.org/10.1186/s12864-019-6168-1" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1186/s12864-019-6168-1</a>

                        <i aria-hidden="true" title="Copy Citation" class="fas fa-copy cursor-pointer ms-2 text-primary" style="font-size:16px;" onclick="navigator.clipboard.writeText('35(7), 583-591.; DOI: https://doi.org/10.1186/s12864-019-6168-1'); alert('Transcriptomics citation copied!');"></i>
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
                },

                autoWidth: false
            });
        });
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>
