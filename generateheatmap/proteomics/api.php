<?php
/**
 * api.php
 * JSON endpoint consumed by index.php (Plotly front end).
 *
 * GET params:
 *   group   = overall | control | infected | both   (default: overall)
 *   scale   = raw | zscore                            (default: zscore)
 *   cluster = 0 | 1                                    (default: 0)
 */

declare(strict_types=1);

require __DIR__ . '/functions.php';

header('Content-Type: application/json');

$group   = $_GET['group']   ?? 'overall';
$scale   = $_GET['scale']   ?? 'zscore';
$cluster = isset($_GET['cluster']) && $_GET['cluster'] === '1';

$allowedGroups = ['overall', 'control', 'infected', 'both'];
$allowedScales = ['raw', 'zscore'];

if (!in_array($group, $allowedGroups, true)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid group parameter']);
    exit;
}
if (!in_array($scale, $allowedScales, true)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid scale parameter']);
    exit;
}

try {
    $csvPath = __DIR__ . '/protein_log2_data.csv';
    $rows = readProteinCsv($csvPath);
    $payload = buildHeatmapPayload($rows, $group, $scale, $cluster);
    echo json_encode($payload);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
