# Proteomics Log2 Abundance Heat Map

Interactive heat map portal module for your proteomics data (columns D & E of
`abundance_final.xlsx`: `CONTROL_APOPLAST_VNC` and `INFECTED_APOPLAST_VNC` log2
abundance values). Built in PHP + Plotly.js.

## Files

```
proteomics_heatmap/
├── data/
│   └── protein_log2_data.csv     # accession, control_log2, infected_log2 (1543 proteins)
├── includes/
│   └── functions.php             # data loading, group selection, clustering, dendrogram SVG
├── api.php                       # JSON endpoint consumed by the front end
├── index.php                     # the heat map page (UI + Plotly.js)
└── README.md
```

## Deployment

1. Copy the whole `proteomics_heatmap/` folder to your PHP-enabled web server
   (PHP 7.4+ recommended, no external PHP extensions or Composer packages
   required — pure PHP, no DB).
2. Make sure `data/protein_log2_data.csv` is readable by the web server.
3. Open `index.php` in a browser (or embed it as an iframe / route inside
   your existing portal).

To refresh the data later, re-export columns D & E from a new
`abundance_final.xlsx` into the same CSV format:

```
accession,control_log2,infected_log2
A0A0R0EK76,18.789615433791813,20.468337884345853
...
```
(A small Python/PHP export snippet can be added if you want this automated
from Excel directly — ask and I'll add an `xlsx importer.)

## What the portal shows

Four protein sets (each capped at 50 proteins), toggled via buttons:

| Set | Ranking logic |
|---|---|
| **Overall Top 50** | Ranked by `MAX(control_log2, infected_log2)` — highest abundance in either condition |
| **Top 50 in Both** | Intersection of (top 50 by Control) and (top 50 by Infected), ranked by average of the two — *may return fewer than 50 rows*, since it depends on overlap |
| **Top 50 Control Only** | Ranked by Control log2 value alone |
| **Top 50 Infected Only** | Ranked by Infected log2 value alone |

Two clustering modes:

- **Without Clustering** — rows kept in the ranking order above.
- **With Hierarchical Clustering** — rows reordered by agglomerative
  hierarchical clustering (average linkage, Euclidean distance on the raw
  `[control, infected]` log2 pair), with a dendrogram rendered to the left of
  the heat map showing the merge tree.

Two colour-scale modes (also toggle buttons):

- **Row Z-score** (default) — each protein's two values are z-scored
  relative to each other, so the map shows *relative* up/down between
  Control and Infected (classic red/green heat map look).
- **Raw Log2** — the actual log2 abundance values are mapped directly onto
  the same green→black→red colour scale.

Hover over any cell to see the protein accession and its exact log2 value.

## Notes on the clustering implementation

Clustering is done in pure PHP (`hierarchicalCluster()` in `functions.php`):
agglomerative, average-linkage, O(n³) — trivial for the ≤50 rows in any view.
The resulting binary tree is used both to reorder heat-map rows and to draw
the dendrogram SVG (`buildDendrogramSvg()`), which is generated server-side
and returned as a string inside the same JSON payload the heat map uses, so
row order always matches between the tree and the heat map.

Clustering always uses the **raw** log2 values (not the z-scored ones) so
the tree structure doesn't change when you flip the colour-scale toggle —
only the colours change, not the row order.

## Customizing

- **Row cap**: change the `50` limit passed to `selectGroup()` in
  `buildHeatmapPayload()` inside `functions.php`.
- **Colours**: edit the `COLORSCALE` array in `index.php` (currently a
  5-stop green→black→red scale).
- **Row height / sizing**: `ROW_HEIGHT` and `MARGIN` constants in the
  `<script>` block of `index.php` (keep in sync with the `rowHeight`
  argument passed to `buildDendrogramSvg()` in `functions.php`, currently
  both set to 18px).
