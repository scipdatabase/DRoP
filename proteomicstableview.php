<?php
include 'Connection.php'; // Using connection matching your index setup

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare(
    "SELECT `Accession`, `Description`, `Sequence` 
     FROM `proteomics_data` WHERE `id` = ?"
);
$stmt->bind_param('i', $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

if (!$row) {
    die('Record not found.');
}

$accession   = !empty($row['Accession']) ? $row['Accession'] : 'Unknown Accession';
$description = !empty($row['Description']) ? $row['Description'] : 'No structural description available.';

// Build standard FASTA format sequence configuration
$sequence = preg_replace('/\s+/', '', $row['Sequence']);
$fasta    = '>' . $accession . "\n" . chunk_split($sequence, 60, "\n");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($accession) ?> - Structural Properties</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            margin: 24px;
            color: #333;
            background: #fafafa;
        }

        h2 {
            font-size: 22px;
            color: #1a252f;
            margin-bottom: 2px;
            border-bottom: 2px solid #34495e;
            padding-bottom: 8px;
        }

        .label {
            font-weight: 700;
            color: #2c3e50;
            margin-top: 20px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        pre {
            background: #ffffff;
            border: 1px solid #dcdde1;
            border-radius: 6px;
            padding: 14px;
            white-space: pre-wrap;
            word-break: break-all;
            font-family: "SFMono-Regular", Consolas, "Liberation Mono", Menlo, monospace;
            font-size: 13.5px;
            line-height: 1.5;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>
    <h2>Accession: <?= htmlspecialchars($accession) ?></h2>

    <div class="label">Functional Description</div>
    <pre><?= htmlspecialchars($description) ?></pre>

    <div class="label">Sequence (FASTA Format)</div>
    <pre><?= htmlspecialchars($fasta) ?></pre>
</body>

</html>