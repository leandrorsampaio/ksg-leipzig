<?php
/**
 * The template that displays all the news
 *
 * Used for News Page
 *
 * @package WordPress
 * @subpackage Papa Bento XVI WordPress Theme
 *
 * Includes Programmer Module, with all the variables */
	include ('in_programmer.php');
?>

	    <!--News listing-->
	    	<?php
	    	$args = array(
			'posts_per_page' => -1,
			);
			//Starts the query for News posts from FEATURED category
			$article = new WP_Query( $args );
			while ($article->have_posts()) : $article->the_post();

				//includes Programmer Module, with all the variables
				include ('in_programmer.php');


				$final_content = get_field_object($lang_content);
				$contentFeatured = $final_content['value'];
			?>

			<!--News card-->

		        <a class="news__single <?php echo $news_class; ?>" href="<?php echo the_permalink();?><?php echo $languageURL; ?>">
		            <h2>
						<?php
						//tests if language is english
						if ($language == 2) {
							echo $final_title['value'];
						} else {
						//or if languague is deutsche
							the_title();
						} ?>
						<img class="arrow-right-news-icon" src="<?php bloginfo('template_url');?>/imgs/icon/arrow-right.svg">
						<!--//
						//
						//Colocar um if pra deixar a seta amarela quando tiver ocm a classe de destaque!
						//
						//-->
		            </h2>

		            <p><?php
		            	//get the content and set a character limit to 200 characters and displays "..." in the end */
		            echo mb_strimwidth($contentFeatured, 0, 200, "...");
		            ?></p>
		        </a>

	        <!--End of News card-->

	        	<hr>
	    	<?php endwhile;
		      wp_reset_query(); ?>
