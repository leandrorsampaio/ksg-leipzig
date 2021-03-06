<?php
/* Query of Events articles
Includes Programmer Module, with all the variables */
	include ('in_programmer.php');

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


	//content
	$final_title = get_field_object($lang_title);
	$final_content = get_field_object($lang_content);

	//Calendar Section

	// Deutsche
	$calendar_section_title_de = 'calendar_section_title_de';
	$calendar_link_label_de = 'events_link_label_de';
	// English
	$calendar_section_title_en = 'calendar_section_title_en';
	$calendar_link_label_en = 'events_link_label_en';

	if ($languageCode == 'en') {
		// section titles
		$calendar_section = $calendar_section_title_en;
		//See more label
		$seeMore = $calendar_link_label_en;
	} else {
		// section titles
		$calendar_section = $calendar_section_title_de;
		//See more label
		$seeMore = $calendar_link_label_de;
	}

	// sections titles
	$final_calendar_section_title = get_field_object($calendar_section);


	?>

<!--Our next events section-->
<section id="next_events_overview" class="full-width default_padding">
    <div class="grid-width">
        <h2><?php $kalender_widget_title = get_field_object($calendar_section, $homeInterface);
        echo $kalender_widget_title['value']; ?></h2>

        <!--Row of cards, overflow on mobile-->
    <div class="row row_margin">
			<?php
			// Ensure the global $post variable is in scope
			global $post;

/*
*------------------------------------
*--------- QUERY EVENTS  ------------
*------------------------------------
*
* Creation of the query EVENTS, that builds the Events widget
*
* When displayed in the Home page, the query won't use taxonomies, so the last 4 events will show. When inside of a single page, the events will be shown by custom taxonomy, so the events will have the same category as the current post.
* The taxonomy is the cat_slug variable.
*
If is a page, the custom taxonomy has the same slug
of the parent page. The taxonomy is the parent_slug variable.
*/


		if (is_page(array(453, 455, 457)))  {

		    $queryEvents = tribe_get_events( array(
		                'posts_per_page' => 4,
										'start_date' => date( 'Y-m-d H:i:s' )
		                ) );

		} elseif (is_page() && $post->post_parent ) {


			global $post;
	    $post_slug_new = $post->post_name;


			$queryEvents = tribe_get_events( array(
				'posts_per_page' => 4,
				'start_date' => date( 'Y-m-d H:i:s' ),
                'tax_query' => array(
                        array (
                            'taxonomy' => 'tribe_events_cat',
                            'field' => 'slug',
                            'terms' => $post_slug_new
												)
                    ),
				) );


} else {

	$queryEvents = tribe_get_events( array(
							'posts_per_page' => 4,
							'start_date' => date( 'Y-m-d H:i:s' )
							) );


}






if($queryEvents) {
				foreach ( $queryEvents as $post ) {
					setup_postdata( $post );


					//$content = $final_content['value'];

					//tests if language is english

						if ($language == 2) {
							$title_english = get_field_object($page_title_en, $post->ID);
							$title = $title_english['value'];

							$content_english = get_field_object($lang_content_en, $post->ID);
							$content = $content_english['value'];

						} else {
						//or if languague is deutsche
							$title = $post->post_title;

							$content_deutsch = get_field_object($lang_content_de, $post->ID);
							$content = $content_deutsch['value'];
						}

					?>
					<!--Event card-->
		            <div class="event_card" onclick="location.href='<?php echo the_permalink();?><?php echo $languageURL; ?>';">
		            	<div class="subcontainer">
			                <p class="day">
												<?php echo tribe_get_start_date( null, false, 'j' ); ?>.
													<span class="month">
														<span class="card_month_de_<?php echo tribe_get_start_date( null, false, 'm' ); ?>">
															<?php echo tribe_get_start_date( null, false, 'M' ); ?>
														</span>
													</span>
											</p>
			                <p class="where">
												<?php
												if ($languageCode == 'en') {
														echo '<span class="card_where_en_' . tribe_get_start_date( null, false, 'l' ) . '">' . tribe_get_start_date( null, false, 'l' ) . '</span> ' . tribe_get_start_date( null, false, '\a\t g:i a' );
												} else {
														echo tribe_get_start_date( null, false, 'l \u\m H:i' );
														echo ' Uhr';
												}
												?>
												<br>
												<?php echo tribe_get_venue ();?>
											</p>
			                <p class="event_name">
												<?php echo $title; ?>
											</p>
			                <span class="event_description">
												<?php
												//$text = mb_strimwidth($content, 0, 90, '...');
												//echo strip_tags($text);
												?>
											</span>
		            	</div>
		        	</div>
		            <!--End of Event card-->
		            <?php
		        }
} else {

	if ($languageCode == 'en') {
	echo '<p class="zeroevents">' . 'Sorry. There is no events for this category.' . '</p>';
	} else {
	echo '<p class="zeroevents">' . 'Entschuldigung. Für diese Kategorie sind keine Veranstaltungen vorhanden.' . '</p>';
	}

}
						?>

        </div>
        <!--End of Row of cards, overflow on mobile-->

         <a class="more_events" href="<?php echo esc_url( home_url( '/kalender' ) ) . $languageURL; ?>">

			<?php $seeMoreLabel = get_field_object($seeMore, $eventsWidget);
			    echo $seeMoreLabel['value']; ?>

         	<img src="<?php bloginfo('template_url');?>/imgs/icon/arrow-right-yellow.svg"></a>
    </div>
</section>
<!--End of Our next events section-->
