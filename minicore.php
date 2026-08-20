<?php
include 'counter_logic.php';
include 'Connection.php';
include 'header.php';

$sql = "SELECT * FROM minicore";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Minicore Collection</title>
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
                    <div class="card-header bg-primary bg-opacity-10 py-3">
                        <h2 class="text-primary display-6 text-center mb-0"><b>Minicore Collection</b></h2>
                    </div>

                    <div class="card-body">
                        <div class="mb-4" style="font-family: cambria; text-align: justify;">
                            <p style="font-size: 20px; font-weight: bold; color: #2c3e50;" class="mb-3">
                                Disease Classification Criteria
                            </p>
                            <p style="font-size: 18px;" class="mb-3">
                                Classifications are assigned based on the severity of the Dry Root Rot (DRR) disease observed:
                                <a href="https://db.nipgr.ac.in/cdpdb/Germplasm.php" target="_blank" fw-bold text-primary ms-2>
                                    Click here for more information
                                </a>
                            </p>

                            <ul style="font-size:16px;">
                                <li><strong>RES</strong> – Resistant</li>
                                <li><strong>MDR</strong> – Moderately Resistant</li>
                                <li><strong>SUS</strong> – Susceptible</li>
                                <li><strong>HSU</strong> – Highly Susceptible</li>
                            </ul>

                            <p class="mb-0 text-muted" style="font-size: 17px; font-family: cambria">
                                <i class="fa-solid fa-magnifying-glass me-2"></i>
                                Use the <b>Search</b> box to filter minicores by keyword. Click on column headers to sort results.
                            </p>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="literatureTable" class="table table-hover table-bordered w-100">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 5%;">S.No.</th>
                                    <th style="width: 10%;">Accessions</th>
                                    <th style="width: 8%;">Class</th>
                                    <th style="width: 10%;">Biological Status</th>
                                    <th style="width: 10%;">Country</th>
                                    <th style="width: 10%;">Province</th>
                                    <th style="width: 10%;">Classification</th>
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
                                            <td class="text-center"><?php echo htmlspecialchars($row['Accessions']); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($row['Class']); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($row['Biological_status']); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($row['Country']); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($row['Province']); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($row['Classification']); ?></td>
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
                    searchPlaceholder: "Search minicores.."
                }
            });
        });
    </script>
    <?php include 'footer.php'; ?>
</body>

</html>