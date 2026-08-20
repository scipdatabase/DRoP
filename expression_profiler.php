<?php
ob_start();

error_reporting(E_ALL);
ini_set('display_errors', '0');

include 'counter_logic.php';
include 'Connection.php';
require __DIR__ . '/generateheatmap/transcriptomics/functions.php';

if (isset($_GET['ajax']) && $_GET['ajax'] == '1') {
    ob_clean();
    header('Content-Type: application/json; charset=utf-8');

    $bioproject = $_GET['bioproject'] ?? '';
    $source     = $_GET['source'] ?? '';
    $condition  = $_GET['condition'] ?? '';

    if ($bioproject === 'PRJNA888832') {
        try {
            $fileMap = [
                'Chickpea'             => 'Chickpea.csv',
                'Parthenium'           => 'Parthenium.csv',
                'Chickpea+Parthenium'  => 'Chickpea_parthenium.csv',
            ];

            // Each source has its own set of condition columns (some
            // sources cover two timepoints); every column becomes one
            // top-20 block in the heatmap, same pattern as PRJNA749609.
            $columnMap = [
                'Chickpea' => [
                    'ICC4958_2D_UP', 'ICC4958_2D_DOWN',
                ],
                'Parthenium' => [
                    'Ph-1_2D_UP', 'Ph-1_2D_DOWN', 'Ph-1_4D_UP', 'Ph-1_4D_DOWN',
                ],
                'Chickpea+Parthenium' => [
                    'Ph-1_2D_vs_ICC4958_2D_UP', 'Ph-1_2D_vs_ICC4958_2D_DOWN',
                    'Ph-1_4D_vs_ICC4958_2D_UP', 'Ph-1_4D_vs_ICC4958_2D_DOWN',
                ],
            ];

            $labelMap = [
                'Chickpea'             => 'Chickpea (2 DAI)',
                'Parthenium'           => 'Parthenium (2 & 4 DAI)',
                'Chickpea+Parthenium'  => 'Chickpea vs Parthenium (2 & 4 DAI)',
            ];

            if (!isset($fileMap[$source])) {
                echo json_encode(['error' => 'Data source mapping could not be resolved.']);
                exit;
            }

            $fileName = $fileMap[$source];
            $filePath = __DIR__ . '/generateheatmap/transcriptomics/' . $fileName;

            if (!file_exists($filePath)) {
                echo json_encode(['error' => "Data file ($fileName) not found on server."]);
                exit;
            }

            $columns = $columnMap[$source];
            $longRows = readLongFormatDiffexCsv($filePath);
            $wideRows = pivotLongFormatToWide($longRows, $columns);

            $payload = buildColumnBlockHeatmapPayload(
                $wideRows,
                $columns,
                'Top 20 genes: ' . $labelMap[$source],
                $source,
                20
            );

            if ($payload['count'] === 0) {
                echo json_encode(['error' => "No genes found for $source in $fileName."]);
                exit;
            }

            echo json_encode($payload);
        } catch (Throwable $e) {
            echo json_encode(['error' => 'Failed processing data file: ' . $e->getMessage()]);
        }
        exit;
    }

    $groupCode = inferDiffexGroupFromCondition($condition);
    if ($groupCode === null) {
        echo json_encode(['error' => 'No expression dataset is available yet for this selection.']);
        exit;
    }

    try {
        $csvPath = __DIR__ . '/generateheatmap/transcriptomics/diffex_PRJNA749609.csv';
        $rows = readDiffexCsv($csvPath);
        $payload = buildDiffexHeatmapPayload($rows, $groupCode, 20);
        echo json_encode($payload);
    } catch (Throwable $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}

ob_end_flush();
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Expression Profiler</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

    <style>
        :root {
            --primary-green: #198754;
            --bg-light: #f8f9fa;
        }

        body {
            background-color: white;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar-steps {
            min-height: 100vh;
            background-color: var(--bg-light);
            border-right: 1px solid #dee2e6;
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

        #heatmapContainer {
            border: 1px solid #eee;
            border-radius: 12px;
            background: #fff;
            min-height: 600px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.02);
        }

        #heatmapScroll {
            width: 100%;
            overflow-x: auto;
        }

        .card {
            border-radius: 15px;
            border: none;
        }

        .btn-success {
            background-color: var(--primary-green);
            border: none;
        }

        .btn-success:hover {
            background-color: #146c43;
        }

        .border-dashed {
            border: 2px dashed #dee2e6;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 p-4 sidebar-steps">
                <h4 class="mb-4 text-success fw-bold"><i class="fas fa-dna me-2"></i>DRoP Filters</h4>

                <div class="mb-4">
                    <label class="filter-label"><span class="step-number">STEP I</span> Select Bioproject</label>
                    <select id="bioprojectSelect" class="form-select shadow-sm">
                        <option value="">-- Choose Project --</option>
                        <option value="PRJNA888832">PRJNA888832</option>
                        <option value="PRJNA749609">PRJNA749609</option>
                        <option value="PRJNA428521">PRJNA428521</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="filter-label"><span class="step-number">STEP II</span> Experimental Source</label>
                    <select id="sourceSelect" class="form-select shadow-sm" disabled>
                        <option value="">-- Choose Source --</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="filter-label"><span class="step-number">STEP III</span> Differential Condition</label>
                    <select id="conditionSelect" class="form-select shadow-sm" disabled>
                        <option value="">-- Choose Condition --</option>
                    </select>
                </div>
                <button id="applyFilters" class="btn btn-success w-100 rounded-pill mt-3 shadow-sm py-2">
                    Generate Heatmap <i class="fas fa-sync ms-1"></i>
                </button>
            </div>

            <div class="col-md-9 p-4">
                <h2 class="fw-bold text-dark mb-4">Transcriptome Analysis</h2>

                <div id="metadataDisplay" class="mb-5">
                    <div class="alert alert-light border-dashed text-center p-5">
                        <p class="text-muted mb-0">Please select a Bioproject in Step I to view experimental details.</p>
                    </div>
                </div>

                <div id="heatmapContainer" class="position-relative">
                    <div id="loadingOverlay" class="d-none position-absolute w-100 h-100 bg-white opacity-75 d-flex align-items-center justify-content-center" style="z-index: 10;">
                        <div class="spinner-border text-success" role="status"></div>
                    </div>
                    <div id="heatmapScroll">
                        <div id="heatmap" style="width:100%; min-height: 600px;" class="d-flex align-items-center justify-content-center">
                            <div class="text-center text-muted">
                                <i class="fas fa-chart-area fa-4x mb-3 opacity-25"></i>
                                <p>Configure filters and click "Generate Heatmap" to visualize gene expression.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const projectLogic = {
            'PRJNA888832': {
                sources: ['Chickpea', 'Parthenium', 'Chickpea+Parthenium'],
                conditions: {
                    'Chickpea': ['Pathogen vs Control 2DAI'],
                    'Parthenium': ['Pathogen vs Control 2DAI', 'Pathogen vs Control 4DAI'],
                    'Chickpea+Parthenium': ['Pathogen (Chickpea) vs Pathogen (Parthenium) 2DAI']
                }
            },
            'PRJNA749609': {
                sources: ['Chickpea'],
                conditions: {
                    'Chickpea': [
                        'Pathogen vs Control',
                        'Drought vs Control',
                        'Drought+Pathogen vs Control'
                    ]
                }
            },
            'PRJNA428521': {
                sources: ['Chickpea'],
                conditions: {
                    'Chickpea': [
                        'Pathogen vs Control 6DAS', 'Pathogen vs Control 3DAS',
                        'Drought vs Control 6DAS', 'Drought vs Control 3DAS',
                        'Drought+Pathogen vs Control 6DAS', 'Drought+Pathogen vs Control 3DAS'
                    ]
                }
            }
        };

        let globalFetchedData = null;

        function updateDropdown(elementId, options, defaultText) {
            const dropdown = document.getElementById(elementId);
            dropdown.innerHTML = `<option value="">-- ${defaultText} --</option>`;
            options.forEach(opt => {
                const o = document.createElement('option');
                o.value = opt;
                o.textContent = opt;
                dropdown.appendChild(o);
            });
            dropdown.disabled = options.length === 0;
        }

        document.getElementById('bioprojectSelect').addEventListener('change', function() {
            const projectID = this.value;
            const container = document.getElementById('metadataDisplay');

            const metadata = {
                'PRJNA888832': `
                <div class="card border-0 shadow-sm" style="border-left: 5px solid #0d6efd !important; border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3 pb-3 border-bottom">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <h5 class="mb-0 me-2 text-dark fw-bold">Project ID: PRJNA888832</h5>
                                <span class="badge bg-primary-subtle text-primary px-3 py-2 border border-primary-subtle rounded-pill">Assay: <strong>Root (Blotter Paper)</strong></span>
                                <span class="badge bg-primary-subtle text-primary px-3 py-2 border border-primary-subtle rounded-pill">Target Hosts: <strong>Chickpea / Parthenium</strong></span>
                            </div>
                            <div style="min-width: 160px;">
                                <span class="d-block small fw-bold text-muted text-end mb-1">Export files</span>
                                <div class="btn-group shadow-sm w-100">
                                    <button id="downloadCSV" class="btn btn-outline-secondary btn-sm"><i class="fas fa-file-csv me-1"></i>CSV</button>
                                    <button id="downloadPNG" class="btn btn-outline-secondary btn-sm"><i class="fas fa-image me-1"></i>PNG</button>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3 mb-3 bg-light p-3 rounded-3 small text-muted mx-0">
                            <div class="col-md-4 border-end-md px-2">
                                <strong class="text-dark d-block mb-1"> Chickpea Profile:</strong>
                                Genotype: ICC 4958 (Moderately resistant)<br>
                                Stage: 2 Days After Inoculation (DAI)
                            </div>
                            <div class="col-md-4 border-end-md px-2">
                                <strong class="text-dark d-block mb-1"> Parthenium Profile:</strong>
                                Ecotype: Ph-1<br>
                                Stages: 2 &amp; 4 Days After Inoculation (DAI)
                            </div>
                            <div class="col-md-4 px-2">
                                <strong class="text-dark d-block mb-1"> Pathogen Agent:</strong>
                                <em>Macrophomina phaseolina</em> (SKMPt70)<br>
                                NCBI Accession: OM674336
                            </div>
                        </div>
                        <div class="mb-2 text-muted small border-start border-2 border-primary-subtle ps-3 py-1">
                            <strong class="text-dark">Statistical Cutoff:</strong> Analyzed via DESeq2 pipeline with significance threshold set at an adjusted FDR &le; 0.05.
                        </div>
                        <div class="small text-muted pt-2 border-top">
                            <span class="fw-bold text-dark me-2 text-transform-uppercase" style="font-size: 0.8rem; letter-spacing: 0.5px;">Sample Encodings:</span>
                            <span class="badge bg-white text-secondary border px-2 py-1 me-1"><strong>Ph-1_2D / 4D</strong> Parthenium Samples</span>
                            <span class="badge bg-white text-secondary border px-2 py-1"><strong>ICC4958_2D</strong> Chickpea Samples</span>
                        </div>
                    </div>
                </div>`,
                'PRJNA749609': `
                <div class="card border-0 shadow-sm" style="border-left: 5px solid #198754 !important; border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3 pb-3 border-bottom">
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <h5 class="mb-0 me-2 text-dark fw-bold">Project ID: PRJNA749609</h5>
                                <span class="badge bg-success-subtle text-success px-3 py-2 border border-success-subtle rounded-pill">Tissue: <strong>Root</strong></span>
                                <span class="badge bg-success-subtle text-success px-3 py-2 border border-success-subtle rounded-pill">Cultivar: <strong>JG62</strong></span>
                                <span class="badge bg-success-subtle text-success px-3 py-2 border border-success-subtle rounded-pill">Stages: <strong>3 &amp; 6 Days After Sowing</strong></span>
                            </div>
                            <div style="min-width: 160px;">
                                <span class="d-block small fw-bold text-muted text-end mb-1">Export files</span>
                                <div class="btn-group shadow-sm w-100">
                                    <button id="downloadCSV" class="btn btn-outline-secondary btn-sm"><i class="fas fa-file-csv me-1"></i>CSV</button>
                                    <button id="downloadPNG" class="btn btn-outline-secondary btn-sm"><i class="fas fa-image me-1"></i>PNG</button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 text-muted small d-flex flex-wrap align-items-center gap-3 bg-light p-3 rounded-3">
                            <span><strong class="text-dark">Fungal Inoculum:</strong> DRR ITCC:8635</span>
                            <span class="text-secondary">|</span>
                            <span><strong class="text-dark">NCBI GenBank ID:</strong> MH509971.1</span>
                            <span class="text-secondary">|</span>
                            <span><strong class="text-dark">Target Profile:</strong> Top 20 Differentially Expressed Genes (DEGs)</span>
                        </div>
                        <div class="mb-3 text-muted ps-3 py-1">
                            <strong class="text-dark small">Statistical Rules:</strong> 
                            Genes with log2FC >= 1 (Upregulated) 
                            or log2FC <= -1 (Downregulated) 
                            subject to a significance cutoff of q-value <= 0.05.
                        </div>
                        <div class="pt-2 border-top-0 small text-muted">
                            <span class="fw-bold text-dark me-2" style="font-size: 0.8rem; letter-spacing: 0.5px">Abbreviations:</span>
                            <span class="badge bg-light text-secondary border px-2 py-1 me-1"><strong>D -</strong> Drought</span>
                            <span class="badge bg-light text-secondary border px-2 py-1 me-1"><strong>P -</strong> Pathogen</span>
                            <span class="badge bg-light text-secondary border px-2 py-1"><strong>D+P -</strong> Drought + Pathogen</span>
                        </div>
                    </div>
                </div>`
            };

            container.innerHTML = metadata[projectID] || '<div class="alert alert-light border-dashed text-center p-5"><p class="text-muted mb-0">Select a project.</p></div>';
            updateDropdown('sourceSelect', [], 'Choose Source');
            updateDropdown('conditionSelect', [], 'Choose Condition');

            if (projectLogic[projectID]) {
                updateDropdown('sourceSelect', projectLogic[projectID].sources, 'Choose Source');
            }
        });

        document.getElementById('sourceSelect').addEventListener('change', function() {
            const projectID = document.getElementById('bioprojectSelect').value;
            if (projectLogic[projectID] && projectLogic[projectID].conditions[this.value]) {
                updateDropdown('conditionSelect', projectLogic[projectID].conditions[this.value], 'Choose Condition');
            }
        });

        document.getElementById('applyFilters').addEventListener('click', function() {
            const bioproject = document.getElementById('bioprojectSelect').value;
            const source = document.getElementById('sourceSelect').value;
            const condition = document.getElementById('conditionSelect').value;
            const overlay = document.getElementById('loadingOverlay');

            if (!condition) return;
            overlay.classList.remove('d-none');

            fetch(`?ajax=1&bioproject=${encodeURIComponent(bioproject)}&source=${encodeURIComponent(source)}&condition=${encodeURIComponent(condition)}`)
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        overlay.classList.add('d-none');
                        return;
                    }

                    globalFetchedData = data;

                    const heatmapDiv = document.getElementById('heatmap');
                    heatmapDiv.classList.remove('d-flex', 'align-items-center', 'justify-content-center');
                    heatmapDiv.style.minHeight = '';

                    const bound = 17.35;

                    const traceData = [{
                        z: data.zValues,
                        x: data.samples,
                        y: data.genes,
                        type: 'heatmap',
                        colorscale: 'RdBu',
                        reversescale: true,
                        zmin: -bound,
                        zmax: bound,
                        zmid: 0,
                        texttemplate: '%{z:.2f}',
                        textfont: {
                            size: 9
                        },
                        colorbar: {
                            title: {
                                text: 'log2FC',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            },
                            thickness: 15,
                            thicknessmode: 'pixels'
                        },
                        hovertemplate: 'Gene: %{y}<br>Condition: %{x}<br>log2FC: %{z:.2f}<extra></extra>'
                    }];

                    const rowHeight = 16;
                    const plotHeight = Math.max(600, data.genes.length * rowHeight + 150);
                    const hasBottomLabels = Array.isArray(data.bottomLabels) && data.bottomLabels.length === data.samples.length;

                    const layout = {
                        title: {
                            text: data.title || condition,
                            y: 0.99
                        },
                        margin: {
                            l: 180,
                            r: 30,
                            b: hasBottomLabels ? 55 : 30,
                            t: 160
                        },
                        paper_bgcolor: '#ffffff',
                        plot_bgcolor: '#cccccc',
                        xaxis: {
                            side: 'top',
                            tickangle: -90,
                            automargin: true
                        },
                        yaxis: {
                            autorange: 'reversed',
                            type: 'category',
                            title: {
                                text: 'Gene ID',
                                font: {
                                    size: 11,
                                    weight: 'bold'
                                },
                                standoff: 15
                            },
                            tickfont: {
                                size: 9
                            }
                        },
                        height: plotHeight
                    };

                    if (hasBottomLabels) {
                        layout.annotations = data.samples.map((sampleName, i) => ({
                            text: `<b>${data.bottomLabels[i]}</b>`,
                            x: sampleName,
                            xref: 'x',
                            y: 0,
                            yref: 'paper',
                            yanchor: 'top',
                            yshift: -10,
                            showarrow: false,
                            font: { size: 11, color: '#495057' }
                        }));
                    }

                    Plotly.newPlot('heatmap', traceData, layout, {
                        responsive: true,
                        displayModeBar: false
                    });

                    overlay.classList.add('d-none');
                })
                .catch(err => {
                    console.error("Fetch Execution Error:", err);
                    alert("Failed parsing standard dynamic response.");
                    overlay.classList.add('d-none');
                });
        });

        // Event Delegation for Export Buttons
        document.body.addEventListener('click', function(e) {

            if (e.target.closest('#downloadCSV')) {
                if (!globalFetchedData || !globalFetchedData.genes || !globalFetchedData.samples) {
                    alert("Please generate a heatmap before trying to export data.");
                    return;
                }

                const genes = globalFetchedData.genes;
                const samples = globalFetchedData.samples;
                const zValues = globalFetchedData.zValues;

                let csvContent = "Gene_ID," + samples.join(",") + "\n";

                genes.forEach((gene, rowIndex) => {
                    let row = [gene];
                    samples.forEach((sample, colIndex) => {
                        row.push(zValues[rowIndex][colIndex]);
                    });
                    csvContent += row.join(",") + "\n";
                });

                const blob = new Blob([csvContent], {
                    type: 'text/csv;charset=utf-8;'
                });
                const link = document.createElement("a");
                const filename = `expression_profile_${globalFetchedData.group || 'data'}.csv`;

                if (navigator.msSaveBlob) {
                    navigator.msSaveBlob(blob, filename);
                } else {
                    link.href = URL.createObjectURL(blob);
                    link.setAttribute("download", filename);
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            }

            if (e.target.closest('#downloadPNG')) {
                const heatmapEl = document.getElementById('heatmap');

                if (!heatmapEl || !heatmapEl.layout) {
                    alert("Please generate a heatmap before trying to export the image.");
                    return;
                }

                const filename = `heatmap_${globalFetchedData ? globalFetchedData.group : 'profile'}`;

                Plotly.downloadImage(heatmapEl, {
                    format: 'png',
                    width: heatmapEl.clientWidth || 1000,
                    height: heatmapEl.clientHeight || 800,
                    filename: filename
                });
            }
        });
    </script>
    <?php include 'footer.php'; ?>
</body>

</html>
