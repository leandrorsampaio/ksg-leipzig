<?php
/**
 * Papa Bento XVI WP Theme - functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom posts and templates tags.
  */

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
	add_theme_support( 'title-tag' );

/*
 * Enable support for Post Thumbnails on posts and pages.
 */
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 825, 510, true );
function disable_sourceset($sources) {
    return false;
   }
add_filter( 'wp_calculate_image_srcset', 'disable_sourceset' );

function remove_image_size_attributes( $html ) {
    return preg_replace( '/(width|height)="\d*"/', '', $html );
    }
    
// Remove image size attributes from post thumbnails
add_filter( 'post_thumbnail_html', 'remove_image_size_attributes' );

// Remove image size attributes from images added to a WordPress post
add_filter( 'image_send_to_editor', 'remove_image_size_attributes' );


/* Register navigation menu on primary location
*
*/
function register_menu() {
	register_nav_menu('main-menu',__( 'Main Menu' ));
}
add_action( 'init', 'register_menu' );
/*
 * Enable support for Post Formats.
 */
add_theme_support( 'post-formats', array(
	'aside', 'image', 'video', 'quote', 'link', 'gallery'
) );
/*
 * Enable support for custom logo.
 */
add_theme_support( 'custom-logo', array(
	'height'      => 248,
	'width'       => 248,
	'flex-height' => true,
) );

/* 
 * Enable and create Custom Post Types.
 * 
*/
add_action( 'init', 'register_cpt_featured' );
/*
 * Register a featured post type.
 */
function register_cpt_featured() {
	/* Register and edit the labels of featured post type. */
    $labels = array(
        'name' => _x('Featured', 'featured'),
        'singular_name' => _x('Image', 'image'),
        'add_new' => _x('Add new', 'image'),
        'add_new_item' => _x('Add new image', 'Image'),
        'edit_item' => _x('Edit image', 'Image'),
        'new_item' => _x('New image', 'Image'),
        'view_item' => _x('View image', 'Image'),
        'search_items' => _x('Search images', 'Image'),
        'not_found' => _x('No images found', 'Image'),
        'not_found_in_trash' => _x('No images found in Trash', 'Image'),
        'menu_name' => _x('Featured', 'Image'),
        );
    /* Set the args of featured post type.  */
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Carousel of images featured in home page',
        'supports' => array('thumbnail'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 2,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'capability_type' => 'post',
        'menu_icon'   => 'dashicons-format-gallery'
        );
    register_post_type('featured', $args);
}
add_action( 'init', 'register_cpt_interface' );
/*
 * Register interface post type
 */
function register_cpt_interface() {
	/* Register and edit the labels of interface post type. */
    $labels = array(
        'name' => _x('Interface', 'interface'),
        'singular_name' => _x('Item', 'item'),
        'add_new' => _x('Add new', 'item'),
        'add_new_item' => _x('Add new item', 'item'),
        'edit_item' => _x('Edit item', 'item'),
        'new_item' => _x('New item', 'item'),
        'view_item' => _x('View item', 'item'),
        'search_items' => _x('Search item', 'item'),
        'not_found' => _x('No itens found', 'item'),
        'not_found_in_trash' => _x('No itens found in Trash', 'item'),
        'menu_name' => _x('Interface', 'item'),
        );
    /* Set the args of interface post type.  */
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => '',
        'supports' => array('title', 'thumbnail', 'editor'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 1,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'capability_type' => 'post',
        'menu_icon'   => 'dashicons-welcome-widgets-menus'
        );
    register_post_type('interface', $args);
}
/*
Displays featured image column on admin post list page 
for the custom post type Featured.

	This function rewrites the HTML of the admin list page, with the given
	elements set withn the $columns variable.
	*/
	function custom_columns( $columns ) {
	    $columns = array(
	        'cb' => '<input type="checkbox" />',
	        'featured_image' => 'Image',
	        'title' => 'Title',
	        'comments' => '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>',
	        'date' => 'Date'
	     );
	    return $columns;
	}
	/*
	The filter adds our custom admin HTML 
	to the custom post type FEATURED.
	*/
	add_filter('manage_featured_posts_columns' , 'custom_columns');

	function custom_columns_data( $column, $post_id ) {
	    switch ( $column ) {
	    case 'featured_image':
	        the_post_thumbnail( 'thumbnail' );
	        break;
	    }
	}
	add_action( 'manage_featured_posts_custom_column' , 'custom_columns_data', 10, 2 ); 


/*
* Customize Login page and dashboard of Wordpress Admin 
*
*
* Change Logo at Login/Register Page
*/
function new_custom_login_logo() {
    echo '<style type="text/css"> h1 a { background-image: url(' . get_template_directory_uri() . '/imgs/logo.svg)!important;
    background-size: auto auto!important;
    width: 299px !important;
    height: 120px !important;
}
</style>';
}
add_action('login_head', 'new_custom_login_logo');

/* Remove default boxes in welcome panel
*
*/
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    // remove_action( 'welcome_panel', 'wp_welcome_panel' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
    remove_meta_box( 'woocommerce_dashboard_recent_reviews', 'dashboard', 'normal'); 
   
    add_meta_box('developer', 'Welcome to KSG!', 'dashboard_developer', 'dashboard', 'side', 'high');
}
/* Create a custom box in welcome panel
*
*/
function dashboard_developer() {
    echo 
    '<p>Welcome to the KSG website admin!</p>
    
     <p style="text-align: center">
     <img src="';
     echo bloginfo ('template_url');
     echo '/imgs/logo.svg">
     </p>';
}
//The function __return_false is a small built-in function that simply returns false. 
//It will stop WordPress from using default gallery style.
add_filter( 'use_default_gallery_style', '__return_false' );


function wpb_change_search_url() {
    if ( is_search() && ! empty( $_GET['s'] ) ) {
        wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
        exit();
    }   
}
add_action( 'template_redirect', 'wpb_change_search_url' );

/* Import the custom fields
*
*/


// if( function_exists('acf_add_local_field_group') ):

// acf_add_local_field_group(array(
//     'key' => 'group_5bbaba2221ed2',
//     'title' => '[Content]',
//     'fields' => array(
//         array(
//             'key' => 'field_5bbaba2cf767c',
//             'label' => 'Deutsche',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bbaba37f767d',
//             'label' => 'Content',
//             'name' => 'content_de',
//             'type' => 'wysiwyg',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'tabs' => 'all',
//             'toolbar' => 'full',
//             'media_upload' => 1,
//             'delay' => 0,
//         ),
//         array(
//             'key' => 'field_5bbaba44f767e',
//             'label' => 'English',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bbabafa7b3b3',
//             'label' => 'Title',
//             'name' => 'title_en',
//             'type' => 'text',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bbaba4cf767f',
//             'label' => 'Content',
//             'name' => 'content_en',
//             'type' => 'wysiwyg',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'tabs' => 'all',
//             'toolbar' => 'full',
//             'media_upload' => 1,
//             'delay' => 0,
//         ),
//     ),
//     'location' => array(
//         array(
//             array(
//                 'param' => 'post_type',
//                 'operator' => '==',
//                 'value' => 'post',
//             ),
//         ),
//         array(
//             array(
//                 'param' => 'page_template',
//                 'operator' => '==',
//                 'value' => 'default',
//             ),
//         ),
//         array(
//             array(
//                 'param' => 'post_type',
//                 'operator' => '==',
//                 'value' => 'tribe_events',
//             ),
//         ),
//     ),
//     'menu_order' => 0,
//     'position' => 'acf_after_title',
//     'style' => 'default',
//     'label_placement' => 'top',
//     'instruction_placement' => 'label',
//     'hide_on_screen' => array(
//         0 => 'the_content',
//         1 => 'excerpt',
//         2 => 'discussion',
//         3 => 'comments',
//         4 => 'send-trackbacks',
//     ),
//     'active' => 1,
//     'description' => '',
// ));

// acf_add_local_field_group(array(
//     'key' => 'group_5bba9df8ecf43',
//     'title' => '[Featured] Content',
//     'fields' => array(
//         array(
//             'key' => 'field_5bf1bc9f24cd7',
//             'label' => 'Responsive Image',
//             'name' => 'responsive_image',
//             'type' => 'image',
//             'instructions' => 'Upload the image optimazed for mobile.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'return_format' => 'array',
//             'preview_size' => 'medium',
//             'library' => 'all',
//             'min_width' => '',
//             'min_height' => '',
//             'min_size' => '',
//             'max_width' => '',
//             'max_height' => '',
//             'max_size' => '',
//             'mime_types' => '',
//         ),
//         array(
//             'key' => 'field_5bba9e15eb954',
//             'label' => 'Deutsche',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bba9e32eb955',
//             'label' => 'Title',
//             'name' => 'featured_title_de',
//             'type' => 'text',
//             'instructions' => 'The title of the featured item.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bba9e40eb956',
//             'label' => 'Description',
//             'name' => 'featured_description_de',
//             'type' => 'wysiwyg',
//             'instructions' => 'Text over the featured image. Leave blank for no description.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'tabs' => 'all',
//             'toolbar' => 'full',
//             'media_upload' => 1,
//             'delay' => 0,
//         ),
//         array(
//             'key' => 'field_5bba9e53eb957',
//             'label' => 'Link label',
//             'name' => 'featured_label_de',
//             'type' => 'text',
//             'instructions' => 'Label on the link button.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bba9e66eb958',
//             'label' => 'English',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bba9e71eb959',
//             'label' => 'Title',
//             'name' => 'featured_title_en',
//             'type' => 'text',
//             'instructions' => 'The title of the featured item.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bba9e7ceb95a',
//             'label' => 'Description',
//             'name' => 'featured_description_en',
//             'type' => 'wysiwyg',
//             'instructions' => 'Text over the featured image. Leave blank for no description.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'tabs' => 'all',
//             'toolbar' => 'full',
//             'media_upload' => 1,
//             'delay' => 0,
//         ),
//         array(
//             'key' => 'field_5bba9e86eb95b',
//             'label' => 'Link label',
//             'name' => 'featured_label_en',
//             'type' => 'text',
//             'instructions' => 'Label on the link button.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//     ),
//     'location' => array(
//         array(
//             array(
//                 'param' => 'post_type',
//                 'operator' => '==',
//                 'value' => 'featured',
//             ),
//         ),
//     ),
//     'menu_order' => 0,
//     'position' => 'acf_after_title',
//     'style' => 'default',
//     'label_placement' => 'top',
//     'instruction_placement' => 'label',
//     'hide_on_screen' => array(
//         0 => 'the_content',
//         1 => 'excerpt',
//         2 => 'discussion',
//         3 => 'comments',
//         4 => 'revisions',
//         5 => 'author',
//         6 => 'format',
//         7 => 'tags',
//         8 => 'send-trackbacks',
//     ),
//     'active' => 1,
//     'description' => '',
// ));

// acf_add_local_field_group(array(
//     'key' => 'group_5ba833fe8e6e5',
//     'title' => '[Featured] Link & Style',
//     'fields' => array(
//         array(
//             'key' => 'field_5b973d8ab9626',
//             'label' => 'Feature Link',
//             'name' => 'feature_link',
//             'type' => 'radio',
//             'instructions' => 'Set the page you would like to link with the featured image. For a image without link, choose "No link" option.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'choices' => array(
//                 'Internal link' => 'Internal link',
//                 'External link' => 'External link',
//                 'No link' => 'No link',
//             ),
//             'other_choice' => 0,
//             'save_other_choice' => 0,
//             'default_value' => '',
//             'layout' => 'vertical',
//             'allow_null' => 0,
//             'return_format' => 'value',
//         ),
//         array(
//             'key' => 'field_5b973eacb9627',
//             'label' => 'Internal link',
//             'name' => 'internal_link',
//             'type' => 'page_link',
//             'instructions' => 'Select the page you would like to link.',
//             'required' => 0,
//             'conditional_logic' => array(
//                 array(
//                     array(
//                         'field' => 'field_5b973d8ab9626',
//                         'operator' => '==',
//                         'value' => 'Internal link',
//                     ),
//                 ),
//             ),
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'post_type' => array(
//             ),
//             'allow_null' => 0,
//             'multiple' => 0,
//             'taxonomy' => array(
//             ),
//             'allow_archives' => 1,
//         ),
//         array(
//             'key' => 'field_5b973edbb9628',
//             'label' => 'External Link',
//             'name' => 'external_link',
//             'type' => 'text',
//             'instructions' => 'The complete address of the external page you would like to like, with http://. Example: http://www.google.com',
//             'required' => 0,
//             'conditional_logic' => array(
//                 array(
//                     array(
//                         'field' => 'field_5b973d8ab9626',
//                         'operator' => '==',
//                         'value' => 'External link',
//                     ),
//                 ),
//             ),
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => 'http://',
//             'prepend' => '',
//             'append' => '',
//             'formatting' => 'html',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5b973ab41839f',
//             'label' => 'Text Align',
//             'name' => 'text_align',
//             'type' => 'select',
//             'instructions' => 'Please select the align style for the text over the image. Default will be align left.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'choices' => array(
//                 'Left' => 'Left',
//                 'Right' => 'Right',
//                 'Center' => 'Center',
//             ),
//             'default_value' => array(
//             ),
//             'allow_null' => 0,
//             'multiple' => 0,
//             'ui' => 0,
//             'ajax' => 0,
//             'placeholder' => '',
//             'return_format' => 'value',
//         ),
//     ),
//     'location' => array(
//         array(
//             array(
//                 'param' => 'post_type',
//                 'operator' => '==',
//                 'value' => 'featured',
//             ),
//         ),
//     ),
//     'menu_order' => 0,
//     'position' => 'acf_after_title',
//     'style' => 'default',
//     'label_placement' => 'top',
//     'instruction_placement' => 'label',
//     'hide_on_screen' => array(
//         0 => 'the_content',
//         1 => 'excerpt',
//         2 => 'discussion',
//         3 => 'comments',
//         4 => 'revisions',
//         5 => 'slug',
//         6 => 'author',
//         7 => 'format',
//         8 => 'categories',
//         9 => 'tags',
//         10 => 'send-trackbacks',
//     ),
//     'active' => 1,
//     'description' => '',
// ));

// acf_add_local_field_group(array(
//     'key' => 'group_5ba833fea1796',
//     'title' => '[Footer]',
//     'fields' => array(
//         array(
//             'key' => 'field_5bbab550f2b5a',
//             'label' => 'Deutsche',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bbab72c1325b',
//             'label' => 'Newsletter text',
//             'name' => 'footer_newsletter_de',
//             'type' => 'text',
//             'instructions' => 'Short text about the newsletter.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bcd2d96ad138',
//             'label' => 'Newsletter form placeholder',
//             'name' => 'footer_placeholder_de',
//             'type' => 'text',
//             'instructions' => 'The text you want to show on the newsletter form.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => 'Type your e-mail address',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5b7e07e7be0b9',
//             'label' => 'Title',
//             'name' => 'footer_title_de',
//             'type' => 'text',
//             'instructions' => 'This is the name of the content displayed in the second column on footer.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5b7e0811be0bb',
//             'label' => 'Content',
//             'name' => 'footer_content_de',
//             'type' => 'wysiwyg',
//             'instructions' => 'Content displayed in the second column on footer.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'tabs' => 'all',
//             'toolbar' => 'basic',
//             'media_upload' => 1,
//             'delay' => 0,
//         ),
//         array(
//             'key' => 'field_5bbab573f2b5b',
//             'label' => 'English',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bbab6fc1325a',
//             'label' => 'Newsletter text',
//             'name' => 'footer_newsletter_en',
//             'type' => 'text',
//             'instructions' => 'Short text about the newsletter.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bcd2ccbad137',
//             'label' => 'Newsletter form placeholder',
//             'name' => 'footer_placeholder_en',
//             'type' => 'text',
//             'instructions' => 'The text you want to show on the newsletter form.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => 'Type your e-mail address',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bbab57cf2b5c',
//             'label' => 'Title',
//             'name' => 'footer_title_en',
//             'type' => 'text',
//             'instructions' => 'This is the name of the content displayed in the second column on footer.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bbab590f2b5d',
//             'label' => 'Content',
//             'name' => 'footer_content_en',
//             'type' => 'wysiwyg',
//             'instructions' => 'Content displayed in the second column on footer.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'tabs' => 'all',
//             'toolbar' => 'basic',
//             'media_upload' => 1,
//             'delay' => 0,
//         ),
//     ),
//     'location' => array(
//         array(
//             array(
//                 'param' => 'post',
//                 'operator' => '==',
//                 'value' => '19',
//             ),
//         ),
//     ),
//     'menu_order' => 0,
//     'position' => 'normal',
//     'style' => 'seamless',
//     'label_placement' => 'top',
//     'instruction_placement' => 'label',
//     'hide_on_screen' => array(
//         0 => 'permalink',
//         1 => 'the_content',
//         2 => 'excerpt',
//         3 => 'discussion',
//         4 => 'comments',
//         5 => 'revisions',
//         6 => 'slug',
//         7 => 'author',
//         8 => 'format',
//         9 => 'featured_image',
//         10 => 'categories',
//         11 => 'tags',
//         12 => 'send-trackbacks',
//     ),
//     'active' => 1,
//     'description' => '',
// ));

// acf_add_local_field_group(array(
//     'key' => 'group_5bd68d76a090d',
//     'title' => '[Footer] Links',
//     'fields' => array(
//         array(
//             'key' => 'field_5bd68d807864a',
//             'label' => 'Link 1',
//             'name' => 'footer_link_1',
//             'type' => 'page_link',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'post_type' => array(
//                 0 => 'page',
//             ),
//             'taxonomy' => '',
//             'allow_null' => 0,
//             'allow_archives' => 1,
//             'multiple' => 0,
//         ),
//         array(
//             'key' => 'field_5bd691938c169',
//             'label' => 'Link 2',
//             'name' => 'footer_link_2',
//             'type' => 'page_link',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'post_type' => array(
//                 0 => 'page',
//             ),
//             'taxonomy' => '',
//             'allow_null' => 0,
//             'allow_archives' => 1,
//             'multiple' => 0,
//         ),
//         array(
//             'key' => 'field_5bd691988c16a',
//             'label' => 'Link 3',
//             'name' => 'footer_link_3',
//             'type' => 'page_link',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'post_type' => array(
//                 0 => 'page',
//             ),
//             'taxonomy' => '',
//             'allow_null' => 0,
//             'allow_archives' => 1,
//             'multiple' => 0,
//         ),
//     ),
//     'location' => array(
//         array(
//             array(
//                 'param' => 'post',
//                 'operator' => '==',
//                 'value' => '19',
//             ),
//         ),
//     ),
//     'menu_order' => 0,
//     'position' => 'normal',
//     'style' => 'default',
//     'label_placement' => 'top',
//     'instruction_placement' => 'label',
//     'hide_on_screen' => array(
//         0 => 'permalink',
//         1 => 'the_content',
//         2 => 'excerpt',
//         3 => 'discussion',
//         4 => 'comments',
//         5 => 'revisions',
//         6 => 'slug',
//         7 => 'author',
//         8 => 'format',
//         9 => 'page_attributes',
//         10 => 'featured_image',
//         11 => 'categories',
//         12 => 'tags',
//         13 => 'send-trackbacks',
//     ),
//     'active' => 1,
//     'description' => '',
// ));

// acf_add_local_field_group(array(
//     'key' => 'group_5ba846149ce33',
//     'title' => '[Homepage] Custom Widget',
//     'fields' => array(
//         array(
//             'key' => 'field_5ba8494ba7340',
//             'label' => 'Image',
//             'name' => 'image',
//             'type' => 'image',
//             'instructions' => 'Upload the image you would like to display in the custom widget.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'return_format' => 'array',
//             'preview_size' => 'thumbnail',
//             'library' => 'all',
//             'min_width' => '',
//             'min_height' => '',
//             'min_size' => '',
//             'max_width' => '',
//             'max_height' => '',
//             'max_size' => '',
//             'mime_types' => '',
//         ),
//         array(
//             'key' => 'field_5ba847104f866',
//             'label' => 'Link',
//             'name' => 'link',
//             'type' => 'page_link',
//             'instructions' => 'Select the page you would like to link.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'post_type' => '',
//             'taxonomy' => '',
//             'allow_null' => 0,
//             'allow_archives' => 1,
//             'multiple' => 0,
//         ),
//         array(
//             'key' => 'field_5bb5fc8d6302d',
//             'label' => 'Deutsche',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5ba846b44f864',
//             'label' => 'Title',
//             'name' => 'widget_title_de',
//             'type' => 'text',
//             'instructions' => 'Title of the custom widget.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5ba846da4f865',
//             'label' => 'Description',
//             'name' => 'widget_description_de',
//             'type' => 'wysiwyg',
//             'instructions' => 'Text displayed on your custom widget in Homepage.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'tabs' => 'all',
//             'toolbar' => 'full',
//             'media_upload' => 1,
//             'delay' => 0,
//         ),
//         array(
//             'key' => 'field_5ba847774f867',
//             'label' => 'Link label',
//             'name' => 'widget_link_label_de',
//             'type' => 'text',
//             'instructions' => 'The label of the link you would like to display. Example: Learn more',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bb5fce56302e',
//             'label' => 'English',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bb5fd226302f',
//             'label' => 'Title',
//             'name' => 'widget_title_en',
//             'type' => 'text',
//             'instructions' => 'Title of the custom widget.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bb5fd3363030',
//             'label' => 'Description',
//             'name' => 'widget_description_en',
//             'type' => 'wysiwyg',
//             'instructions' => 'Text displayed on your custom widget in Homepage.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'tabs' => 'all',
//             'toolbar' => 'full',
//             'media_upload' => 1,
//             'delay' => 0,
//         ),
//         array(
//             'key' => 'field_5bb5fd4163031',
//             'label' => 'Link label',
//             'name' => 'widget_link_label_en',
//             'type' => 'text',
//             'instructions' => 'The label of the link you would like to display. Example: Learn more',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//     ),
//     'location' => array(
//         array(
//             array(
//                 'param' => 'post',
//                 'operator' => '==',
//                 'value' => '26',
//             ),
//         ),
//     ),
//     'menu_order' => 0,
//     'position' => 'normal',
//     'style' => 'default',
//     'label_placement' => 'top',
//     'instruction_placement' => 'label',
//     'hide_on_screen' => array(
//         0 => 'the_content',
//         1 => 'excerpt',
//         2 => 'comments',
//         3 => 'revisions',
//         4 => 'author',
//         5 => 'format',
//         6 => 'featured_image',
//         7 => 'categories',
//         8 => 'tags',
//         9 => 'send-trackbacks',
//     ),
//     'active' => 1,
//     'description' => '',
// ));

// acf_add_local_field_group(array(
//     'key' => 'group_5bc28b4d32837',
//     'title' => '[Homepage] Section Titles',
//     'fields' => array(
//         array(
//             'key' => 'field_5bc28bac0b456',
//             'label' => 'Deutsche',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bc28b660b455',
//             'label' => 'News Section Title',
//             'name' => 'news_section_title_de',
//             'type' => 'text',
//             'instructions' => 'The title for the section where the last news are displayed.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bc28bcd0b458',
//             'label' => 'Calendar Section Title',
//             'name' => 'calendar_section_title_de',
//             'type' => 'text',
//             'instructions' => 'The title for the section where the last events are displayed.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bc28bbc0b457',
//             'label' => 'English',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bc28be70b459',
//             'label' => 'News Section Title',
//             'name' => 'news_section_title_en',
//             'type' => 'text',
//             'instructions' => 'The title for the section where the last news are displayed.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bc28bf60b45a',
//             'label' => 'Calendar Section Title',
//             'name' => 'calendar_section_title_en',
//             'type' => 'text',
//             'instructions' => 'The title for the section where the last events are displayed.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//     ),
//     'location' => array(
//         array(
//             array(
//                 'param' => 'post',
//                 'operator' => '==',
//                 'value' => '26',
//             ),
//         ),
//     ),
//     'menu_order' => 0,
//     'position' => 'normal',
//     'style' => 'default',
//     'label_placement' => 'top',
//     'instruction_placement' => 'label',
//     'hide_on_screen' => '',
//     'active' => 1,
//     'description' => '',
// ));

// acf_add_local_field_group(array(
//     'key' => 'group_5ba833fea7764',
//     'title' => '[Homepage] Welcome Widget',
//     'fields' => array(
//         array(
//             'key' => 'field_5bb5fefa6465e',
//             'label' => 'Deutsche',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bc2769eaffe4',
//             'label' => 'Welcome Title',
//             'name' => 'welcome_title_de',
//             'type' => 'text',
//             'instructions' => 'The title of the Welcome widget.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5b7df80e68301',
//             'label' => 'Welcome Tagline',
//             'name' => 'welcome_tagline_de',
//             'type' => 'wysiwyg',
//             'instructions' => 'Welcome short text displayed in the main page.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'tabs' => 'all',
//             'toolbar' => 'basic',
//             'media_upload' => 0,
//             'delay' => 0,
//         ),
//         array(
//             'key' => 'field_5b7df85368302',
//             'label' => 'Welcome Text',
//             'name' => 'welcome_text_de',
//             'type' => 'wysiwyg',
//             'instructions' => 'Welcome text displayed in the main page.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'tabs' => 'all',
//             'toolbar' => 'basic',
//             'media_upload' => 0,
//             'delay' => 0,
//         ),
//         array(
//             'key' => 'field_5b7df9159abf7',
//             'label' => 'Welcome link',
//             'name' => 'welcome_link_de',
//             'type' => 'page_link',
//             'instructions' => 'Choose which page you would like to target after the welcome text.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'post_type' => array(
//                 0 => 'page',
//             ),
//             'taxonomy' => '',
//             'allow_null' => 0,
//             'allow_archives' => 1,
//             'multiple' => 0,
//         ),
//         array(
//             'key' => 'field_5b7dfa0d9abf8',
//             'label' => 'Link label',
//             'name' => 'welcome_link_label_de',
//             'type' => 'text',
//             'instructions' => 'Set the name you would like to display on the link. Example: More about us',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => 'More about us',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => 90,
//         ),
//         array(
//             'key' => 'field_5bb5ff806465f',
//             'label' => 'English',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bc276bdaffe5',
//             'label' => 'Welcome Title',
//             'name' => 'welcome_title_en',
//             'type' => 'text',
//             'instructions' => 'The title of the Welcome widget.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bb5ffaf64660',
//             'label' => 'Welcome Tagline',
//             'name' => 'welcome_tagline_en',
//             'type' => 'wysiwyg',
//             'instructions' => 'Welcome short text displayed in the main page.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'tabs' => 'all',
//             'toolbar' => 'basic',
//             'media_upload' => 0,
//             'delay' => 0,
//         ),
//         array(
//             'key' => 'field_5bb5ffbf64661',
//             'label' => 'Welcome Text',
//             'name' => 'welcome_text_en',
//             'type' => 'wysiwyg',
//             'instructions' => 'Welcome text displayed in the main page.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'tabs' => 'all',
//             'toolbar' => 'basic',
//             'media_upload' => 0,
//             'delay' => 0,
//         ),
//         array(
//             'key' => 'field_5bb5ffd064662',
//             'label' => 'Welcome link',
//             'name' => 'welcome_link_en',
//             'type' => 'page_link',
//             'instructions' => 'Choose which page you would like to target after the welcome text.',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'post_type' => array(
//                 0 => 'page',
//             ),
//             'taxonomy' => '',
//             'allow_null' => 0,
//             'allow_archives' => 1,
//             'multiple' => 0,
//         ),
//         array(
//             'key' => 'field_5bb5ffe164663',
//             'label' => 'Link label',
//             'name' => 'welcome_link_label_en',
//             'type' => 'text',
//             'instructions' => 'Set the name you would like to display on the link. Example: More about us',
//             'required' => 1,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => 'More about us',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => 90,
//         ),
//     ),
//     'location' => array(
//         array(
//             array(
//                 'param' => 'post',
//                 'operator' => '==',
//                 'value' => '26',
//             ),
//         ),
//     ),
//     'menu_order' => 0,
//     'position' => 'acf_after_title',
//     'style' => 'default',
//     'label_placement' => 'top',
//     'instruction_placement' => 'label',
//     'hide_on_screen' => array(
//         0 => 'permalink',
//         1 => 'the_content',
//         2 => 'excerpt',
//         3 => 'discussion',
//         4 => 'comments',
//         5 => 'revisions',
//         6 => 'slug',
//         7 => 'author',
//         8 => 'format',
//         9 => 'featured_image',
//         10 => 'categories',
//         11 => 'tags',
//         12 => 'send-trackbacks',
//     ),
//     'active' => 1,
//     'description' => '',
// ));

// acf_add_local_field_group(array(
//     'key' => 'group_5bf1e91361674',
//     'title' => '[Search results]',
//     'fields' => array(
//         array(
//             'key' => 'field_5bf1e99f4de7d',
//             'label' => 'Deutsche',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bf1e9be4de7e',
//             'label' => 'Page title with results',
//             'name' => 'page_title_de',
//             'type' => 'text',
//             'instructions' => 'The title of the search results page, when there is results.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bf1ea004de7f',
//             'label' => 'Page title with no results',
//             'name' => 'page_title_no_results_de',
//             'type' => 'text',
//             'instructions' => 'The title of the search results page, when there is no results.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bf1ea604de80',
//             'label' => 'No results message',
//             'name' => 'no_results_message_de',
//             'type' => 'textarea',
//             'instructions' => 'The message displayed when there\'s no results, so the user can search using another terms.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'maxlength' => '',
//             'rows' => '',
//             'new_lines' => '',
//         ),
//         array(
//             'key' => 'field_5bf1ea974de81',
//             'label' => 'English',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bf1eaa44de82',
//             'label' => 'Page title with results',
//             'name' => 'page_title_en',
//             'type' => 'text',
//             'instructions' => 'The title of the search results page, when there is results.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bf1eaaf4de83',
//             'label' => 'Page title with no results',
//             'name' => 'page_title_no_results_en',
//             'type' => 'text',
//             'instructions' => 'The title of the search results page, when there is no results.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bf1eabc4de84',
//             'label' => 'No results message',
//             'name' => 'no_results_message_en',
//             'type' => 'textarea',
//             'instructions' => 'The message displayed when there\'s no results, so the user can search using another terms.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'maxlength' => '',
//             'rows' => '',
//             'new_lines' => '',
//         ),
//     ),
//     'location' => array(
//         array(
//             array(
//                 'param' => 'post',
//                 'operator' => '==',
//                 'value' => '315',
//             ),
//         ),
//     ),
//     'menu_order' => 0,
//     'position' => 'acf_after_title',
//     'style' => 'default',
//     'label_placement' => 'top',
//     'instruction_placement' => 'label',
//     'hide_on_screen' => array(
//         0 => 'the_content',
//     ),
//     'active' => 1,
//     'description' => '',
// ));

// acf_add_local_field_group(array(
//     'key' => 'group_5bf583b00dbab',
//     'title' => '[Widget] Events',
//     'fields' => array(
//         array(
//             'key' => 'field_5bf583e397fde',
//             'label' => 'Deutsche',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bf583da97fdd',
//             'label' => 'Link label',
//             'name' => 'events_link_label_de',
//             'type' => 'text',
//             'instructions' => 'The label of the button that links to the Calendar page.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//         array(
//             'key' => 'field_5bf583fb97fdf',
//             'label' => 'English',
//             'name' => '',
//             'type' => 'tab',
//             'instructions' => '',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'placement' => 'top',
//             'endpoint' => 0,
//         ),
//         array(
//             'key' => 'field_5bf5840797fe0',
//             'label' => 'Link label',
//             'name' => 'events_link_label_en',
//             'type' => 'text',
//             'instructions' => 'The label of the button that links to the Calendar page.',
//             'required' => 0,
//             'conditional_logic' => 0,
//             'wrapper' => array(
//                 'width' => '',
//                 'class' => '',
//                 'id' => '',
//             ),
//             'default_value' => '',
//             'placeholder' => '',
//             'prepend' => '',
//             'append' => '',
//             'maxlength' => '',
//         ),
//     ),
//     'location' => array(
//         array(
//             array(
//                 'param' => 'post',
//                 'operator' => '==',
//                 'value' => '329',
//             ),
//         ),
//     ),
//     'menu_order' => 0,
//     'position' => 'normal',
//     'style' => 'default',
//     'label_placement' => 'top',
//     'instruction_placement' => 'label',
//     'hide_on_screen' => array(
//         0 => 'the_content',
//     ),
//     'active' => 1,
//     'description' => '',
// ));

// endif;
	
?>