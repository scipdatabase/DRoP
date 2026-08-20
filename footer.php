<?php include 'counter_logic.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DROP Portal Footer</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        :root {
            --primary-dark: #0a0a0a;
            --accent-green: #27ae60;
        }

        footer {
            background-color: var(--primary-dark) !important;
            padding: 1.5rem 0 1rem 0;
            /* Narrowed padding vertical scale */
            border-top: 4px solid var(--accent-green);
            font-family: 'Inter', sans-serif;
            color: white;
        }

        .visitor-card {
            background: #161616 !important;
            border: 1px solid #333 !important;
            transition: all 0.4s ease;
        }

        .visitor-card:hover {
            transform: translateY(-3px);
            border-color: var(--accent-green) !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.6);
        }

        .pulse-dot {
            height: 8px;
            width: 8px;
            background-color: var(--accent-green);
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(39, 174, 96, 0.7);
            }

            70% {
                box-shadow: 0 0 0 8px rgba(39, 174, 96, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(39, 174, 96, 0);
            }
        }

        .social-icons a {
            color: rgba(255, 255, 255, 0.6) !important;
            margin-left: 12px;
            transition: 0.3s;
            text-decoration: none;
        }

        .social-icons a:hover {
            color: var(--accent-green) !important;
            transform: translateY(-2px);
        }

        .text-accent-green {
            color: var(--accent-green) !important;
            text-decoration: none;
        }

        .footer-copyright-link {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            transition: color 0.2s ease-in-out;
        }

        .footer-copyright-link:hover {
            color: var(--accent-green);
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <footer class="mt-auto py-2" style="background-color: #111;">
        <div class="container">
            <div class="row align-items-center gy-2">

                <div class="col-md-4 text-start ps-0 me-auto">
                    <h6 class="text-white fw-bold mb-0" style="font-size: 1rem;">DRoP</h6>
                    <p class="text-white-50 small mb-0" style="font-size: 0.75rem; line-height: 1.3;">
                        BRIC-National Institute of Plant Genome Research (NIPGR)<br>
                        Aruna Asaf Ali Marg, New Delhi-110067, India.
                    </p>
                </div>
                <div class="col-md-4 d-flex flex-column align-items-start gap-2">
                    <div class="p-1 px-2 visitor-card rounded-3 w-100" style="max-width: 240px; background: rgba(255,255,255,0.05);">
                        <div class="d-flex align-items-center justify-content-between mb-0">
                            <div>
                                <div class="d-flex align-items-center mb-0">
                                    <span class="pulse-dot"></span>
                                    <p class="mb-0 fw-bold" style="font-size: 0.55rem; color: #888; letter-spacing: 0.5px;">Unique Global Visitors</p>
                                </div>
                                <h5 class="mb-0 fw-bold text-white" id="visitorCount" data-target="<?php echo $visitor_count; ?>" style="font-size: 1.1rem;">0</h5>
                            </div>
                            <i class="fas fa-globe-americas text-success fa-sm"></i>
                        </div>

                        <div class="visitor-details pt-1 mt-1 border-top border-secondary border-opacity-25" style="font-size: 0.6rem; line-height: 1.2;">
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <span style="color: #888;">Your Location:</span>
                                <span class="fw-bold text-success">
                                    <i class="fas fa-map-marker-alt me-1"></i><?php echo htmlspecialchars($current_visitor_country); ?>
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <span style="color: #888;">Session:</span>
                                <span class="text-white fw-bold" id="sessionTimer">00:00</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-white-50 small ps-1">
                        <p class="mb-0" style="font-size: 0.65rem; letter-spacing: 0.3px;">&copy; 2026 BRIC-NIPGR, New Delhi. All rights reserved.</p>
                    </div>
                </div>


                <div class="col-md-4 text-start">
                    <p class="text-white fw-bold small mb-0" style="font-size: 1rem;">Developed & Maintained by</p>
                    <a href="https://nipgr.ac.in/research/dr_skmuthappa.php" target="_blank" class="small fw-bold text-accent-green" style="font-size: 0.75rem;">
                        Plant Stress Biology Lab
                    </a>
                    <div class="mt-1 social-icons" style="margin-left: -12px;">
                        <a href="https://www.facebook.com/profile.php?id=100090964596150" target="_blank" title="Facebook"><i class="fab fa-facebook fa-sm"></i></a>
                        <a href="https://www.youtube.com/channel/UCamQH8rGtNMBvjuyNiSVyCw?view_as=subscriber" target="_blank" title="YouTube"><i class="fab fa-youtube fa-sm"></i></a>
                        <a href="https://twitter.com/SCIPdatabase" title="Twitter/X" target="_blank"><i class="fab fa-x-twitter fa-sm"></i></a>
                        <a href="https://www.researchgate.net/profile/Senthil-Kumar_Muthappa" title="ResearchGate" target="_blank"><i class="fab fa-researchgate fa-sm"></i></a>
                        <a href="https://github.com/scipdatabase" target="_blank" title="GitHub"><i class="fab fa-github fa-sm"></i></a>
                        <a href="https://bsky.app/profile/scipdatabase.bsky.social" target="_blank" title="Bluesky"><i class="fab fa-bluesky fa-sm"></i></a>
                        <a href="https://www.instagram.com/scipdatabase?igsh=MWxueGJvczJqc3cweQ%3D%3D" target="_blank" title="Instagram"><i class="fab fa-instagram fa-sm"></i></a>
                        <a href="https://open.spotify.com/show/5nZXyJZ7nIi7tCtpw9yVyn" target="_blank" title="Spotify"><i class="fab fa-spotify fa-sm"></i></a>
                        <a href="https://www.linkedin.com/in/sk-muthappa-25276b339/" target="_blank" title="Linkedin"><i class="fab fa-linkedin fa-sm"></i></a>
                    </div>
                    <br>
                    <div style="font-size: 0.8rem;">
                        <a href="Images/copyright.pdf" target="_blank" class="footer-copyright-link">
                            <i class="fas fa-copyright me-1"></i>Copyright Terms
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Visitor Count Animation Logic
            const counter = document.getElementById('visitorCount');
            const target = parseInt(counter.getAttribute('data-target')) || 0;

            if (target > 0) {
                let count = 0;
                const speed = 2000;
                const increment = target / (speed / 16);

                const updateCount = () => {
                    count += increment;
                    if (count < target) {
                        counter.innerText = Math.ceil(count);
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            }

            // 2. Client Session Elapsed Timer
            let seconds = 0;
            const timerElement = document.getElementById('sessionTimer');
            setInterval(() => {
                seconds++;
                let mins = Math.floor(seconds / 60);
                let secs = seconds % 60;
                timerElement.innerText =
                    (mins < 10 ? "0" + mins : mins) + ":" +
                    (secs < 10 ? "0" + secs : secs);
            }, 1000);
        });
    </script>

</body>

</html>
