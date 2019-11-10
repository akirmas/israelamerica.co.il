<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

    <meta name="viewport" content="width=device-width, user-scalable=no">

	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>

    <?php $theme_url = get_stylesheet_directory_uri(); ?>

    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url.'/css/bootstrap.css'; ?>" media="all">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url.'/css/font-awesome.min.css'; ?>" media="all">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url.'/css/owl.carousel.css'; ?>" media="all">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url.'/css/swiper.min.css'; ?>" media="all">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url.'/css/jquery-ui.css'; ?>" media="all">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url.'/css/jquery.fancybox.css'; ?>" media="all">
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url.'/css/styles.css'; ?>" media="all">

    <script type="text/javascript" src="<?php echo $theme_url.'/js/noconflict.js'; ?>"></script>
    <?php /* ?>
    <script type="text/javascript" src="<?php echo $theme_url.'/js/bootstrap.js'; ?>"></script>
    <?php */ ?>
    <script type="text/javascript" src="<?php echo $theme_url.'/js/owl.carousel.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $theme_url.'/js/jquery.fancybox.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $theme_url.'/js/jquery.event.move.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $theme_url.'/js/jquery-ui.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $theme_url.'/js/jquery.cycle2.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $theme_url.'/js/jquery.cycle2.swipe.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $theme_url.'/js/slideshow.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $theme_url.'/js/swiper.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $theme_url.'/js/mask.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo $theme_url.'/js/main.js'; ?>"></script>
</head>

<body <?php body_class(); ?>>

<header>
    <div class="navbar-fixed-top">
        <div class="prerender-overwrite navbar navbar-rs navbar-default ">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?php echo site_url(); ?>/" class="navbar-brand">
                        <img src="<?php echo $theme_url; ?>/images/logo3.png" alt="logo">
                    </a>
                    <ul class="nav navbar-nav visible-xs visible-sm pull-right">
                        <li class="pull-right" style="border: none;">
                            <div class="mar-t-15">
                                <a href="<?php echo site_url(); ?>/signup" class="btn btn-outline-primary">Sign Up</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="navbar-collapse collapse">
                    <button type="button" class="navbar-toggle hidden-md hidden-lg" data-toggle="collapse" data-target=".navbar-collapse">
                        <img src="<?php echo $theme_url; ?>/images/close.png" alt="Close">
                    </button>
                    <ul class="nav navbar-nav rs-header">
                        <li>
                            <a href="<?php echo site_url(); ?>/" class="top top-menu-item">Home</a>
                        </li>

                        <li class="dropdown">
                            <a href="<?php echo site_url(); ?>/#" class="dropdown-toggle top-menu-item" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Services <i class="far fa-angle-down"></i> </a>
                            <ul aria-labelledby="list-of-learn" class="dropdown-menu dropdown-menu-left">
                                <li><a href="<?php echo site_url(); ?>/e2-visa-for-employees-and-investors" class="top top-menu-item">E2 Visa</a></li>
                                <li><a href="<?php echo site_url(); ?>/usa-bank-account" class="top top-menu-item">USA Bank Account</a></li>
                                <li><a href="<?php echo site_url(); ?>/private-company-llc" class="top top-menu-item">Private Company , LLC</a></li>
                                <li><a href="<?php echo site_url(); ?>/real-estate-investments" class="top top-menu-item">Real Estate Investments</a></li>
                                <li><a href="<?php echo site_url(); ?>/total-package" class="top top-menu-item">Total Package</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="<?php echo site_url(); ?>/#" class="dropdown-toggle top-menu-item" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                About
                                <i class="far fa-angle-down"></i>
                            </a>
                            <ul aria-labelledby="list-of-about-us" class="dropdown-menu dropdown-menu-left">
                                <li><a href="<?php echo site_url(); ?>/about-us">About Us</a></li>
                                <li><a href="<?php echo site_url(); ?>/why-should-you-invest">Why Should you Invest</a></li>
                                <li><a href="<?php echo site_url(); ?>/testimonials">Testimonials</a></li>
                                <li><a href="<?php echo site_url(); ?>/facts-about-baltimore">Facts About Baltimore</a></li>
                                <li><a href="<?php echo site_url(); ?>/facts-about-philadelphia">Facts About Philadelphia</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="<?php echo site_url(); ?>/new-inventory" class="top top-menu-item">New Inventory</a>
                        </li>

                        <li>
                            <a href="<?php echo site_url(); ?>/contact" class="top top-menu-item">Contact</a>
                        </li>

                    </ul>
                    <ul class="nav navbar-nav navbar-right rs-header">

                        <li>
                            <div class="mar-t-15">
                                <a href="<?php echo site_url(); ?>/signup" class="btn btn-outline-primary">Sign Up</a>
                            </div>
                        </li>
                        <li>
                            <a href="<?php echo site_url(); ?>/login" class="top-menu-item">Log In</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="top-nav-filler"></div>