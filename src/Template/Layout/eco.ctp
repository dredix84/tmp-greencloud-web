<?php

use Cake\Core\Configure;
use Cake\View\Helper\HtmlHelper;
?><!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 8)]><!-->
<html lang="en-US" class="cmsms_html">
    <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="shortcut icon" href="<?= WEBROOT ?>img/favicon-2.jpg" type="image/x-icon" />

        <title><?= Configure::read('app_name') ?></title>

        <link rel='stylesheet' href='<?= WEBROOT ?>LayerSlider/css/layerslider.css' type='text/css' media='all' />
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lato:100,300,regular,700,900%7COpen+Sans:300%7CIndie+Flower:regular%7COswald:300,regular,700&#038;subset=latin,latin-ext' type='text/css' media='all' />
        <link rel="stylesheet" type="text/css" href="<?= WEBROOT ?>css/settings.css" media="screen" />
        <link rel='stylesheet' href='<?= WEBROOT ?>css/style.css' />
        <link rel='stylesheet' href='<?= WEBROOT ?>css/adaptive.css' />
        <link rel='stylesheet' href='<?= WEBROOT ?>css/retina.css' />
        <link rel='stylesheet' href='<?= WEBROOT ?>css/ilightbox.css' />
        <link rel='stylesheet' href='<?= WEBROOT ?>css/ilightbox-skins/dark-skin.css' />
        <link rel='stylesheet' href='<?= WEBROOT ?>css/cmsms-events-style.css' />
        <link rel='stylesheet' href='<?= WEBROOT ?>css/cmsms-events-adaptive.css' />
        <link rel='stylesheet' href='<?= WEBROOT ?>css/fontello.css' />
        <link rel='stylesheet' href='<?= WEBROOT ?>css/animate.css' />
        <!--[if lte IE 9]>
                <link rel='stylesheet' href='<?= WEBROOT ?>css/ie.css' type='text/css' media='screen' />
                <link rel='stylesheet' href='<?= WEBROOT ?>css/econature_fonts.css' type='text/css' media='screen' />
                <link rel='stylesheet' href='<?= WEBROOT ?>css/econature_colors_primary.css' type='text/css' media='screen' />
                <link rel='stylesheet' href='<?= WEBROOT ?>css/econature_colors_secondary.css' type='text/css' media='screen' />
        <![endif]-->
        <link rel='stylesheet' href='<?= WEBROOT ?>css/econature.css' />
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Oxygen%3A300%2C400%2C700&#038;ver=4.2' type='text/css' media='all' />
        <link rel='stylesheet' href='<?= WEBROOT ?>css/jquery.isotope.css' type='text/css' media='screen' />

        <script type='text/javascript' src='<?= WEBROOT ?>js/jquery.js'></script>
        <script type='text/javascript' src='<?= WEBROOT ?>js/jquery-migrate.min.js'></script>

        <style type="text/css">
            .cmsms_dynamic_cart .widget_shopping_cart_content .cart_list {
                overflow-y:auto;
            }

            .header_mid_inner .logo {
                position:static;
            }
            #footer.cmsms_footer_default .footer_inner {
                min-height:450px;
            }

            .fixed_footer #main {
                margin-bottom:450px;
            }

            #cmsms_row_1 .cmsms_row_outer_parent {
                padding-top: 0px;
            }

            #cmsms_row_1 .cmsms_row_outer_parent {
                padding-bottom: 0px;
            }

            #cmsms_row_1 .cmsms_row_inner.cmsms_row_fullwidth {
                padding-left:0%;
            }
            #cmsms_row_1 .cmsms_row_inner.cmsms_row_fullwidth {
                padding-right:0%;
            }

            #cmsms_row_2 .cmsms_row_outer_parent {
                padding-top: 40px;
            }

            #cmsms_row_2 .cmsms_row_outer_parent {
                padding-bottom: 20px;
            }

            #cmsms_row_3 .cmsms_row_outer_parent {
                padding-top: 60px;
            }

            #cmsms_row_3 .cmsms_row_outer_parent {
                padding-bottom: 0px;
            }

            #cmsms_heading_553e49e80710d, #cmsms_heading_553e49e80710d a {
                font-size:34px;
                text-align:center;
                font-weight:300;
                font-style:normal;
                margin-top:0px;
                margin-bottom:40px;
            }

            #cmsms_row_4 .cmsms_row_outer_parent {
                padding-top: 0px;
            }

            #cmsms_row_4 .cmsms_row_outer_parent {
                padding-bottom: 0px;
            }

            #cmsms_stat_553e49e8075f6 .cmsms_stat_counter {
                color:#57cbe1;
            }

            #cmsms_stat_553e49e8076a4 .cmsms_stat_counter {
                color:#62e0c1;
            }

            #cmsms_stat_553e49e80773a .cmsms_stat_counter {
                color:#7fe092;
            }

            #cmsms_stat_553e49e8077d1 .cmsms_stat_counter {
                color:#b7f275;
            }

            #cmsms_row_5 .cmsms_row_outer_parent {
                padding-top: 0px;
            }

            #cmsms_row_5 .cmsms_row_outer_parent {
                padding-bottom: 0px;
            }

            #cmsms_heading_553e49e807cad, #cmsms_heading_553e49e807cad a {
                color:#979ca4; color:rgba(151, 156, 164, 1);
                font-size:18px;
                line-height:32px;
                text-align:center;
                font-weight:300;
                font-style:normal;
                margin-top:0px;
                margin-bottom:30px;
            }

            #cmsms_row_6 .cmsms_row_outer_parent {
                padding-top: 0px;
            }

            #cmsms_row_6 .cmsms_row_outer_parent {
                padding-bottom: 70px;
            }


            #cmsms_paypal_donations_553e49e8080d0 {
                text-align:center;
            }

            #cmsms_paypal_donations_553e49e8080d0 .cmsms_button:before {
                margin-right:0;
                margin-left:0;
                vertical-align:baseline;
            }

            #cmsms_paypal_donations_553e49e8080d0 .cmsms_button {
                font-weight:100;
                font-style:normal;
            }

            #cmsms_paypal_donations_553e49e8080d0 form:hover + .cmsms_button {
            }

            #cmsms_row_7 {
                background-image: url(<?= WEBROOT ?>img/images/bg-big-sky.jpg);
                background-position: top center;
                background-repeat: repeat-y;
                background-attachment: scroll;
                background-size: cover;
            }

            #cmsms_row_7 .cmsms_row_outer_parent {
                padding-top: 60px;
            }

            #cmsms_row_7 .cmsms_row_outer_parent {
                padding-bottom: 100px;
            }

            #cmsms_row_7 .cmsms_row_inner.cmsms_row_fullwidth {
                padding-left:10%;
            }
            #cmsms_row_7 .cmsms_row_inner.cmsms_row_fullwidth {
                padding-right:10%;
            }

            #cmsms_heading_553e49e808e7f, #cmsms_heading_553e49e808e7f a {
                color:#ffffff; color:rgba(255, 255, 255, 1);
                font-size:34px;
                text-align:center;
                font-weight:300;
                font-style:normal;
                margin-top:0px;
                margin-bottom:60px;
            }

            #cmsms_row_8 .cmsms_row_outer_parent {
                padding-top: 80px;
            }

            #cmsms_row_8 .cmsms_row_outer_parent {
                padding-bottom: 0px;
            }

            #cmsms_heading_553e49e81ea44, #cmsms_heading_553e49e81ea44 a {
                font-size:32px;
                text-align:center;
                font-weight:300;
                font-style:normal;
                margin-top:0px;
                margin-bottom:0px;
            }

            #cmsms_row_9 .cmsms_row_outer_parent {
                padding-top: 60px;
            }

            #cmsms_row_9 .cmsms_row_outer_parent {
                padding-bottom: 20px;
            }

            #cmsms_icon_list_items_553e49e81ee7b.cmsms_icon_list_pos_right .cmsms_icon_list_item:before {
                left:auto;
                right:39.5px;
            }
            #cmsms_icon_list_items_553e49e81ee7b.cmsms_icon_list_type_block .cmsms_icon_list_item:before {
                width:1px;
            }

            #cmsms_icon_list_items_553e49e81ee7b .cmsms_icon_list_icon {
                border-width:1px;
                width:80px;
                height:80px;
                -webkit-border-radius:50;
                -moz-border-radius:50;
                border-radius:50;
            }

            #cmsms_icon_list_items_553e49e81ee7b .cmsms_icon_list_icon:before {
                font-size:32px;
                line-height:78px;
            }

            .cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_553e49e81efbc .cmsms_icon_list_icon:before {
                color:#58d4e7;
            }

            .cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_553e49e81efbc:hover .cmsms_icon_list_icon {
                background-color:#58d4e7;
            }

            .cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_553e49e81efbc:hover .cmsms_icon_list_icon:before {
                color:inherit;
            }

            .cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_553e49e81f115 .cmsms_icon_list_icon:before {
                color:#62e0c7;
            }

            .cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_553e49e81f115:hover .cmsms_icon_list_icon {
                background-color:#62e0c7;
            }

            .cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_553e49e81f115:hover .cmsms_icon_list_icon:before {
                color:inherit;
            }

            #cmsms_icon_list_items_553e49e81f520.cmsms_icon_list_items .cmsms_icon_list_item:before {
                left:39.5px;
            }

            #cmsms_icon_list_items_553e49e81f520.cmsms_icon_list_type_block .cmsms_icon_list_item:before {
                width:1px;
            }

            #cmsms_icon_list_items_553e49e81f520 .cmsms_icon_list_icon {
                border-width:1px;
                width:80px;
                height:80px;
                -webkit-border-radius:50%;
                -moz-border-radius:50%;
                border-radius:50%;
            }

            #cmsms_icon_list_items_553e49e81f520 .cmsms_icon_list_icon:before {
                font-size:32px;
                line-height:78px;
            }

            .cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_553e49e81f676 .cmsms_icon_list_icon:before {
                color:#7ce095;
            }

            .cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_553e49e81f676:hover .cmsms_icon_list_icon {
                background-color:#7ce095;
            }

            .cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_553e49e81f676:hover .cmsms_icon_list_icon:before {
                color:inherit;
            }

            .cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_553e49e81f7b9 .cmsms_icon_list_icon:before {
                color:#a6ec7c;
            }

            .cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_553e49e81f7b9:hover .cmsms_icon_list_icon {
                background-color:#a6ec7c;
            }

            .cmsms_icon_list_items.cmsms_color_type_icon #cmsms_icon_list_item_553e49e81f7b9:hover .cmsms_icon_list_icon:before {
                color:inherit;
            }

            #cmsms_row_10 .cmsms_row_outer_parent {
                padding-top: 40px;
            }

            #cmsms_row_10 .cmsms_row_outer_parent {
                padding-bottom: 50px;
            }

            #cmsms_heading_553e49e81fcae, #cmsms_heading_553e49e81fcae a {
                font-size:32px;
                text-align:center;
                font-weight:300;
                font-style:normal;
                margin-top:0px;
                margin-bottom:0px;
            }

            #cmsms_row_11 .cmsms_row_outer_parent {
                padding-top: 0px;
            }

            #cmsms_row_11 .cmsms_row_outer_parent {
                padding-bottom: 70px;
            }

            #cmsms_heading_553e49e832cc5, #cmsms_heading_553e49e832cc5 a {
                font-size:26px;
                text-align:left;
                font-weight:300;
                font-style:normal;
                margin-top:0px;
                margin-bottom:40px;
            }

            #cmsms_tabs_list_item_553e49e832e43 a:hover,#cmsms_tabs_list_item_553e49e832e43.current_tab a {
                background-color:#57cbe1;
                border-color:#57cbe1;
            }

            #cmsms_tabs_list_item_553e49e8358a9 a:hover,#cmsms_tabs_list_item_553e49e8358a9.current_tab a {
                background-color:#62e0c1;
                border-color:#62e0c1;
            }

            #cmsms_tabs_list_item_553e49e835a40 a:hover,#cmsms_tabs_list_item_553e49e835a40.current_tab a {
                background-color:#7fe092;
                border-color:#7fe092;
            }

            #cmsms_heading_553e49e835edb, #cmsms_heading_553e49e835edb a {
                font-size:26px;
                text-align:left;
                font-weight:300;
                font-style:normal;
                margin-top:0px;
                margin-bottom:40px;
            }

            .cmsms_stats.shortcode_animated #cmsms_stat_553e49e836051.cmsms_stat {
                width:78%;
            }

            #cmsms_stat_553e49e836051 .cmsms_stat_inner {
                background-color:#57cbe1;
                color:#ffffff;
            }

            .cmsms_stats.shortcode_animated #cmsms_stat_553e49e8360f4.cmsms_stat {
                width:73%;
            }

            #cmsms_stat_553e49e8360f4 .cmsms_stat_inner {
                background-color:#62e0c1;
                color:#ffffff;
            }

            .cmsms_stats.shortcode_animated #cmsms_stat_553e49e836189.cmsms_stat {
                width:92%;
            }

            #cmsms_stat_553e49e836189 .cmsms_stat_inner {
                background-color:#7fe092;
                color:#ffffff;
            }

            .cmsms_stats.shortcode_animated #cmsms_stat_553e49e836214.cmsms_stat {
                width:88%;
            }

            #cmsms_stat_553e49e836214 .cmsms_stat_inner {
                background-color:#b7f275;
                color:#ffffff;
            }

            .cmsms_stats.shortcode_animated #cmsms_stat_553e49e83629e.cmsms_stat {
                width:78%;
            }

            #cmsms_stat_553e49e83629e .cmsms_stat_inner {
                background-color:#c9ef5f;
                color:#ffffff;
            }

            #cmsms_row_12 {
                background-image: url(<?= WEBROOT ?>img/images/bg-big-water.jpg);
                background-position: top center;
                background-repeat: repeat-y;
                background-attachment: scroll;
                background-size: cover;
            }

            #cmsms_row_12 .cmsms_row_outer_parent {
                padding-top: 40px;
            }

            #cmsms_row_12 .cmsms_row_outer_parent {
                padding-bottom: 20px;
            }
            .menu_special span{
                color: green !important;
                font-weight: bold;
            }
        </style>

        <!-- Google Tag Manager -->
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-WB7KKWZ');
        </script>
        <!-- End Google Tag Manager -->
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WB7KKWZ"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <!-- _________________________ Start Page _________________________ -->
        <div id="page" class="csstransition cmsms_liquid fixed_header hfeed site">
            <!-- _________________________ Start Main _________________________ -->
            <div id="main">
                <!-- _________________________ Start Header _________________________ -->
                <header id="header">
                    <div class="header_mid" data-height="95">
                        <div class="header_mid_outer">
                            <div class="header_mid_inner">
                                <div class="logo_wrap">
                                    <a href="<?= WEBROOT ?>" title="Eco Nature" class="logo">
                                        <img src="<?= WEBROOT . Configure::read('logo_small') ?>" alt="Eco Nature" />
                                        <img class="logo_retina" src="<?= WEBROOT . Configure::read('logo_medium') ?>" alt="Eco Nature" width="179" height="44" />
                                    </a>
                                </div>
                                <div class="resp_nav_wrap">
                                    <div class="resp_nav_wrap_inner">
                                        <div class="resp_nav_content">
                                            <a class="responsive_nav cmsms-icon-menu-2" href="javascript:void(0);"></a>
                                        </div>
                                    </div>
                                </div>

                                <!-- _________________________ Start Navigation _________________________ -->
                                <nav role="navigation">
                                    <div class="menu-main-container">
                                        <ul id="navigation" class="navigation">
                                            <li class="current-menu-item">
                                                <a href="<?= WEBROOT ?> ">
                                                    <span class="nav_bg_clr"></span>
                                                    <span>Home</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="nav_bg_clr"></span>
                                                    <span>About</span>
                                                </a>
                                                <ul class="sub-menu">
                                                    <li><a href="<?= WEBROOT ?>pages/about"><span>About Us</span></a></li>
                                                    <li><a href="<?= WEBROOT ?>pages/terms-of-use"><span>Term of Use</span></a></li>
                                                    <li><a href="<?= WEBROOT ?>pages/privacy-policy"><span>Privacy Policy</span></a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="nav_bg_clr"></span>
                                                    <span>Download</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?= WEBROOT ?>contact">
                                                    <span class="nav_bg_clr"></span>
                                                    <span>Contacts</span>
                                                </a>
                                            </li>
                                            <?php if ($this->Permission->isLoggedIn()) { ?>
                                                <li>
                                                    <a href="<?= WEBROOT ?>dashboards">
                                                        <span class="nav_bg_clr"></span>
                                                        <span><?= __('Dashboard') ?></span>
                                                    </a>
                                                </li>

                                            <?php } else { ?>
                                                <li class="menu_special">
                                                    <a href="<?= WEBROOT ?>users/signup">
                                                        <span class="nav_bg_clr"></span>
                                                        <span><?= __('Sign Up') ?></span>
                                                    </a>
                                                </li>
                                                <li class="menu_special">
                                                    <a href="<?= WEBROOT ?>login">
                                                        <span class="nav_bg_clr"></span>
                                                        <span><?= __('Login') ?></span>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="cl"></div>
                                </nav>
                                <!-- _________________________ Finish Navigation _________________________ -->
                            </div>
                        </div>
                    </div>
                </header>
                <!-- _________________________ Finish Header _________________________ -->
                <!-- _________________________ Start Middle _________________________ -->
                <section id="middle">
                    <?php if (isset($h1)) { ?>
                        <?php echo $this->element('Eco/hi', compact('h1')); ?>
                    <?php } ?>
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </section>
                <!-- _________________________ Finish Middle _________________________ -->
                <a href="javascript:void(0);" id="slide_top" class="cmsms-icon-up-open-mini"></a>
            </div>
            <!-- _________________________ Finish Main _________________________ -->
            <!-- _________________________ Start Footer _________________________ -->
            <?php echo $this->element('Eco/footer'); ?>
            <!-- _________________________ Finish Footer _________________________ -->
        </div>
        <!-- _________________________ Finish Page _________________________ -->
        <script type='text/javascript' src='<?= WEBROOT ?>LayerSlider/js/layerslider.kreaturamedia.jquery.js'></script>
        <script type='text/javascript' src='<?= WEBROOT ?>LayerSlider/js/greensock.js'></script>
        <script type='text/javascript' src='<?= WEBROOT ?>LayerSlider/js/layerslider.transitions.js'></script>
        <script type='text/javascript' src='<?= WEBROOT ?>js/jsLibraries.min.js'></script>
        <script type='text/javascript' src='<?= WEBROOT ?>js/jquery.iLightBox.min.js'></script>
        <script type='text/javascript' src='<?= WEBROOT ?>js/jqueryLibraries.min.js'></script>
        <script type='text/javascript'>
            /* <![CDATA[ */
            var cmsms_script = {
                "ilightbox_skin": "dark",
                "ilightbox_path": "vertical",
                "ilightbox_infinite": "0",
                "ilightbox_aspect_ratio": "1",
                "ilightbox_mobile_optimizer": "1",
                "ilightbox_max_scale": "1",
                "ilightbox_min_scale": "0.2",
                "ilightbox_inner_toolbar": "0",
                "ilightbox_smart_recognition": "0",
                "ilightbox_fullscreen_one_slide": "0",
                "ilightbox_fullscreen_viewport": "center",
                "ilightbox_controls_toolbar": "1",
                "ilightbox_controls_arrows": "0",
                "ilightbox_controls_fullscreen": "1",
                "ilightbox_controls_thumbnail": "1",
                "ilightbox_controls_keyboard": "1",
                "ilightbox_controls_mousewheel": "1",
                "ilightbox_controls_swipe": "1",
                "ilightbox_controls_slideshow": "0",
                "ilightbox_close_text": "Close",
                "ilightbox_enter_fullscreen_text": "Enter Fullscreen (Shift+Enter)",
                "ilightbox_exit_fullscreen_text": "Exit Fullscreen (Shift+Enter)",
                "ilightbox_slideshow_text": "Slideshow",
                "ilightbox_next_text": "Next",
                "ilightbox_previous_text": "Previous",
                "ilightbox_load_image_error": "An error occurred when trying to load photo.",
                "ilightbox_load_contents_error": "An error occurred when trying to load contents.",
                "ilightbox_missing_plugin_error": "The content your are attempting to view requires the <a href='{pluginspage}' target='_blank'>{type} plugin<\\\/a>."
            };
            /* ]]> */
        </script>
        <script type='text/javascript' src='<?= WEBROOT ?>js/jquery.easing.min.js?ver=1.3.0'></script>
        <script type='text/javascript' src='<?= WEBROOT ?>js/jquery.script.js'></script>
        <script type='text/javascript' src='<?= WEBROOT ?>js/jquery.tweet.min.js'></script>
        <script type='text/javascript' src='<?= WEBROOT ?>js/jquery.isotope.min.js'></script>
        <script type='text/javascript' src='<?= WEBROOT ?>js/jquery.isotope.mode.js'></script>
    </body>
</html>
