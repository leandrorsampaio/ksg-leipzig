

<?php
$langCode = $_GET['lang'];

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

        <a class="sidebar-item-sub" href="<?php echo get_permalink($uberuns) . $languageURL; ?>">
            <li class="child"><?php
        //get field object PAGE_TITLE from the specific page ID
            $uberuns_title = get_field_object('title_en', $uberuns);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $uberuns_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($uberuns); } ?></li></a>

        <a class="sidebar-item-sub" href="<?php echo get_permalink($personen) . $languageURL; ?>">
            <li class="child">
            <?php
        //get field object PAGE_TITLE from the specific page ID
            $personen_title = get_field_object('title_en', $personen);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $personen_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($personen); } ?></li></a>

        <a class="sidebar-item-sub" href="<?php echo get_permalink($unsere) . $languageURL; ?>">
            <li class="child">
            <?php
        //get field object PAGE_TITLE from the specific page ID
            $unsere_title = get_field_object('title_en', $unsere);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $unsere_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($unsere); } ?></li></a>
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
        <a class="sidebar-item-sub" href="<?php echo get_permalink($gemeindeleben) . $languageURL; ?>">
            <li class="child"><?php
        //get field object PAGE_TITLE from the specific page ID
            $gemeindeleben_title = get_field_object('title_en', $gemeindeleben);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $gemeindeleben_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($gemeindeleben); } ?></li></a>

        <a class="sidebar-item-sub" href="<?php echo get_permalink($heiligeMesse) . $languageURL; ?>">
            <li class="child"><?php
        //get field object PAGE_TITLE from the specific page ID
            $heiligeMesse_title = get_field_object('title_en', $heiligeMesse);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $heiligeMesse_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($heiligeMesse); } ?></li></a>

        <a class="sidebar-item-sub" href="<?php echo get_permalink($musik) . $languageURL; ?>">
            <li class="child"><?php
        //get field object PAGE_TITLE from the specific page ID
            $musik_title = get_field_object('title_en', $musik);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $musik_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($musik); } ?></li></a>

        <a class="sidebar-item-sub" href="<?php echo get_permalink($laudes) . $languageURL; ?>">
            <li class="child"><?php
        //get field object PAGE_TITLE from the specific page ID
            $laudes_title = get_field_object('title_en', $laudes);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $laudes_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($laudes); } ?></li></a>

        <a class="sidebar-item-sub" href="<?php echo get_permalink($chor) . $languageURL; ?>">
            <li class="child"><?php
        //get field object PAGE_TITLE from the specific page ID
            $chor_title = get_field_object('title_en', $chor);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $chor_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($chor); } ?></li></a>


        <a class="sidebar-item-sub" href="<?php echo get_permalink($internationalerAbend) . $languageURL; ?>">
            <li class="child"><?php
        //get field object PAGE_TITLE from the specific page ID
            $internationalerAbend_title = get_field_object('title_en', $internationalerAbend);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $internationalerAbend_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($internationalerAbend); } ?></li></a>

        <a class="sidebar-item-sub" href="<?php echo get_permalink($soziales) . $languageURL; ?>">
            <li class="child"><?php
        //get field object PAGE_TITLE from the specific page ID
            $soziales_title = get_field_object('title_en', $soziales);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $soziales_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($soziales); } ?></li></a>

        <a class="sidebar-item-sub" href="<?php echo get_permalink($uberregionales) . $languageURL; ?>">
            <li class="child"><?php
        //get field object PAGE_TITLE from the specific page ID
            $uberregionales_title = get_field_object('title_en', $uberregionales);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $uberregionales_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($uberregionales); } ?></li></a>

        <a class="sidebar-item-sub" href="<?php echo get_permalink($okumene) . $languageURL; ?>">
            <li class="child"><?php
        //get field object PAGE_TITLE from the specific page ID
            $okumene_title = get_field_object('title_en', $okumene);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $okumene_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($okumene); } ?></li></a>

    </ul>

    <script>
$("#gemen").mouseup(function(){
	$('#gemen-child').slideToggle( "fast" );
    $('#gemen-child').toggleClass("active");
    $(this).toggleClass("active");
});
</script>

    <a class="sidebar-item" href="<?php echo get_permalink($freundeskreis) . $languageURL; ?>">
        <li><?php
        //get field object PAGE_TITLE from the specific page ID
            $freundeskreis_title = get_field_object('title_en', $freundeskreis);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $freundeskreis_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($freundeskreis); } ?></li></a>


    <a class="sidebar-item" href="<?php echo get_permalink($datens) . $languageURL; ?>">
        <li><?php
        //get field object PAGE_TITLE from the specific page ID
            $datens_title = get_field_object('title_en', $datens);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $datens_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($datens); } ?></li></a>

    <a class="sidebar-item" href="<?php echo get_permalink($impressum) . $languageURL; ?>">
        <li><?php
        //get field object PAGE_TITLE from the specific page ID
            $impressum_title = get_field_object('title_en', $impressum);
        //if language is English, displays the custom field
        if ($language == 2) {
            echo $impressum_title['value'];
        } else {
        //if is Deutsche, displays the page title
            echo get_the_title($impressum); } ?></li></a>



    <span class="sidebar-item">
        <li class="sidebar-item-li">
          <div class="sidebar-item-li-all">
            <div class="sidebar-item-li-wrapper">
                <a class="sidebar-item-li-wrapper-link" href="<?php echo get_bloginfo('url'); ?>?lang=de"><img src="<?php bloginfo('template_url');?>/imgs/flagmenu_de.png" />Deutsch</a>
            </div>
            <div class="sidebar-item-li-wrapper">
                <a class="sidebar-item-li-wrapper-link" href="<?php echo get_bloginfo('url'); ?>?lang=en"><img src="<?php bloginfo('template_url');?>/imgs/flagmenu_uk.png" />English</a>
            </div>
          <div>
        </li>
    </span>





</div>
