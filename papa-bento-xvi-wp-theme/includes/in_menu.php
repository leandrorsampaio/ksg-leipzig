

<?php


if (empty($_GET['lang'])) {
	$langCode = 'de';
} else {
	$langCode = $_GET['lang'];
}

if ($langCode == 'en') {
    $language = 2; //EN
    $languageURL = '?lang=en';
    $languageCode = 'en';
    $flag = 'lang-uk.svg';
} else {
    $language = 1; //DE (default)
    $languageURL = '?lang=de';
    $languageCode = 'de';
    $flag = 'lang-de.svg';
}
include ('in_programmer.php');


//Start the loop of the post MENU - Menu (ID 1935) */
$args = array(
    'p' => 1935,
    'post_type' => 'interface'
);

$menuWidget = new WP_Query( $args );
while ($menuWidget->have_posts()) : $menuWidget->the_post();

// PART 1
$aboutus = 'menu_aboutus';
$aboutus_link = get_field($aboutus, false, false);
// PART 2
$groups = 'menu_groups';
$groups_link = get_field($groups, false, false);
// PART 3
$bottomlinks = 'menu_bottomlinks';
$bottomlinks_link = get_field($bottomlinks, false, false);

endwhile;
wp_reset_query();
?>


<div class="sidebar">

    <a id="menu-untoggle">
      <img src="<?php bloginfo('template_url');?>/imgs/icon/close.svg">
    </a>

    <a class="sidebar__top sidebar-item" href="<?php echo esc_url( home_url( '/' ) ) . $languageURL; ?>">
      <li>Homepage</li>
    </a>


    <a class="sidebar-item" href="<?php echo get_permalink($news) . $languageURL; ?>">
      <li>News</li>
    </a>

    <a class="sidebar-item" href="<?php echo esc_url( home_url( '/kalender' ) ) . $languageURL; ?>">
        <li>
          <?php
            //get field object PAGE_TITLE from the specific page ID
            $kalender_title = get_field_object('title_en', $kalender);
            //if language is English, displays the custom field
            if ($language == 2) {
              echo $kalender_title['value'];
            } else {
              //if is Deutsche, displays the page title
              echo get_the_title($kalender);
            }
          ?>
        </li>
      </a>

    <a class="sidebar-item"><li id="uberuns" style="cursor:pointer;">
    <?php
        //get field object PAGE_TITLE from the specific page ID
            $uberuns_title = get_field_object('title_en', $uberuns);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $uberuns_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($uberuns); } ?>
    </li></a>
    <ul class="sidebar-item" id="uberuns-child" style="display:none;">

    <?php 
    foreach( $aboutus_link as $url ): 
        
        if ($langCode == 'en') {

            if (get_field( 'title_en', $url )) {
                $lang_title = get_field( 'title_en', $url );
            } else {
                $lang_title = get_the_title($url);
            }
        } else {
            $lang_title = get_the_title($url);
        }

        echo '<a class="sidebar-item-sub" href="' . get_the_permalink($url) . $languageURL . '">';
        echo '<li class="child">';
        echo $lang_title;
        echo '</li>';
        echo '</a>';
    
    endforeach; 
    ?>

    </ul>

<script>
$("#uberuns").mouseup(function(){
	$('#uberuns-child').slideToggle( "fast" );
    $('#uberuns-child').toggleClass("active");
    $(this).toggleClass("active");
});
</script>

    <a class="sidebar-item"><li id="gemen" style="cursor:pointer;">
    <?php
        //get field object PAGE_TITLE from the specific page ID
            $gemeindeleben_title = get_field_object('title_en', $gemeindeleben);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $gemeindeleben_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($gemeindeleben); } ?>
    </li></a>

    <ul class="sidebar-item" id="gemen-child" style="display:none;">


<?php 
    foreach( $groups_link as $url ): 
        
        if ($langCode == 'en') {

            if (get_field( 'title_en', $url )) {
                $lang_title = get_field( 'title_en', $url );
            } else {
                $lang_title = get_the_title($url);
            }
        } else {
            $lang_title = get_the_title($url);
        }

        echo '<a class="sidebar-item-sub" href="' . get_the_permalink($url) . $languageURL . '">';
        echo '<li class="child">';
        echo $lang_title;
        echo '</li>';
        echo '</a>';
    
    endforeach; 
    ?>



    </ul>

    <script>
$("#gemen").mouseup(function(){
	$('#gemen-child').slideToggle( "fast" );
    $('#gemen-child').toggleClass("active");
    $(this).toggleClass("active");
});
</script>

<?php 
    foreach( $bottomlinks_link as $url ): 
        
        if ($langCode == 'en') {

            if (get_field( 'title_en', $url )) {
                $lang_title = get_field( 'title_en', $url );
            } else {
                $lang_title = get_the_title($url);
            }
        } else {
            $lang_title = get_the_title($url);
        }

        echo '<a class="sidebar-item" href="' . get_the_permalink($url) . $languageURL . '">';
        echo '<li>';
        echo $lang_title;
        echo '</li>';
        echo '</a>';
    
    endforeach; 
    ?>




    <span class="sidebar-item">
        <li class="sidebar-item-li">
          <div class="sidebar-item-li-all">
            <div class="sidebar-item-li-wrapper">
                <a class="sidebar-item-li-wrapper-link" href="?lang=de"><img src="<?php bloginfo('template_url');?>/imgs/flagmenu_de.png" />Deutsch</a>
            </div>
            <div class="sidebar-item-li-wrapper">
                <a class="sidebar-item-li-wrapper-link" href="?lang=en"><img src="<?php bloginfo('template_url');?>/imgs/flagmenu_uk.png" />English</a>
            </div>
          <div>
        </li>
    </span>





</div>
