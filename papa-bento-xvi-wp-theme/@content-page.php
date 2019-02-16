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
	include ('includes/in_programmer.php');

	// checks if its Calendar Page
	if( tribe_is_month() && !is_tax() ) { // Month View Page
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
<?php }

//if it's a different page than the Calendar

else { 
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
		<div class="article-width">
			<h1>
				<?php 
				//tests if language is english
				if ($language == 2) { 
					echo $final_title['value'];
				} else {
				//or if languague is deutsche
					the_title();
				} ?>
			</h1>
			<p><?php echo $final_content['value']; ?></p>
		</div>
	</div>
<!--End of Article post content-->

</article>


<?php }
?>