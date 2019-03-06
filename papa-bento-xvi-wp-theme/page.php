<?php
/**
 * The template for displaying all pages
 *
 * @package WordPress
 * @subpackage Papa Bento XVI WordPress Theme
 */

get_header();
//include ('includes/in_programmer.php'); /* includes Programmer Module, with all the variables */
 ?>

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();


      $postid = get_the_ID();

      if ($postid != 451) {
        // Include the page content template.
  			get_template_part( 'content', 'page');
      } else {
        include ('includes/news_home.php');
      }


		// End the loop.
		endwhile;

		//Displays the Events Widget in all the pages, except the Events Single and the Agenda Page
		if( tribe_is_event() && is_single() || is_post_type_archive() ) {
		} else {
			include ('includes/in_events.php');
		}
		?>

<?php get_footer(); ?>
