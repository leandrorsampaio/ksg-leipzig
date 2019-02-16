<?php
//
// NOT display error reports
error_reporting(-1);
//
//
//
// Testing only page
if ( is_home() ) {
  $pageonly = 0;
} else {
  $pageonly = 1;
}

//
//
//
/* Programmer module - file with all variables shown across the site
*
*
*
*------------------------------------
*--------- CATEGORY SLUG  -----------
*------------------------------------
*
 /* Get category slug of the current post
 * The slug of the current post will be used as a variable
 * to create the query Events, that builds the Events Widget,
 * so the events shown in the widget will be from the same category
 * as the current post.
 *
  */
    if ( is_single() ) {
        $cats =  get_the_category();
        $cat = $cats[0];
    } else {
        $cat = get_category( get_query_var( 'cat' ) );
    }

    // if ( $pageonly == 1 ) {
    //   $cat_slug = $cat->slug;
    // } else {

    // }


    //Get the page parent's slug
    $post_data = get_post($post->post_parent);
    $parent_slug = $post_data->post_name;


/*
*------------------------------------
*--------- QUERY EVENTS  ------------
*------------------------------------
*
* Creation of the query EVENTS, that builds the Events widget
*
* When displayed in the Home page, the query won't use taxonomies, so the last 4 events will show. When inside of a single page, the events will be shown by custom taxonomy, so the events will have the same category as the current post.
* The taxonomy is the cat_slug variable.
*
If is a page, the custom taxonomy has the same slug
of the parent page. The taxonomy is the parent_slug variable.
*/

// if (is_single()) {
// 			$queryEvents = tribe_get_events( array(
// 				'posts_per_page' => 4,
// 				'tax_query' => array(
// 				        array (
// 				            'taxonomy' => 'tribe_events_cat',
// 				            'field' => 'slug',
// 				            'terms' => $cat_slug,
// 				        )
// 				    ),
// 				) );

// }
if (is_page() && $post->post_parent ) {
			$queryEvents = tribe_get_events( array(
				'posts_per_page' => 4,
                'tax_query' => array(
                        array (
                            'taxonomy' => 'tribe_events_cat',
                            'field' => 'slug',
                            'terms' => $parent_slug,
                        )
                    ),
				) );
} else {
    $queryEvents = tribe_get_events( array(
                'posts_per_page' => 4,
                ) );
}


/*
*------------------------------------
*------------ PAGES IDS --------------
*------------------------------------
*/
$homeInterface = 26;
$eventsWidget = 418;
$news = 451;
$kalender = 449;
$uberuns = 453;
$personen = 455;
$unsere = 457;
$gemeindeleben = 427;
$heiligeMesse = 433;
$musik = 431;
$laudes = 439;
$chor = 429;
$internationalerAbend = 437;
$soziales = 443;
$uberregionales = 445;
$okumene = 441;
$freundeskreis = 425;
$datens = 423;
$impressum = 447;

/*
*------------------------------------
*------------ LANGUAGE --------------
*------------------------------------
*/

// gets the language URL
// the variable languageURL is used to set the language
// in all permalinks through the site

// global $language;
// $language = 1;
// //$languageGet = $_GET['lang'];
// $languageGet = 'de';
// if ($languageGet == 'en') {
//     $language = 2; //EN
//     $languageURL = '?lang=en';
// } else {
//     $language = 1; //DE (default)
//     $languageURL = '?lang=de';
// }




// Identify custom fields' by name
/*
* --------------------------
*------- Main Menu ---------
*---------------------------
*/
$page_title_en = 'title_en';

  $lang_content_de ='content_de';
  $lang_content_en = 'content_en';

//
//
// Set the right ID to the current language
if ($language == 2) {

    // ---------------- MAIN MENU
    if ( $pageonly == 1 ) {
      $page_title = $page_title_en;
      $contentFeatured = $lang_content_en;
    } else {
      $page_title = '';
      $contentFeatured = $lang_content_de;
    }

} else {

}
//
//
// Gets the custom field object
//-------------- MAIN MENU

// if ( $pageonly == 1 ) {
//   $final_page_title =  get_field_object($page_title);
// } else {
//   $final_page_title =  '';
// }
