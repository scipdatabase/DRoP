<?php
include 'counter_logic.php';
include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Funding & Acknowledgement</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="styles.css">
<!--        <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=OabXHS8gl7H6EwEOLiRHQQE4IUCYSRWS4Jq8Z3hT_vWCHtNqnqVRnTCX22f3G4rUMmba0pH8b3fP4d29RbroXhipTclP8gMdv2JbXdL-aU7PZsOj_RUmThfz7mEyIIsJcvNkNS4Sy8TIonpxkvqVrYhdslYWSYYJCy7P5i1BrmxNtqe4Lmn-gf6s_a1CsCznY9x9bHWE8Yn4CU1n4nNGAKmntdp-jnAzmumudtBsmsl93ZxRSiua8aN00vQDOmHvV3wzs_yB7qCjmvOlAv4CiETU0f6GQFXXO3JezUfW0dxr-BCopHjv43jbiajsNpDg89n7jCeD_08Whv1kv8kOEguvgXKtc_rFRuGwzEBBbOp7CmxGIt-7aEvNCZAJHtFDxAO4OJJTj6xZPFpEnlOv-Ry9ta-l-lP6zWXexffWVgKzlbGsY_BrvcvJDGpAe4_HWLwtP6U576IHlKmdO_WLIhMY-VZGOZwp91g9ocR2sOflK4xofyOF-zN7Bj1YKTh6L9ZZzENSEfj8PpFsOlJCLEymlhk60sZguxb8p42ICAUPqpRfz-7j5QrLv_2BSHkHwpQL1AeoNmdhsUd_m_ZpDPZK6r9YGjVg2Kjc3TwnMAaEgtdRaLpfIxjsACLV7NKvUF3J2Ty8lco5rHy-swjb3lQ1GJ5g3f41AymlGbfoNCqeX_CA3JqRWjtkpPAhu0eW-kVTOp_0nCZoQY43Ic9YPfoYVJ5AVuYx5rYmD0jlPNPjHr7jCaRc_lOQbtK5FQyG3Q7O5BzAgamdxe0aqDjgrcDVl7oAw_4yAhwhIeTN8cEGbantMrTzP8r-oARsKMlA-Lll1qCCax4GT8XyS08V1_P3vs--TyYiijwHT7OAznCoUOidm1cVE81AaRE3chshpNZxXhmsrDuxJyrNL7LMolQbdUtDUwdWsLREUh69I2U_zgD1DQUPKHqQexP6WrcFSR3NU7YPD0lY0E8l-0HFx4Fr9UgTkSBCJ7j7GQG3NBuQhIiRRdArBE1uFVoqfFnmFaSxMhNeDrx5S6xE663uMy__uUgP8kg2PvHpm2J69rq6w5c9YIGIQ4_3Uu6Oy5HQG4b9WDh8oPz09EUSDE48qerNjFm7mwEFu9iH-IMFxk2f4PzIR7NCyw3aVNXD7OJEG41ISwNWWXkCrY0kUy4hEiQ_5BIk-BVDIeeWARDlxIpF--aJJO6VjTI7qSkD1uQ9nc_GUvh2Q7XNX0Wv9dM6aIUQfWKZMsvGf7AmyjTv07NT9t2PKSyiG1XhVZ780pewUuVS8Amq5RbVTFJIKm-NCt2HON23-WkyvwUcsY7aNTThcHpF4E1Ba30uH0Fttm_mXwQfsG6sEFahLiewYUSeFu4LzNxO92EftasHFm6k8jONdYE_tGqnEfLOreHavhYtZhksMfXmc4FqoXDMwJVnR8iaf2M8GCDYN6UaWBJnScFMYmvVHy0r78ghJ_cnrQSW2EyrL_fJ-5gEhgnGrOUE7U7eEtNkud5qCg9umh1S1HKbZ3rUnJ7_6DmPb3iDtlZGFCgbLtkaaO3gYyNNyQboSiLovsv1TI_lClFYVs5tZu40FkxWt9ORGXZXaOwI7xP9c6JCJBc9Cb6afw9pi9WcbwYCytAFiS1Q1xLBABfwT5IQch2chlEI5AcyL6idb89qj1WR7SAhjGWJc4BbD3h-ducB5hxZkR2M6mGbENCHRByCCz2uE9nRR-b0fiPUq40sUZkVhBREV3FaF8hf7v05og" nonce="9b53d6cffafd52e0670b1c189974ff46" charset="UTF-8"></script>
        <link rel="stylesheet" crossorigin="anonymous" href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly9tYWlsLWF0dGFjaG1lbnQuZ29vZ2xldXNlcmNvbnRlbnQuY29tL2F0dGFjaG1lbnQvdS8wLz91aT0yJmlrPThjMDJiOWE0ZjcmYXR0aWQ9MC4yJnBlcm1tc2dpZD1tc2ctZjoxODU0NjcyMTczOTU4NzgxNzgzJnRoPTE5YmQxZTg0MDc5ZDViNTcmdmlldz1hdHQmZGlzcD1zYWZlJnJlYWxhdHRpZD1mX21ra3F5czd1MSZ6dyZzYWRkYmF0PUFOR2pkSl9PMHB4MTR5ektLRHdTY010clNpVmM3NWxzMlRoNS1sbk9wa1BnTktZSGh3TmVDTVZMamRzclZYdWJuWDJma1ZFaGJyRjhyYlFFcGRteDV3UkZUdmFZOEQ2ZmpYcVJyMF8yRGtJMlRnR3lwdU5iQXdZWVdLdlI3X1FYclVEMUhZeXAycGJUY1hXaDNrbkMwbkFGOHZmLVZxUHJWRnUtdnVOblpQWlFSWXNvdjRXZjZGQzZVVk95U09CZWtuN2ppSUFWbEk3QTdfeHBMTnNqYXNvSXF0TWNHLXhWRVZ1MmxtQU9EazhSaTFLNkd1d29NT1ZSUHN3MUh1endpTV8wbFBxUDRNWm1rT2xwZzlQZ0lvQ3g3Z0hlQi1aemZ0ZkRTU2xmMzVPTU9ZZk9zemZhd0F5RUpIZ2ZrMm5kdmpnVXJHWXRTYk84YUJBQzFvd3JnSTJHbGhUZm5EbDJVQkpQWk5FNVdoZXZqN042LXlSaHk2d0N5MUVsSlVQUTdyUV9BYU9jOEhlT1lndFphZl9abmpiTUp1Wk9tTjdFT0QtTGhuV3BIYUF3NjFjemtnaDFoeVBLVzZkSlAxOVd0WXNjY2VTeElOWDBFTDlscWRtbDZDN256dFRIRW1SNWRDX0plM1dTTnl6WDVxVjE1Zzg4ODk4YXV4TmNWUnpTRExzWGo5Wkl5c3QtRmR0RHhKZFFYdDJsUUJrbF9HWTVnOXJZNE9KWnR2S1gtb1RWUWdOdmNvUmNRa244WmdOOWNIb3JkR2VhMTBaZWFNUWQ5QXZEUmIxZ3NPeEFBNlVFekE4MHRRdUxqR2pDR3ZZbDhneVB6QjlaLVBjM0QwdEswaWoyd003V0JTMDREMkFxbU9kVjJ2VzNudnNxTGhXdGg2YzR3R25vLU9ybW9LUUl5TGpyUVJwZnI3LWVFWmd2eUhlWTdvT3JzT2tHSHV0MGwtbnRsdUQ0bUJQZk9CZjVEWGtfanBjbVpGSlNVX3cwTkFrV3R0RjAxa0dVdzNGR1pHQmI1N09WWERHbzlja0x4bHBaWkh3QV9xV3RaN0tLR1ZFbGlDQkxyYUZKTlJzOEI4LUswU2NWVTFMQ19NNTh5UWJxaDUwNFVSWDcwTlpjU1hjX0RQZ0NqM3ZOVTdNWTBQYS1DYjIxbnl2RUpYaFZXQ3dJSlUwZHFuQ3ptYUNTY3hMczNqa21sN0dHYmcwOEt3TldZN2RmS1FqNVJ1TjQ4WU5SQ29UM1Ffb3ktaFZJTnhOYXlqMUdiMS12U0FlR180RGxzMmU3LUpIWDB5cEdveVFwdjhpaXNOZlp5Y1hEbnZxVHllREpqTmhYMmVMMnRUSzJoYVJnS2RrTGgwbFk2aTlfVXBOUmdpeTNseDFGVWZhVTNEZkI3Y003cThpYjFGSlh4MzhhYkN3bXhmcEpEV3BfbUpielVaWURHWmM" /> -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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

            /* Interactive Funding Box */
            .funding-box {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(10px);
                border-left: 8px solid var(--primary-green);
                padding: 2rem;
                margin-bottom: 3rem;
                border-radius: 15px;
                box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
            }

            .funding-box:hover {
                border-left-width: 15px;
                background: rgba(255, 255, 255, 0.9);
            }

            /* Modern Card Styling */
            .ack-card {
                border: none;
                border-radius: 20px;
                background: #fff;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
                height: 100%;
            }

            .ack-card:hover {
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            }

            .card-title-bar {
                padding: 1.2rem;
                text-align: center;
                font-weight: bold;
                text-transform: uppercase;
                letter-spacing: 2px;
                border-radius: 20px 20px 0 0;
            }

            .scientist-bg {
                background: linear-gradient(45deg, #D2C9A5, #e5ddc0);
                color: #4b4532;
            }

            .member-bg {
                background: linear-gradient(45deg, #b5dac4, #c0eedf);
                color: #2c3e50;
            }

            .people-bg {
                background: linear-gradient(45deg, #a19ca1, #c9b0c9);
                color: #4b454a;
            }

            .name-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .name-list li {
                padding: 10px;
                border-radius: 8px;
                cursor: default;
            }

            .name-list li:hover {
                background: #f0f4ff;
                color: #0026FF;
            }

            .institute-tag {
                color: #6B7280;
                font-size: 0.85rem;
                display: block;
            }
        </style>
    </head>

    <body>
        <section class="ack-section">
            <div class="container-fluid">
                <div class="ack-header bg-primary bg-opacity-10 py-3 mb-5 rounded-3">
                    <h2 class="text-primary display-4 text-center mb-0">
                        <i class="me-3"></i>Funding and Acknowledgement
                    </h2>
                </div>

                <div class="funding-box">
                    <p style="font-family: 'Cambria', serif; font-size: 1.2rem; line-height: 1.6; margin-bottom: 0;">
                        <strong><i class="fas fa-hand-holding-usd me-2 text-success"></i>Financial support:</strong>
                        We acknowledge the financial support provided by the
                        <span class="text-success fw-bold">BRIC-NIPGR</span> core fund.
                        <span class="text-success fw-bold">Anusandhan National Research Foundation (ANRF) </span> for fellowships.
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-12" data-aos="fade-right">
                        <div class="ack-card">
                            <div class="card-title-bar people-bg">Acknowlegement</div>
                            <p class="lead" style="max-width: 1200px; margin: auto;">
                                We sincerely acknowledge the following scientists and researchers for their invaluable contributions for the contribution at various stages of DRR research with our team.</p>
                            <br>
                            <div class="row g-4">
                                <div class="col-md-6" data-aos="fade-right">
                                    <div class="ack-card">
                                        <div class="card-title-bar scientist-bg">Scientists</div>
                                        <div class="card-content p-4">
                                            <ul class="name-list">
                                                <li>
                                                    <strong>Dr. Basavanagouda Siddanagouda Patil</strong>
                                                    <span class="institute-tag">Incharge and Principal Scientist, IARI, Regional Research Center, Dharwad, Karnataka, India</span>
                                                </li>
                                                <li>
                                                    <strong>Dr. Ram Phool Ghasolia</strong>
                                                    <span class="institute-tag">Associate Professor, Department of Pathology, SKN College of Agriculture, Sri Karan Narendra Agriculture University Jobner, Jaipur, India</span>
                                                </li>
                                                <li>
                                                    <strong>Dr. Venkategowda Ramegowda</strong>
                                                    <span class="institute-tag">Department of Crop Physiology, College of Agriculture, University of Agricultural Sciences, GKVK, Bengaluru, India</span>
                                                </li>
                                                <li>
                                                    <strong>Prof. Sevugapperumal Nakkeeran</strong>
                                                    <span class="institute-tag">CPMB-B, Tamil Nadu Agricultural University, Coimbatore, India</span>
                                                </li>
                                                <li>
                                                    <strong>Dr. Krishnappa Rangappa</strong>
                                                    <span class="institute-tag">Scientist, Division of Crop Sciences, ICAR-NEH region, Umroi, Road, Umiam, Meghalaya, India</span>
                                                </li>
                                                <li>
                                                    <strong>Prof. MuthuKumar Bagavathiannan</strong>
                                                    <span class="institute-tag">Professor, Department of Soil and Crop Sciences, TAMU, India</span>
                                                </li>
                                                <li>
                                                    <strong>Dr. Krishnappa Rangappa</strong>
                                                    <span class="institute-tag">Scientist, Division of Crop Sciences, ICAR-NEH region, Umroi, Road, Umiam, Meghalaya, India</span>
                                                </li>
                                                <li>
                                                    <strong>Dr. Ayam Gangarani Devi</strong>
                                                    <span class="institute-tag">Senior Scientist (Plant Physiology) ICAR RC for NEH Region, Manipur Center, Lamphelpat, Imphal West-795004</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" data-aos="fade-left">
                                    <div class="ack-card">
                                        <div class="card-title-bar member-bg">Lab Members & Alumni</div>
                                        <div class="card-content p-4">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <ul class="name-list">
                                                        <li>Mr. Aswin Reddy Chilakala <span class="institute-tag">PhD Scholar</span></li>
                                                        <li>Mr. Rishabh Mirchanandani <span class="institute-tag">PhD Scholar</span></li>
                                                        <li>Mr. Shubhashish Ranjan<span class="institute-tag">PhD Scholar</span></li>
                                                        <li>Mr. Dulla Sandeep <span class="institute-tag">Senior Research Fellow</span></li>
                                                    </ul>
                                                </div>
                                                <div class="col-sm-6">
                                                    <ul class="name-list">
                                                        <li>Dr. Ranjita Sinha <span class="institute-tag">Post-doctoral researcher - Lab alumni</span></li>
                                                        <li>Mr. Vishnu S Babu <span class="institute-tag">Junior Reseach Fellow - Lab alumni</span></li>
                                                        <li>Dr. Vadivel Murugan Irulappan <span class="institute-tag">PhD Scholar - Lab alumni</span></li>
                                                        <li>Dr. Komal Vithalrao Mali <span class="institute-tag">PhD Scholar - Lab alumni</span></li>
                                                        <li>Dr. Avanish Rai <span class="institute-tag">RA - Lab alumni</span></li>
                                                        <li>Dr. Prachi Pandey <span class="institute-tag">RA - Lab alumni</span></li>
                                                    </ul>
                                                </div>

                                            </div>
                                            <p class="text-center mt-4 text-muted small border-top pt-2">BRIC-NIPGR, New Delhi, India</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 1000,
                once: true
            });
        </script> 
        <?php include 'footer.php'; ?>
    </body>

</html>