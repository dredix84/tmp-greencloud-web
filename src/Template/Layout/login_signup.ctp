<?php

use Cake\Core\Configure;

$webroot = $this->request->webroot;
?><!doctype html>
<html class="fixed">
    <head>
        <?= $this->Html->charset() ?>
        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="description" content="Porto Admin - Responsive HTML5 Template">
        <meta name="author" content="okler.net">
        <title><?= $this->fetch('title') ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!--link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css"-->
        <link rel="stylesheet" href="<?= $webroot ?>assets/vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?= $webroot ?>assets/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="<?= $webroot ?>assets/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="<?= $webroot ?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />
        <link rel="stylesheet" href="<?= $webroot ?>assets/stylesheets/theme.css" />
        <link rel="stylesheet" href="<?= $webroot ?>assets/stylesheets/skins/default.css" />
        <link rel="stylesheet" href="<?= $webroot ?>assets/stylesheets/theme-custom.css">
        <script src="<?= $webroot ?>assets/vendor/modernizr/modernizr.js"></script>

    </head>
    <body>
        <section class="body-sign">
            <div class="center-sign">
                <?php
                echo $this->Flash->render();
                echo $this->Flash->render('auth');
                ?>

                <a href="<?= $webroot ?>" class="logo pull-left">
                    <img src="<?= $webroot . Configure::read('logo_medium'); ?>" height="54" alt="<?= Configure::read('app_name'); ?>" />
                </a>

                <?= $this->fetch('content') ?>


                <p class="text-center text-muted mt-md mb-md"><?= Configure::read('footer_copyright'); ?></p>
            </div>
        </section>

        <script src="<?= $webroot ?>assets/vendor/jquery/jquery.js"></script>
        <script src="<?= $webroot ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="<?= WEBROOT ?>assets/vendor/jquery-maskedinput/jquery.maskedinput.js">
        <script src="<?= $webroot ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="<?= $webroot ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="<?= $webroot ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="<?= $webroot ?>assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
        <script src="<?= $webroot ?>assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
       
        <script src="<?= $webroot ?>assets/javascripts/theme.js"></script>
        <script src="<?= $webroot ?>assets/javascripts/theme.custom.js"></script>
        <script src="<?= $webroot ?>assets/javascripts/theme.init.js"></script>
    </body>
</html>