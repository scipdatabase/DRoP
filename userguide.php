<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <style>
        .pdf {width: 100%; aspect-ratio: 4/3 ; height: auto; display: block;}
        .tsearch {font-family: 'Times New Roman', Cambria, Cochin, Georgia, Times, serif; position: absolute; left: 50%; transform: translate(-50%, -0%); padding: 40px; width: 100%; max-width: 1100px; /* Adjust as needed */ border-radius: 50px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);}
        #myBtn { display: none; position: fixed; bottom: 15px; right: 30px; z-index: 99; font-size: 18px;
        border: none; outline: none; background-color:rgb(41, 216, 216); color: white; cursor: pointer; padding: 15px;
        border-radius: 4px; }

        #myBtn:hover { background-color: rgb(6, 240, 111); }
    </style>
    <body>
        <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
                <h2><strong><center>User guide</center></strong></h2><hr>
                <iframe class="pdf" 
                    src="../DROP/documents/userguide.pdf#toolbar=0&navpanes=0&scrollbar=0&view=FitH" 
                    width="100%" 
                    height="500px" 
                    style="border:none;">
                </iframe>
        <div><?php include 'footer.php'; ?></div> 
        <script>
            // Get the button
            let mybutton = document.getElementById("myBtn");

            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                } else {
                    mybutton.style.display = "none";
                }
            }

            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>

    </body>
</html>
