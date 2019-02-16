<?php
/* 
Main page code
*/

/* Include WordPress header code
and other components
*/
	get_header();
	/* include ('includes/in_language.php'); /* includes Language */

?>


<!--Welcome section-->

<?php 
	/* includes hero */
	include ('includes/in_hero.php'); 
	/* Start the loop of the post Interface - Home (ID 26) */
	$args = array(
		'p' => 26,
		'post_type' => 'interface'
		);
	$home = new WP_Query( $args );
	while ($home->have_posts()) : $home->the_post(); ?>

		<section id="welcome" class="grid-width">
		    <div class="col48 title_text">
		        <h1>Welcome</h1>
		        <p><?php the_field('welcome_tagline'); ?></p>
		    </div>
		    <div class="col48 welcome_text">
		    	<?php the_field('welcome_text'); ?>
		        <a href="<?php the_field('welcome_link'); ?>"><?php the_field ('welcome_link_label'); ?> 
		        	<img src="<?php bloginfo('template_url');?>/imgs/icon/arrow-right.svg">
		    	</a>
		    </div>
		</section>

<?php 
	endwhile;
	wp_reset_query(); 
?>
<!--End of Welcome section-->

<!--News section-->
	<section id="news" class="grid-width default_padding">
	    <div class="col48">
	        <h1>News</h1>
	    </div>

	    <!--News listing-->
	    <div class="col48" style="position: relative">
	    	<?php
			/*Starts the query for News posts from FEATURED category
			Displays 2 posts fixed in the main page
			 */
			$args = array(
				'posts_per_page' => 2,
				'category_name' => 'featured'
				);
			$article = new WP_Query( $args );
			while ($article->have_posts()) : $article->the_post();
				$content = get_the_content();
			?>
	        <!--News card-->
	        <a class="news_link news_feature" href="<?php echo the_permalink();?>">
	            <h2><?php echo the_title(); ?><img src="<?php bloginfo('template_url');?>/imgs/icon/arrow-right.svg"></h2>

	            <p><?php 
	            	/* get the content and set a character limit to 200 characters and displays "..." in the end */
	            echo mb_strimwidth($content, 0, 200, "..."); 

	            ?></p>
	        </a>
	        <!--End of News card-->
	        <hr>
	    <?php endwhile;
		      wp_reset_query(); ?> <!-- end of Featured posts -->

		<!-- Lists default posts -->
			<?php
			/*Starts the query for News posts
			Displays 3 posts in the main page
			 */
			$args = array(
				'posts_per_page' => 3,
				'category__not_in' => 3,
				);
			$article = new WP_Query( $args );
			while ($article->have_posts()) : $article->the_post();
				$content = get_the_content();
			?>
	        <!--News card-->
	        <a class="news_link" href="<?php echo the_permalink();?>">
	            <h2><?php echo the_title(); ?><img src="<?php bloginfo('template_url');?>/imgs/icon/arrow-right.svg"></h2>

	            <p><?php 
	            	/* get the content and set a character limit to 200 characters and displays "..." in the end */
	            echo mb_strimwidth($content, 0, 200, '...'); ?></p>
	        </a>
	        <!--End of News card-->
	        <hr>
	    <?php endwhile;
		      wp_reset_query(); ?>
	    </div> <!-- End of News listing-->
	</section> <!-- End of News Section -->

	<?php include ('includes/in_events.php'); ?>



 	<section id="new_here" class="full-width default_padding">
        <div class="grid-width">
            <div class="card">
            	<?php
         	/* Start the loop of the post Interface - Home (ID 26) */
			$args = array(
				'p' => 26,
				'post_type' => 'interface'
				);
			$homeWidget = new WP_Query( $args );
			while ($homeWidget->have_posts()) : $homeWidget->the_post();
				/* get image field */
				$image = get_field('image'); ?>
                <img class="left-img" src="<?php echo $image['url']; ?>" />
                <div class="container">
                	<div class="subcontainer">
	                    <h2><?php echo the_field('title');?></h2>
	                    <p><?php echo the_field('description');?></p>
	                    <a href="<?php echo the_field('link');?>"><?php echo the_field('link_label');?><img src="<?php bloginfo('template_url');?>/imgs/icon/arrow-right.svg"></a>
               		</div>
            	</div>
            </div>
        </div>
    </section>
  <?php 
	endwhile;
	wp_reset_query(); 
?>

	<?php /* includes footer */

	get_footer(); ?>

