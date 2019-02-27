<?php
?>
<!--Hero slider-->

<div class="hero">
<?php

	/* Start the loop for Featured custom post */
	$args = array(
		'post_type' => 'featured',
		'posts_per_page' => -1
		);
	$hero = new WP_Query( $args );
	while ($hero->have_posts()) : $hero->the_post();
	//includes Programmer Module, with all the variables



	/////////////////////
	///////// Hero Featured
	/////////////////////

	global $hero_language;
	$hero_language = 1;
	$hero_languageGet = $_GET['lang'];

	if ($hero_languageGet == 'en') {
			$hero_language = 2; //EN
			$hero_languageURL = '?lang=en';
	} else {
			$hero_language = 1; //DE (default)
			$hero_languageURL = '?lang=de';
	}

	//Deutsche
	$featured_title_de = 'featured_title_de';
	$featured_description_de = 'featured_description_de';
	$featured_label_de = 'featured_label_de';
	//English
	$featured_title_en = 'featured_title_en';
	$featured_description_en = 'featured_description_en';
	$featured_label_en = 'featured_label_en';

	//
	// Set the right ID to the current language
	if ($hero_language == 2) {
	    //hero - featured
	    $featured_title = $featured_title_en;
	    $featured_description = $featured_description_en;
	    $featured_label = $featured_label_en;
	} else {
	    //hero - featured
	    $featured_title = $featured_title_de;
	    $featured_description = $featured_description_de;
	    $featured_label = $featured_label_de;
	}

	//hero - featured
	$final_featured_title = get_field_object($featured_title);
	$final_featured_description = get_field_object($featured_description);
	$final_featured_label = get_field_object($featured_label);

	/* Conditional logif for the featured image */
	/* Check if there's a responsive image on the custom field and gets its url*/
	if( get_field('responsive_image') ) {
		$responsive_image = get_field('responsive_image');
		$responsive_url = $responsive_image['url'];
	} else {
	/* If there is not a responsive image, the original image will show */
		$responsive_url = get_the_post_thumbnail_url(get_the_ID(),'full');
	}
	/*get the thumbnail url for the Desktop image*/
 	$desktop_url = get_the_post_thumbnail_url(get_the_ID(),'full');


	/* Conditional Logic for the link url */
	/* If selected option is Internal Link */
	if ( get_field('feature_link') == 'Internal Link' ) {
		$link_url = get_field('internal_link');
	}
	/* If selected option is External Link */
	elseif ( get_field('feature_link') == 'External Link' ) {
		$link_url = get_field('external_link');
 	}
	/* If selected option is No Link */
	elseif ( get_field('feature_link') == 'No Link' ) {
		$link_url = '';
 	}

 	/* Conditional logic for the texts align
 	/* Get align preference and set the class to be displayed*/
 	if ( get_field('text_align') == 'Right' ) {
		$align_class = 'hero-right';
	}
	/* If selected option is External Link */
	elseif ( get_field('text_align') == 'Center' ) {
		$align_class = 'hero-center';
 	}
 	/* If selected option is External Link */
	elseif ( get_field('text_align') == 'Left' ) {
		$align_class = ' ';
	 }


	//  IMAGE GET RETURN TO THE SLIDER
	//  echo $img_url;

 ?>

			<div class="hero__inner">
				<img class="bg desktop_only" src="<?php echo $desktop_url; ?>" />
				<img class="bg mobile_only" src="<?php echo $responsive_url; ?>" />
				<div class="grid-width">
					<!--Here goes the center or right class so the hero aligns as the user wants to-->
					<div class="container <?php echo $align_class;?>">
						<h1><?php echo $final_featured_title['value']; ?></h1>
						<p><?php echo $final_featured_description['value']; ?></p>
						<a class="hero__inner__a">
							<?php echo $final_featured_label['value']; ?>

							<img class="desktop_only" src="<?php bloginfo('template_url');?>/imgs/icon/arrow-right-white.svg">
							<img class="mobile_only" src="<?php bloginfo('template_url');?>/imgs/icon/arrow-right.svg">
						</a>
					</div>
				</div>
				<a class="hero__link" href="<?php echo $link_url; ?><?php echo $languageURL;?>"></a>
		</div>

	<?php
		endwhile;
		wp_reset_query();
?>
</div>

<script>
var slider = tns({
	container: '.hero',
	mode: 'carousel',
	axis: 'horizontal',
	items: 1,
    slideBy: 'page',
	autoplay: true,
	controls: 'true',
	nav: 'true',
	arrowKeys: 'true',
	touch: 'true',
	controlsText: ["<img src='<?php bloginfo('template_url'); ?>/imgs/icon/chevron-white.svg' />", "<img src='<?php bloginfo('template_url'); ?>/imgs/icon/chevron-white.svg' />"],
  });
</script>
<!--End of Hero slider-->
