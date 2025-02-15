<!-- footer.html -->
<!-- Footer Section -->


</main>

<footer class="bg-dark text-white text-center  mt-5">
    <!-- Contact Info Section -->
    <div class="container">
        <div class="row">
            <!-- <div class="col-md-8">
                <h5>Primordis.tech</h5>
                <p>Primordis is changing the recharegeable energy landscape with autonomous energy intelligence</p>
            </div> -->
            <!-- <div class="col-md-3">
                <h5>Contact Information</h5>
                <ul class="list-unstyled">
                    <li><strong>Address:</strong> 10 J-Avenue, near white house, Global city, Indiana, USA </li>
                    <li><strong>Email:</strong> <a href="mailto:info@primordis.tech" class="text-white">info@primordis.tech</a></li>
                    <li><strong>Phone:</strong> +1 (123) 456-7890</li>
                </ul>
            </div> -->
            <div class="col-md-12">
                <h5>Quick Links</h5>
                <a href="<?php echo site_url('home/privacy'); ?>" class="text-white" style="text-decoration: none;">Privacy Policy</a> | 
                <a href="<?php echo site_url('home/terns_conditions'); ?>" class="text-white" style="text-decoration: none;">Terms & Conditions</a> 
                <!-- <a href="<?php //echo site_url('home/faq'); ?>" class="text-white" style="text-decoration: none;">FAQ</a> -->
                
                <ul class="list-unstyled"> 
                    <!-- <li><a href="<?php echo site_url(); ?>" class="text-white" style="text-decoration: none;">Home</a></li> -->
                    <!-- <li><a href="<?php echo site_url(); ?>#services" class="text-white" style="text-decoration: none;">Services</a></li>
                    <li><a href="<?php echo site_url(); ?>#about" class="text-white" style="text-decoration: none;">About Us</a></li>
                    <li><a href="<?php echo site_url(); ?>#contact" class="text-white" style="text-decoration: none;">Contact Us</a></li> -->
                    <!-- <li><a href="<?php echo site_url('home/privacy'); ?>" class="text-white" style="text-decoration: none;">Privacy Policy</a></li>
                    <li><a href="<?php echo site_url('home/terns_conditions'); ?>" class="text-white" style="text-decoration: none;">Terms & Conditions</a></li> -->
                </ul>
            </div>
            <!-- <div class="col-md-3">
                <h5>Follow Us</h5>
                <a href="https://twitter.com" class="text-white me-3" target="_blank">X</a> <br>
                <a href="https://facebook.com" class="text-white me-3" target="_blank">Facebook</a> <br>
                <a href="https://linkedin.com" class="text-white me-3" target="_blank">Linkedin</a> <br>
                <a href="https://instagram.com" class="text-white" target="_blank">Instagram</a> <br>
            </div> -->
        </div>
    </div>

    <!-- Footer Bottom Section -->
    <div class="container ">
        <p>&copy; <?= date('Y') ?> Primordis.tech. All rights reserved.</p>
    </div>
</footer>




<div id="cookieConsent" style="display: none; position: fixed; bottom: 0; width: 100%; background: #333; color: white; padding: 15px; text-align: center; z-index: 9999;" >
    This website uses cookies to ensure you get the best experience on our website.
    <a href="privacy-policy" style="color: #4CAF50;">Learn More</a>
    <button id="acceptCookies" style="background:rgb(22, 163, 228); color: white; border: none; padding: 10px 20px; margin-left: 10px; cursor: pointer;">
        Accept
    </button>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Check if cookie consent is already given

    console.log(getCookie('cookieConsent'));
    if (!getCookie('cookieConsent')) {
        document.getElementById('cookieConsent').style.display = 'block'; // Show consent banner
    }

    // Accept cookies when the button is clicked
    document.getElementById('acceptCookies').addEventListener('click', function () {
        setCookie('cookieConsent', 'accepted', 365); // Set cookie for 365 days
        document.getElementById('cookieConsent').style.display = 'none'; // Hide the consent banner
    });

    // Function to set a cookie
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // Set expiration time
            expires = "; expires=" + date.toUTCString();
        }
        // Ensure the cookie is accessible across all pages of the website
        document.cookie = name + "=" + value + expires + "; path=/; SameSite=Lax"; // Set SameSite=Lax for better cookie handling
    }

    // Function to get a cookie
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length); // Trim spaces
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length); // Return cookie value
        }
        return null; // Cookie not found
    }
});
</script>




<!-- Include jQuery, Bootstrap, and Animate.js Scripts -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script> -->


<!-- Link to Local JavaScript -->
<!-- 
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-3.5.1.slim.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script> -->

 

<!-- Back to Top Functionality -->
<script>
    // Show back-to-top button when scrolling
    // $(window).scroll(function() {
    //     if ($(this).scrollTop() > 200) {
    //         $('#backToTop').fadeIn();
    //     } else {
    //         $('#backToTop').fadeOut();
    //     }
    // });

    // // Scroll to the top when the button is clicked
    // $('#backToTop').click(function() {
    //     $('html, body').animate({ scrollTop: 0 }, 500);
    //     return false;
    // });
</script>

</body>
</html>
