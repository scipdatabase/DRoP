<?php
/**
 * functions.php
 * Core data + clustering logic for the proteomics log2 abundance heat map.
 *
 * Data assumption: CSV with header accession,control_log2,infected_log2
 * (already extracted from columns D & E of abundance_final.xlsx)
 */

declare(strict_types=1);

/**
 * Read the protein log2 CSV into an array of associative rows.
 */
function readProteinCsv(string $path): array
{
    if (!file_exists($path)) {
        throw new RuntimeException("Data file not found: $path");
    }

    $rows = [];
    if (($handle = fopen($path, 'r')) !== false) {
        $header = fgetcsv($handle); // skip header
        while (($data = fgetcsv($handle)) !== false) {
            if (count($data) < 3) {
                continue;
            }
            [$accession, $control, $infected] = $data;
            if ($control === '' || $infected === '' || $control === null || $infected === null) {
                continue; // skip incomplete rows
            }
            $rows[] = [
                'accession' => trim((string) $accession),
                'control'   => (float) $control,
                'infected'  => (float) $infected,
            ];
        }
        fclose($handle);
    }
    return $rows;
}

/**
 * Select the requested protein subset (max 50 rows), per group logic:
 *
 *  - overall  : top 50 ranked by MAX(control, infected)   -- highest abundance in either condition
 *  - control  : top 50 ranked by control value alone
 *  - infected : top 50 ranked by infected value alone
 *  - both     : intersection of (top 50 control) and (top 50 infected) accessions,
 *               ordered by AVG(control, infected) desc (may be < 50 rows)
 */
function selectGroup(array $rows, string $group, int $limit = 50): array
{
    $group = strtolower($group);

    $byControl = $rows;
    usort($byControl, fn($a, $b) => $b['control'] <=> $a['control']);

    $byInfected = $rows;
    usort($byInfected, fn($a, $b) => $b['infected'] <=> $a['infected']);

    switch ($group) {
        case 'control':
            return array_slice($byControl, 0, $limit);

        case 'infected':
            return array_slice($byInfected, 0, $limit);

        case 'both':
            $top50Control  = array_slice($byControl, 0, $limit);
            $top50Infected = array_slice($byInfected, 0, $limit);

            $controlAcc = array_column($top50Control, null, 'accession');
            $infectedAcc = array_column($top50Infected, null, 'accession');

            $intersectAcc = array_intersect_key($controlAcc, $infectedAcc);
            $result = array_values($intersectAcc);

            usort($result, fn($a, $b) => (($b['control'] + $b['infected']) <=> ($a['control'] + $a['infected'])));
            return array_slice($result, 0, $limit);

        case 'overall':
        default:
            $byOverall = $rows;
            usort($byOverall, function ($a, $b) {
                $am = max($a['control'], $a['infected']);
                $bm = max($b['control'], $b['infected']);
                return $bm <=> $am;
            });
            return array_slice($byOverall, 0, $limit);
    }
}

/**
 * Apply the chosen colour-scale transform to a set of rows.
 *
 *  - 'raw'    : leave control/infected log2 values as-is
 *  - 'zscore' : row-wise (per protein) z-score across its two conditions
 *               z = (x - mean) / population_std   (std of the pair)
 */
function applyScale(array $rows, string $scale): array
{
    $scale = strtolower($scale);
    if ($scale !== 'zscore') {
        foreach ($rows as &$r) {
            $r['control_val']  = $r['control'];
            $r['infected_val'] = $r['infected'];
        }
        return $rows;
    }

    foreach ($rows as &$r) {
        $mean = ($r['control'] + $r['infected']) / 2.0;
        $std  = sqrt((($r['control'] - $mean) ** 2 + ($r['infected'] - $mean) ** 2) / 2.0);
        if ($std == 0.0) {
            $r['control_val']  = 0.0;
            $r['infected_val'] = 0.0;
        } else {
            $r['control_val']  = ($r['control'] - $mean) / $std;
            $r['infected_val'] = ($r['infected'] - $mean) / $std;
        }
    }
    return $rows;
}

/**
 * Euclidean distance between two protein points in (control, infected) space.
 * Clustering always uses the RAW log2 values (stable regardless of display scale).
 */
function pointDistance(array $a, array $b): float
{
    return sqrt(($a['control'] - $b['control']) ** 2 + ($a['infected'] - $b['infected']) ** 2);
}

/**
 * Agglomerative hierarchical clustering (average linkage).
 * Returns:
 *   'clusters' => [nodeId => ['members'=>[...leaf idx...], 'left'=>id|null, 'right'=>id|null, 'height'=>float]]
 *   'root'     => rootNodeId
 * Leaf node ids are 0..n-1 matching the input array index.
 */
function hierarchicalCluster(array $rows): array
{
    $n = count($rows);
    $clusters = [];
    for ($i = 0; $i < $n; $i++) {
        $clusters[$i] = ['members' => [$i], 'left' => null, 'right' => null, 'height' => 0.0];
    }

    if ($n <= 1) {
        return ['clusters' => $clusters, 'root' => $n > 0 ? 0 : null];
    }

    // Precompute leaf-to-leaf distances once.
    $dist = [];
    for ($i = 0; $i < $n; $i++) {
        for ($j = $i + 1; $j < $n; $j++) {
            $d = pointDistance($rows[$i], $rows[$j]);
            $dist[$i][$j] = $d;
            $dist[$j][$i] = $d;
        }
    }

    $active = range(0, $n - 1);
    $nextId = $n;

    while (count($active) > 1) {
        $minDist = INF;
        $mi = -1;
        $mj = -1;
        $count = count($active);

        for ($x = 0; $x < $count; $x++) {
            for ($y = $x + 1; $y < $count; $y++) {
                $ci = $active[$x];
                $cj = $active[$y];
                $sum = 0.0;
                $cnt = 0;
                foreach ($clusters[$ci]['members'] as $li) {
                    foreach ($clusters[$cj]['members'] as $lj) {
                        $sum += $dist[$li][$lj];
                        $cnt++;
                    }
                }
                $avg = $cnt > 0 ? $sum / $cnt : 0.0;
                if ($avg < $minDist) {
                    $minDist = $avg;
                    $mi = $x;
                    $mj = $y;
                }
            }
        }

        $ci = $active[$mi];
        $cj = $active[$mj];

        $clusters[$nextId] = [
            'members' => array_merge($clusters[$ci]['members'], $clusters[$cj]['members']),
            'left'    => $ci,
            'right'   => $cj,
            'height'  => $minDist,
        ];

        $newActive = [];
        foreach ($active as $val) {
            if ($val !== $ci && $val !== $cj) {
                $newActive[] = $val;
            }
        }
        $newActive[] = $nextId;
        $active = $newActive;
        $nextId++;
    }

    return ['clusters' => $clusters, 'root' => $active[0]];
}

/**
 * Recursively compute leaf order (in-order traversal) for a clustering tree.
 */
function clusterLeafOrder(array $clusters, ?int $nodeId): array
{
    if ($nodeId === null) {
        return [];
    }
    $node = $clusters[$nodeId];
    if ($node['left'] === null && $node['right'] === null) {
        return [$node['members'][0]];
    }
    return array_merge(
        clusterLeafOrder($clusters, $node['left']),
        clusterLeafOrder($clusters, $node['right'])
    );
}

/**
 * Compute a "position" (avg leaf index) and "height" for every node,
 * used to lay out dendrogram coordinates.
 */
function computeNodeLayout(array $clusters, array $leafOrder): array
{
    $leafPosition = array_flip($leafOrder); // leaf id => position 0..n-1

    $layout = [];
    $computePos = function (int $nodeId) use (&$computePos, &$layout, $clusters, $leafPosition) {
        if (isset($layout[$nodeId])) {
            return $layout[$nodeId]['pos'];
        }
        $node = $clusters[$nodeId];
        if ($node['left'] === null && $node['right'] === null) {
            $pos = $leafPosition[$node['members'][0]];
            $layout[$nodeId] = ['pos' => $pos, 'height' => 0.0];
            return $pos;
        }
        $lp = $computePos($node['left']);
        $rp = $computePos($node['right']);
        $pos = ($lp + $rp) / 2.0;
        $layout[$nodeId] = ['pos' => $pos, 'height' => $node['height']];
        return $pos;
    };

    foreach (array_keys($clusters) as $id) {
        $computePos($id);
    }
    return $layout;
}

/**
 * Build an SVG dendrogram (leaves on the right at height 0, root at the left)
 * sized to line up vertically with heat-map rows of $rowHeight px each.
 */
function buildDendrogramSvg(array $clusterResult, array $leafOrder, int $rowHeight, int $width = 160): string
{
    $clusters = $clusterResult['clusters'];
    $root = $clusterResult['root'];
    $n = count($leafOrder);

    if ($root === null || $n <= 1) {
        return '<svg width="' . $width . '" height="' . ($rowHeight * max($n, 1)) . '"></svg>';
    }

    $layout = computeNodeLayout($clusters, $leafOrder);
    $maxHeight = $clusters[$root]['height'] ?: 1.0;

    $totalHeight = $rowHeight * $n;
    $pad = 8; // right-side padding so lines don't touch the heat map edge

    $toX = function (float $h) use ($width, $maxHeight, $pad) {
        // height 0 -> right edge (near heatmap); maxHeight -> left edge
        $usable = $width - $pad;
        return $width - $pad - ($h / $maxHeight) * $usable;
    };
    $toY = function (float $pos) use ($rowHeight) {
        return $pos * $rowHeight + $rowHeight / 2.0;
    };

    $lines = [];
    foreach ($clusters as $id => $node) {
        if ($node['left'] === null) {
            continue; // leaf, nothing to draw from here
        }
        $leftId  = $node['left'];
        $rightId = $node['right'];

        $xNode  = $toX($node['height']);
        $yLeft  = $toY($layout[$leftId]['pos']);
        $yRight = $toY($layout[$rightId]['pos']);
        $xLeft  = $toX($layout[$leftId]['height']);
        $xRight = $toX($layout[$rightId]['height']);

        // horizontal stem to each child + vertical connector between children
        $lines[] = sprintf('<line x1="%.2f" y1="%.2f" x2="%.2f" y2="%.2f" class="dendro-line"/>', $xLeft, $yLeft, $xNode, $yLeft);
        $lines[] = sprintf('<line x1="%.2f" y1="%.2f" x2="%.2f" y2="%.2f" class="dendro-line"/>', $xRight, $yRight, $xNode, $yRight);
        $lines[] = sprintf('<line x1="%.2f" y1="%.2f" x2="%.2f" y2="%.2f" class="dendro-line"/>', $xNode, $yLeft, $xNode, $yRight);
    }

    $svg = '<svg width="' . $width . '" height="' . $totalHeight . '" xmlns="http://www.w3.org/2000/svg">';
    $svg .= '<style>.dendro-line{stroke:#888;stroke-width:1.4;fill:none;}</style>';
    $svg .= implode('', $lines);
    $svg .= '</svg>';

    return $svg;
}

/**
 * End-to-end helper used by api.php: given raw rows + params, return
 * everything the front end needs to draw one heat map view.
 */
function buildHeatmapPayload(array $allRows, string $group, string $scale, bool $cluster): array
{
    $selected = selectGroup($allRows, $group, 50);

    $order = range(0, count($selected) - 1);
    $dendrogramSvg = null;

    if ($cluster && count($selected) > 1) {
        $clusterResult = hierarchicalCluster($selected);
        $order = clusterLeafOrder($clusterResult['clusters'], $clusterResult['root']);
        $dendrogramSvg = buildDendrogramSvg($clusterResult, $order, 18);
    }

    $ordered = [];
    foreach ($order as $idx) {
        $ordered[] = $selected[$idx];
    }

    $ordered = applyScale($ordered, $scale);

    $labels = array_map(fn($r) => $r['accession'], $ordered);
    $controlVals = array_map(fn($r) => round($r['control_val'], 4), $ordered);
    $infectedVals = array_map(fn($r) => round($r['infected_val'], 4), $ordered);
    $controlRaw = array_map(fn($r) => round($r['control'], 4), $ordered);
    $infectedRaw = array_map(fn($r) => round($r['infected'], 4), $ordered);

    return [
        'group'          => $group,
        'scale'          => $scale,
        'clustered'      => $cluster,
        'count'          => count($ordered),
        'labels'         => $labels,
        'control_vals'   => $controlVals,
        'infected_vals'  => $infectedVals,
        'control_raw'    => $controlRaw,
        'infected_raw'   => $infectedRaw,
        'columns'        => ['Control', 'Infected'],
        'dendrogram_svg' => $dendrogramSvg,
        'rowHeight'      => 18,
    ];
}
