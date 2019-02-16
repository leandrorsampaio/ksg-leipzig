<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
*/?>

        <footer class="full-width">
            <div class="grid-width">
                <div class="logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ) . $footer_languageURL; ?>"><img src="<?php bloginfo('template_url');?>/imgs/logo.svg"></a>
                </div>

                <?php
                // Start the loop of the post Interface - Footer (ID 19)
                    $args = array(
                        'p' => 19,
                        'post_type' => 'interface'
                        );

                    $footer = new WP_Query( $args );
                    while ($footer->have_posts()) : $footer->the_post();
                    //includes Programmer Module, with all the variables


                    /////////////////////
                    ///////// Footer
                    /////////////////////

                    global $footer_language;
                    $footer_language = 1;
                    //$footer_languageGet = $_GET['lang'];
                    $footer_languageGet = 'de';

                    if ($footer_languageGet == 'en') {
                        $footer_language = 2; //EN
                        $footer_languageURL = '?lang=en';
                    } else {
                        $footer_language = 1; //DE (default)
                        $footer_languageURL = '?lang=de';
                    }


                    //Deutsche
                    $footer_newsletter_de ='footer_newsletter_de';
                    $footer_placeholder_de = 'footer_placeholder_de';
                    $footer_title_de = 'footer_title_de';
                    $footer_content_de = 'footer_content_de';

                    //English
                    $footer_newsletter_en ='footer_newsletter_en';
                    $footer_placeholder_en = 'footer_placeholder_en';
                    $footer_title_en = 'footer_title_en';
                    $footer_content_en = 'footer_content_en';


                    if ($footer_language == 2) {
                      //---------------- FOOTER
                      $footer_newsletter = $footer_newsletter_en;
                      $footer_placeholder = $footer_placeholder_en;
                      $footer_title = $footer_title_en;
                      $footer_content = $footer_content_en;
                    } else {
                      //---------------- FOOTER
                      $footer_newsletter = $footer_newsletter_de;
                      $footer_placeholder = $footer_placeholder_de;
                      $footer_title = $footer_title_de;
                      $footer_content = $footer_content_de;
                    }

                    $final_footer_newsletter = get_field_object($footer_newsletter);
                    $final_footer_placeholder = get_field_object($footer_placeholder);
                    $final_footer_title = get_field_object($footer_title);
                    $final_footer_content = get_field_object($footer_content);


                    //include ('includes/in_programmer.php');

                    ?>

                    <div class="newsletter">
                        <p><?php echo $final_footer_newsletter['value']; ?></p>
                        <form id="form1" action="#hehe" method="get">
                            <input type="text" placeholder="<?php  echo $final_footer_placeholder['value']; ?>">
                            <button class="newsletter_btn" type="submit" form="form1"><img src="<?php bloginfo('template_url');?>/imgs/icon/arrow-right.svg"></button>
                        </form>
                    </div>
                    <div class="contact">
                        <p class="darkgray"><?php  echo $final_footer_title['value']; ?></p>
                        <p><?php  echo $final_footer_content['value'];?></p>
                    </div>
                </div>

                <?php endwhile;
                  wp_reset_query();
                ?>

            <!-- Three links -->
            <div class="links full-width">



              <?php
                $args = array(
                    'page_id' => 420
                    );

                $footer = new WP_Query( $args );
                while ($footer->have_posts()) : $footer->the_post();

                $langCodefooterlink1 = $_GET['lang'];

                if ($langCodefooterlink1 == 'en') {
                    $link1title = get_field('title_en');
                    $languageURLfooterlink1 = '?lang=en';
                } else {
                    $link1title = get_the_title();
                    $languageURLfooterlink1 = '?lang=de';
                }

                echo '<span class="desktop_only"><a href="' . get_the_permalink() . $languageURLfooterlink1 . '">' . $link1title . '</a></span>';

                endwhile;
                wp_reset_query();
              ?>

              •

              <?php
                $args = array(
                    'page_id' => 423
                    );

                $footer = new WP_Query( $args );
                while ($footer->have_posts()) : $footer->the_post();

                $langCodefooterlink1 = $_GET['lang'];

                if ($langCodefooterlink1 == 'en') {
                    $link1title = get_field('title_en');
                    $languageURLfooterlink1 = '?lang=en';
                } else {
                    $link1title = get_the_title();
                    $languageURLfooterlink1 = '?lang=de';
                }

                echo '<span class="desktop_only"><a href="' . get_the_permalink() . $languageURLfooterlink1 . '">' . $link1title . '</a></span>';

                endwhile;
                wp_reset_query();
              ?>

              •

              <?php
                $args = array(
                    'page_id' => 425
                    );

                $footer = new WP_Query( $args );
                while ($footer->have_posts()) : $footer->the_post();

                $langCodefooterlink1 = $_GET['lang'];

                if ($langCodefooterlink1 == 'en') {
                    $link1title = get_field('title_en');
                    $languageURLfooterlink1 = '?lang=en';
                } else {
                    $link1title = get_the_title();
                    $languageURLfooterlink1 = '?lang=de';
                }

                echo '<span class="desktop_only"> <a href="' . get_the_permalink() . $languageURLfooterlink1 . '">' . $link1title . '</a></span>';

                endwhile;
                wp_reset_query();
              ?>











            </div>

        </footer>
    </body>

    <script type="text/javascript">
        $('#menu-toggle').on('mouseup', function() {
            $('.sidebar').addClass('sidebar__appear');
            $('body').css({"position":"fixed"});
        });
        $('#menu-toggle-mobile').on('mouseup', function() {
            $('.sidebar').addClass('sidebar__appear');
        });
        $('#menu-untoggle').on('mouseup', function() {
            $('.sidebar').removeClass('sidebar__appear');
            $('body').css({"position":"relative"});
        });
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 120) {
                $("#header").addClass("header__stick");
            } else {
                $("#header").removeClass("header__stick");
            }
        });

        $('#search').mouseup(function(){
            if ( $('form[role=search]').hasClass("search__open") ) {
                $('form[role=search]').css({"opacity":"0"});
                $('form[role=search]').css({"display":"none"});
                $('form[role=search]').css({"visibility":"hidden"});
                $('form[role=search]').removeClass('search__open');
            } else {
                $('form[role=search]').css({"opacity":"1"});
                $('form[role=search]').css({"display":"block"});
                $('form[role=search]').css({"visibility":"visible"});
                $('form[role=search]').addClass('search__open');
            }
        });
    </script>

<?php wp_footer(); ?>
</html>
