<?php

declare(strict_types=1);

const DIFFEX_CONDITIONS = [
    'D_3DAS_UP',
    'D_3DAS_DOWN',
    'D_6DAS_UP',
    'D_6DAS_DOWN',
    'P_3DAS_UP',
    'P_3DAS_DOWN',
    'P_6DAS_UP',
    'P_6DAS_DOWN',
    'DP_3DAS_UP',
    'DP_3DAS_DOWN',
    'DP_6DAS_UP',
    'DP_6DAS_DOWN',
];

function readDiffexCsv(string $path): array
{
    if (!file_exists($path)) {
        throw new RuntimeException("Data file not found: $path");
    }

    $rows = [];
    if (($handle = fopen($path, 'r')) === false) {
        throw new RuntimeException("Unable to open data file: $path");
    }

    $header = fgetcsv($handle);
    if ($header === false) {
        fclose($handle);
        throw new RuntimeException("Data file is empty: $path");
    }
    $header = array_map('trim', $header);

    while (($data = fgetcsv($handle)) !== false) {
        if (count($data) < count($header)) {
            continue;
        }
        $row = array_combine($header, $data);
        if ($row === false || !isset($row['Gene_ID'])) {
            continue;
        }
        $clean = ['Gene_ID' => trim((string) $row['Gene_ID'])];
        foreach (DIFFEX_CONDITIONS as $cond) {
            $clean[$cond] = isset($row[$cond]) && is_numeric($row[$cond]) ? (float) $row[$cond] : 0.0;
        }
        $rows[] = $clean;
    }
    fclose($handle);
    return $rows;
}

function diffexGroupColumns(string $groupCode): array
{
    $groupCode = strtoupper($groupCode);
    if (!in_array($groupCode, ['D', 'P', 'DP'], true)) {
        throw new InvalidArgumentException("Unknown treatment group: $groupCode");
    }
    return [
        'up3'    => "{$groupCode}_3DAS_UP",
        'down3'  => "{$groupCode}_3DAS_DOWN",
        'up6'    => "{$groupCode}_6DAS_UP",
        'down6'  => "{$groupCode}_6DAS_DOWN",
    ];
}

function diffexGroupLabel(string $groupCode): string
{
    switch (strtoupper($groupCode)) {
        case 'D':
            return 'Drought';
        case 'P':
            return 'Pathogen';
        case 'DP':
            return 'Drought+Pathogen';
        default:
            return $groupCode;
    }
}

function inferDiffexGroupFromCondition(string $condition): ?string
{
    if (stripos($condition, 'Drought') !== false && stripos($condition, 'Pathogen') !== false) {
        return 'DP';
    }
    if (stripos($condition, 'Drought') !== false) {
        return 'D';
    }
    if (stripos($condition, 'Pathogen') !== false) {
        return 'P';
    }
    return null;
}

function topNByColumn(array $rows, string $column, bool $ascending, int $limit = 20): array
{
    $sorted = $rows;
    usort($sorted, function ($a, $b) use ($column, $ascending) {
        $cmp = $a[$column] <=> $b[$column];
        return $ascending ? $cmp : -$cmp;
    });
    return array_slice($sorted, 0, $limit);
}

function buildDiffexHeatmapPayload(array $allRows, string $groupCode, int $topN = 20): array
{
    $cols = diffexGroupColumns($groupCode);

    $blocks = [
        topNByColumn($allRows, $cols['up3'],   false, $topN),
        topNByColumn($allRows, $cols['down3'], true,  $topN),
        topNByColumn($allRows, $cols['up6'],   false, $topN),
        topNByColumn($allRows, $cols['down6'], true,  $topN),
    ];

    $genes = [];
    $zValues = [];

    foreach ($blocks as $block) {
        foreach ($block as $row) {
            $genes[] = $row['Gene_ID'];
            $zRow = [];
            foreach (DIFFEX_CONDITIONS as $cond) {
                $zRow[] = round($row[$cond], 4);
            }
            $zValues[] = $zRow;
        }
    }

    return [
        'group'   => $groupCode,
        'label'   => diffexGroupLabel($groupCode),
        'title'   => 'Top 20 genes: ' . diffexGroupLabel($groupCode) . ' (3 & 6 DAS)',
        'genes'   => $genes,
        'samples' => DIFFEX_CONDITIONS,
        'zValues' => $zValues,
        'count'   => count($genes),
    ];
}

/**
 * ---------------------------------------------------------------------
 * PRJNA888832 support: long-format diffex files with columns
 * Gene_ID, log2FoldChange, Condition (Chickpea.csv, Parthenium.csv,
 * Chickpea_parthenium.csv). Some of these files have a trailing empty
 * 4th column in their header, which is simply ignored below.
 * ---------------------------------------------------------------------
 */

/**
 * Read a long-format differential-expression CSV into a flat list of
 * ['Gene_ID' => string, 'log2FoldChange' => float, 'Condition' => string].
 * Rows with a missing/non-numeric fold-change or empty gene ID are skipped.
 */
function readLongFormatDiffexCsv(string $path): array
{
    if (!file_exists($path)) {
        throw new RuntimeException("Data file not found: $path");
    }

    $rows = [];
    if (($handle = fopen($path, 'r')) === false) {
        throw new RuntimeException("Unable to open data file: $path");
    }

    $header = fgetcsv($handle);
    if ($header === false) {
        fclose($handle);
        throw new RuntimeException("Data file is empty: $path");
    }

    while (($data = fgetcsv($handle)) !== false) {
        if (count($data) < 3) {
            continue;
        }
        $gene = trim((string) $data[0]);
        $fc   = is_numeric($data[1]) ? (float) $data[1] : null;
        $cond = trim((string) $data[2]);

        if ($gene === '' || $fc === null || $cond === '') {
            continue;
        }

        $rows[] = ['Gene_ID' => $gene, 'log2FoldChange' => $fc, 'Condition' => $cond];
    }
    fclose($handle);
    return $rows;
}

/**
 * From a long-format diffex dataset, pick up to $topN most-upregulated
 * rows matching $upToken (highest log2FC first) and up to $topN
 * most-downregulated rows matching $downToken (most negative first).
 * Returned as two separate lists (not merged) so callers can plot
 * UP and DOWN as distinct x-axis columns.
 */
function selectTopUpDownGenes(array $rows, string $upToken, string $downToken, int $topN = 20): array
{
    $upRows   = array_values(array_filter($rows, fn($r) => $r['Condition'] === $upToken));
    $downRows = array_values(array_filter($rows, fn($r) => $r['Condition'] === $downToken));

    usort($upRows, fn($a, $b) => $b['log2FoldChange'] <=> $a['log2FoldChange']);
    usort($downRows, fn($a, $b) => $a['log2FoldChange'] <=> $b['log2FoldChange']);

    return [
        'up'   => array_slice($upRows, 0, $topN),
        'down' => array_slice($downRows, 0, $topN),
    ];
}

/**
 * Build a two-column (UP / DOWN) heatmap payload used for the
 * PRJNA888832 branch. Each gene appears once, with its log2FC value
 * in whichever column (UP or DOWN) it was selected under, and 0.0 in
 * the other — mirroring the UP/DOWN column pairing used for PRJNA749609.
 *
 * 'samples' carries the technical condition tokens (shown at the top
 * of the heatmap, e.g. "ICC4958_2D_UP"/"ICC4958_2D_DOWN"). 'bottomLabels'
 * carries the matching biological labels (shown at the bottom of the
 * heatmap: UP = higher under infection = "Infected", DOWN = higher in
 * the uninfected sample = "Control").
 */
function buildSingleSampleHeatmapPayload(array $upRows, array $downRows, string $sampleLabel, string $title, string $groupCode): array
{
    $genes   = [];
    $zValues = [];

    foreach ($upRows as $row) {
        $genes[]   = $row['Gene_ID'];
        $zValues[] = [round($row['log2FoldChange'], 4), 0.0];
    }
    foreach ($downRows as $row) {
        $genes[]   = $row['Gene_ID'];
        $zValues[] = [0.0, round($row['log2FoldChange'], 4)];
    }

    return [
        'title'        => $title,
        'genes'        => $genes,
        'samples'      => ["{$sampleLabel}_UP", "{$sampleLabel}_DOWN"],
        'bottomLabels' => ['Infected', 'Control'],
        'zValues'      => $zValues,
        'group'        => $groupCode,
        'count'        => count($genes),
    ];
}

/**
 * Pivot long-format rows (Gene_ID, log2FoldChange, Condition) into a
 * wide table across a fixed list of condition columns. Cells for a
 * gene/column combination that doesn't exist in the source data are
 * filled with null (not 0) — the front end renders null cells as
 * blank/gray "no data", matching the PRJNA749609 heatmap style,
 * instead of a misleading true-zero color.
 */
function pivotLongFormatToWide(array $longRows, array $columns): array
{
    $map = [];
    foreach ($longRows as $r) {
        $gene = $r['Gene_ID'];
        if (!isset($map[$gene])) {
            $map[$gene] = array_fill_keys($columns, null);
        }
        if (in_array($r['Condition'], $columns, true)) {
            $map[$gene][$r['Condition']] = $r['log2FoldChange'];
        }
    }

    $result = [];
    foreach ($map as $gene => $vals) {
        $result[] = array_merge(['Gene_ID' => $gene], $vals);
    }
    return $result;
}

/**
 * Like topNByColumn, but treats null as "not applicable" and excludes
 * it from ranking entirely (rather than sorting nulls as if they were 0).
 */
function topNByColumnNullable(array $rows, string $column, bool $ascending, int $limit = 20): array
{
    $filtered = array_values(array_filter($rows, fn($r) => $r[$column] !== null));
    usort($filtered, function ($a, $b) use ($column, $ascending) {
        $cmp = $a[$column] <=> $b[$column];
        return $ascending ? $cmp : -$cmp;
    });
    return array_slice($filtered, 0, $limit);
}

/**
 * Build a heatmap payload where every column in $columns contributes
 * its own top-N block (columns ending in "_DOWN" ranked ascending/
 * most-negative-first, everything else ranked descending), concatenated
 * in column order. This is the same multi-column "block" layout used
 * for the PRJNA749609 D/P/DP heatmaps, generalized to any column list —
 * used here for the PRJNA888832 sources (Chickpea / Parthenium /
 * Chickpea+Parthenium), each of which has its own condition columns.
 */
function buildColumnBlockHeatmapPayload(array $wideRows, array $columns, string $title, string $groupCode, int $topN = 20): array
{
    $genes = [];
    $zValues = [];

    foreach ($columns as $col) {
        $ascending = (substr($col, -5) === '_DOWN');
        $block = topNByColumnNullable($wideRows, $col, $ascending, $topN);
        foreach ($block as $row) {
            $genes[] = $row['Gene_ID'];
            $zRow = [];
            foreach ($columns as $c) {
                $zRow[] = $row[$c] === null ? null : round($row[$c], 4);
            }
            $zValues[] = $zRow;
        }
    }

    $bottomLabels = array_map(
        fn($c) => substr($c, -5) === '_DOWN' ? 'Control' : 'Infected',
        $columns
    );

    return [
        'title'        => $title,
        'genes'        => $genes,
        'samples'      => $columns,
        'bottomLabels' => $bottomLabels,
        'zValues'      => $zValues,
        'group'        => $groupCode,
        'count'        => count($genes),
    ];
}
