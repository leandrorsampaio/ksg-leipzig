<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Papa Bento XVI WordPress Theme
 */

get_header();






$langCode = $_GET['lang'];

global $language;
global $languageURL;
global $languageCode;
global $flag;

if ($langCode == 'en') {
    $language = 2;
    $languageURL = '?lang=en';
    $languageCode = 'en';
    $flag = 'lang-de.svg';
} else {
    //DE (default)
    $language = 1;
    $languageURL = '?lang=de';
    $languageCode = 'de';
    $flag = 'lang-uk.svg';
}




/* --------------------------
*----- Search results -------
*--------------------------- */


//Deutsche
$search_title_de = 'page_title_de';
$search_title_no_results_de = 'page_title_no_results_de';
$search_no_results_message_de = 'no_results_message_de';

//English
$search_title_en = 'page_title_en';
$search_title_no_results_en = 'page_title_no_results_en';
$search_no_results_message_en = 'no_results_message_en';

  if ($language == 2) {
    //---------------- SEARCH RESULTS
$search_title = $search_title_en;
$search_title_no_results = $search_title_no_results_en;
$search_no_results_message = $search_no_results_message_en;
  } else {
// ---------------- SEARCH RESULTS
$search_title = $search_title_de;
$search_title_no_results = $search_title_no_results_de;
$search_no_results_message = $search_no_results_message_de;
  }

//-------- SEARCH RESULTS
$final_search_title = get_field_object($search_title);
$final_search_title_no_results = get_field_object($search_title_no_results);
$final_search_no_results_message = get_field_object($search_no_results_message);




/*
* --------------------------
*------- Single News -------
*---------------------------
*/
$lang_content_de ='content_de';
$lang_title_en = 'title_en';
$lang_content_en = 'content_en';


if ($languageCode == 'en') {
 // ---------------- SINGLE NEWS
    $lang_title = $lang_title_en;
    $lang_content = $lang_content_en;
} else {
    $lang_title = '';
    $lang_content = $lang_content_de;
}


//-------- SINGLE NEWS
//content single
$final_title = get_field_object($lang_title);
$final_content = get_field_object($lang_content);

$contentFeatured = get_field($lang_content);


?>

<article>
	<div class="page-header">
		<?php if ( have_posts() ) :

				// Start the loop for the Search Results Interface
				$args = array(
					'p' => 419,
					'post_type' => 'interface',
					);

				$search = new WP_Query( $args );
				while ($search->have_posts()) : $search->the_post();
				?>

        <div class="full-width">
      		<div class="article-width">
      			<h1 class="page-title page-title-search">

                <?php
                if ($language == 2) {
                  echo "Search Results ";
                  printf( __( 'for: %s'), '<span>' . get_search_query() . '</span>' );
                } else {
                  echo "Suchergebnisse ";
                  printf( __( 'für: %s'), '<span>' . get_search_query() . '</span>' );
                }
                ?>

      				</h1>
            </div>
          </div>

			<?php endwhile;
			wp_reset_query(); ?>

		<?php else :

		// Start the loop for the Search Results Interface
				$args = array(
					'p' => 419,
					'post_type' => 'interface',
					);

				$searchNoResults = new WP_Query( $args );
				while ($searchNoResults->have_posts()) : $searchNoResults->the_post();  ?>

        <div class="full-width">
      		<div class="article-width">
			         <h1 class="page-title page-title-search"><?php echo get_field('page_title_en') ?></h1>
             </div>
           </div>
			<?php endwhile;
			wp_reset_query(); ?>

		<?php endif; ?>
	</div><!-- .page-header -->

	<div id="primary" class="content-area">


    <div class="full-width">
  		<div class="article-width">


    		<?php
    		if ( have_posts() ) :
    			/* Start the Loop */
    			while ( have_posts() ) : the_post();

    				// $content = the_content();

    				?>


            <a class="result-search-item" href="<?php echo the_permalink();?><?php echo $languageURL; ?>">
              <?php
              if ($language == 2) {
                echo "<h2>" . $final_title['value'] . "</h2>";
                $text = mb_strimwidth($contentFeatured, 0, 300, '...');
                echo "<p class='result-search-item-text'>" . strip_tags($text) . "</p>";

              } else {
                echo "<h2>" . get_the_title() . "</h2>";
                $text = mb_strimwidth($contentFeatured, 0, 300, '...');
                echo "<p class='result-search-item-text'>" . strip_tags($text) . "</p>";


              }
              ?>
            </a>


    			<?php endwhile; // End of the loop.

    			the_posts_pagination( array(
    				'prev_text' => '<span class="screen-reader-text">' . __( '<' ) . '</span>',
    				'next_text' => '<span class="screen-reader-text">' . __( '>' ) . '</span>',
    				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page' ) . ' </span>',
    			) );

    		else : ?>


    			<?php
    				$args = array(
    				'p' => 419,
    				'post_type' => 'interface',
    				);

    				$noResults = new WP_Query( $args );
    				while ($noResults->have_posts()) : $noResults->the_post();

            if ($langCode == 'en') {
                ?>
                <div class="search-no-result"><p><?php echo get_field('no_results_message_en') ?></p></div>
              <?php
            } else {
              ?>

              <div class="search-no-result"><p><?php echo get_field('no_results_message_de') ?></p></div>

            <?php
            }

            ?>
    			<?php endwhile;
    			wp_reset_query();

    		endif;
    		?>


      </div>
    </div>

	</div><!-- #primary -->
</article>

<?php get_footer(); ?>
