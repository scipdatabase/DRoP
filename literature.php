 <?php
    include 'counter_logic.php';
    include 'Connection.php';
    include 'header.php';

    $sql = "SELECT * FROM literature_drr";
    $result = $conn->query($sql);
    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <title>Literature Related to DRR</title>

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
             width: 260px;
             border: 2px solid #2980b9 !important;
             background: #f1f5ff;
             padding: 8px 18px;
             border-radius: 20px;
             font-size: 15px;
         }

         .page-item.active .page-link {
             background-color: #198754;
             border-color: #198754;
         }
     </style>
 </head>

 <body>
     <div class="container-fluid pt-5 mb-5">
         <div class="row">
             <div class="col-12">
                 <div class="card shadow">
                     <div class="card-header bg-primary bg-opacity-10 py-3">
                         <h2 class="text-primary display-6 text-center mb-0">
                             <b>Literature Related to DRR</b>
                         </h2>
                     </div>

                     <div class="card-body">
                         <p class="mb-2 text-muted" style="font-size:20px; font-family:Cambria; text-align:justify;">
                             <i class="fa-solid fa-magnifying-glass me-2"></i>
                             Use the <b>Search</b> box to filter literature by keyword. Click on column headers to sort results.
                         </p>
                         <div class="d-flex justify-content-end" style="margin-top: -40px;">
                             <a href="download_data/literature_drr.csv" class="btn btn-success">
                                 <i class="fas fa-download me-2"></i>Download Full Dataset
                             </a>
                         </div>
                     </div>

                     <div class="table-responsive">
                         <table id="literatureTable" class="table table-hover table-bordered w-100">
                             <thead>
                                 <tr>
                                     <th style="width:5%">S.No.</th>
                                     <th style="width:45%">Full Reference</th>
                                     <th style="width:20%">Source</th>
                                     <th style="width:15%">Report category</th>
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

                                             <td> <?php echo htmlspecialchars($row['Full_reference']); ?>
                                             </td>

                                             <td class="text-center">
                                                 <?php if (!empty($row['Source'])): ?>
                                                     <a href="<?php echo htmlspecialchars($row['Source']); ?>"
                                                         target="_blank"
                                                         class="fw-bold text-primary text-decoration-none">
                                                         🔗 View
                                                     </a>
                                                 <?php else: ?>
                                                     <span class="text-muted">N/A</span>
                                                 <?php endif; ?>
                                             </td>

                                             <td class="text-center">
                                                 <?php echo htmlspecialchars($row['Report_category']); ?>
                                             </td>
                                         </tr>
                                 <?php
                                        }
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
                     searchPlaceholder: "Search literature.."
                 }
             });
         });
     </script>

     <?php
        $conn->close();
        include 'footer.php';
        ?>
 </body>

 </html>