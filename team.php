<?php
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Research Team</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #003366;
            --accent-blue: #007bff;
            --role-bg: rgba(0, 123, 255, 0.1);
            --slate-bg: #ffffff;
        }

        .ack-section {
            padding: 4rem 0;
            background: transparent;
            width: 100%;
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

        .lead-badge {
            background: #2c3e50;
            color: black !important;
            padding: 4px 12px;
            border-radius: 50px;
            /* animation: pulse-light 2s infinite; */
        }

        /* Distinct background for Lead Scientist */
        .lead-member {
            max-width: 850px;
            height: 280px !important;
            background: linear-gradient(135deg, #f0f7ff 0%, #ffffff 100%);
            border: 2px solid rgba(15, 15, 15, 0.1) !important;
        }

        @keyframes pulse-light {
            0% {
                box-shadow: 0 0 0 0 rgba(44, 62, 80, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(44, 62, 80, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(44, 62, 80, 0);
            }
        }

        /* Member Slate Base Design */
        .member-slate {
            background: var(--slate-bg);
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: row;
            border: 1px solid #eee;
        }

        .member-slate:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        /* Image Container */
        .slate-img {
            width: 100%;
            height: 400px;
            overflow: hidden;
        }

        .slate-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* transition: transform 0.5s ease; */
        }

        .member-slate:hover .slate-img img {
            transform: scale(1.05);
        }

        /* Content Area */
        .slate-content {
            padding: 1.5rem;
            text-align: center;
            flex-grow: 1;
        }

        .slate-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--primary-blue);
        }

        .role-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: var(--role-bg);
            color: var(--accent-blue);
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
        }

        .location-text {
            font-size: 1rem;
            color: #6c757d;
            margin: 0;
        }

        /* Special Styling for Lead Member */
        .lead-member {
            flex-direction: row;
            text-align: left;
            max-width: 900px;
            align-items: center;
        }

        .lead-member .slate-img {
            width: 300px;
            height: 300px;
        }

        .lead-member .slate-content {
            text-align: left;
            padding: 3rem;
        }

        .btn-publications {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            background: var(--accent-blue);
            color: black !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: background 0.3s;
        }

        .btn-publications:hover {
            background: var(--primary-blue);
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .lead-member {
                flex-direction: column;
                text-align: center;
            }

            .lead-member .slate-img {
                width: 100%;
            }

            .lead-member .slate-content {
                text-align: center;
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    <section class="ack-section">
        <div class="container-fluid">
            <div class="ack-header bg-primary bg-opacity-10 py-3 mb-5 rounded-3">
                <h2 class="text-primary display-4 text-center mb-0">
                    <i class="me-3"></i>Scientific minds behind portal
                </h2>
            </div>

            <div class="row g-4">
                <div class="col-12 d-flex justify-content-center mb-4">
                    <div class="member-slate lead-member shadow-lg">
                        <div class="slate-img">
                            <img src="Images/SKM.png" alt="Dr. Senthil Kumar Muthappa">
                        </div>
                        <div class="slate-content">
                            <span class="role-badge lead-badge"><i class="fas fa-star me-1"></i> Principal Scientist</span>
                            <div class="slate-header">
                                <h3 class="display-6 fw-bold">Dr. Muthappa Senthil-Kumar </h3>
                            </div>
                            <div class="slate-body">
                                <p class="location-text"><i class="fas fa-university me-1"></i> BRIC-National Institute of Plant Genome Research (NIPGR)</p>
                                <div class="slate-actions mt-3">
                                    <a href="https://scholar.google.com/citations?user=vmbK4UMAAAAJ&hl=en&oi=ao" target="_blank" class="btn-publications"><i class="fab fa-google me-1"></i> Research Portfolio</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="member-slate">
                        <div class="slate-img"><img src="Images/Durga.jpg" alt="Durgadevi Athimoolam"></div>
                        <div class="slate-content">
                            <div class="slate-header">
                                <h3>Durgadevi Athimoolam</h3>
                            </div>
                            <span class="role-badge">Senior Research Fellow</span>
                            <div class="slate-body">
                                <p class="location-text">BRIC-NIPGR, New Delhi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="member-slate">
                        <div class="slate-img"><img src="Images/Shikha.jpg" alt="Dr. Shikha Rani"></div>
                        <div class="slate-content">
                            <div class="slate-header">
                                <h3>Dr. Shikha Rani</h3>
                            </div>
                            <span class="role-badge">Research Associate-III (RA-III)</span>
                            <div class="slate-body">
                                <p class="location-text">BRIC-NIPGR, New Delhi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="member-slate">
                        <div class="slate-img"><img src="Images/RubiJain.jpg" alt="Dr. Rubi Jain"></div>
                        <div class="slate-content">
                            <div class="slate-header">
                                <h3>Dr. Rubi Jain</h3>
                            </div>
                            <span class="role-badge">National Post Doctoral Fellow (NPDF)</span>
                            <div class="slate-body">
                                <p class="location-text">BRIC-NIPGR, New Delhi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="member-slate">
                        <div class="slate-img"><img src="Images/Navaneeth V.jpg" alt="Navaneet"></div>
                        <div class="slate-content">
                            <div class="slate-header">
                                <h3>Mr. Navaneeth Vinayachandran</h3>
                            </div>
                            <span class="role-badge">Trainee</span>
                            <div class="slate-body">
                                <p class="location-text">BRIC-NIPGR, New Delhi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="member-slate">
                        <div class="slate-img"><img src="Images/S_Acharya.jpg" alt="Shankar Acharya"></div>
                        <div class="slate-content">
                            <div class="slate-header">
                                <h3>Mr. Shankar Acharya</h3>
                            </div>
                            <span class="role-badge">Senior Technical Officer</span>
                            <div class="slate-body">
                                <p class="location-text">BRIC-NIPGR, New Delhi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php include 'footer.php'; ?>
</body>

</html>