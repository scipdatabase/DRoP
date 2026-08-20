<?php

include 'counter_logic.php';
include 'header.php';

// -------------------------------------------------------
// CONFIGURATION
// -------------------------------------------------------

$protocolDirectory =
    __DIR__ . '/documents/Protocols';

$protocolWebDirectory =
    'documents/Protocols';

// -------------------------------------------------------
// FIND ALL PDF FILES
// -------------------------------------------------------

$pdfFiles = [];

if (is_dir($protocolDirectory)) {

    $files = scandir($protocolDirectory);

    foreach ($files as $file) {

        // Ignore . and ..
        if ($file === '.' || $file === '..') {
            continue;
        }

        $fullPath =
            $protocolDirectory . DIRECTORY_SEPARATOR . $file;

        // Only PDF files
        if (
            is_file($fullPath) &&
            strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'pdf'
        ) {

            $pdfFiles[] = $file;
        }
    }
}

// -------------------------------------------------------
// SORT ALPHABETICALLY
// -------------------------------------------------------

natcasesort($pdfFiles);

$pdfFiles = array_values($pdfFiles);


// -------------------------------------------------------
// CREATE DISPLAY TITLE
// -------------------------------------------------------

function protocolTitle($filename)
{
    $title =
        pathinfo($filename, PATHINFO_FILENAME);

    // Replace underscores
    $title =
        str_replace('_', ' ', $title);

    // Replace hyphens
    $title =
        str_replace('-', ' ', $title);

    // Remove repeated spaces
    $title =
        preg_replace('/\s+/', ' ', $title);

    return trim($title);
}

// -------------------------------------------------------
// HTML ESCAPE
// -------------------------------------------------------

function e($value)
{
    return htmlspecialchars(
        $value,
        ENT_QUOTES,
        'UTF-8'
    );
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Protocols</title>


    <style>

        .ack-section {
            padding: 4rem 0;
            background: transparent;
        }

        .ack-header h2 {
            font-weight: 400;
            font-size: 2.5rem;
            text-align: center;
            position: relative;
            margin-bottom: 3rem;
        }

        .ack-header h2::after {
            content: '';
            width: 80px;
            height: 4px;
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 10px;
        }

        .protocol-card {
            background: #ffffff;
            border:
                1px solid #e2e8f0;
            border-radius: 16px;
            transition:
                all 0.35s
                cubic-bezier(
                    0.4,
                    0,
                    0.2,
                    1
                );
            overflow: hidden;
            position: relative;
        }

        .protocol-card:hover {
            transform:
                translateY(-6px);
            border-color:
                #0d9488;
            box-shadow:
                0 20px 25px -5px
                rgba(0, 0, 0, 0.05),
                0 10px 10px -5px
                rgba(0, 0, 0, 0.03);
        }

        .pdf-link-title {
            color: #1e293b;
            font-size: 1.25rem;
            font-weight: 700;
            text-decoration: none;
            transition:
                color 0.2s ease;
            display: inline-block;
        }

        .protocol-card:hover
        .pdf-link-title {
            color: #0d9488;
        }

        .protocol-badge {
            background-color:
                #f0fdf4;
            color: #166534;
            font-size: 0.75rem;
            font-weight: 600;
            padding:
                6px 14px;
            border-radius: 30px;
            border:
                1px solid #bbf7d0;
        }

        .custom-icon-box {
            width: 55px;
            height: 55px;
            background: #f1f5f9;
            color: #1e3a8a;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition:
                all 0.3s ease;
        }

        .protocol-card:hover
        .custom-icon-box {
            background: #0d9488;
            color: #ffffff;
        }

        .action-indicator {
            font-size: 0.85rem;
            font-weight: 600;
            color: #0d9488;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: auto;
        }

        /* Search */

        .protocol-search {
            max-width: 700px;
            margin:
                0 auto 40px auto;
        }

        .protocol-search input {
            width: 100%;
            padding:
                14px 18px;
            border:
                1px solid #cbd5e1;
            border-radius: 12px;
            font-size: 16px;
            outline: none;
        }

        .protocol-search input:focus {
            border-color:
                #0d9488;
            box-shadow:
                0 0 0 3px
                rgba(
                    13,
                    148,
                    136,
                    0.1
                );
        }

        .protocol-count {
            text-align: center;
            color: #64748b;
            margin-bottom: 30px;
        }

    </style>

</head>

<body>

<div class="ack-section py-5">
    <div class="container-fluid">
        <!-- HEADER -->
        <div
            class="ack-header
                   bg-primary
                   bg-opacity-10
                   py-4
                   mb-5
                   rounded-3
                   text-center"
        >
        <h2
                class="text-primary
                       display-4
                       mb-2"
            >
                <strong>
                    Protocols
                </strong>
            </h2>
        </div>

        <!-- SEARCH -->
        <div class="protocol-search">
            <input
                type="text"
                id="protocolSearch"
                placeholder="Search protocols..."
                autocomplete="off"
            >
        </div>

        <!-- COUNT -->
        <div class="protocol-count">
            Total protocols:
            <strong>
                <?php echo count($pdfFiles); ?>
            </strong>
        </div>

        <!-- PROTOCOL CARDS -->
        <div
            class="row g-4"
            id="protocolContainer"
        >
            <?php if (empty($pdfFiles)): ?>
                <div
                    class="col-12 text-center"
               >
                    <div
                        class="alert
                               alert-warning"
                    >
                        No protocol PDF files
                        were found.
                    </div>
                </div>
            <?php else: ?>
                <?php foreach (
                    $pdfFiles
                    as $index => $filename
                ): ?>
                    <?php
                    $title =
                        protocolTitle($filename);
                    $encodedFile =
                        urlencode($filename);
                    ?>
                    <div
                        class="col-12 col-lg-6
                               protocol-item"
                        data-title="<?php
                            echo e(
                                strtolower($title)
                            );
                        ?>"
                    >
                        <div
                            class="
                                card
                                h-100
                                protocol-card
                                p-4
                            "
                        >
                            <div
                                class="
                                    card-body
                                    p-0
                                    d-flex
                                    flex-column
                                "
                            >
                                <!-- BADGE -->
                                <div
                                    class="
                                        d-flex
                                        align-items-start
                                        justify-content-between
                                        mb-4
                                    "
                                >
                                    <span
                                        class="
                                            protocol-badge
                                        "
                                    >
                                        Lab Protocol
                                    </span>
                                </div>

                                <!-- TITLE -->
                                <h4 class="mb-3">
                                    <a
                                        href="/protocol-view?file=<?php
                                            echo $encodedFile;
                                        ?>"
                                        class="
                                            pdf-link-title
                                        "
                                    >
                                        <?php
                                        echo e($title);
                                        ?>
                                        <i
                                            class="
                                                fas
                                                fa-external-link-alt
                                                ms-1
                                                fs-6
                                                text-muted
                                                opacity-50
                                            "
                                        ></i>
                                    </a>
                                </h4>
                                <!-- DESCRIPTION -->
                                <p
                                    class="
                                        text-muted
                                        small
                                        lh-relaxed
                                        mb-4
                                    "
                                >
                                    Click to view the
                                    complete protocol
                                    directly in the
                                    browser.
                                </p>

                                <!-- BUTTON -->
                                <div
                                    class="
                                        action-indicator
                                        mt-auto
                                    "
                                >
                                    <a
                                        href="/protocol-view?file=<?php
                                            echo $encodedFile;
                                        ?>"
                                        class="
                                            btn
                                            btn-sm
                                            btn-outline-secondary
                                            rounded-pill
                                            px-3
                                        "
                                    >
                                        <i
                                            class="
                                                far
                                                fa-file-pdf
                                                me-2
                                                text-danger
                                            "
                                        ></i>
                                        View Protocol
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>

const searchBox =
    document.getElementById(
        'protocolSearch'
    );

const protocolItems =
    document.querySelectorAll(
        '.protocol-item'
    );

searchBox.addEventListener(
    'input',
    function () {
        const search =
            this.value
                .toLowerCase()
                .trim();
        protocolItems.forEach(
            function (item) {
                const title =
                    item.dataset.title;
                if (
                    title.includes(search)
                ) {

                    item.style.display =
                        '';
                } else {
                    item.style.display =
                        'none';
                }
            }
        );
    }
);

</script>

<?php
include 'footer.php';
?>

</body>
</html>
