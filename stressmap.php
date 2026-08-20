<?php 
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geospatial/Stress Map</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <div class="container py-5">
    <div class="map-header">
        <h1 class="display-5 fw-bold">Geospatial Distribution of DRR</h1>
        <p class="lead text-muted mx-auto" style="max-width: 700px;">
            Interactive mapping of global <strong>Dry Root Rot</strong> hotspots and their correlation with
            <strong>Drought Stress</strong> zones.
        </p>
    </div>

    <div class="map-wrapper">
        <div class="map-container">
            <iframe src="map.html" title="DRR Geospatial Map"></iframe>
        </div>
    </div>

    <div class="row mt-4 g-4">
        <div class="col-lg-8">
            <div class="legend-box shadow-sm border">
                <h5 class="fw-bold mb-3">Map Analysis & Legend</h5>
                <div class="d-flex flex-wrap gap-4">
                    <div><span class="color-dot" style="background: #e74c3c;"></span> High Severity (DRR + Drought)</div>
                    <div><span class="color-dot" style="background: #f1c40f;"></span> Emerging Hotspots</div>
                    <div><span class="color-dot" style="background: #2ecc71;"></span> Monitored Regions</div>
                </div>
                <hr>
                <p class="text-muted small">
                    Data consolidated from geospatial surveys (2019-2026) and NIPGR simulation modeling. 
                    Markers indicate validated epidemiological hotspots.
                </p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 bg-success text-white p-4 rounded-4 shadow-sm h-100 d-flex flex-column justify-content-center">
                <h6>Download Geospatial Data</h6>
                <p class="small opacity-75">Get raw GIS coordinates and stress indices for bioinformatics research.</p>
                <a href="data/drr_geospatial_2026.csv" download class="btn btn-light btn-sm fw-bold rounded-pill px-4 w-fit">
                    <i class="fas fa-file-csv me-1"></i> Download .CSV
                </a>
            </div>
        </div>
    </div>
</div>
    <?php include 'footer.php'; ?>
</body>

</html>