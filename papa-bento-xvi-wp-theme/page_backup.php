<?php
/* 
Single page code
/* Include WordPress header code
and other components
*/
	get_header();
	/* include ('includes/in_language.php'); /* includes Language */
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the main Calendar page template 
			if (is_page('kalender')) {
			include('templates/kalender.php');
		}

			// Include the events single
			else if (is_singular('tribe_events')) {
			include('templates/single-kalender.php');
		} 
				else { }


		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
