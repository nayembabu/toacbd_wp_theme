 
        <footer>
            <section class="footerSec1">
                <div class="FooterTopImg"></div>
            </section>
            <section class="footerSec2">
                <div class="footerMenu row container mx-auto bg-none">
                    <div class="col-12 col-md-3 bg-none footerMenuContent">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Member Directory</a></li>
                            <li><a href="#">News & Blog</a></li>
                            <li><a href="#">Photo & Video Gallery</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-3 bg-none footerMenuContent">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">Support</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-3 bg-none footerMenuContent">
                        <h4>About TOAC</h4>
                        <ul>
                            <li><a href="#">Our Mission</a></li>
                            <li><a href="#">Our Vision</a></li>
                            <li><a href="#">Our Team</a></li>
                            <li><a href="#">Contact Information</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-3 facebookPagePreview">
                        <div class="fb-page" data-href="https://www.facebook.com/toacorg" data-tabs="timeline" data-width="" data-height="320" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/toacorg" class="fb-xfbml-parse-ignore">
                                <a href="https://www.facebook.com/toacorg">TOAC Secretariat</a>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </section>
            <section class="footerSec3">
                <div class="footerBottom row container mx-auto">
                    <div class="col-md-6 footerBottomLeft d-flex align-items-center justify-content-center">
                        <p>© 2025 TOAC. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 footerBottomRight d-flex align-items-center justify-content-center">
                        <p>Developed by <a href="https://devtarak.github.io/" target="_blank" style="text-decoration: none; color: white;">Allion Coders</a></p>
                    </div>
                </div>
            </section>
        </footer>
        <script src="<?php echo get_template_directory_uri(); ?>/assest/custom_js/script.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/assest/bt/js/bootstrap.bundle.min.js" ></script>


        <script>
                     
            $(document).ready(function() {
                // যখন ইউজার ছবি আপলোড করবে
                $("#post_image").change(function(event) {
                    // FileReader ব্যবহার করে ছবির প্রিভিউ দেখানো
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                        // প্রিভিউ ছবি সেট করুন
                        $("#previewImage").attr("src", e.target.result);
                        $("#imagePreviewContainer").show(); // প্রিভিউ কনটেইনারটি দেখান
                    }
                    
                    // ছবির ফাইল রিড করুন
                    reader.readAsDataURL(this.files[0]);
                });
            });
        </script>




        <?php wp_footer(); ?>
    </body>
</html>

