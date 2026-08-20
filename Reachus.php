<?php
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reach Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        .section-intro {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 3rem;
            padding: 0 20px;
        }

        .section-intro h1 {
            color: var(--primary-green);
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .section-intro .lead {
            color: var(--text-muted);
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .contact-wrapper {
            display: flex;
            flex-wrap: wrap;
            max-width: 1100px;
            margin: 0 auto;
            gap: 2rem;
            padding: 20px;
        }

        /* Left Side Profile Card */
        .contact-left {
            flex: 1;
            min-width: 300px;
            background: var(--bg-light);
            padding: 2.5rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-top: 5px solid var(--primary-green);
        }

        .contact-left img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .contact-left h2 {
            color: var(--primary-green);
            margin: 0.5rem 0;
            font-size: 1.4rem;
        }

        .contact-left .designation {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .info-row {
            margin: 10px 0;
            font-size: 0.95rem;
            color: var(--text-muted);
        }

        /* Right Side Form */
        .contact-right {
            flex: 1.5;
            min-width: 300px;
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border: 1px solid #E5E7EB;
        }

        .contact-right label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .contact-right label.required::after {
            content: " *";
            color: #DC2626;
        }

        .contact-right input,
        .contact-right textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .contact-right input:focus,
        .contact-right textarea:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(6, 95, 70, 0.1);
        }

        .contact-right button {
            background-color: var(--primary-green);
            color: black;
            padding: 14px 28px;
            /* border: none; */
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            width: 100%;
            transition: transform 0.2s, background 0.3s;
        }

        .contact-right button:hover {
            background-color: #057c5c;
            transform: translateY(-2px);
        }
    </Style>
</head>

<section class="ack-section">
    <div class="container-fluid">
        <div class="ack-header bg-primary bg-opacity-10 py-2 mb-4 rounded-3 text-center">
            <h2 class="text-primary display-5 mb-2">
                <i class="me-5"></i>Reach us
            </h2>
            <p class="lead text-muted mx-auto" style="max-width: 700px;">
                Have questions about the DRR portal? Reach out to our lead researcher or use the form below to support your studies.
            </p>
        </div>

        <div class="contact-wrapper">
            <div class="contact-left">
                <img src="Images/SKM.png" alt="Dr. Senthil Kumar Muthappa">
                <h2>Dr. Muthappa Senthil-Kumar </h2>
                <p class="designation">Scientist</p>

                <div class="info-row">
                    <i class="fa-solid fa-envelope me-2 text-primary"></i>
                    <strong>Email:</strong><br>
                    <a href="mailto:skmuthappa@nipgr.ac.in">scipdatabase@nipgr.ac.in</a>
                </div>
                <div class="info-row">
                    <i class="fa-solid fa-phone me-2 text-primary"></i>
                    <strong>Phone:</strong><br>
                    <span>Phone - +91-11-26735229, Fax - 26741658</span>
                </div>
                <div class="info-row">
                    <i class="fa-solid fa-location-dot me-2 text-primary"></i>
                    <strong>Location:</strong><br>
                    <small>NIPGR, New Delhi, India</small>
                </div>
            </div>

            <form action="https://formspree.io/f/mdklvgyp" method="POST" class="contact-right">
                <div class="mb-3">
                    <label for="name" class="required">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="required">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="email@university.edu" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="required">How can we help?</label>
                    <textarea id="message" name="message" rows="5" placeholder="Inquire about datasets, collaboration, or technical support..." required></textarea>
                </div>

                <button type="submit">
                    <i class="fa-solid fa-paper-plane me-2"></i>Send Message
                </button>
            </form>
        </div>
    </div>
</section>

<script>
    const scrollBtn = document.getElementById("scrollTopBtn");

    window.onscroll = function() {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            scrollBtn.style.display = "block";
        } else {
            scrollBtn.style.display = "none";
        }
    };

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>
<?php include 'footer.php'; ?>
</body>

</html>
