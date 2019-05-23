<?php
/**
 * The default template for displaying content
 *
 * Used for article single
 *
 * @package WordPress
 * @subpackage Papa Bento XVI WordPress Theme
 *
 * Includes Programmer Module, with all the variables */
	//include ('includes/in_programmer.php');


	if (empty($_GET['lang'])) {
		$langCode = 'de';
	} else {
		$langCode = $_GET['lang'];
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




?>

<?php
	/* grab the url for the full size featured image */
		$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
 ?>

<article>

<?php //check if post thas a thumbnail
if ( has_post_thumbnail() ) { ?>

	<!--Hero slider-->
	<div class="hero article_hero" style="background-image: url('<?php echo esc_url($featured_img_url); ?>')"></div>
	<!--End of Hero slider-->

<?php } else { } ?>

<!--Article post content-->
	<div class="full-width">
		<div class="article-width-v2">


			<h1 class="title_general_all <?php if ( is_archive() ) { echo 'title_general_all-for-events-page'; } ?>">
				<?php
				//The title for Events Page
				if( tribe_is_month() && !is_tax() ) {

					//Calendar Section
					// Deutsche
					$calendar_section_title_de = 'calendar_section_title_de';
					// English
					$calendar_section_title_en = 'calendar_section_title_en';

					if ($languageCode == 'en') {
						// section titles
						$calendar_section = $calendar_section_title_en;
					} else {
						// section titles
						$calendar_section = $calendar_section_title_de;
					}

					// sections titles
					$final_calendar_section_title = get_field_object($calendar_section);
					$kalender_widget_title = get_field_object($calendar_section, 26);
					echo $kalender_widget_title['value'];
					    } else {

				//Pages in general
				//tests if language is english
				if ($languageCode == 'en') {
					echo $final_title['value'];
				} else {
				//or if languague is deutsche
					//get the id of current post
					global $wp_query;
					$id = $wp_query->post->ID;
					echo get_the_title($id);
				}
					    }
				?>
			</h1>
			<?php
			//check if is page News and displays the template
			if (is_page('news')) {
				include ('includes/temp_news.php');

			} else {

				echo $final_content['value'];
				echo the_content();
				// echo the_title();
			}
			?>
		</div>
	</div>
<!--End of Article post content-->

</article>
