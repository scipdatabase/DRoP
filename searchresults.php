<?php
include 'counter_logic.php';
include 'Connection.php';
include 'header.php';

$search_query = isset($_GET['query']) ? trim($_GET['query']) : '';
$all_results = [];

if (!empty($search_query)) {
    $search_lower = strtolower($search_query);

    $portal_pages = [
        'index.php' => 'Home Page - Dry Root Rot Disease Portal',
        'OtherResources.php' => 'Quick links - External resources for the DRR related information',
        'drrothercrops.php' => 'Quick links - DRR disease in other crops',
        'diseasedescription.php' => 'About Section - Full description of DRR Disease',
        'pathogendescription.php' => 'About Section - Full description of <em>M.Phaseolina</em>',
        'rootrotcomplex.php' => 'About Section - Root rot complex',
        'comonpractice.php' => 'About Section - Management - Common practices',
        'croprotation.php' => 'About Section - Management - Crop rotation',
        'biopesticides.php' => 'About Section - Management - Biopesticides',
        'consortium.php' => 'About Section - Management - Microbial consortium',
        'antifungalprotein.php' => 'About Section - Management - Transgenics and gene editing',
        'RootROTAI-1.0.php' => 'Disease identification and assessment - Numerical data based',
        'RootROTAI-2.0.php' => 'Disease identification and assessment - Image data based',
        'RootROTAI-2.1.php' => 'Disease identification and assessment - Image data based',
        'RootROTAI-2.2.php' => 'Disease identification and assessment - Image data based',
        'protocol.php' => 'Resources - Protocol',
        'pathogenstrains.php' => 'Resources - Standardized Protocols for DRR',
        'literature.php' => 'Resources - Literature related to DRR',
        'minicore.php' => 'Resources - Information about minicore collection',
        'photos.php' => 'Resources - Images related to DRR',
        'Videos.php' => 'Resources - Tutorial Videos',
        'Sprout.php' => 'Resources - DRR screening facility',
        'genomics.php' => 'OMICS - Plant and Pathogen Genomics Data',
        'transcriptomics.php' => 'OMICS - Transcriptomics Profiling and Data',
        'metagenomics.php' => 'OMICS - Metagenomics Data',
        'proteomics.php' => 'OMICS - Proteomics Data',
        'metabolomics.php' => 'OMICS - Metabolomics Data',
        'expression_profile.php' => 'OMICS - Transcriptomics - Generate Heatmap Tool'
    ];

    foreach ($portal_pages as $file => $page_title) {
        if (file_exists($file)) {
            $file_content = file_get_contents($file);

            $clean_text = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $file_content);
            $clean_text = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', "", $clean_text);
            $clean_text = strip_tags($clean_text);
            $clean_text = html_entity_decode($clean_text);

            if (strpos(strtolower($clean_text), $search_lower) !== false) {
                $pos = stripos($clean_text, $search_lower);
                $start = max(0, $pos - 80);
                $snippet = "..." . substr($clean_text, $start, 180) . "...";

                $all_results[] = [
                    'title' => $page_title,
                    'type'  => 'Portal Information Page',
                    'badge_color' => 'bg-primary text-white',
                    'desc'  => $snippet,
                    'url'   => $file . "?query=" . urlencode($search_query)
                ];
            }
        }
    }

    $like_term = "%" . $search_query . "%";

    function table_has_column($conn, $table, $column)
    {
        try {
            $check = $conn->query("SHOW COLUMNS FROM `$table` LIKE '$column'");
            return ($check && $check->num_rows > 0);
        } catch (Exception $e) {
            return false;
        }
    }

    $meta_query = "SELECT * FROM metagenomics WHERE 1=0 ";
    $meta_cols = ['bioproject_id', 'host_genotype', 'location', 'stress_treatment'];
    foreach ($meta_cols as $col) {
        if (table_has_column($conn, 'metagenomics', $col)) {
            $meta_query .= " OR `$col` LIKE ? ";
        }
    }

    if (substr_count($meta_query, '?') > 0) {
        $stmt1 = $conn->prepare($meta_query);
        $params = array_fill(0, substr_count($meta_query, '?'), $like_term);
        $stmt1->bind_param(str_repeat("s", count($params)), ...$params);
        $stmt1->execute();
        $res1 = $stmt1->get_result();
        while ($row = $res1->fetch_assoc()) {
            $id = $row['bioproject_id'] ?? 'Dataset Record';
            $all_results[] = [
                'title' => "Metagenomics Raw Entry: " . $id,
                'type'  => 'Database Entry',
                'badge_color' => 'bg-success text-white',
                'desc'  => "Found matching records within the experimental dataset parameters of " . $id . ".",
                'url'   => "metagenomics.php"
            ];
        }
        $stmt1->close();
    }

    $gens_query = "SELECT * FROM genomics_pathogen WHERE 1=0 ";
    $gens_cols = ['bioproject_id', 'host_name', 'cultivar', 'tissue'];
    foreach ($gens_cols as $col) {
        if (table_has_column($conn, 'genomics_pathogen', $col)) {
            $gens_query .= " OR `$col` LIKE ? ";
        }
    }

    if (substr_count($gens_query, '?') > 0) {
        $stmt2 = $conn->prepare($gens_query);
        $params2 = array_fill(0, substr_count($gens_query, '?'), $like_term);
        $stmt2->bind_param(str_repeat("s", count($params2)), ...$params2);
        $stmt2->execute();
        $res2 = $stmt2->get_result();
        while ($row = $res2->fetch_assoc()) {
            $id = $row['Bioproject ID'] ?? $row['bioproject_id'] ?? 'Dataset Record';
            $all_results[] = [
                'title' => "genomics_pathogen: " . $id,
                'type'  => 'Database Entry',
                'badge_color' => 'bg-info text-dark',
                'desc'  => "Found targeted matching sequencing parameters relative to project dataset profile " . $id . ".",
                'url'   => "genomics.php"
            ];
        }
        $stmt2->close();
    }


    $trans_query = "SELECT * FROM transcriptomics_data WHERE 1=0 ";
    $trans_cols = ['bioproject_id', 'host_name', 'cultivar', 'tissue'];
    foreach ($trans_cols as $col) {
        if (table_has_column($conn, 'transcriptomics_data', $col)) {
            $trans_query .= " OR `$col` LIKE ? ";
        }
    }

    if (substr_count($trans_query, '?') > 0) {
        $stmt2 = $conn->prepare($trans_query);
        $params2 = array_fill(0, substr_count($trans_query, '?'), $like_term);
        $stmt2->bind_param(str_repeat("s", count($params2)), ...$params2);
        $stmt2->execute();
        $res2 = $stmt2->get_result();
        while ($row = $res2->fetch_assoc()) {
            $id = $row['Bioproject ID'] ?? $row['bioproject_id'] ?? 'Dataset Record';
            $all_results[] = [
                'title' => "Transcriptomics Entry Profile: " . $id,
                'type'  => 'Database Entry',
                'badge_color' => 'bg-info text-dark',
                'desc'  => "Found targeted matching sequencing parameters relative to project dataset profile " . $id . ".",
                'url'   => "transcriptomics.php"
            ];
        }
        $stmt2->close();
    }

    $lit_query = "SELECT * FROM literature_drr WHERE 1=0 ";
    $lit_cols = ['Full_reference', 'Source', 'Report_category'];
    foreach ($lit_cols as $col) {
        if (table_has_column($conn, 'literature_drr', $col)) {
            $lit_query .= " OR `$col` LIKE ? ";
        }
    }

    if (substr_count($lit_query, '?') > 0) {
        $stmt3 = $conn->prepare($lit_query);
        $params3 = array_fill(0, substr_count($lit_query, '?'), $like_term);
        $stmt3->bind_param(str_repeat("s", count($params3)), ...$params3);
        $stmt3->execute();
        $res3 = $stmt3->get_result();
        while ($row = $res3->fetch_assoc()) {
            $source = $row['Source'] ?? 'Literature Reference';
            $all_results[] = [
                'title' => "Literature Analysis Entry: " . $source,
                'type'  => 'Literature Record',
                'badge_color' => 'bg-warning text-dark',
                'desc'  => substr(($row['Full_reference'] ?? ''), 0, 150) . "...",
                'url'   => "literature.php"
            ];
        }
        $stmt3->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Global Portal Search Engine</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white border-bottom py-4">
                        <div class="text-muted small uppercase tracking-wider mb-1"><i class="fa-solid fa-earth-americas me-1"></i> Global Portal Index Search</div>
                        <h2 class="h3 mb-0 text-dark">
                            Results for: <span class="text-success fw-bold">"<?= htmlspecialchars($search_query); ?>"</span>
                            <span class="fs-6 text-muted fw-normal font-monospace ms-2">(<?= count($all_results); ?> matches found)</span>
                        </h2>
                    </div>

                    <div class="card-body p-4">
                        <?php if (empty($all_results)): ?>
                            <div class="text-center py-5 my-3">
                                <i class="fa-solid fa-box-open text-muted display-1 mb-3"></i>
                                <h4 class="text-secondary">No results found matching your query</h4>
                                <p class="text-muted small">Check your spelling, or try searching for generic terms like "drought", "chickpea", or specific "BioProject IDs".</p>
                            </div>
                        <?php else: ?>
                            <div class="list-group list-group-flush">
                                <?php foreach ($all_results as $result): ?>
                                    <div class="list-group-item py-4 px-2 border-bottom hover-bg transition">
                                        <div class="d-flex align-items-center mb-1 flex-wrap gap-2">
                                            <span class="badge <?= $result['badge_color']; ?> font-monospace px-2 py-1 small rounded-sm"><?= $result['type']; ?></span>
                                            <h4 class="h5 mb-0"><a href="<?= $result['url']; ?>" class="text-decoration-none text-primary fw-semibold"><?= htmlspecialchars($result['title']); ?></a></h4>
                                        </div>
                                        <p class="text-secondary small mb-1 mt-2 text-justify" style="line-height: 1.6;">
                                            <?= htmlspecialchars($result['desc']); ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>