<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<div id="tribe-events-content" class="tribe-events-single  single-event-page-ksg">

<!-- 	<p class="tribe-events-back">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '&laquo; ' . esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' ), $events_label_plural ); ?></a>
	</p> -->

	<!-- Notices -->
	<?php tribe_the_notices() ?>


	<div class="tribe-events-schedule tribe-clearfix">
		<?php echo tribe_events_event_schedule_details( $event_id, '<h2>', '</h2>' ); ?>
		<?php if ( tribe_get_cost() ) : ?>
			<span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
		<?php endif; ?>
	</div>

	<!-- Event header -->
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		<!-- Navigation -->
		<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
			<ul class="tribe-events-sub-nav">
				<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
				<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
			</ul>
			<!-- .tribe-events-sub-nav -->
		</nav>
	</div>
	<!-- #tribe-events-header -->

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Event featured image, but exclude link -->
			<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>

			<!-- Event content -->



			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<!-- <div class="tribe-events-single-event-description tribe-events-content"> -->
				<?php // the_content(); ?>
			<!-- </div> -->
			<!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		</div> <!-- #post-x -->
		<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
	<?php endwhile; ?>

</div>















<div class="single-event-page-ksg-wrapper-blue">
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
        <h2>
		<span class="trans_de">Kalender</span><span class="trans_en">Calendar</span>
		</h2>

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
													<span class="month"><?php echo tribe_get_start_date( null, false, 'M' ); ?>
												</span>
											</p>
			                <p class="where">
												<?php
												if ($languageCode == 'en') {
														echo tribe_get_start_date( null, false, 'l \a\t g:i a' );
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
</div>