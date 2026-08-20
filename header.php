<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Web Portal, Dry Root Rot, Disease Severity, Genotypes">
    <meta name="author" content="Durga Devi, Shikha Rani, Rubi Jain, Shankar Acharya, Senthil Kumar Muthappa">
    <link rel="icon" type="image/x-icon" href="../DROP/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --primary-dark: #2c3e50; 
            --accent-green: #27ae60;
            --light-bg: #5e9de0;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #99c2da, #E8F8FF, #83c8e7);
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-wrapper {
            flex: 1 0 auto;
        }

        .header-section {
            background: linear-gradient(135deg, #96c5e0, #E8F8FF, #83c3e0);
            padding: 0.7rem 0;
            border-bottom: 4px solid var(--accent-green);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .main-title {
            font-size: 3.0rem;
            color: #1e3377;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            letter-spacing: -1px;
            font-weight: 700;
            margin-bottom: 0;
        }

        .title {
            font-size: 2.0rem;
            color: #1e3377;
        }

        .navbar {
            background-color: var(--primary-dark) !important;
            padding: 0.8rem 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .navbar-nav .nav-item {
            margin: 0 0.75rem;
        }

        .nav-link {
            color: var(--white) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 6px;
        }

        .nav-link:hover {
            color: var(--white) !important;
            background-color: rgba(39, 174, 96, 0.2);
        }

        .navbar-nav .nav-link.active {
            color: #fff !important;
            background-color: rgba(39, 174, 96, 0.2) !important;
            border-radius: 6px;
        }

        .navbar-nav .nav-link.active:hover {
            color: var(--white) !important;
            background-color: rgba(39, 174, 96, 0.2) !important;
        }

        .navbar-nav .dropdown {
            position: relative;
        }

        .navbar-nav .dropdown > .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1050;
            margin-top: 0;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            min-width: 220px;
        }

        .navbar-nav .dropdown:hover > .dropdown-menu {
            display: block;
        }
        .navbar-nav .dropdown > .dropdown-menu:hover {
            display: block;
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .dropdown-item:hover {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--light-bg);
            padding-left: 2rem;
        }

        .dropdown-menu .dropdown-item:hover {
            background: rgba(39, 174, 96, 0.15) !important;
            color: var(--light-bg) !important;
            font-weight: 600;
        }

        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu > .dropdown-menu {
            display: none;
            position: absolute;
            top: 0;
            left: 100%;
            margin-top: 0;
            margin-left: 0;
            z-index: 1060;
            border: none;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            min-width: 240px;
        }

        .dropdown-submenu:hover > .dropdown-menu {
            display: block;
        }

        .dropdown-submenu:hover > a.dropdown-item {
            background: rgba(39, 174, 96, 0.15) !important;
            color: var(--light-bg) !important;
            font-weight: 600;
        }

        .dropdown-submenu > .dropdown-menu:hover {
            display: block;
        }

        .dropdown-header {
            color: #2c3e50;
            font-size: 0.85rem;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        @media (max-width: 768px) {

            .main-title {
                font-size: 2rem;
            }

            .navbar-nav .dropdown > .dropdown-menu {
                position: static;
                margin-left: 0;
                box-shadow: none;
            }

            .dropdown-submenu > .dropdown-menu {
                position: static;
                margin-left: 1rem;
                box-shadow: none;
            }

            .navbar-nav .dropdown:hover > .dropdown-menu {
                display: none;
            }

            .navbar-nav .dropdown.show > .dropdown-menu {
                display: block;
            }

            .dropdown-submenu:hover > .dropdown-menu {
                display: none;
            }

            .dropdown-submenu.show > .dropdown-menu {
                display: block;
            }
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <header class="header-section">
            <div class="container-fluid px-2">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center text-md-start">
                        <a href="http://www.nipgr.ac.in/home/home.php" target="_blank"> <img src="Images/BRIC-NIPGR-LOGO.png" alt="NIPGR Logo" style="height: 80px;"> </a>
                    </div>

                    <div class="col-md-7 text-center">
                        <h1 class="fw-bold main-title">
                            <span style="text-decoration: underline;">D</span>ry Root
                            <span style="text-decoration: underline;">Ro</span>t
                            <span style="text-decoration: underline;">P</span>ortal
                        </h1>
                        <h1 class="fw-bold title">
                            (DRoP)
                        </h1>
                        <span class="text-muted ms-1 ps-1"
                            style="
                                font-size: 0.95rem;
                                font-weight: 500;
                                letter-spacing: 0.5px;
                            ">
                            A chickpea focused resource
                        </span>

                    </div>

                    <div class="col-md-1 text-center text-md-end">
                        <a href="https://db.nipgr.ac.in/cdpdb/Germplasm.php"
                            target="_blank">
                            <img src="Images/CDPdb_Logo.png"
                                alt="SCIP Logo"
                                style="height: 100px">
                        </a>
                    </div>
                    <div class="col-md-1 text-center text-md-end">
                        <a href="https://github.com/scipdatabase/RootRotAI/releases/tag/v2.2"
                            target="_blank">
                            <img src="Images/ROOTROT_AI.png"
                                alt="SCIP Logo"
                                style="height: 100px">
                        </a>
                    </div>
                    <div class="col-md-1 text-center text-md-end">
                        <a href="https://db.nipgr.ac.in/plant_complete/index_orangesunset.php"
                            target="_blank">
                            <img src="Images/logodb.png"
                                alt="SCIP Logo"
                                style="height: 100px">
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
            <div class="container-fluid px-5">
                <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNav"
                    aria-controls="mainNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse"
                    id="mainNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active"
                                href="index.php">
                                Home
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                About
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item"
                                        href="diseasedescription.php">
                                        Disease description
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="pathogendescription.php">
                                        Pathogen description
                                    </a>
                                </li>
<li class="dropdown-submenu">
    <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
        <span>Management</span>
        <i class="fas fa-chevron-right ms-3" style="font-size: 0.8rem;"></i>
    </a>
    <ul class="dropdown-menu">
        
        <li class="dropdown-submenu">
            <a class="dropdown-item d-flex justify-content-between align-items-center" href="commonpractice.php">
                <span>Agronomy practices</span>
                <i class="fas fa-chevron-right ms-3" style="font-size: 0.8rem;"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="croprotation.php">Crop rotation</a>
                </li>
            </ul>
        </li>

        <li class="dropdown-submenu">
            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                <span>Chemical control</span>
                <i class="fas fa-chevron-right ms-3" style="font-size: 0.8rem;"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="fungicides.php">Fungicides</a>
                </li>
            </ul>
        </li>

        <li class="dropdown-submenu">
            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                <span>Biological control</span>
                <i class="fas fa-chevron-right ms-3" style="font-size: 0.8rem;"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="Biopesticides.php">Biopesticides</a>
                </li>
                <li>
                    <a class="dropdown-item" href="consortium.php">Microbial consortium</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="dropdown-item" href="antifungalprotein.php">
                Transgenics and gene editing
            </a>
        </li>
    </ul>
</li>
                              
                                <li>
                                    <a class="dropdown-item"
                                        href="rootrotcomplex.php">
                                        Root rot complex
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Tools
                            </a>
                            <ul class="dropdown-menu shadow">
                                <li>
                                    <h6 class="dropdown-header fw-bold px-3 pt-2 pb-1">
                                        Disease Identification & Assessment
                                    </h6>
                                </li>
                                <li>
                                    <hr class="dropdown-divider my-1">
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2"
                                        href="RootRotAI-1.0.php">
                                        <span class="fw-medium">
                                            RootRotAI-1.0
                                        </span>
                                        <span class="badge bg-light text-secondary border ms-3 fw-normal">
                                            Numerical Data Based
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2"
                                        href="RootRotAI-2.0.php">
                                        <span class="fw-medium">
                                            RootRotAI-2.0
                                        </span>
                                        <span class="badge bg-light text-secondary border ms-3 fw-normal">
                                            Image Data Based — GitHub Repo
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2"
                                        href="RootRotAI-2.1.php">
                                        <span class="fw-medium">
                                            RootRotAI-2.1
                                        </span>

                                        <span class="badge bg-light text-secondary border ms-3 fw-normal">
                                            Image Data Based — Web App
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between py-2"
                                        href="RootRotAI-2.2.php">
                                        <span class="fw-medium">
                                            RootRotAI-2.2
                                        </span>
                                        <span class="badge bg-light text-secondary border ms-3 fw-normal">
                                            Image Data Based — Mobile App
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Resources
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item"
                                        href="protocol.php">
                                        Protocol
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="pathogenstrains.php">
                                        Pathogen strains
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="literature.php">
                                        Literature
                                    </a>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="dropdown-item d-flex justify-content-between align-items-center"
                                        href="#">
                                        <span>Germplasm</span>
                                        <i class="fas fa-chevron-right ms-3"
                                            style="font-size: 0.8rem;">
                                        </i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item"
                                                href="https://genebank.icrisat.org/IND/Passport?Crop=Chickpea"
                                                target="_blank">
                                                Passport collection
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="minicore.php">
                                                Mini-core collection
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="photos.php">
                                        Images
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="videos.php">
                                        Videos
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="Sprout.php">
                                        DRR screening facility
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                OMICS
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item"
                                        href="genomics.php">
                                        Genomics
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="metagenomics.php">
                                        Metagenomics
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="transcriptomics.php">
                                        Transcriptomics
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="proteomics.php">
                                        Proteomics
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="metabolomics.php">
                                        Metabolomics
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="https://db.nipgr.ac.in/cdpdb/Germplasm.php"
                                        target="_blank">
                                        Phenomics
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Help
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item"
                                        href="userguide.php">
                                        User guide
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="FAQs.php">
                                        FAQs
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="sitemap.php">
                                        Site map
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Contact
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item"
                                        href="team.php">
                                        Team members
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="FnA.php">
                                        Funding & Acknowledgement
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="Reachus.php">
                                        Reach us
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="socialmedia.php">
                                        @ Social media
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex"
                        action="searchresults.php"
                        method="GET">
                        <div class="input-group">
                            <input class="form-control"
                                type="search"
                                name="query"
                                placeholder="Search...."
                                aria-label="Search"
                                required
                                value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
                            <button class="btn btn-success"
                                type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const submenuParents = document.querySelectorAll(
                '.dropdown-submenu > a.dropdown-item'
            );
            submenuParents.forEach(function (link) {
                link.addEventListener('click', function (event) {
                    if (window.innerWidth > 768) {
                        event.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>
