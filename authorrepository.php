<?php
include 'counter_logic.php';
include 'Connection.php';
include 'header.php';

$sql = "SELECT * FROM author_repository";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Author repository</title>
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
                    <div class="card-header bg-success bg-opacity-10 py-3">
                        <h2 class="display-6 text-center mb-0"><b>Author repository</b></h2>
                    </div>

                    <div class="card-body">
                        <p class="mb-4 text-muted" style="font-size:18px; font-family:cambria; text-align:justify;">
                            Use the <b>Search</b> box to filter authors by keyword. Click on the column headers to
                            sort results.
                        </p>
                        <div class="d-flex justify-content-end" style="margin-top: -40px;">
                            <a href="download_data/author_repository.csv" class="btn btn-success">
                                <i class="fas fa-download me-2"></i>Download Full Dataset
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="literatureTable" class="table table-hover table-bordered w-100">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 5%;">S.No.</th>
                                    <th style="width: 10%;">Authors</th>
                                    <th style="width: 10%;">Institution</th>
                                    <th style="width: 10%;">Email</th>
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
                                            <!-- <td class="text-center"><?php echo htmlspecialchars($row['S.No.']); ?></td> -->
                                            <td class="text-center"><?php echo htmlspecialchars($row['Authors']); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($row['Institution']); ?></td>
                                            <td class="text-center"><?php echo htmlspecialchars($row['Email']); ?></td>
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
                "pageLength": 10,
                "ordering": true,
                "language": {
                    "search": "Filter authors:"
                }
            });
        });
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>