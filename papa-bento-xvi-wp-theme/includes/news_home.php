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



?>



<article>
		<div class="page-header">

			<div class="full-width">
				<div class="article-width">
					<h1 class="page-title page-title-search">

						News

						</h1>






	    <!--News listing-->
	    	<?php
	    	$args = array(
			'posts_per_page' => -1,
			);
			//Starts the query for News posts from FEATURED category
			$article = new WP_Query( $args );
			while ($article->have_posts()) : $article->the_post();




			if ($languageCode == 'en') {
			 // ---------------- SINGLE NEWS
					$lang_title = 'title_en';

					$lang_content = $lang_content_en;
			} else {
					$lang_title = '';
					$lang_content = $lang_content_de;
			}


			$final_title = get_field_object($lang_title);
			$titleFeatured = $final_title['value'];

			$final_content = get_field_object($lang_content);
			$contentFeatured = $final_content['value'];



			?>

			<!--News card-->

			<a class="result-search-item" href="<?php echo the_permalink();?><?php echo $languageURL; ?>">
				<?php
				if ($language == 2) {
					echo "<h2>" . $titleFeatured . "</h2>";
					$text = mb_strimwidth($contentFeatured, 0, 300, '...');
					echo "<p class='result-search-item-text'>" . strip_tags($text) . "</p>";

				} else {
					echo "<h2>" . get_the_title() . "</h2>";
					$text = mb_strimwidth($contentFeatured, 0, 300, '...');
					echo "<p class='result-search-item-text'>" . strip_tags($text) . "</p>";


				}
				?>
			</a>

	        <!--End of News card-->

	    	<?php endwhile;
		      wp_reset_query(); ?>




				</div>
				</div>


				</div><!-- #primary -->
			</article>
