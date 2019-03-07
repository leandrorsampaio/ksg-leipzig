<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Papa Bento XVI WP Theme 2.0
 * @since Papa Bento XVI WP Theme 1.0
 */
?><!DOCTYPE html>
<html lang="de" class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css" lazyload>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/tinyslider.css" lazyload>
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/imgs/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?php bloginfo('template_url'); ?>/imgs/favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php bloginfo('template_url');?>/tinyslider.js"></script>




		<script type="text/javascript">
					// Test if there is lang code
					var url = window.location.href;
					if (url.indexOf('?') > -1){
						 // yes, there is
					} else {
						// no, there is not. Redirect to DE Url
						 url += '?lang=de';
						 window.location.href = url;
					}

		</script>




	<?php

		// Turn off all error reporting
		error_reporting(0);

    // includes WP_head
    wp_head();

		$langCode = $_GET['lang'];

		if ($langCode == 'en') {
		    $language = 2; //EN
		    $languageURL = '?lang=en';
				$languageCode = 'en';
				$flag = 'lang-uk.svg';
				//
				$searchtextbutton = 'search';

		} else {
				$language = 1; //DE (default)
			 	$languageURL = '?lang=de';
			 	$languageCode = 'de';
			 	$flag = 'lang-de.svg';
				//
				$searchtextbutton = 'Suche';
		}
    ?>





</head>

<body id="lang-body-<?php echo $languageCode; ?>">
    <?php
    //includes the main Menu
    include ('includes/in_menu.php');
    // include ('searchform.php') ;?>
    <header id="header">
        <div class="grid-width">
            <div class="logo-container">
                <div class="logo"><a href="<?php echo get_bloginfo('url') . $languageURL; ?>"><img src="<?php bloginfo('template_url');?>/imgs/logo.svg"></a></div>
            </div>
            <div class="container">
                <!--Desktop items for the menu-->
                <div class="items">
                    <div class="header__languages">
                        <div id="hl__container" class="hl__container">
														<a><p><img class="lang__flag" src="<?php bloginfo('template_url');?>/imgs/<?php echo $flag; ?>" /><img src="<?php bloginfo('template_url');?>/imgs/icon/chevron-down.svg" alt="chevron-down"></p></a>
                        </div>
                        <div id="hl__options" class="hl__options">
                            <div class="hl__option">
                                <a href="?lang=de"><img src="<?php bloginfo('template_url');?>/imgs/lang-de.svg" />DE</a>
                            </div>
                            <div class="hl__option">
                                <a href="?lang=en"><img src="<?php bloginfo('template_url');?>/imgs/lang-uk.svg" />EN</a>
                            </div>
                        </div>
                    </div>
                    <script>
                    $("#hl__container").mouseup(function(){
                        $('.hl__options').css({"opacity":"1"});
                        $('.hl__options').css({"top":"-10px"});
                        $('.hl__options').css({"visibility":"visible"});
                    });
  									</script>





                    <a class="margin-left-40 trigger-search" id="search"><img src="<?php bloginfo('template_url');?>/imgs/icon/search.svg" class="menu-icon"><p><?php echo $searchtextbutton; ?></p></a>
                    <a id="menu-toggle" class="margin-left-40"><img src="<?php bloginfo('template_url');?>/imgs/icon/menu.svg" class="menu-icon"><p>Menu</p></a>
                </div>
                <!--End of Desktop items for the menu-->

                <!--Mobile toggle for the menu-->
                <div class="items_mobile">
                    <a id="menu-toggle-mobile"><img src="<?php bloginfo('template_url');?>/imgs/icon/menu.svg"></a>
                </div>
            </div>
            <?php include ('searchform.php') ;?>


						<script>
						$(".trigger-search").click(function(){
							$(".search-form").toggle();
						});
						</script>


        </div>
    </header>

    <!--End of Menu for desktop breakpoints-->
