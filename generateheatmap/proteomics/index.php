<?php
/**
 * index.php
 * Interactive log2-abundance proteomics heat map portal page.
 * Data source: data/protein_log2_data.csv (accession, control_log2, infected_log2)
 * Rendering: Plotly.js heat map + optional PHP-generated dendrogram (SVG) for
 * hierarchical clustering, fetched live from api.php.
 */
declare(strict_types=1);
require __DIR__ . '/includes/functions.php';

// Basic sanity check so the page fails loudly (not silently) if data is missing.
$csvPath = __DIR__ . '/data/protein_log2_data.csv';
$dataOk = file_exists($csvPath);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Proteomics Log2 Abundance Heat Map</title>
<script src="https://cdn.plot.ly/plotly-2.32.0.min.js"></script>
<style>
  :root {
    --bg: #0f1115;
    --panel: #171a21;
    --border: #2a2e37;
    --text: #e6e8eb;
    --muted: #9aa0aa;
    --accent: #4f8cff;
  }
  * { box-sizing: border-box; }
  body {
    margin: 0;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    background: var(--bg);
    color: var(--text);
    padding: 24px;
  }
  h1 { font-size: 20px; margin: 0 0 4px; }
  .subtitle { color: var(--muted); font-size: 13px; margin-bottom: 20px; }
  .panel {
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 16px 18px;
    margin-bottom: 18px;
  }
  .controls { display: flex; flex-wrap: wrap; gap: 22px; align-items: flex-end; }
  .control-group { display: flex; flex-direction: column; gap: 6px; }
  .control-group label.title { font-size: 11px; text-transform: uppercase; letter-spacing: .05em; color: var(--muted); }
  .btn-row { display: flex; gap: 6px; flex-wrap: wrap; }
  .btn {
    background: #1f232c;
    border: 1px solid var(--border);
    color: var(--text);
    padding: 7px 14px;
    border-radius: 7px;
    cursor: pointer;
    font-size: 13px;
    transition: background .15s, border-color .15s;
  }
  .btn:hover { background: #262b35; }
  .btn.active { background: var(--accent); border-color: var(--accent); color: #fff; }
  .meta { color: var(--muted); font-size: 12.5px; margin-top: 4px; }
  .heatmap-wrap {
    display: flex;
    align-items: flex-start;
    background: var(--panel);
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 10px 12px 16px;
    overflow-x: auto;
  }
  #dendrogram-container { flex-shrink: 0; padding-top: 40px; }
  #dendrogram-container svg line { stroke: #8a91a0; }
  #plot { flex: 1; min-width: 420px; }
  #loading { color: var(--muted); font-size: 13px; padding: 20px; }
  .error-box {
    background: #2a1a1a; border: 1px solid #6b2b2b; color: #ffb4b4;
    padding: 14px 16px; border-radius: 8px; margin-bottom: 16px; font-size: 13px;
  }
  .legend-note { color: var(--muted); font-size: 12px; margin-top: 10px; }
</style>
</head>
<body>

<h1>Proteomics Log2 Abundance Heat Map</h1>
<div class="subtitle">Green &rarr; low, Red &rarr; high. Columns: Control vs Infected (log2 abundance).</div>

<?php if (!$dataOk): ?>
  <div class="error-box">Data file not found at <code><?= htmlspecialchars($csvPath) ?></code>. Upload protein_log2_data.csv into the /data folder.</div>
<?php endif; ?>

<div class="panel">
  <div class="controls">
    <div class="control-group">
      <label class="title">Protein set</label>
      <div class="btn-row" id="group-buttons">
        <button class="btn active" data-group="overall">Overall Top 50</button>
        <button class="btn" data-group="both">Top 50 in Both</button>
        <button class="btn" data-group="control">Top 50 Control Only</button>
        <button class="btn" data-group="infected">Top 50 Infected Only</button>
      </div>
    </div>

    <div class="control-group">
      <label class="title">Clustering</label>
      <div class="btn-row" id="cluster-buttons">
        <button class="btn active" data-cluster="0">Without Clustering</button>
        <button class="btn" data-cluster="1">With Hierarchical Clustering</button>
      </div>
    </div>

    <div class="control-group">
      <label class="title">Colour scale</label>
      <div class="btn-row" id="scale-buttons">
        <button class="btn active" data-scale="zscore">Row Z-score</button>
        <button class="btn" data-scale="raw">Raw Log2</button>
      </div>
    </div>
  </div>
  <div class="meta" id="meta-line">Loading&hellip;</div>
</div>

<div class="heatmap-wrap">
  <div id="dendrogram-container"></div>
  <div id="plot"><div id="loading">Loading heat map&hellip;</div></div>
</div>
<div class="legend-note">Row scaling (Z-score) shows relative up/down per protein between Control and Infected. Raw Log2 shows absolute log2 abundance values on the same colour scale.</div>

<script>
const state = { group: 'overall', cluster: '0', scale: 'zscore' };

function setActive(containerId, attr, value) {
  document.querySelectorAll('#' + containerId + ' .btn').forEach(b => {
    b.classList.toggle('active', b.dataset[attr] === value);
  });
}

document.getElementById('group-buttons').addEventListener('click', e => {
  if (!e.target.dataset.group) return;
  state.group = e.target.dataset.group;
  setActive('group-buttons', 'group', state.group);
  loadHeatmap();
});
document.getElementById('cluster-buttons').addEventListener('click', e => {
  if (!e.target.dataset.cluster) return;
  state.cluster = e.target.dataset.cluster;
  setActive('cluster-buttons', 'cluster', state.cluster);
  loadHeatmap();
});
document.getElementById('scale-buttons').addEventListener('click', e => {
  if (!e.target.dataset.scale) return;
  state.scale = e.target.dataset.scale;
  setActive('scale-buttons', 'scale', state.scale);
  loadHeatmap();
});

// Classic red-black-green diverging colour scale.
const COLORSCALE = [
  [0,    '#00b300'],
  [0.25, '#009900'],
  [0.5,  '#111111'],
  [0.75, '#b30000'],
  [1,    '#ff0000']
];

const ROW_HEIGHT = 18;
const MARGIN = { t: 40, b: 40, l: 190, r: 30 };

async function loadHeatmap() {
  const plotDiv = document.getElementById('plot');
  const dendroDiv = document.getElementById('dendrogram-container');
  document.getElementById('meta-line').textContent = 'Loading…';

  const params = new URLSearchParams({ group: state.group, scale: state.scale, cluster: state.cluster });
  let payload;
  try {
    const res = await fetch('api.php?' + params.toString());
    payload = await res.json();
    if (payload.error) throw new Error(payload.error);
  } catch (err) {
    plotDiv.innerHTML = '<div style="color:#ffb4b4;padding:20px;">Failed to load data: ' + err.message + '</div>';
    return;
  }

  const n = payload.count;
  const labels = payload.labels;
  const controlVals = payload.z[0];
  const infectedVals = payload.z[1];
  const controlRaw = payload.raw[0];
  const infectedRaw = payload.raw[1];

  // Build row-oriented z matrix for Plotly: rows = proteins, cols = [Control, Infected]
  const zMatrix = [];
  const hoverText = [];
  for (let i = 0; i < n; i++) {
    zMatrix.push([controlVals[i], infectedVals[i]]);
    hoverText.push([
      `${labels[i]}<br>Control log2: ${controlRaw[i]}<br>Value shown: ${controlVals[i]}`,
      `${labels[i]}<br>Infected log2: ${infectedRaw[i]}<br>Value shown: ${infectedVals[i]}`
    ]);
  }

  const allVals = controlVals.concat(infectedVals);
  const zmid = state.scale === 'zscore' ? 0 : (Math.min(...allVals) + Math.max(...allVals)) / 2;

  const data = [{
    z: zMatrix,
    x: payload.columns,
    y: labels,
    type: 'heatmap',
    colorscale: COLORSCALE,
    zmid: zmid,
    text: hoverText,
    hoverinfo: 'text',
    colorbar: { title: state.scale === 'zscore' ? 'Row Z-score' : 'Log2 abundance', titleside: 'right' },
    xgap: 2,
    ygap: 1
  }];

  const plotHeight = MARGIN.t + MARGIN.b + n * ROW_HEIGHT;

  const layout = {
    height: plotHeight,
    margin: MARGIN,
    paper_bgcolor: 'transparent',
    plot_bgcolor: 'transparent',
    font: { color: '#e6e8eb', size: 11 },
    xaxis: { side: 'top', tickfont: { size: 12 } },
    yaxis: { autorange: 'reversed', tickfont: { size: 10 }, automargin: false }
  };

  Plotly.newPlot(plotDiv, data, layout, { displaylogo: false, responsive: true });

  if (payload.clustered && payload.dendrogram) {
    dendroDiv.style.paddingTop = MARGIN.t + 'px';
    dendroDiv.innerHTML = payload.dendrogram;
  } else {
    dendroDiv.innerHTML = '';
    dendroDiv.style.paddingTop = '0';
  }

  const groupLabel = { overall: 'Overall Top 50', both: 'Top 50 in Both', control: 'Top 50 Control Only', infected: 'Top 50 Infected Only' }[state.group];
  document.getElementById('meta-line').textContent =
    `${groupLabel} — ${n} protein${n === 1 ? '' : 's'} shown` +
    (payload.clustered ? ' — hierarchically clustered (average linkage, Euclidean distance)' : ' — ordered by ranking metric');
}

loadHeatmap();
</script>

</body>
</html>
