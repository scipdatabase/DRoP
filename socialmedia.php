   <?php
    include 'counter_logic.php';
    include 'header.php'; ?>
   <!DOCTYPE html>
   <html lang="en">

   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Social Media</title>
       <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
       <style>
           :root {
               --facebook-blue: #1877F2;
               --twitter-black: #01090e;
               --youtube-red: #FF0000;
               --researchgate-green: #00ccbb;
               --scoopit-orange: #f3aa1e;
               --glass-bg: rgba(255, 255, 255, 0.8);
           }

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

           /* Interactive Icon Grid */
           .icon-grid {
               display: grid;
               grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
               gap: 25px;
               margin: 50px 0;
           }

           .social-item {
               transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
               text-decoration: none;
               display: flex;
               flex-direction: column;
               align-items: center;
               padding: 20px;
               background: white;
               border-radius: 16px;
               box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
               color: #636e72;
           }

           .social-item i {
               font-size: 2.8rem;
               margin-bottom: 12px;
               transition: color 0.3s ease;
           }

           .social-item small {
               font-weight: 600;
               text-transform: uppercase;
               font-size: 0.75rem;
               letter-spacing: 0.5px;
           }

           /* Hover States with Brand Colors */
           .social-item:hover {
               transform: translateY(-10px);
               box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
           }

           .social-item:hover .fa-facebook-square {
               color: var(--facebook-blue);
           }

           .social-item:hover .fa-x-twitter {
               color: var(--twitter-black);
           }

           .social-item:hover .fa-youtube {
               color: var(--youtube-red);
           }

           .social-item:hover .fa-researchgate {
               color: var(--researchgate-green);
           }

           .social-item:hover .fa-share-alt {
               color: var(--scoopit-orange);
           }

           /* Podcast Section - Glassmorphism */
           .podcast-card {
               background: var(--glass-bg);
               backdrop-filter: blur(10px);
               border-radius: 24px;
               padding: 40px;
               border: 1px solid rgba(255, 255, 255, 0.3);
               box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
               margin-top: 50px;
           }

           .podcast-card h4 {
               font-weight: 700;
               color: #2d3436;
           }

           .platform-logos {
               display: flex;
               justify-content: center;
               align-items: center;
               gap: 40px;
               flex-wrap: wrap;
           }

           .platform-logos img {
               height: 45px;
               transition: all 0.3s ease;
               opacity: 0.7;
           }

           .platform-logos a:hover img {
               opacity: 1;
               transform: scale(1.1);
           }

           .sc-embed-container {
               border-radius: 15px;
               overflow: hidden;
               box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
           }
       </style>

       <section class="ack-section">
           <div class="container-fluid">
               <div class="ack-header bg-primary bg-opacity-10 py-3 mb-5 rounded-3">
                   <h2 class="text-primary display-4 text-center mb-0">Connect With Our Research Community</h2>
                   <p class="lead text-center">Connect with us on Social Media platform</p>
               </div>
               <div class="container">
                   <div class="icon-grid">
                       <a href="https://www.facebook.com/profile.php?id=100090964596150" target="_blank" class="social-item">
                           <i class="fab fa-facebook-square"></i>
                           <small>Facebook</small>
                       </a>
                       <a href="https://twitter.com/SCIPdatabase" target="_blank" class="social-item">
                           <i class="fab fa-x-twitter"></i>
                           <small>Twitter</small>
                       </a>
                       <a href="https://www.youtube.com/channel/UCamQH8rGtNMBvjuyNiSVyCw?view_as=subscriber" target="_blank" class="social-item">
                           <i class="fab fa-youtube"></i>
                           <small>YouTube</small>
                       </a>
                       <a href="https://www.researchgate.net/profile/Senthil-Kumar_Muthappa" target="_blank" class="social-item">
                           <i class="fab fa-researchgate"></i>
                           <small>ResearchGate</small>
                       </a>
                       <a href="https://www.scoop.it/u/scipdatabase" target="_blank" class="social-item">
                           <i class="fas fa-share-alt"></i>
                           <small>Scoop.it</small>
                       </a>
                   </div>

                   <div class="podcast-card">
                       <div class="row align-items-center">
                           <div class="col-lg-12">
                               <h4 class="text-center mb-4">
                                   <i class="fas fa-microphone-alt text-danger me-2"></i>
                                   Latest Audio Insights
                               </h4>

                               <div class="sc-embed-container">
                                   <iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay"
                                       src="https://w.soundcloud.com/player/?url=https%3A//soundcloud.com/skm-lab/dry-root-rot-disease-in-chickpea-plant-biology-students-perspective-hindi-translation&color=%231877F2&auto_play=false&hide_related=true&show_comments=false&show_user=true&show_reposts=false&show_teaser=false">
                                   </iframe>
                               </div>

                               <div class="mt-5 text-center">
                                   <h6 class="text-uppercase mb-4" style="font-size: 0.75rem; letter-spacing: 2px; color: #a4b0be;">
                                       Available on all major platforms
                                   </h6>
                                   <div class="platform-logos">
                                       <a href="https://open.spotify.com/show/5nZXyJZ7nIi7tCtpw9yVyn" title="Listen on Spotify">
                                           <img src="https://upload.wikimedia.org/wikipedia/commons/2/26/Spotify_logo_with_text.svg" alt="Spotify">
                                       </a>
                                       <a href="https://podcasts.google.com/?q=skmlab_podcasts" title="Listen on Google Podcasts">
					<i class="fas fa-podcast"></i> 					
					<small>Google Podcast</small>                                          
                                       </a>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
       </section>
       <?php include 'footer.php'; ?>
       </body>

   </html>
