<?php 
include 'counter_logic.php';
include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Plant Genomics</title>
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
                        <h2 class="display-6 text-center mb-0"><b>Plant Genomics</b></h2><br>
                        <p class="lead mx-auto" style="max-width: 1500px; text-align:justify;">
                            Genome-wide association studies (GWAS) were performed using a chickpea reference core germplasm collection consisting of 305 genotypes, including 254 landraces, 38 improved varieties, and 13 breeding lines, representing diverse geographical regions across Asia, Africa, Europe, North America, and South America. The collection included 221 desi, 74 kabuli, and 10 intermediate genotypes. Through GWAS, identified 1.2 million high-quality SNPs and 11 significant marker-trait associations (MTAs) for disease severity index under dry root rot, osmotic, and combined stress (DRR + osmotic stress) responses. A total of 13 MTAs were identified under DRR stress, while 14 stress-responsive candidate genes were identified under combined stress. The associated loci included genes related to disease resistance, transcription factors, receptor-like kinases (LRR-RLKs), proline transporters, and sugar transporters. Notably, <em>CaSWEET15b</em>, a sugar transporter gene, showed a strong association with susceptibility to DRR and combined stress. Functional validation demonstrated that overexpression of <em>CaSWEET15b</em> increased susceptibility to <em> Macrophomina phaseolina</em>, whereas RNAi-mediated silencing enhanced tolerance. Overall, this study provides important insights into the genetic architecture of DRR susceptibility under osmotic stress and highlight <em>CaSWEET15b</em> as a promising target for breeding DRR-resistant chickpea cultivars (Ranjan et al., 2026, under revision).
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <?php include 'footer.php' ?>
</body>

</html>