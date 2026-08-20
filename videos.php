<?php 
include 'counter_logic.php';
include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Video Resources</title>

    <style>
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

        /* Video Card Styling */
        .video-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            border: none;
        }

        .video-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(25, 135, 84, 0.15);
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .video-body {
            padding: 20px;
        }

        .video-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #0d6efd;
            line-height: 1.4;
            margin-bottom: 0;
        }

        /* Channel Section */
        .channel-cta {
            background: white;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            border: 2px dashed #198754;
            margin-top: 60px;
        }

        .btn-youtube {
            background-color: #FF0000;
            color: #198754;
            border-radius: 50px;
            padding: 12px 35px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-youtube:hover {
            background-color: #cc0000;
            color: #198754;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(255, 0, 0, 0.3);
        }
    </style>
</head>

<body>

    <section class="ack-section">
        <div class="container-fluid my-5">
            <div class="ack-header bg-primary bg-opacity-10 py-3 mb-5 rounded-3">
                <h2 class="text-primary display-4 text-center mb-0">
                    <i class="me-3"></i>Video Resources
                </h2>
                <p class="lead opacity-95 text-muted text-center mx-auto">
                    A curated list of videos focusing on the impact of Dry root rot
                    (<em>Macrophomina phasolina</em>) and its interaction with drought stress.
                </p>
            </div>

            <div class="container-fluid mt-5 mb-5">
                <div class="row g-4" id="videoGrid">
                    <div class="col-lg-6 video-item">
                        <div class="video-card animate__animated animate__fadeIn">
                            <div class="video-container">
                                <iframe class="yt-video" src="https://www.youtube.com/embed/4eK92FX7_Z4?enablejsapi=1" title="Tutorial 1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <div class="video-body">
                                <h5 class="video-title">Video 1: Effect of drought stress on pathogen incidence in chickpea</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 video-item">
                        <div class="video-card animate__animated animate__fadeIn">
                            <div class="video-container">
                                <iframe class="yt-video" src="https://www.youtube.com/embed/k6VDtwEnKiQ?enablejsapi=1" title="Tutorial 2" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <div class="video-body">
                                <h5 class="video-title">Video 2: Effects of water deficit crisis on dry root rot</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 video-item">
                        <div class="video-card">
                            <div class="video-container">
                                <iframe class="yt-video" src="https://www.youtube.com/embed/zZ4VyD4w-kU?enablejsapi=1" title="Tutorial 3" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <div class="video-body">
                                <h5 class="video-title">Video 3: Occurrence of dry root rot in Andhra Pradesh, India</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 video-item">
                        <div class="video-card">
                            <div class="video-container">
                                <iframe class="yt-video" src="https://www.youtube.com/embed/2-XclGrKccg?enablejsapi=1" title="Tutorial 4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <div class="video-body">
                                <h5 class="video-title">Video 4: Water scarcity in soil increases the risk of fungal root rot</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 video-item">
                        <div class="video-card">
                            <div class="video-container">
                                <iframe class="yt-video" src="https://www.youtube.com/embed/T2WRaXh9Sl0?enablejsapi=1" title="Tutorial 5" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <div class="video-body">
                                <h5 class="video-title">Video 5: Combined stresses "Dry Root Rot of Chickpea"</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 video-item">
                        <div class="video-card">
                            <div class="video-container">
                                <iframe class="yt-video" src="https://www.youtube.com/embed/nZxv4QEADoU?enablejsapi=1" title="Tutorial 6" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <div class="video-body">
                                <h5 class="video-title">Video 6: Rhizoctonia bataticola: the causal agent of dry root rot</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 video-item">
                        <div class="video-card">
                            <div class="video-container">
                                <iframe class="yt-video" src="https://www.youtube.com/embed/vc_N7k2Yy50?enablejsapi=1" title="Tutorial 7" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <div class="video-body">
                                <h5 class="video-title">Video 7: Dry root rot disease and drought stress in chickpea</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 video-item">
                        <div class="video-card">
                            <div class="video-container">
                                <iframe class="yt-video" src="https://www.youtube.com/embed/5sIquTu3qy4?enablejsapi=1" title="Tutorial 8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <div class="video-body">
                                <h5 class="video-title">Video 8: Artificial Neural Network-Based Applications in Agriculture</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 video-item">
                        <div class="video-card">
                            <div class="video-container">
                                <iframe class="yt-video" src="https://www.youtube.com/embed/jBh4TN0oYi4?enablejsapi=1" title="Tutorial 9" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <div class="video-body">
                                <h5 class="video-title">Video 9: Impact of dry root rot on chickpea production</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 video-item">
                        <div class="video-card">
                            <div class="video-container">
                                <iframe class="yt-video" src="https://www.youtube.com/embed/GPxfT9gspS0?enablejsapi=1" title="Tutorial 10" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <div class="video-body">
                                <h5 class="video-title">Video 10: A Pursuit for Climate Resilient Crops</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="channel-cta">
                    <h2 class="fw-bold mb-3">Explore More Insights</h2>
                    <p class="text-muted mb-4">Subscribe to our channel for the latest updates on plant stress research.</p>
                    <a href="https://www.youtube.com/channel/UCamQH8rGtNMBvjuyNiSVyCw" target="_blank" class="btn btn-success btn-lg shadow-sm">
                        Visit Our YouTube Channel
                    </a>
                </div>
            </div>
        </section>
        <?php include 'footer.php'; ?>
        <script src="https://www.youtube.com/iframe_api"></script>
		<script>
		    let players = [];

		    function onYouTubeIframeAPIReady() {
		        const iframes = document.querySelectorAll('.yt-video');

		        iframes.forEach((iframe, index) => {
		            players[index] = new YT.Player(iframe, {
		                events: {
		                    'onStateChange': onPlayerStateChange
		                }
		            });
		        });
		    }

		    function onPlayerStateChange(event) {
		        if (event.data === YT.PlayerState.PLAYING) {
		            players.forEach(player => {
		                if (player !== event.target) {
		                    player.pauseVideo();
		                }
		            });
		        }
		    }
		</script>
</body>

</html>
