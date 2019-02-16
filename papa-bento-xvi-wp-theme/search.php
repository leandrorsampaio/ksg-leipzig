<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Papa Bento XVI WordPress Theme
 */

get_header();
global $search_language;
    $search_language = 1;
    //$search_languageGet = $_GET['lang'];
    $search_languageGet = 'de';

    if ($search_languageGet == 'en') {
        $search_language = 2; //EN
        $search_languageURL = '?lang=en';
    } else {
        $search_language = 1; //DE (default)
        $search_languageURL = '?lang=de';
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

        if ($search_language == 2) {
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

			<h1 class="page-title">
				Search Results
				<?php printf( __( 'for: %s'), '<span>' . get_search_query() . '</span>' ); ?>				
				</h1>

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

			<h1 class="page-title"><?php echo get_field('page_title_en') ?></h1>
			<?php endwhile;
			wp_reset_query(); ?>

		<?php endif; ?>
	</div><!-- .page-header -->

	<div id="primary" class="content-area">
		<?php
		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) : the_post(); 

				// $content = the_content();

				?>
				<a href="<?php echo the_permalink();?><?php echo $search_languageURL; ?>">
					<p>
					<h2><?php echo the_title(); ?></h2>
						Lorem ipsum dolor sit amet
					</p>
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
				while ($noResults->have_posts()) : $noResults->the_post(); ?>

			<p><?php echo get_field('no_results_message_en') ?></p>
			
			<?php endwhile;
			wp_reset_query(); 

			get_search_form();

		endif;
		?>

	</div><!-- #primary -->
</article>

<?php get_footer(); ?>
