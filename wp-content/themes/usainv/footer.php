<?php $theme_url = get_stylesheet_directory_uri(); ?>

<footer class="no-margin-top">
    <div class="container">
        <div class="d-flex">
            <?php /* ?>
            <div class="col">
                <ul class="list-unstyled">
                    <li class="group-header">Business</li>
                    <li><a href="<?php echo site_url(); ?>/investment-property-marketplace">Buy Properties</a></li>
                    <li><a href="<?php echo site_url(); ?>/seller-services">Sell Properties</a></li>
                    <li><a href="<?php echo site_url(); ?>/manage-properties">Manage Properties</a></li>
                    <li><a href="<?php echo site_url(); ?>/agents-brokers">Agents &amp; Brokers</a></li>
                    <li><a href="<?php echo site_url(); ?>/property-management">Certified Property Managers</a></li>
                </ul>
            </div>
            <?php */ ?>
            <div class="col">
                <ul class="list-unstyled">
                    <li class="group-header">About Us</li>
                    <li><a href="<?php echo site_url(); ?>/about-us">What We Do</a></li>
                    <?php /* ?>
                    <li><a href="<?php echo site_url(); ?>/about-us/#team">Our Team</a></li>
                    <li><a href="<?php echo site_url(); ?>/about-us/press">Press</a></li>
                    <li><a href="<?php echo site_url(); ?>/reviews">Reviews</a></li>
                    <li><a href="<?php echo site_url(); ?>/about-us/partners">Partners</a></li>
                    <li><a href="<?php echo site_url(); ?>/about-us/careers">Careers</a></li>
                    <?php */ ?>
                    <li><a href="<?php echo site_url(); ?>/facts-about-baltimore">Facts About Baltimore</a></li>
                    <li><a href="<?php echo site_url(); ?>/facts-about-philadelphia">Facts About Philadelphia</a></li>
                </ul>
            </div>
            <div class="col">
                <ul class="list-unstyled">
                    <li class="group-header">Learn</li>
                    <li><a href="<?php echo site_url(); ?>/how-it-works">How It Works</a></li>
                    <li><a href="<?php echo site_url(); ?>/portfolios/overview">Portfolio Investments</a></li>
                    <li><a href="<?php echo site_url(); ?>/blog">Blog</a></li>
                    <li><a href="<?php echo site_url(); ?>/investment-property/coverage">Markets</a></li>
                    <li><a href="<?php echo site_url(); ?>/financing">Financing</a></li>
                    <li><a href="<?php echo site_url(); ?>/fund-partners">Fund Partners</a></li>
                    <li><a href="<?php echo site_url(); ?>/certification-guarantee">Certification &amp; Guarantee</a></li>
                    <li><a href="<?php echo site_url(); ?>/get-neighborhood-rating">Neighborhoods</a></li>
                    <li><a href="<?php echo site_url(); ?>/faq">FAQ</a></li>
                    <li><a href="<?php echo site_url(); ?>/learn/glossary">Glossary</a></li>
                </ul>
            </div>
            <div class="col">
                <ul class="list-unstyled">
                    <li class="group-header">Services</li>
                    <li><a href="<?php echo site_url(); ?>/advisory-services">Advisory Services</a></li>
                    <li><a href="<?php echo site_url(); ?>/1031-exchange">1031 Exchange</a></li>
                    <li><a href="<?php echo site_url(); ?>/sdira">IRA Investing</a></li>
                </ul>
            </div>
            <div class="col">
                <ul class="list-unstyled">
                    <li class="group-header">Contact Us</li>
                    <?php /* ?>
                    <li><a href="<?php echo site_url(); ?>/about-us/contact">General Inquiries</a></li>
                    <?php */ ?>
                    <li class="info"><a href="tel:+12676031803">+1 (267) 603-18-03</a></li>
                    <li><a class="info" href="mailto:support@support@usainvestmentspro.com" target="_top">support@usainvestmentspro.com</a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <ul class="list-unstyled">
                    <li class="group-header" style="border: 0;">Questions?</li>
                    <li>
                        <a class="btn btn-sm btn-primary" href="<?php echo site_url(); ?>/#" onclick="return window.Intercom(&#39;show&#39;);"> <img src="<?php echo $theme_url; ?>/images/chat.svg" alt="chat icon" style="padding-right: 5px;"> Chat Now! </a>
                    </li>
                </ul>
                <div class="social-media-links">
                    <a href="https://www.facebook.com/#" target="facebook">
                        <i class="fab fa-facebook"></i>
                        <span class="sr-only">Facebook</span>
                    </a>
                    <a href="https://www.linkedin.com/company/#" target="linkedin">
                        <i class="fab fa-linkedin"></i>
                        <span class="sr-only">LinkedIn</span>
                    </a>
                    <a href="https://twitter.com/#" target="twitter">
                        <i class="fab fa-twitter"></i>
                        <span class="sr-only">Twitter</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="copyright">
            <a href="<?php echo site_url(); ?>/privacy">Privacy Policy</a>
            &nbsp; | &nbsp;
            <a href="<?php echo site_url(); ?>/terms">Terms &amp; Conditions</a>
            &nbsp; | &nbsp;
            <a>© 2018 USA Investments Pro, Inc.</a> <br>
            <span>#1 ranking based on website traffic from Alexa.com as of 7/31/18. Over $1 billion in transactions since 1/26/16 as of 1/1/18.</span>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

<script type="text/javascript">
    function setupChangeHeaderOnScroll() {
        window.onscroll = function () {
            if (jQuery(window).scrollTop() > 50) {
                jQuery("body.home .navbar.isLoggedIn").addClass("navbar-navy").removeClass("navbar-default");
            } else {
                jQuery("body.home .navbar.isLoggedIn").addClass("navbar-default").removeClass("navbar-navy");
            }
        }
    }
    setupChangeHeaderOnScroll();
</script>

</body>
</html>
