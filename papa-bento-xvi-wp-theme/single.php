<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Papa Bento XVI WordPress Theme
 */

get_header();
//include ('includes/in_programmer.php'); /* includes Programmer Module, with all the variables */ ?>


        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();

            /*
             * Include the post template for the content.
             */

            echo '<div class="single-wrapper">';


            get_template_part( 'content', get_post_format() );


            echo '</div>';


        // End the loop.
        endwhile;

        include ('includes/in_events.php');
        ?>

<?php get_footer(); ?>
