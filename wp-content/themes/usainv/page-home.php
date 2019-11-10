<?php

get_header();

$theme_url = get_stylesheet_directory_uri();

?>
    <div class="home3">
        <section class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7 col-md-6 col-lg-5">
                        <h1> Build Wealth Through <br>Real Estate</h1>
                        <h4>
                            <strong>#1 Marketplace</strong> for buying and selling <br class="hidden-xs hidden-sm"> single-family rental homes
                        </h4>
                        <div class="btn-wrap">
                            <a href="<?php echo site_url(); ?>/investment-property-marketplace" onclick="trackCtaClicked(&#39;See Our Properties&#39;);" class="btn btn-solid btn-primary btn-lg"> Browse Properties </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="value-prop-trio">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <img src="<?php echo $theme_url; ?>/images/buy-online-icon.svg" alt="">
                                </td>
                                <td>
                                    <h3>Online Marketplace</h3>
                                    <p>Access 40 markets across the US to find the right property for you.</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br class="hidden-md hidden-lg">
                    <div class="col-md-4">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <img src="<?php echo $theme_url; ?>/images/icon-platform.svg" alt="">
                                </td>
                                <td>
                                    <h3>Trusted Platform</h3>
                                    <p>With over $1 billion in completed transactions, you benefit from our proven technology.</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <br class="hidden-md hidden-lg">
                    <div class="col-md-4">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <img src="<?php echo $theme_url; ?>/images/icon-rs-guarantee.svg" alt="">
                                </td>
                                <td>
                                    <h3>USA Investments Pro Guarantee</h3>
                                    <p>Industry-leading guarantee to give you total confidence.</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <div id="rs-video-mobile-container" class="embed-responsive embed-responsive-16by9" style="display:none;">
            <video id="rs-video-mobile" controls="controls" preload="none">
                <source src="https://player.vimeo.com/external/235615353.m3u8?s=a5cd10dbcebfb8b06a361aa35a8382a361d837c9" type="video/mp4">
            </video>
        </div>
        <section class="video" id="video-message-container">
            <div class="container text-center visible-xs"><h3>Why buy rental property on USA Investments Pro?</h3>
                <a href="javascript:void()" onclick="playVideo();">
                    <img src="<?php echo $theme_url; ?>/images/play-icon-orange.svg" alt="">
                </a>
            </div>
            <div class="container text-center hidden-xs">
                <h3>Why buy rental property on USA Investments Pro?</h3>
                <a href="<?php echo site_url(); ?>/#" class="launch-modal" data-modal-id="modalVideo">
                    <img src="<?php echo $theme_url; ?>/images/play-icon-orange.svg" alt="">
                </a>
            </div>
        </section>

        <?php

        $args = array(
            'status' => 'publish',
        );

        $products = wc_get_products( $args );

        ?>

        <?php if ( count( $products ) ): ?>
            <section class="cards">
                <div class="container">
                    <h2 class="accent-bar-orange"> Buy an investment property with as little as 20% down</h2>
                    <div class="property-cards margin-t-b-20">
                        <div class="property-cards-swiper-container swiper-container">
                            <div class="swiper-wrapper">

                                <?php foreach ( $products as $product ): ?>

                                    <?php $post_id = $product->get_id(); ?>

                                    <div class="swiper-slide">
                                        <a href="<?php echo get_permalink( $post_id ); ?>" class="link-to-details">
                                            <div class="roof-card card">
                                                <div align="center" class="embed-responsive">
                                                    <img class="property-img" src="<?php echo acf_photo_gallery_resize_image( get_the_post_thumbnail_url( $post_id, 'full' ), 320, 180 ); ?>">
                                                    <div class="overlay ">
                                                        <div class="price">
                                                            <div>
                                                                <div class="price-value tentative-adjust ">
                                                                    <?php echo get_field( 'purchase_price', $post_id ); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <span class="details"> <?php echo get_field( 'property type', $post_id ); ?> | <?php echo get_field( 'sqft', $post_id ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="property-stats">
                                                    <div class="property-stats-item initial-investment"><h6>Total Investment</h6>
                                                        <span class="nowrap"><?php echo get_field( 'total_investment', $post_id ); ?></span>
                                                    </div>
                                                    <div class="property-stats-item current-rent">
                                                        <h6>Current Rent</h6>
                                                        <?php echo get_field( 'rental_monthly_income', $post_id ); ?>
                                                    </div>
                                                    <div class="property-stats-item total-return">
                                                        <h6>Annual Return</h6>
                                                        <span class="nowrap">
                                                            <?php echo get_field( 'annual_net_return', $post_id ); ?>
                                                        </span>
                                                    </div>
                                                    <div class="property-stats-item nh">
                                                        <h6>Cash-On-Cash</h6>
                                                        <?php echo get_field( 'annual_cash-on-cash_on_investment', $post_id ); ?>
                                                        <span class="field-note">/Year</span>
                                                    </div>
                                                </div>
                                                <div class="property-address">
                                                    <span class="street"><?php echo $product->get_title(); ?></span><br>
                                                    <span class="csz"><?php echo get_field( 'property class', $post_id ); ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                <?php endforeach; ?>




                            </div>

                            <div class="property-cards-swiper-pagination swiper-pagination"></div>
                        </div>
                    </div>
                    <?php /* ?>
                    <div class="text-center">
                        <a href="<?php echo site_url(); ?>/investment-property-marketplace" onclick="trackCtaClicked(&#39;Browse Properties&#39;);" class="btn btn-solid btn-primary btn-lg margin-t-20"> Browse Properties </a>
                    </div>
                    <?php */ ?>
                    <br><br>
                    <div class="testimonials cards social-proofs">
                        <div class="social-proofs-swiper-container swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="story-card" href="<?php echo site_url(); ?>/reviews/bryce-h-customer-review" target="_blank"><h3>Richard Clements</h3>
                                        <blockquote>I have purchased one property from USA Investments Pro 10 months ago. The purchase process was very smooth. we got our E2 Visa as promised, and we moved to The USA 4 months ago. What I like about USA Investments Pro is that I have the peace of mind – They takes care of everything. Can’t beat that. I have great communication with Alex, whenever I have a question, I get a prompt response within a day.</blockquote>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="story-card" href="<?php echo site_url(); ?>/reviews/bryce-h-customer-review" target="_blank"><h3>Kouji Kawasaki</h3>
                                        <blockquote>I bought my first house from USA Investments Pro 3 years ago. Now I have 2 and my friends and family have bought another 8. They have always delivered what they have said they would. Most importantly, I always get my rent! I recommend investing with USA Investments pro.</blockquote>
                                    </div>
                                </div>
                                <?php /* ?>
                                <div class="swiper-slide">
                                    <a class="story-card" href="<?php echo site_url(); ?>/reviews/bryce-h-customer-review" target="_blank"><h3>Bought sight unseen</h3>
                                        <blockquote> I never needed to see the property in person. The certification process provided everything I was looking for to help me find the right investment property.</blockquote>
                                        <cite>
                                            <span class="cite-img"> <img src="<?php echo $theme_url; ?>/images/thumb-bryce.png" alt=""> </span>
                                            <span class="cite-text"> <span class="line">2 properties purchased in FL </span> <span class="line">Bryce H. - New York City, NY</span> </span>
                                        </cite>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a class="story-card" href="<?php echo site_url(); ?>/reviews/linda-d-customer-review" target="_blank"><h3>Invested with confidence</h3>
                                        <blockquote> USA Investments Pro's website is a dream come true for property investors, offering properties that are both certified and occupied, with detailed inspection reports &amp; property management company recommendations</blockquote>
                                        <cite>
                                            <span class="cite-img"> <img src="<?php echo $theme_url; ?>/images/thumb-linda-dalton.png" alt=""> </span>
                                            <span class="cite-text"> <span class="line">1 property purchased in GA </span> <span class="line">Linda D. - Seattle, WA</span> </span>
                                        </cite>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a class="story-card" href="<?php echo site_url(); ?>/reviews/josh-l-customer-review" target="_blank"><h3>Partnered with the right providers</h3>
                                        <blockquote> After looking around at property management and financing options on my own, I decided to go with USA Investments Pro's certified partners which really smoothed out the whole closing process.</blockquote>
                                        <cite>
                                            <span class="cite-img"> <img src="<?php echo $theme_url; ?>/images/thumb-josh-lawlor.png" alt=""> </span>
                                            <span class="cite-text"> <span class="line">4 properties purchased in FL &amp; GA </span> <span class="line">Josh L. - New York, NY</span> </span>
                                        </cite>
                                    </a>
                                </div>
                                <?php */ ?>
                            </div>
                            <div class="social-proofs-swiper-pagination swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif; ?>

        <section class="press-logos text-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <ul class="list-inline">
                            <li><img src="<?php echo $theme_url; ?>/images/pr-logo-wsj.png" alt="The Wall Street Journal"></li>
                            <li><img src="<?php echo $theme_url; ?>/images/pr-logo-cnbc.png" alt="CNBC"></li>
                            <li><img src="<?php echo $theme_url; ?>/images/pr-logo-forbes.png" alt="Forbes"></li>
                            <li><img src="<?php echo $theme_url; ?>/images/pr-logo-techcrunch.png" alt="TechCrunch"></li>
                            <li><img src="<?php echo $theme_url; ?>/images/pr-logo-recode.png" alt="Recode"></li>
                            <li><img src="<?php echo $theme_url; ?>/images/pr-logo-sf-chronicle.png" alt="San Francisco Chronical"></li>
                            <li><img src="<?php echo $theme_url; ?>/images/pr-logo-cbinsights.png" alt="CBInsights"></li>
                            <li><img src="<?php echo $theme_url; ?>/images/pr-logo-inman.png" alt="inman"></li>
                            <li><img src="<?php echo $theme_url; ?>/images/pr-logo-lmm.png" alt="Listen Money Matters"></li>
                            <li><img src="<?php echo $theme_url; ?>/images/pr-logo-investor-junkie.png" alt="Investor Junkie"></li>
                            <li><img src="<?php echo $theme_url; ?>/images/pr-logo-stacking-benjamins.png" alt="Stacking Benjamins"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section id="home-e2-visa" class="value-prop-1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h2 class="accent-bar-purple">E2 Visa for Employees and Investors</h2>
                        <?php

                        /*$e2_post_id = 85;
                        $content_post = get_post( $e2_post_id );
                        $content = $content_post->post_content;
                        $content = apply_filters('the_content', $content);
                        $content = str_replace(']]>', ']]&gt;', $content);
                        echo $content;*/

                        ?>

                        The investors who wish to develop and direct their business in the United States can stay and work there through the E2 Investor visa. In many of the large-scale enterprises, often the executive and management level employees are chosen for a tour to the US in place of the business owners. Besides, if both the investor and the employee are nationals of the same country for which the E2 visa is applied, the employee can also qualify for the E2 visa. Interestingly, there is no particular quota for the E2 visas which makes it significantly different from the visa category of H1B. The total investment required for qualifying for the E2 Treaty Investor visa is not fixed. It varies, and there is no particular minimum amount set as an eligibility criterion. For instance, in the case of any consultancy business, the investment amount can be thousands of dollars. Besides, it can be less for some other business. However, it is important to mention that the larger the investment, the easier it is to get your company registered as the E2 business. On the contrary, it becomes significantly difficult for small investors to get registered...

                        <a href="<?php echo home_url('/e2-visa-for-employees-and-investors/'); ?>">Read More</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="value-prop-2">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-push-6 col-md-5 col-md-push-7"><h2 class="accent-bar-orange"> Find the right property with ease</h2>
                        <ul class="list-style-check-orange hidden-xs">
                            <li>Market, neighborhood, and local school insights</li>
                            <li>Interior &amp; exterior inspection reports</li>
                            <li>Property valuation &amp; comparables</li>
                            <li>Tenant payment history &amp; lease details</li>
                            <li>Preliminary title report</li>
                            <li>Major repair cost estimates, if applicable</li>
                            <li>Visualizations of appreciation, income &amp; total returns</li>
                            <li>Detailed financial pro forma &amp; return estimates</li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-sm-pull-6 col-md-pull-5">
                        <ul class="list-style-box">
                            <li onclick="void(0)">
                                <div class="visual-wrapper"><img src="<?php echo $theme_url; ?>/images/analytics-icon.svg" alt="" class="img-responsive"></div>
                                <div class="text-wrapper"><h4>Market Overview</h4>
                                    <p>
                                        <small>
                                            <a href="<?php echo site_url(); ?>/investment-property/coverage">Explore our markets</a>
                                            . We provide research and data analysis to help you determine which locations meet your investing objectives.
                                        </small>
                                    </p>
                                </div>
                            </li>
                            <li onclick="void(0)">
                                <div class="visual-wrapper"><img src="<?php echo $theme_url; ?>/images/neighborhood-icon.svg" alt="" class="img-responsive"></div>
                                <div class="text-wrapper"><h4>Neighborhood Insights</h4>
                                    <p>
                                        <small> Learn the investing appeal of different neighborhoods. Compare homes across similar areas with our
                                            <a href="<?php echo site_url(); ?>/neighborhood-rating">Proprietary Neighborhood Rating</a>
                                            .
                                        </small>
                                    </p>
                                </div>
                            </li>
                            <li onclick="void(0)">
                                <div class="visual-wrapper"><img src="<?php echo $theme_url; ?>/images/report-icon.svg" alt="" class="img-responsive"></div>
                                <div class="text-wrapper"><h4>Property Analysis</h4>
                                    <p>
                                        <small> Review inspection reports, take a 3-D tour, see estimated returns based on your financial criteria, and more.</small>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="value-prop-3">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-5">
                        <div class="max-455-lg"><h2 class="accent-bar-purple"> Enjoy long-term, expert support</h2>
                            <div class="hidden-xs"><p> Our team is here for you all the way. We set you up with a vetted local property manager, and continue to work on your behalf to help everything go smoothly.</p></div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-md-offset-1">
                        <ul class="list-style-box">
                            <li onclick="void(0)">
                                <div class="visual-wrapper online-icon"><img src="<?php echo $theme_url; ?>/images/buy-online-icon.svg" alt="" class="img-responsive"></div>
                                <div class="text-wrapper"><h4>100% online</h4>
                                    <p>
                                        <small> Browse, close, manage and sell from the comfort of your home.</small>
                                    </p>
                                </div>
                            </li>
                            <li onclick="void(0)">
                                <div class="visual-wrapper vetted-partners-icon"><img src="<?php echo $theme_url; ?>/images/diligence-icon.svg" alt="" class="img-responsive"></div>
                                <div class="text-wrapper"><h4>Vetted Partners</h4>
                                    <p>
                                        <small> Choose top providers for property management, lending &amp; insurance.</small>
                                    </p>
                                </div>
                            </li>
                            <li onclick="void(0)">
                                <div class="visual-wrapper support-icon"><img src="<?php echo $theme_url; ?>/images/mini-house-icon-v2.svg" alt="" class="img-responsive"></div>
                                <div class="text-wrapper"><h4>Long-term support</h4>
                                    <p>
                                        <small> From selecting to post-purchase, our advisors are with you every step.</small>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="why-single-family">
            <div class="container">
                <h2>
                    <span>Why Single-Family?</span>
                </h2>
                <ul class="list-style-square-orange">
                    <li>Own a tangible asset</li>
                    <li>Build long-term wealth</li>
                    <li>Buy with leverage</li>
                    <li>Tax benefits</li>
                    <li>Cash flow from day one</li>
                    <li>Passive income</li>
                    <li>Hedge on inflation</li>
                    <li>Diversify your investment portfolio</li>
                    <li>Uncorrelated to the stock market</li>
                </ul>
            </div>
        </section>
        <section class="media-proof cards">
            <div class="container">
                <div class="testimonials">
                    <div class="media-proofs-swiper-container swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="story-card"><h3><img src="<?php echo $theme_url; ?>/images/pr-logo-forbes-black.png" alt="" class="img-responsive center-block"></h3>
                                    <blockquote class="text-center"> The only online marketplace that allows investors to buy leased single-family homes without interrupting tenant occupancy.</blockquote>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="story-card"><h3><img src="<?php echo $theme_url; ?>/images/pr-logo-recode-black.png" alt="" class="img-responsive center-block"></h3>
                                    <blockquote class="text-center"> The way USA Investments Pro works is pretty straightforward. If you want to buy a single-tenant home that's already leased, USA Investments Pro's marketplace offers a variety of properties at different price points.</blockquote>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="story-card"><h3><img src="<?php echo $theme_url; ?>/images/pr-logo-wsj-black.png" alt="" class="img-responsive center-block"></h3>
                                    <blockquote class="text-center"> USA Investments Pro has the potential to introduce liquidity into a market that has traditionally been illiquid.</blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="media-proofs-swiper-pagination swiper-pagination"></div>
                    </div>
                </div>
                <br><br>
                <div class="text-center">
                    <a href="<?php echo site_url(); ?>/about-us/press" onclick="trackCtaClicked(&#39;Read More Press&#39;);" class="btn btn-lg btn-outline-primary"> Read More Press</a>
                </div>
            </div>
        </section>
        <section class="call-advisor">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 col-sm-push-7 col-md-5 col-md-push-7"><h2 class="accent-bar-orange"> Advisors Are Here to Help</h2>
                        <p> Whether you're a savvy investor looking for multiple buys or a first-timer ready to crack into the lucrative real-estate market, we will partner with you every step of the away.</p> <br class="visible-xs"></div>
                    <div class="col-sm-7 col-sm-pull-5 col-md-pull-5">
                        <table>
                            <tbody>
                            <tr>
                                <td class="visual-wrapper"><img src="<?php echo $theme_url; ?>/images/thumb-zach-evanish.png" alt="Zach Evanish" class="img-responsive" width="160"></td>
                                <td class="text-wrapper">
                                    <p class="hidden-xs">
                                        <small>
                                            <strong>Zach Evanish</strong>
                                            <br> Director of Client Advisory Services
                                        </small>
                                    </p>
                                    <a href="#" class="btn btn-solid btn-primary btn-lg margin-t-20"> Schedule a Call</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-labelledby="myModalVideoLabel">
        <div class="modal-dialog full-screen" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="<?php echo $theme_url; ?>/images/close.png">
                    </button>
                    <div class="embed-responsive embed-responsive-16by9">
                        <video id="rs-video" controls="controls" preload="none" class="embed-responsive-item" style="max-height: 1040px; margin: 0 auto; z-index: 50;">
                            <source src="<?php echo $theme_url; ?>/video/usinvestmentspro-720.mp4" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>jQuery(function () {
            setupModalVideoEvents();
            setupPropertyCardsCarousel();
            setupSocialProofsCarousel();
            setupMediaProofsCarousel();
        });

        function setupModalVideoEvents() {
            jQuery('.launch-modal').on('click', function (e) {
                e.preventDefault();
                jQuery('#' + jQuery(this).data('modal-id')).modal();
            });
            setupVideoAsElement();
        }

        function setupVideoAsElement() {
            var rsVideo = document.getElementById("rs-video");
            jQuery('#modalVideo').on('shown.bs.modal', function () {
                rsVideo.play();
                trackVideoPLayed();
            });
            jQuery('#modalVideo').on('hidden.bs.modal', function () {
                rsVideo.pause();
            });
        }

        function playVideo() {
            const videoMessageContainer = document.getElementById("video-message-container");
            const rsVideoMobileContainer = document.getElementById("rs-video-mobile-container");
            const rsVideoMobile = document.getElementById("rs-video-mobile");
            videoMessageContainer.style.display = "none";
            rsVideoMobileContainer.style.display = "";
            rsVideoMobile.play();
            trackVideoPLayed();
        }

        function setupVideoAsIframe() {
            var iframe = jQuery('#vimeoplayer')[0];
            var player = $f(iframe);
            player.addEvent('ready', function () {
                jQuery('#modalVideo').on('shown.bs.modal', function () {
                    player.api('play');
                });
                jQuery('#modalVideo').on('hidden.bs.modal', function () {
                    player.api('pause');
                });
            });
        }

        function setupPropertyCardsCarousel() {
            var mySwiper = new Swiper('.property-cards-swiper-container', {
                slidesPerView: 4,
                breakpoints: {
                    321: {slidesPerView: 1.07, spaceBetweenSlides: 1},
                    361: {slidesPerView: 1.2, spaceBetweenSlides: 1},
                    376: {slidesPerView: 1.25, spaceBetweenSlides: 1},
                    415: {slidesPerView: 1.35, spaceBetweenSlides: 1},
                    767: {slidesPerView: 1.2, spaceBetweenSlides: 1},
                    991: {slidesPerView: 2.5},
                    1199: {slidesPerView: 3.3}
                },
                pagination: '.property-cards-swiper-pagination',
                paginationClickable: true
            });
        }

        function setupSocialProofsCarousel() {
            var mySwiper = new Swiper('.social-proofs-swiper-container', {
                slidesPerView: 2,
                spaceBetween: 30,
                breakpoints: {
                    321: {slidesPerView: 1.07, spaceBetweenSlides: 1},
                    361: {slidesPerView: 1.2, spaceBetweenSlides: 1},
                    376: {slidesPerView: 1.25, spaceBetweenSlides: 1},
                    415: {slidesPerView: 1.35, spaceBetweenSlides: 1},
                    767: {slidesPerView: 1.2, spaceBetweenSlides: 1},
                    991: {slidesPerView: 2.5},
                },
                pagination: '.social-proofs-swiper-pagination',
                paginationClickable: true
            });
        }

        function setupMediaProofsCarousel() {
            var mySwiper = new Swiper('.media-proofs-swiper-container', {
                slidesPerView: 3,
                spaceBetween: 30,
                breakpoints: {
                    321: {slidesPerView: 1.07, spaceBetweenSlides: 1},
                    361: {slidesPerView: 1.2, spaceBetweenSlides: 1},
                    376: {slidesPerView: 1.25, spaceBetweenSlides: 1},
                    415: {slidesPerView: 1.35, spaceBetweenSlides: 1},
                    767: {slidesPerView: 1.2, spaceBetweenSlides: 1},
                    991: {slidesPerView: 2.5},
                },
                pagination: '.media-proofs-swiper-pagination',
                paginationClickable: true
            });
        }

        function trackCtaClicked(source) {
            window.mixpanel.track("Home Page CTA Clicked", {'CTASource': source});
        }

        function trackVideoPLayed() {
            window.mixpanel.track("Home Page Video Played");
        }

        function trackPropertyCardClicked(propertyId) {
            window.mixpanel.track("Home Page Property Card Clicked", {'propertyId': propertyId});
        }

        jQuery(document).ready(function () {
            jQuery('[data-toggle="popover"]').popover();
        });
    </script>

<?php
get_footer();
