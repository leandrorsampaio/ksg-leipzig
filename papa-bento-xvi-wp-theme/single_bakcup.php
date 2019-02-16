<?php
/* 
Single page code
/* Include WordPress header code
and other components
*/
	get_header();
	/* include ('includes/in_language.php'); /* includes Language */
	/* checks if have posts, and then starts the loop */
	    while (have_posts()) : the_post(); 
   	

	/* displays default template for single posts
	/* grab the url for the full size featured image */
        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
      ?>

    <!--Hero slider-->
    <div class="hero article_hero" style="background-image: url('<?php echo esc_url($featured_img_url); ?>')"></div>
    <!--End of Hero slider-->

    <!--Article post content-->
    <div class="full-width">
        <div class="article-width">
        	<h1><?php the_title();?></h1>
            <?php the_content();?> 
        </div>
    </div>
    <!--End of Article post content-->
    
    <!--Our next events section-->
    <section id="next_events_overview" class="full-width default_padding">
        <div class="grid-width">
            <h2>Our next events</h2>
            
            <!--Row of cards, overflow on mobile-->
            <div class="row row_margin">
                
                <!--Event card-->
                <div class="event_card" onclick="location.href='events.html';">
                    <div class="subcontainer">
                        <p class="day">24<span class="month">July</span></p>
                        <p class="where">Friday - 9am<br>Hotel Catholic di Berlin</p>
                        <p class="event_name">Heilige Messe</p>
                        <p class="event_description">A brief description of the event. Anything you can inform to convince people to come.</p>
                    </div>
                </div>
                <!--End of Event card-->
                
                <!--Event card-->
                <div class="event_card" onclick="location.href='events.html';">
                    <div class="subcontainer">
                        <p class="day">24<span class="month">July</span></p>
                        <p class="where">Friday - 9am<br>Hotel Catholic di Berlin</p>
                        <p class="event_name">Heilige Messe</p>
                        <p class="event_description">A brief description of the event. Anything you can inform to convince people to come.</p>
                    </div>
                </div>
                <!--End of Event card-->
                
                <!--Event card-->
                <div class="event_card" onclick="location.href='events.html';">
                    <div class="subcontainer">
                        <p class="day">24<span class="month">July</span></p>
                        <p class="where">Friday - 9am<br>Hotel Catholic di Berlin</p>
                        <p class="event_name">Heilige Messe</p>
                        <p class="event_description">A brief description of the event. Anything you can inform to convince people to come.</p>
                    </div>
                </div>
                <!--End of Event card-->
                
                <!--Event card-->
                <div class="event_card" onclick="location.href='events.html';">
                    <div class="subcontainer">
                        <p class="day">24<span class="month">July</span></p>
                        <p class="where">Friday - 9am<br>Hotel Catholic di Berlin</p>
                        <p class="event_name">Heilige Messe</p>
                        <p class="event_description">A brief description of the event. Anything you can inform to convince people to come.</p>
                    </div>
                </div>
                <!--End of Event card-->
                
            </div>
            <!--End of Row of cards, overflow on mobile-->
            
            <a class="more_events">See all events<img src="imgs/icon/arrow-right-yellow.svg"></a>
        </div>
    </section>
    <!--End of Our next events section-->

<?php 
    endwhile; 
	/* includes footer */
	get_footer(); ?>