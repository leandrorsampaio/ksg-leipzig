<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the body tag.
 *
 */
?><!DOCTYPE html>
	<head>
		<title><?php echo wp_title('|',true,'right'); bloginfo('name'); ?></title>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css" lazyload>
		<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/imgs/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php bloginfo('template_url'); ?>/imgs/favicon.ico" type="image/x-icon">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover" />
	</head>

	<body>
		<div class="sidebar">
            <a id="menu-untoggle"><img src="<?php bloginfo('template_url');?>/imgs/icon/close.svg"></a>
            <ul class="active">
                <a href="#"><li>The KSG</li></a>
                <a href="#"><li class="child">Student Chaplain</li></a>
                <a href="#"><li class="child">Community Leadership</li></a>
                <a href="#"><li class="child">Student Counselor</li></a>
                <a href="#"><li class="child">Souls</li></a>
                <a href="#"><li class="child">The way to us</li></a>
            </ul>
            <a href="<?php echo get_permalink(94);?>"><li>Program</li></a>
            <a href="#"><li>Church Service</li></a>
            <a href="#"><li>Social</li></a>
            <a href="#"><li>About regional</li></a>
            <a href="#"><li>Ecumenism</li></a>
            <a href="#"><li>The Cirle of Friends</li></a>
            <a href="#"><li>Services</li></a>
            <a href="#"><li>Data Protection</li></a>
        </div>

        <header>
            <div class="grid-width">
                <div class="logo-container">
                    <div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php bloginfo('template_url');?>/imgs/logo.svg"></a></div>
                </div>
                <div class="container">
                    <!--Desktop items for the menu-->
                    <div class="items">
                        <a><img src="<?php bloginfo('template_url');?>/imgs/icon/search.svg" class="menu-icon"><p>Search</p></a>
                        <a id="menu-toggle" class="margin-left-40"><img src="<?php bloginfo('template_url');?>/imgs/icon/menu.svg" class="menu-icon"><p>Menu</p></a>
                    </div>
                    <!--End of Desktop items for the menu-->

                    <!--Mobile toggle for the menu-->
                    <div class="items_mobile">
                        <a id="menu-toggle-mobile"><img src="<?php bloginfo('template_url');?>/imgs/icon/menu.svg"></a>
                    </div>
                </div>
            </div>
        </header>
        <!--End of Menu for desktop breakpoints-->
