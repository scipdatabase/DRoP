<?php
include 'counter_logic.php';
include 'Connection.php';
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

if ($action == 'get_sources') {
    $id = $_GET['bioproject_id'];
    $stmt = $conn->prepare("SELECT DISTINCT sample_source FROM transcriptomics_meta WHERE bioproject_id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row['sample_source'];
    }
    echo json_encode($data ?: ['Plant', 'Plate']); // Fallback if meta table is empty
    exit;
}

if ($action == 'get_conditions') {
    $id = $_GET['bioproject_id'];
    $source = $_GET['source'];
    $stmt = $conn->prepare("SELECT DISTINCT comparison_group FROM transcriptomics_meta WHERE bioproject_id = ? AND sample_source = ?");
    $stmt->bind_param("ss", $id, $source);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row['comparison_group'];
    }
    echo json_encode($data);
    exit;
}

if ($action == 'get_heatmap') {
    // Note: You will need to replace this with your actual DEG data table query
    // Example format required by Plotly:
    echo json_encode([
        'genes' => ['LOC101', 'LOC102', 'LOC103', 'LOC104'],
        'samples' => ['Control_R1', 'Control_R2', 'Stress_R1', 'Stress_R2'],
        'z_values' => [
            [0.5, 0.4, 2.1, 2.3],
            [-1.1, -1.0, 0.5, 0.6],
            [2.0, 1.9, -0.2, -0.1],
            [0.1, 0.0, 0.5, 0.4]
        ]
    ]);
    exit;
}
