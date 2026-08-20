<?php
include 'counter_logic.php';
include 'Connection.php';
include 'header.php';

$sql = "SELECT * FROM Genomics_Pathogen";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pathogen Genomics</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .table-bordered {
            border: 2px solid #192087 !important;
        }

        #literatureTable thead th {
            background-color: #2980b9;
            color: white;
            text-align: center;
            vertical-align: middle;
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
                <div class="card shadow">
                    <div class="card-header bg-success bg-opacity-10 py-3">
                        <h2 class="display-6 text-center mb-0"><b>Pathogen Genomics</b></h2><br>
                        <p class="lead mx-auto" style="max-width: 1500px; text-align:justify;">
                            Whole-genome sequencing datasets for Macrophomina species, including <em>M. phaseolina</em>, <em>Macrophomina sp. BRIP 63780</em>, <em>Macrophomina sp. 242773</em>, <em>M. pseudophaseolina</em>, <em>M. euphorbiicola</em>, and <em>M. tecta</em>, have been generated from diverse host species and geographic locations worldwide. Genomic resources for <em>M. phaseolina</em> are accessible through the NCBI taxonomy browser (<a href="https://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?mode=Info&id=35725" target="_blank">https://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?mode=Info&id=35725</a>), JGI MycoCosm (<a href="https://mycocosm.jgi.doe.gov/mycocosm/home/releases" target="_blank">https://mycocosm.jgi.doe.gov/mycocosm/home/releases</a>) and EnsemblFungi (<a href="https://fungi.ensembl.org/Macrophomina_phaseolina_ms6_gca_000302655/Info/Index" target="_blank">https://fungi.ensembl.org/Macrophomina_phaseolina_ms6_gca_000302655/Info/Index</a>).
                        </p>
                        <p class="lead mx-auto" style="max-width: 1500px; text-align:justify;">
                            Burkhardt et al. (2019) reported genome sequences and assemblies for two reference isolates: <em>M. phaseolina</em> strain Mp11-12 from strawberry (BioProject: PRJNA428521) and strain Al-1 from alfalfa (BioProject: PRJNA432410). Subsequently, Gluck-Thaler et al. (2022) performed genome assemblies for twelve strains — mp007, mp021, mp040, mp042, mp050, mp053, mp070, mp102, mp117, mp124, mp194, and mp247 — isolated from soil samples collected from six soybean fields in Paraguay (2014–2015) and six in Ohio, USA (2013–2014), under BioProject PRJNA687837. Recently, Pennerman et al. (2025) generated a large-scale population genomics dataset comprising 463 Macrophomina isolates obtained from 23 countries and 91 plant hosts and soil, with original field-collection dates ranging from 1927 to 2021 (BioProject: PRJNA953043). Mirchandani and Kumar (unpublished) performed whole-genome sequencing of <em>M. phaseolina</em> isolates infecting chickpea across multiple agroclimatic regions of India, including Jaipur, Chikkabalapur, Dharwad, Andhra Pradesh, and Akola, and curated the data under BioProject PRJNA1198842 at the strain level. Although the taxonomic identity of the pathogen has historically been confused with <em>Rhizoctonia bataticola</em> (Taub.) Butler, due to morphological similarities and the rare occurrence of sporulation in planta, which often led to its misidentification. 
                        </p>
                        <p class="lead mx-auto" style="max-width: 1500px; text-align:justify;">
                            Collectively, these datasets are systematically annotated, and each entry is linked to its assembly name, assembly accession, BioSample, and SRA run accession, allowing users to directly retrieve genome assemblies and raw sequencing reads for their own downstream analyses across the broad host range and global distribution of <em>Macrophomina</em> species.
                        </p>
                        <p class="lead mx-auto" style="max-width: 1500px; text-align:justify"> <strong>Kingdom:</strong> Fungi, <strong>Phylum:</strong> Ascomycota, <strong>Family:</strong> Botryosphaeriaceae, <strong>Genus:</strong> Macrophomina, <strong>Species:</strong> <em>M. phaseolina </em></p>
                    </div>

                    <div class="card-body">
                        <p class="mb-4 text-muted" style="font-size:18px; font-family:cambria; text-align:justify;">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>
                            Use the <b>Search</b> box to filter genome data by keyword. Click on the column headers to sort results.
                        </p>

                        <div class="table-responsive">
                            <table id="literatureTable" class="table table-hover table-bordered w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Assembly Name</th>
                                        <th>Assembly Accession</th>
                                        <th>Pathogen Name</th>
                                        <th>Strain Name</th>
                                        <th>BioProject</th>
                                        <th>BioSample</th>
                                        <th>Host Name</th>
                                        <th>Location</th>
                                        <th>SRA Accession</th>
                                        <th>Reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result && $result->num_rows > 0) {
                                        $count = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            // Pre-processing values for cleaner HTML
                                            $assemblyName = !empty($row['Assembly_Name']) ? $row['Assembly_Name'] : 'N/A';
                                            $pathogenName = !empty($row['Pathogen_Name']) ? $row['Pathogen_Name'] : 'N/A';
                                            $sraAccession = !empty($row['NCBI_SRA_Accession']) ? $row['NCBI_SRA_Accession'] : '';
                                            $ref = !empty($row['Reference']) ? $row['Reference'] : '';
                                    ?>
                                            <tr>
                                                <td class="text-center"><?php echo $count++; ?></td>

                                                <!-- Assembly Name -->
                                                <td class="text-center">
                                                    <?php if (!empty($row['Assembly_Name'])): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/assembly/<?php echo urlencode($row['Assembly_Name']); ?>" target="_blank">
                                                            <?php echo htmlspecialchars($row['Assembly_Name']); ?>
                                                        </a>
                                                    <?php else: echo 'N/A';
                                                    endif; ?>
                                                </td>

                                                <!-- Assembly Accession -->
                                                <td class="text-center">
                                                    <?php if (!empty($row['Assembly_Accession'])): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/assembly/<?php echo urlencode($row['Assembly_Accession']); ?>" target="_blank">
                                                            <?php echo htmlspecialchars($row['Assembly_Accession']); ?>
                                                        </a>
                                                    <?php else: echo 'N/A';
                                                    endif; ?>
                                                </td>

                                                <!-- Pathogen -->
                                                <td><em><?php echo htmlspecialchars($row['Pathogen_Name'] ?: 'N/A'); ?></em></td>

                                                <td><?php echo htmlspecialchars($row['Strain_Name'] ?: 'N/A'); ?></td>

                                                <!-- BioProject -->
                                                <td class="text-center">
                                                    <?php if (!empty($row['BioProject_Accession'])): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/bioproject/<?php echo urlencode($row['BioProject_Accession']); ?>" target="_blank">
                                                            <?php echo htmlspecialchars($row['BioProject_Accession']); ?>
                                                        </a>
                                                    <?php else: echo 'N/A';
                                                    endif; ?>
                                                </td>

                                                <!-- BioSample -->
                                                <td class="text-center">
                                                    <?php if (!empty($row['BioSample_Accession'])): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/biosample/<?php echo urlencode($row['BioSample_Accession']); ?>" target="_blank">
                                                            <?php echo htmlspecialchars($row['BioSample_Accession']); ?>
                                                        </a>
                                                    <?php else: echo 'N/A';
                                                    endif; ?>
                                                </td>

                                                <td><?php echo htmlspecialchars($row['Host_name'] ?: 'N/A'); ?></td>
                                                <td><?php echo htmlspecialchars($row['Location'] ?: 'N/A'); ?></td>

                                                <!-- SRA -->
                                                <td class="text-center">
                                                    <?php if (!empty($row['NCBI_SRA_Accession'])): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/sra/<?php echo urlencode($row['NCBI_SRA_Accession']); ?>" target="_blank"
                                                            class="btn btn-sm btn-outline-primary">
                                                            SRA
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="text-muted small">N/A</span>
                                                    <?php endif; ?>
                                                </td>

                                                <!-- Reference -->
                                                <td class="text-center">
                                                    <?php if (!empty($row['Reference'])): ?>
                                                        <a href="<?php echo htmlspecialchars($row['Reference']); ?>" target="_blank" class="btn btn-sm btn-success">
                                                            View
                                                        </a>
                                                    <?php else: ?>
                                                        <span class="text-muted small">N/A</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='11' class='text-center py-5 text-muted'>No pathogen data found in the repository.</td></tr>";
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
    </div>
    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="ui-left-bordered-title-card bg-white p-4 shadow-sm border-start border-4 border-success">
                    <div class="ui-left-bordered-title mb-3">
                        <h5 class="fw-bold">How to cite: </h5>
                    </div>
                    <p class="mb-0 text-muted" style="word-break:break-word; line-height: 1.6;">
                        Chilakala, A.R., Pandey, P., Durgadevi, A., Kandpal, M., Patil, B.S., Rangappa, K., Reddy, P.C.O., Ramegowda, V. and Senthil Kumar, M. Drought attenuates plant responses to multiple rhizospheric pathogens: A study on a dry root rot-associated disease complex in chickpea fields.
                        <strong>Field Crops Research (2023)</strong> 298, p.108965.;
                        DOI: <a href="https://doi.org/10.1016/j.fcr.2023.108965" rel="nofollow" target="_blank" class="text-decoration-none">https://doi.org/10.1016/j.fcr.2023.108965</a>

                        <i aria-hidden="true"
                            title="Copy Citation"
                            class="fas fa-copy cursor-pointer ms-2 text-primary"
                            style="font-size:16px;"
                            onclick="navigator.clipboard.writeText('Chilakala, A.R., Pandey, P., Durgadevi, A., Kandpal, M., Patil, B.S., Rangappa, K., Reddy, P.C.O., Ramegowda, V. and Senthil Kumar, M. Drought attenuates plant responses to multiple rhizospheric pathogens: A study on a dry root rot-associated disease complex in chickpea fields. Field Crops Research (2023) 298, p.108965.; DOI: https://doi.org/10.1016/j.fcr.2023.108965'); alert('Citation copied!');">
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
    <?php include 'footer.php' ?>
</body>

</html>