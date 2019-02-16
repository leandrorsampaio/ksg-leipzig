<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @package WordPress
 * @subpackage Papa Bento XVI WP Theme 2.0
 * @since Papa Bento XVI WP Theme 1.0
 */



if (isset($_GET['lang'])) {
  $langCode = $_GET['lang'];
} else {
 	$addressRedirec = 'Location: ' . get_bloginfo('url') . '/?lang=de';
	header($addressRedirec);
	die();
}

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







/* Include WordPress header code and other components */
get_header();

//includes Programmer Module, with all the variables
include ('includes/in_programmer.php');


//
//
//
if ( have_posts() ) :

endif;

?>




<?php
	// includes hero
	include ('includes/in_hero.php');
?>




<!--Welcome section-->
<?php
	// Start the loop of the post Interface - Home (ID 26)
	$args = array(
		'p' => 26,
		'post_type' => 'interface'
		);

	$home = new WP_Query( $args );
	while ($home->have_posts()) : $home->the_post();


	/////////////////////
	///////// Welcome
	/////////////////////

	// Deutsche
	$welcome_title_de = 'welcome_title_de';
	$welcome_tagline_de = 'welcome_tagline_de';
	$welcome_text_de = 'welcome_text_de';
	$welcome_link_de = 'welcome_link_de';
	$welcome_link_label_de = 'welcome_link_label_de';
	// English
	$welcome_title_en = 'welcome_title_en';
	$welcome_tagline_en = 'welcome_tagline_en';
	$welcome_text_en = 'welcome_text_en';
	$welcome_link_en = 'welcome_link_en';
	$welcome_link_label_en = 'welcome_link_label_en';

	if ($langCode == 'en') {
		// welcome widget
		$welcome_title = $welcome_title_en;
		$welcome_tagline = $welcome_tagline_en;
		$welcome_text = $welcome_text_en;
		$welcome_link = $welcome_link_en;
		$welcome_link_label = $welcome_link_label_en;
    $languageURL = '?lang=en';
	} else {
		//welcome widget
		$welcome_title = $welcome_title_de;
		$welcome_tagline = $welcome_tagline_de;
		$welcome_text = $welcome_text_de;
		$welcome_link = $welcome_link_de;
		$welcome_link_label = $welcome_link_label_de;
    $languageURL = '?lang=de';
	}

	//welcome widget
	$final_welcome_title = get_field_object($welcome_title);
	$final_welcome_tagline = get_field_object($welcome_tagline);
	$final_welcome_text = get_field_object($welcome_text);
	$final_welcome_link = get_field_object($welcome_link);
	$final_welcome_link_label = get_field_object($welcome_link_label);

	?>

	<section id="welcome" class="grid-width">
	    <div class="col48 title_text">
	        <h1><?php echo $final_welcome_title['value']; ?></h1>
	        <p><?php echo $final_welcome_tagline['value']; ?></p>
	    </div>
	    <div class="col48 welcome_text">
	    	<?php echo $final_welcome_text['value']; ?>
	        <a href="<?php echo $final_welcome_link['value']; ?><?php echo $languageURL;?>"><?php echo $final_welcome_link_label['value']; ?>
	        	<img src="<?php bloginfo('template_url');?>/imgs/icon/arrow-right.svg">
	    	</a>
	    </div>
	</section>
	<!--End of Welcome section-->




	<!--News section-->
	<section id="news" class="grid-width default_padding">
		<div class="col48">

			<?php
			/////////////////////
			///////// CALENDAR & NEWS
			/////////////////////



			// Deutsche
			$news_section_title_de = 'news_section_title_de';
			$calendar_section_title_de = 'calendar_section_title_de';
			// English
			$news_section_title_en = 'news_section_title_en';
			$calendar_section_title_en = 'calendar_section_title_en';

			if ($langCode == 'en') {
				// section titles
				$news_section_title = $news_section_title_en;
				$calendar_section = $calendar_section_title_en;
			} else {
				// section titles
				$news_section_title = $news_section_title_de;
				$calendar_section = $calendar_section_title_de;
			}

			// sections titles
			$final_news_section_title = get_field_object($news_section_title);
			$final_calendar_section_title = get_field_object($calendar_section);

			?>


	    <h1>
				<?php echo $final_news_section_title['value']; ?>
			</h1>

		</div>

	  <?php
			endwhile;
			wp_reset_query();
		?>


	  <!--News listing-->

	  <div class="col48" style="position: relative">
	    	<?php
		    	//check if there's posts from FEATURED category
		    	if (get_category('3')->category_count > 0) {

		    		//set the CSS class to Featured
		    		$news_class = 'news_feature';
		    		$arrowImage = 'arrow-right-yellow.svg';

	    		} else {

		    		//set the CSS class to normal post
		    		$news_class = ' ';
		    		$arrowImage = 'arrow-right.svg';

	    		}


					$argsnews = array(
						'posts_per_page' => -1,
						'category_name' => 'featured'
					);

					//Starts the query for News posts from FEATURED category
					$article = new WP_Query( $argsnews );
					while ($article->have_posts()) : $article->the_post();

						$lang_content_de ='content_de';
						$lang_title_en = 'title_en';
						$lang_content_en = 'content_en';


						if ($langCode == 'en') {
					    // ---------------- SINGLE NEWS
					    $lang_title = get_field($lang_title_en);
			    		$lang_content = $lang_content_en;
						} else {
			    		// ---------------- SINGLE NEWS
              $lang_title = get_the_title();
			    		$lang_content = $lang_content_de;
						}

						$contentFeatured = get_field($lang_content);

			?>

			<!--News card-->

      <a class="news_link <?php echo $news_class; ?>" href="<?php echo the_permalink();?><?php echo $languageURL; ?>">
        <h2>
					<?php
					//tests if language is english
						if ($langCode == 'en') {
							//echo $lang_title['value'];
						} else {
							//or if languague is deutsche
							//the_title();
						}

            echo $lang_title;
					?>
					<img src="<?php bloginfo('template_url');?>/imgs/icon/<?php echo $arrowImage;?>">
					<!-- Colocar um if pra deixar a seta amarela quando tiver ocm a classe de destaque!-->
        </h2>

        <?php
        	//get the content and set a character limit to 200 characters and displays "..." in the end */
          echo '<p>' . mb_strimwidth($contentFeatured, 0, 100, "...") . '</p>';
        ?>
      </a>

      <!--End of News card-->

	    <hr>

			<?php
				endwhile;
	      wp_reset_query();
			?>


		</div> <!-- End of News listing-->
	</section> <!-- End of News Section -->










	<!-- Events section -->
	<?php
	//includes events widget with last 4 events
	include ('includes/in_events.php');
	?>
	<!-- End of Events section -->


	<!-- Image and Text Widget section -->
	<section id="new_here" class="full-width default_padding">
  	<div class="grid-width">
    	<div class="card">


      	<?php
        	//Start the loop of the post Interface - Home (ID 26) */
					$args = array(
						'p' => 26,
						'post_type' => 'interface'
					);

					$homeWidget = new WP_Query( $args );
					while ($homeWidget->have_posts()) : $homeWidget->the_post();


					/////////////////////
					///////// Widget
					/////////////////////

					if ($langCode == 'en') {
							$homepage_language = 2; //EN
							$homepage_languageURL = '?lang=en';
					} else {
							$homepage_language = 1; //DE (default)
							$homepage_languageURL = '?lang=de';
					}

					//Deutsche
					$widget_title_de = 'widget_title_de';
					$widget_description_de = 'widget_description_de';
					$widget_link_label_de = 'widget_link_label_de';

					//English
					$widget_title_en = 'widget_title_en';
					$widget_description_en = 'widget_description_en';
					$widget_link_label_en = 'widget_link_label_en';

					if ($langCode == 'en') {
						//custom widget
						$widget_title = $widget_title_en;
						$widget_description = $widget_description_en;
						$widget_link_label = $widget_link_label_en;
					} else {
						//custom widget
						$widget_title = $widget_title_de;
						$widget_description = $widget_description_de;
						$widget_link_label = $widget_link_label_de;
					}

					//custom widget
					$final_widget_title = get_field_object($widget_title);
					$final_widget_description = get_field_object($widget_description);
					$final_widget_link_label = get_field_object($widget_link_label);

					// get image field
					$image = get_field('image');

				?>

        <img class="left-img" src="<?php echo $image['url']; ?>" />

        <div class="container">
        	<div class="subcontainer">
	        	<h2><?php echo $final_widget_title['value']; ?></h2>
	          <p><?php echo $final_widget_description['value']; ?></p>
	          <a href="<?php echo the_field('link');?><?php echo $languageURL; ?>">
								<?php echo $final_widget_link_label['value']; ?>
								<img src="<?php bloginfo('template_url');?>/imgs/icon/arrow-right.svg">
						</a>
          </div>
        </div>


				<?php
					endwhile;
					wp_reset_query();
				?>


      </div>
    </div>
  </section>

	<!-- End of Image and Text Widget section -->









<?php
/* Include footer */
get_footer(); ?>
