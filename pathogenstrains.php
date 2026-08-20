<?php
include 'counter_logic.php';
include 'Connection.php';
include 'header.php';

$sql = "SELECT * FROM pathogen_strains";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pathogen Strains</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

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
                    <div class="card-header bg-primary bg-opacity-10 py-3 d-flex align-items-center justify-content-between flex-wrap g-3">
                        <h3 class="h4 mb-0 text-dark">
                            <h2 class="text-primary display-6 text-center mb-0"><b><em>Macrophomina phaseolina</em> strains</b>
                            </h2>

                            <a href="download_data/pathogen_strains.csv" class="btn btn-success btn-sm px-3 rounded-pill shadow-sm d-inline-flex align-items-center fw-semibold transition-hover">
                                <i class="fa-solid fa-file-excel me-2"></i> Export to .csv format
                            </a>
                    </div>

                    <div class="card-body">
                        <p class="mb-4 text-muted" style="font-size:20px; font-family:cambria; text-align:justify;">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>
                            Use the <b>Search</b> box to filter pathogen strains by keyword. Click on the column headers to
                            sort results.
                        </p>

                        <div class="table-responsive">
                            <table id="literatureTable" class="table table-hover table-bordered w-100">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="width: 5%;">S.No.</th>
                                        <th style="width: 10%;">BioSample Id</th>
                                        <th style="width: 8%;">Database</th>
                                        <th style="width: 10%;">Isolate</th>
                                        <th style="width: 10%;">Strain</th>
                                        <th style="width: 10%;">SRA Id</th>
                                        <th style="width: 10%;">Geographic location</th>
                                        <th style="width: 10%;">Collection date</th>
                                        <th style="width: 35%;">Collected by</th>
                                        <th style="width: 20%;">Source</th>
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
                                                <td class="text-center">
                                                    <?php if (!empty($row['BioSample_Id'])): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/nuccore/<?= htmlspecialchars($row['BioSample_Id']); ?>"
                                                            target="_blank">
                                                            <?= htmlspecialchars($row['BioSample_Id']); ?>
                                                        </a>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center"><?php echo htmlspecialchars($row['Database']); ?></td>
                                                <td class="text-center"><em><?php echo htmlspecialchars($row['Isolate']); ?></em></td>
                                                <td class="text-center"><?php echo htmlspecialchars($row['Strain']); ?></td>
                                                <td class="text-center">
                                                    <?php if (!empty($row['SRA_Id'])): ?>
                                                        <a href="https://www.ncbi.nlm.nih.gov/sra/<?= htmlspecialchars($row['SRA_Id']); ?>"
                                                            target="_blank">
                                                            <?= htmlspecialchars($row['SRA_Id']); ?>
                                                        </a>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center"><?php echo htmlspecialchars($row['Geographic_location']); ?></td>
                                                <td class="text-center"><?php echo htmlspecialchars($row['Collection_date']); ?></td>
                                                <td class="text-center"><?php echo htmlspecialchars($row['Collected_by']); ?></td>
                                                <td class="text-center"><?php echo htmlspecialchars($row['Source']); ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='10' class='text-center text-muted'>No data found</td></tr>";
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
                    search: "",
                    searchPlaceholder: "Search pathogen strains.."
                }
            });
        });
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>