<?php

declare(strict_types=1);

include 'counter_logic.php';
include 'Connection.php';
include 'header.php'; // Renders the top brand banners, navigation bar, and structural wrappers

require_once __DIR__ . '/generateheatmap/proteomics/functions.php';
$csvPath = __DIR__ . '/generateheatmap/proteomics/protein_log2_data.csv';
$dataOk = file_exists($csvPath);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Proteomics Abundance Map</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <style>
        :root {
            --primary-green: #198754;
            --bg-light: #f8f9fa;
            --border-color: #dee2e6;
        }

        body {
            background-color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar-steps {
            min-height: 100vh;
            background-color: var(--bg-light);
            border-right: 1px solid var(--border-color);
        }

        .step-number {
            width: 80px;
            height: 30px;
            background: var(--primary-green);
            color: white;
            border-radius: 15px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .filter-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            display: block;
        }

        .heatmap-container-box {
            border: 1px solid #eee;
            border-radius: 12px;
            background: #fff;
            min-height: 600px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.02);
            padding: 20px;
            position: relative;
        }

        .heatmap-wrap {
            display: flex;
            align-items: flex-start;
            overflow-x: auto;
            position: relative;
        }

        #dendrogram-container {
            flex-shrink: 0;
            padding-top: 40px;
        }

        #dendrogram-container svg line {
            stroke: #475569;
            stroke-width: 1.5;
        }

        #plot {
            flex: 1;
            min-width: 450px;
        }

        .btn-success {
            background-color: var(--primary-green);
            border: none;
        }

        .btn-success:hover {
            background-color: #146c43;
        }

        .border-dashed {
            border: 2px dashed var(--border-color);
        }

        #loading {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: #64748b;
            font-size: 14px;
            padding: 60px;
            width: 100%;
        }

        .error-box {
            background: #fef2f2;
            border: 1px solid #f87171;
            color: #991b1b;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Selection Panel -->
            <div class="col-md-3 p-4 sidebar-steps">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0 text-success fw-bold"><i class="fas fa-sliders me-2"></i>DRoP Filters</h4>
                </div>

                <div class="mb-4">
                    <label class="filter-label"><span class="step-number">STEP I</span> Dataset filter</label>
                    <select class="form-select shadow-sm" id="group-select">
                        <option value="overall" selected>Overall top 50</option>
                        <option value="both">Top 50 in Both</option>
                        <option value="control">Top 50 Control only</option>
                        <option value="infected">Top 50 Infected only</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="filter-label"><span class="step-number">STEP II</span> Clustering</label>
                    <select class="form-select shadow-sm" id="cluster-select">
                        <option value="0" selected>Raw order</option>
                        <option value="1">Hierarchical dendrogram</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="filter-label"><span class="step-number">STEP III</span> Normalization</label>
                    <select class="form-select shadow-sm" id="scale-select">
                        <option value="zscore" selected>Row Z-score</option>
                        <option value="raw">Absolute log2</option>
                    </select>
                </div>

                <button id="applyFiltersBtn" class="btn btn-success w-100 rounded-pill mt-3 shadow-sm py-2">
                    Generate Heatmap <i class="fas fa-sync ms-1"></i>
                </button>
            </div>

            <!-- Main Content Panel -->
            <div class="col-md-9 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold text-dark mb-0">Proteomics abundance map</h2>
                    <div class="btn-group shadow-sm style-download-group">
                        <button id="downloadCSV" class="btn btn-outline-secondary btn-sm"><i class="fas fa-file-csv me-1"></i> CSV</button>
                        <button id="downloadPNG" class="btn btn-outline-secondary btn-sm"><i class="fas fa-image me-1"></i> PNG</button>
                    </div>
                </div>

                <?php if (!$dataOk): ?>
                    <div class="error-box">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>Data source failure: <code><?= htmlspecialchars($csvPath) ?></code> missing. Please place the target matrix CSV file in the designated path.</span>
                    </div>
                <?php endif; ?>

                <div class="row g-3 mb-4 bg-light p-3 rounded-4 border mx-0">
                    <div class="col-12 border-bottom pb-3 mb-2">
                        <div class="row g-2">
                            <div class="col-md-6 col-lg-4">
                                <span class="fw-bold text-dark"><i class="me-1 text-muted"></i> Pathogen Isolation:</span>
                                <em>Macrophomina phaseolina</em> isolated from infected soybean roots at JNKVV, Jabalpur, MP, India (23° 12′ 47.808″ N, 79° 57′ 49.752″ E, 301.5 m above mean sea level), established via hyphal tip method on Potato dextrose agar.
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <span class="fw-bold text-dark"><i class="me-1 text-muted"></i> Sample Type:</span>
                                Root apoplastic fluids from infected and control roots at 3 days post-inoculation (dpi).
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <span class="fw-bold text-dark"><i class="me-1 text-muted"></i> Infection Assay:</span>
                                Roots of 2-week-old JS 20–94 seedlings inoculated with <em>M. phaseolina</em> mycelium.
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <span class="fw-bold text-dark"><i class="me-1 text-muted"></i>Variety:</span>
                                Soybean JS 20–94
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <span class="fw-bold text-dark"><i class="me-1 text-muted"></i> Proteomics Approach:</span>
                                Label-free quantitative LC-MS/MS analysis of apoplastic proteomes.
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <span class="fw-bold text-dark"><i class="me-1 text-muted"></i> Data Repository:</span>
                                ProteomeXchange Consortium (PRIDE) — <span class="badge bg-secondary font-monospace">PXD059244</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 pt-1">
                        <label class="small fw-bold text-muted mb-1">Expression scale legend</label>
                        <div class="small mt-1">
                            <span class="badge bg-success me-1"><i class="fa-solid fa-circle small"></i> Green</span> Low expression
                            <i class="fa-solid fa-arrow-right-long mx-2 text-muted"></i>
                            <span class="badge bg-danger"><i class="fa-solid fa-circle small"></i> Red</span> High expression
                        </div>
                    </div>
                </div>

                <!-- Heatmap Render Area -->
                <div class="heatmap-container-box">
                    <div id="loadingOverlay" class="d-none position-absolute start-0 top-0 w-100 h-100 bg-white opacity-75 d-flex align-items-center justify-content-center" style="z-index: 10; border-radius: 12px;">
                        <div class="spinner-border text-success" role="status"></div>
                    </div>
                    <div id="metadataDisplay" class="mb-4">
                        <div class="alert alert-light border-dashed p-3 small text-muted mb-0" id="meta-line">
                            <i class="fa-solid fa-circle-notch fa-spin me-2 text-success"></i>Initializing workspace variables...
                        </div>
                    </div>
                    <div class="heatmap-wrap">
                        <div id="dendrogram-container"></div>
                        <div id="plot">
                            <div id="loading"><i class="fa-solid fa-circle-notch fa-spin"></i> Rendering matrix array data...</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const groupSelect = document.getElementById('group-select');
            const clusterSelect = document.getElementById('cluster-select');
            const scaleSelect = document.getElementById('scale-select');
            const metaLine = document.getElementById('meta-line');
            const dendrogramContainer = document.getElementById('dendrogram-container');
            const plotContainer = document.getElementById('plot');
            const overlay = document.getElementById('loadingOverlay');

            let currentHeatmapData = null;

            async function updateHeatmap() {
                if (overlay) overlay.classList.remove('d-none');
                metaLine.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin text-success me-2"></i> Syncing backend metrics matrix...';

                const group = groupSelect.value;
                const cluster = clusterSelect.value;
                const scale = scaleSelect.value;

                const apiUrl = `generateheatmap/proteomics/api.php?group=${encodeURIComponent(group)}&scale=${encodeURIComponent(scale)}&cluster=${encodeURIComponent(cluster)}`;

                try {
                    const response = await fetch(apiUrl);
                    if (!response.ok) {
                        throw new Error(`HTTP Endpoint returned error status: ${response.status}`);
                    }

                    const data = await response.json();

                    if (data.error) {
                        throw new Error(data.error);
                    }

                    currentHeatmapData = data;

                    if (cluster === "1" && data.dendrogram_svg) {
                        dendrogramContainer.style.display = 'block';
                        dendrogramContainer.innerHTML = data.dendrogram_svg;
                    } else {
                        dendrogramContainer.style.display = 'none';
                        dendrogramContainer.innerHTML = '';
                    }

                    const zMatrix = [];
                    const textMatrix = [];

                    for (let i = 0; i < data.labels.length; i++) {
                        zMatrix.push([data.control_vals[i], data.infected_vals[i]]);
                        textMatrix.push([
                            `Accession: ${data.labels[i]}<br>Condition: Control<br>Value: ${data.control_vals[i]} (Raw Log2: ${data.control_raw[i]})`,
                            `Accession: ${data.labels[i]}<br>Condition: Infected<br>Value: ${data.infected_vals[i]} (Raw Log2: ${data.infected_raw[i]})`
                        ]);
                    }

                    const heatmapTrace = {
                        z: zMatrix,
                        x: ['Control', 'Infected'],
                        y: data.labels,
                        type: 'heatmap',
                        text: textMatrix,
                        hoverinfo: 'text',
                        colorscale: [
                            [0, '#259b50'], // Low = Green
                            [0.5, '#f8fafc'], // Mid = Baseline
                            [1, '#b41b1b'] // High = Red
                        ],
                        showscale: true,
                        colorbar: {
                            title: scale === 'zscore' ? 'Z-Score' : 'Log2 Value',
                            titleside: 'top',
                            thickness: 15
                        }
                    };

                    const layout = {
                        margin: {
                            l: 140,
                            r: 20,
                            t: 20,
                            b: 40
                        },
                        xaxis: {
                            tickfont: {
                                weight: 'bold',
                                color: '#0f172a'
                            }
                        },
                        yaxis: {
                            autorange: 'reversed',
                            type: 'category',
                            tickfont: {
                                size: 11
                            }
                        },
                        height: Math.max(500, data.labels.length * 18 + 80)
                    };

                    plotContainer.innerHTML = '';
                    Plotly.newPlot('plot', [heatmapTrace], layout, {
                        responsive: true,
                        displayModeBar: false
                    });

                    metaLine.innerHTML = `<i class="fa-solid fa-circle-check text-success me-2"></i> Visualizing ${data.count} core structural proteins successfully.`;

                } catch (error) {
                    console.error("Pipeline failure details:", error);
                    metaLine.innerHTML = `<i class="fa-solid fa-circle-exclamation text-danger me-2"></i> Render engine failed: ${error.message}`;
                    plotContainer.innerHTML = `<div class="text-danger p-5 text-center"><i class="fa-solid fa-triangle-exclamation fa-2x mb-2"></i><br>Failed loading rendering matrices interface view data layout maps.<br><small class="text-muted">Verify file locations and configuration pathways.</small></div>`;
                } finally {
                    if (overlay) overlay.classList.add('d-none');
                }
            }

            document.getElementById('applyFiltersBtn').addEventListener('click', updateHeatmap);

            document.getElementById('downloadCSV').addEventListener('click', () => {
                if (!currentHeatmapData || !currentHeatmapData.labels) {
                    alert("No data available to export. Please generate a heatmap first.");
                    return;
                }

                let csvRows = ['Protein_Accession,Control_Value,Infected_Value,Control_Raw_Log2,Infected_Raw_Log2'];
                for (let i = 0; i < currentHeatmapData.labels.length; i++) {
                    csvRows.push([
                        `"${currentHeatmapData.labels[i]}"`,
                        currentHeatmapData.control_vals[i],
                        currentHeatmapData.infected_vals[i],
                        currentHeatmapData.control_raw[i],
                        currentHeatmapData.infected_raw[i]
                    ].join(','));
                }

                const csvContent = "data:text/csv;charset=utf-8," + csvRows.join("\n");
                const encodedUri = encodeURI(csvContent);
                const downloadAnchor = document.createElement("a");
                downloadAnchor.setAttribute("href", encodedUri);
                downloadAnchor.setAttribute("download", `DRoP_Proteomics_Matrix_${groupSelect.value}.csv`);
                document.body.appendChild(downloadAnchor);
                downloadAnchor.click();
                document.body.removeChild(downloadAnchor);
            });

            document.getElementById('downloadPNG').addEventListener('click', () => {
                const plotDiv = document.getElementById('plot');
                if (!plotDiv || !plotDiv.data) {
                    alert("No rendered heatmap available to export.");
                    return;
                }

                Plotly.downloadImage('plot', {
                    format: 'png',
                    width: 1000,
                    height: plotDiv.offsetHeight > 500 ? plotDiv.offsetHeight : 600,
                    filename: `DRoP_Proteomics_Heatmap_${groupSelect.value}`
                });
            });

            updateHeatmap();
        });
    </script>

    <?php include 'footer.php'; ?>
</body>

</html>