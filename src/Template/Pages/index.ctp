<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

//$this->layout = false;
?>
<!DOCTYPE html>
<div class="middle_inner">
    <!--_________________________ Start Content _________________________ -->
    <div id="cmsms_row_1" class="cmsms_row cmsms_color_scheme_default">
        <div class="cmsms_row_outer_parent">
            <div class="cmsms_row_outer">
                <div class="cmsms_row_inner cmsms_row_fullwidth">
                    <div class="cmsms_row_margin">
                        <div class="cmsms_column one_first">
                            <div class="cmsms_slider">
                                <script type="text/javascript">var lsjQuery = jQuery;</script>
                                <script type="text/javascript">
                                    lsjQuery(document).ready(function () {
                                        if (typeof lsjQuery.fn.layerSlider == "undefined") {
                                            lsShowNotice('layerslider_1', 'jquery');
                                        } else {
                                            lsjQuery("#layerslider_1").layerSlider({
                                                navStartStop: false,
                                                navButtons: false,
                                                skinsPath: '<?= WEBROOT ?>LayerSlider/assets/skins/'
                                            })
                                        }
                                    });
                                </script>
                                <div id="layerslider_1" class="ls-wp-container" style="width:1920px;height:670px;margin:0 auto;">
                                    <div class="ls-slide" data-ls="slidedelay:3500; transition2d: all;">
                                        <img src="<?= WEBROOT ?>LayerSlider/img/blank.gif" data-src="<?= WEBROOT ?>LayerSlider/img/bg-blur-2.jpg" class="ls-bg" alt="bg-blur-2" />
                                        <img class="ls-l" style="top:0px;left:0px;white-space: nowrap;" data-ls="offsetxin:0;durationin:800;delayin:200;offsetxout:0;durationout:1000;parallaxlevel:1;" src="<?= WEBROOT ?>LayerSlider/img/blank.gif" data-src="<?= WEBROOT ?>LayerSlider/img/bg-2.jpg" alt="">
                                        <p class="ls-l" style="top:195px;left:510px;font-weight:300;font-family:open sans;font-size:180px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;delayin:400;offsetxout:0;durationout:0;">Receipt Cloud</p>
                                        <p class="ls-l" style="top:526px;left:711px;font-weight:500;font-family:open sans;font-size:28px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;delayin:1000;offsetxout:0;">In One Cloud</p>
                                        <img class="ls-l" style="top:161px;left:934px;font-weight:300;font-family:open sans;font-size:40px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:2000;delayin:800;rotatexin:180;rotateyin:180;offsetxout:0;" src="<?= WEBROOT ?>LayerSlider/img/blank.gif" data-src="<?= WEBROOT ?>LayerSlider/img/wave.png" alt="">
                                        <p class="ls-l" style="top:398px;left:838px;font-weight:300;font-family:open sans;font-size:60px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;delayin:600;offsetxout:0;durationout:0;">All your receipts</p>
                                    </div>
                                    <div class="ls-slide" data-ls="slidedelay:3500; transition2d: all;">
                                        <img src="<?= WEBROOT ?>LayerSlider/img/blank.gif" data-src="<?= WEBROOT ?>LayerSlider/img/bg-blur.jpg" class="ls-bg" alt="bg-blur" />
                                        <img class="ls-l" style="top:0px;left:0px;white-space: nowrap;" data-ls="offsetxin:0;delayin:400;offsetxout:0;durationout:1000;parallaxlevel:1;" src="<?= WEBROOT ?>LayerSlider/img/blank.gif" data-src="<?= WEBROOT ?>LayerSlider/img/bg.jpg" alt="">
                                        <p class="ls-l" style="top:210px;left:573px;font-weight:300;font-family:open sans;font-size:54px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:1300;delayin:400;offsetxout:0;">Keep All Your Receipts</p>
                                        <p class="ls-l" style="top:280px;left:567px;font-weight:300;font-family:open sans;font-size:90px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;delayin:800;offsetxout:0;durationout:0;">And Save A Few Trees</p>
                                        <p class="ls-l" style="top:402px;left:1089px;font-weight:300;font-family:open sans;font-size:40px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:2000;delayin:1200;offsetxout:0;">Welcome to Green Cloud</p>
                                        <img class="ls-l" style="top:278px;left:1354px;font-weight:300;font-family:open sans;font-size:40px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:2000;delayin:1200;rotatein:90;rotatexin:180;rotateyin:180;offsetxout:0;" src="<?= WEBROOT ?>LayerSlider/img/blank.gif" data-src="<?= WEBROOT . Configure::read('logo_small') ?>" alt="">
                                    </div>
                                    <div class="ls-slide" data-ls="slidedelay:3800; transition2d: all;">
                                        <img src="<?= WEBROOT ?>LayerSlider/img/blank.gif" data-src="<?= WEBROOT ?>LayerSlider/img/bg-blur-3.jpg" class="ls-bg" alt="bg-blur-3" />
                                        <img class="ls-l" style="top:0px;left:1px;white-space: nowrap;" data-ls="offsetxin:0;durationin:800;delayin:200;offsetxout:0;durationout:1000;parallaxlevel:1;" src="<?= WEBROOT ?>LayerSlider/img/blank.gif" data-src="<?= WEBROOT ?>LayerSlider/img/bg-3.jpg" alt="">
                                        <p class="ls-l" style="top:125px;left:373px;font-weight:300;font-family:open sans;font-size:240px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:800;delayin:400;offsetxout:0;durationout:0;">Freedom</p>
                                        <img class="ls-l" style="top:153px;left:791px;font-weight:300;font-family:open sans;font-size:44px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:-160;offsetyin:250;durationin:1500;delayin:800;rotatein:60;rotatexin:60;rotateyin:60;offsetxout:160;offsetyout:-250;durationout:600;" src="<?= WEBROOT ?>LayerSlider/img/blank.gif" data-src="<?= WEBROOT ?>LayerSlider/img/plan.png" alt="">
                                        <p class="ls-l" style="top:407px;left:382px;font-weight:300;font-family:open sans;font-size:36px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;delayin:800;offsetxout:0;">Experience paper freedom</p>
                                        <p class="ls-l" style="top:456px;left:381px;font-weight:300;font-family:open sans;font-size:36px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;delayin:800;offsetxout:0;">Never loose a receipt again.</p>
                                        <p class="ls-l" style="top:508px;left:380px;font-weight:300;font-family:open sans;font-size:36px;color:#ffffff;white-space: nowrap;" data-ls="offsetxin:0;durationin:1500;delayin:800;offsetxout:0;">They are all here</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	

    <div id="cmsms_row_3" class="cmsms_row cmsms_color_scheme_default">
        <div class="cmsms_row_outer_parent">
            <div class="cmsms_row_outer">
                <div class="cmsms_row_inner">
                    <div class="cmsms_row_margin">
                        <div class="cmsms_column one_fourth"></div>
                        <div class="cmsms_column one_half">
                            <h2 id="cmsms_heading_553e49e80710d" class="cmsms_heading">Your All in One Receipt Cloud</h2>
                        </div>
                        <div class="cmsms_column one_fourth"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="cmsms_row_9" class="cmsms_row cmsms_color_scheme_default">
        <div class="cmsms_row_outer_parent">
            <div class="cmsms_row_outer">
                <div class="cmsms_row_inner">
                    <div class="cmsms_row_margin">
                        <div class="cmsms_column one_half">
                            <ul id="cmsms_icon_list_items_553e49e81ee7b" class="cmsms_icon_list_items cmsms_icon_list_type_block cmsms_icon_list_pos_right cmsms_color_type_icon">
                                <li id="cmsms_icon_list_item_553e49e81efbc" class="cmsms_icon_list_item">
                                    <div class="cmsms_icon_list_item_inner">
                                        <div class="cmsms_icon_list_icon_wrap">
                                            <span class="cmsms_icon_list_icon cmsms-icon-cloud-7"></span>
                                        </div>
                                        <div class="cmsms_icon_list_item_content">
                                            <h2 class="cmsms_icon_list_item_title"> Receipt Cloud</h2>
                                            <div class="cmsms_icon_list_item_text">
                                                <p>Access your receipts from anywhere. At home, in the office, at the game or even on your vacation.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li id="cmsms_icon_list_item_553e49e81f115" class="cmsms_icon_list_item">
                                    <div class="cmsms_icon_list_item_inner">
                                        <div class="cmsms_icon_list_icon_wrap">
                                            <span class="cmsms_icon_list_icon cmsms-icon-star-7"></span>
                                        </div>
                                        <div class="cmsms_icon_list_item_content">
                                            <h2 class="cmsms_icon_list_item_title">Find Them Easily</h2>
                                            <div class="cmsms_icon_list_item_text">
                                                <p>Find any receipt easily no matter when it was received. They are all here.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="cmsms_column one_half">
                            <ul id="cmsms_icon_list_items_553e49e81f520" class="cmsms_icon_list_items cmsms_icon_list_type_block cmsms_icon_list_pos_left cmsms_color_type_icon">
                                <li id="cmsms_icon_list_item_553e49e81f676" class="cmsms_icon_list_item">
                                    <div class="cmsms_icon_list_item_inner">
                                        <div class="cmsms_icon_list_icon_wrap">
                                            <span class="cmsms_icon_list_icon cmsms-icon-heart-7"></span>
                                        </div>
                                        <div class="cmsms_icon_list_item_content">
                                            <h2 class="cmsms_icon_list_item_title">Eco Friendly</h2>
                                            <div class="cmsms_icon_list_item_text">
                                                <p>No paper means no need to cut down a tree. Do your part to save the plant.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li id="cmsms_icon_list_item_553e49e81f7b9" class="cmsms_icon_list_item">
                                    <div class="cmsms_icon_list_item_inner">
                                        <div class="cmsms_icon_list_icon_wrap">
                                            <span class="cmsms_icon_list_icon cmsms-icon-trash-8"></span>
                                        </div>
                                        <div class="cmsms_icon_list_item_content">
                                            <h2 class="cmsms_icon_list_item_title">Recycling</h2>
                                            <div class="cmsms_icon_list_item_text">
                                                <p>Never throw away a receipt again. We will keep them all for you while saving a few trees in the process.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="cl"></div>
</div>
