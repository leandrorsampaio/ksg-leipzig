<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */



 if ($langCode == 'en') {
     $languageSearchName = 'Search';
 } else {
     $languageSearchName = 'Suche';
 }



?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?><?php echo $languageURL; ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ); ?></span>
	</label>
	<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo $languageSearchName; ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><span class="screen-reader-text screen-reader-text-button"><?php echo _x( 'Search', 'submit button'); ?></span></button>
</form>
