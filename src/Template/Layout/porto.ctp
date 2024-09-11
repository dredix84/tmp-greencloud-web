<?php

use Cake\Core\Configure;
use Cake\View\Helper\HtmlHelper;

$webroot = $this->Url->build('/', true);
?><!doctype html>
<html class="fixed">
<head>

    <?= $this->Html->charset() ?>

    <title><?= $this->fetch('title') ?></title>
    <meta name="keywords" content="ereceipt"/>
    <meta name="description" content="The e-Receipt system by Variant Solutions">
    <meta name="author" content="dredix.net">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <!--link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css"-->

    <link rel="stylesheet" href="<?= $webroot ?>assets/vendor/bootstrap/css/bootstrap.css"/>

    <link rel="stylesheet" href="<?= $webroot ?>assets/vendor/font-awesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"/>
    <link rel="stylesheet" href="<?= $webroot ?>assets/vendor/magnific-popup/magnific-popup.css"/>
    <link rel="stylesheet" href="<?= $webroot ?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css"/>

    <link rel="stylesheet" href="<?= $webroot ?>assets/stylesheets/theme.css"/>

    <link rel="stylesheet" href="<?= $webroot ?>assets/stylesheets/skins/default.css"/>

    <link rel="stylesheet" href="<?= $webroot ?>assets/stylesheets/theme-custom.css">

    <script src="<?= $webroot ?>assets/vendor/modernizr/modernizr.js"></script>
    <script src="<?= $webroot ?>assets/vendor/jquery/jquery.js"></script>
    <script src="<?= $webroot ?>js/bundle.js"></script>
    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WB7KKWZ');
    </script>
    <!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WB7KKWZ"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<section class="body">

    <!-- start: header -->
    <header class="header">
        <div class="logo-container">
            <a href="../" class="logo">
                <img src="<?= $webroot . Configure::read('logo_small') ?>" height="35" alt="Porto Admin"/>
            </a>
            <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
                 data-fire-event="sidebar-left-opened">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <!-- start: search & user box -->
        <div class="header-right">

            <form action="<?= WEBROOT ?>receipts/index" accept-charset="utf-8" method="get" class="search nav-form">
                <input id="a" type="hidden" name="a" value="search">
                <div class="input-group input-search">

                    <input type="text" class="form-control" name="search_term" id="search_term" autocomplete="off"
                           placeholder="<?= __('Search Receipts') ?>...">
                    <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                </div>
            </form>

            <span class="separator"></span>

            <ul class="notifications">
                <?php if (!empty($userinfo['merchant_id'])) { ?>
                    <li>
                        <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                            <i class="fa fa-tasks"></i>
                        </a>

                        <div class="dropdown-menu notification-menu large">
                            <div class="notification-title">
                                <?= __('Switch Account Type') ?>
                            </div>

                            <div class="content">
                                <ul>
                                    <li>
                                        <a href="<?= WEBROOT . 'users/merchant-switch-profile/0GXdPHLT1F' ?>"
                                           class="clearfix">
                                            <figure class="image">
                                                <img src="<?= $webroot ?>assets/images/!sample-user.jpg"
                                                     alt="Joseph Doe Junior" class="img-circle"/>
                                            </figure>
                                            <span class="title"><?= __('Switch to Customer') ?></span>
                                            <span
                                                class="message"><?= __('This allows you to switch to a customer view so you view the application as a customer.') ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= WEBROOT . 'users/merchant-switch-profile/m3tD4fQzRz' ?>"
                                           class="clearfix">
                                            <figure class="image">
                                                <img src="<?= $webroot ?>assets/images/!sample-user.jpg"
                                                     alt="Joseph Doe Junior" class="img-circle"/>
                                            </figure>
                                            <span class="title"><?= __('Switch to Merchant') ?></span>
                                            <span
                                                class="message"><?= __('This allows you to switch to back to a merchant view so you view the application as a merchant.') ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                <?php } ?>

                <?php if ($this->Permission->hasPermission('merchants.switchto') && isset($merchantAccounts)) { ?>
                    <li>
                        <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                            <i class="fa fa-building"></i>
                            <!--span class="badge"><?= count($merchantAccounts) ?></span--> <?php //@TODO: Fix count issue  ?>
                        </a>

                        <div class="dropdown-menu notification-menu">
                            <div class="notification-title">
                                <span class="pull-right label label-default"><?= $merchantAccounts->count() ?></span>
                                <?= __('Switch Merchant Account') ?>
                            </div>

                            <div class="content">
                                <ul>
                                    <?php foreach ($merchantAccounts as $ma) { ?>
                                        <li>
                                            <a href="<?= WEBROOT . 'merchants/switch-to/' . $ma->id ?>"
                                               class="clearfix">
                                                <figure class="image">
                                                    <img src="<?= $webroot ?>assets/images/!sample-user.jpg"
                                                         alt="Joseph Doe Junior" class="img-circle"/>
                                                </figure>
                                                <span class="title"><?= $ma->name ?> - <?= $ma->city ?></span>
                                                <span class="message"><?= $ma->contact_name ?></span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>

                                <hr/>
                                <p>
                                    <?= __('Account') ?>: <?= $userinfo['merchant']['name'] ?>
                                    - <?= $userinfo['merchant']['city'] ?>
                                </p>
                                <hr/>
                                <p>
                                    <?= __('This menu allows you to quickly switch to a different merchant account.') ?>
                                </p>
                                <hr/>

                                <div class="text-right">
                                    <?= $this->Html->link(__('View All'),
                                        ['controller' => 'merchants', 'action' => 'myAccounts'], ['escape' => false]) ?>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php } ?>

                <!--li>
                    <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                        <i class="fa fa-bell"></i>
                        <span class="badge">3</span>
                    </a>

                    <div class="dropdown-menu notification-menu">
                        <div class="notification-title">
                            <span class="pull-right label label-default">3</span>
                            Alerts
                        </div>

                        <div class="content">
                            <ul>
                                <li>
                                    <a href="#" class="clearfix">
                                        <div class="image">
                                            <i class="fa fa-thumbs-down bg-danger"></i>
                                        </div>
                                        <span class="title">Server is Down!</span>
                                        <span class="message">Just now</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="clearfix">
                                        <div class="image">
                                            <i class="fa fa-lock bg-warning"></i>
                                        </div>
                                        <span class="title">User Locked</span>
                                        <span class="message">15 minutes ago</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="clearfix">
                                        <div class="image">
                                            <i class="fa fa-signal bg-success"></i>
                                        </div>
                                        <span class="title">Connection Restaured</span>
                                        <span class="message">10/10/2014</span>
                                    </a>
                                </li>
                            </ul>

                            <hr />

                            <div class="text-right">
                                <a href="#" class="view-more">View All</a>
                            </div>
                        </div>
                    </div>
                </li-->
            </ul>


            <?php
            //Only admins are allowed to switch roles
            if ($this->Permission->isAdmin() || $this->Permission->hasPermission('app.roleswtiching')) {
                $roles = $this->request->session()->read('user.roles');
                ?>
                <span class="separator"></span>

                <ul class="notifications">

                    <li>
                        <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                            <i class="fa fa-users"></i>
                            <span class="badge"><?= count($roles) ?></span>
                        </a>

                        <div class="dropdown-menu notification-menu">
                            <div class="notification-title">
                                Switch Role
                            </div>

                            <div class="content">
                                <ul>
                                    <?php
                                    if (!empty($roles)) {
                                        foreach ($roles as $rid => $rval) {
                                            ?>
                                            <li>
                                                <a href="<?= $webroot ?>users/switchrole/<?= $rid ?>"
                                                   class="clearfix">
                                                    <figure class="image">
                                                        <img src="<?= $webroot ?>assets/images/!sample-user.jpg"
                                                             alt="Joseph Doe Junior" class="img-circle"/>
                                                    </figure>
                                                    <span class="title"><?= __($rval) ?></span>
                                                    <span class="message"><?= __('Switch to a ') . __($rval) ?></span>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </li>

                </ul>

            <?php } ?>


            <span class="separator"></span>

            <?php if (isset($userinfo)) { ?>
                <div id="userbox" class="userbox">
                    <a href="#" data-toggle="dropdown">
                        <figure class="profile-picture">
                            <img src="<?= $webroot ?>assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle"
                                 data-lock-picture="<?= $webroot ?>assets/images/!logged-user.jpg"/>
                        </figure>
                        <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                            <span class="name"><?= $userinfo['first_name'] . ' ' . $userinfo['last_name'] ?></span>
                            <span class="role"><?= __($userinfo['role']['title']) ?></span>
                        </div>

                        <i class="fa custom-caret"></i>
                    </a>

                    <div class="dropdown-menu">
                        <ul class="list-unstyled">
                            <li class="divider"></li>

                            <li>
                                <?= $this->Html->link(__('My Profile'),
                                    ['controller' => 'users', 'action' => 'my-profile'], ['escape' => false]) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(__('Change My Password'),
                                    ['controller' => 'users', 'action' => 'changeMyPassword'], ['escape' => false]) ?>
                            </li>
                            <li>
                                <?= $this->Html->link(__('<i class="fa fa-power-off"></i> Logout</a>'),
                                    ['controller' => 'users', 'action' => 'logout'], ['escape' => false]) ?>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- end: search & user box -->
    </header>
    <!-- end: header -->

    <div class="inner-wrapper">
        <!-- start: sidebar -->
        <aside id="sidebar-left" class="sidebar-left">

            <div class="sidebar-header">
                <div class="sidebar-title">
                    Navigation
                </div>
                <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html"
                     data-fire-event="sidebar-left-toggle">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>

            <div class="nano">
                <div class="nano-content">
                    <nav id="menu" class="nav-main" role="navigation">


                        <ul class="nav nav-main">
                            <?php echo $this->element('sidenav'); ?>
                        </ul>
                    </nav>

                    <hr class="separator"/>

                    <!--div class="sidebar-widget widget-tasks">
                        <div class="widget-header">
                            <h6>Projects</h6>
                            <div class="widget-toggle">+</div>
                        </div>
                        <div class="widget-content">
                            <ul class="list-unstyled m-none">
                                <li><a href="#">Porto HTML5 Template</a></li>
                                <li><a href="#">Tucson Template</a></li>
                                <li><a href="#">Porto Admin</a></li>
                            </ul>
                        </div>
                    </div>

                    <hr class="separator" />

                    <div class="sidebar-widget widget-stats">
                        <div class="widget-header">
                            <h6>Company Stats</h6>
                            <div class="widget-toggle">+</div>
                        </div>
                        <div class="widget-content">
                            <ul>
                                <li>
                                    <span class="stats-title">Stat 1</span>
                                    <span class="stats-complete">85%</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">
                                            <span class="sr-only">85% Complete</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <span class="stats-title">Stat 2</span>
                                    <span class="stats-complete">70%</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
                                            <span class="sr-only">70% Complete</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <span class="stats-title">Stat 3</span>
                                    <span class="stats-complete">2%</span>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
                                            <span class="sr-only">2% Complete</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div-->
                </div>

            </div>

        </aside>
        <!-- end: sidebar -->

        <section role="main" class="content-body">
            <header class="page-header">
                <h2><?= $this->fetch('title') ?></h2>

                <div class="right-wrapper pull-right">
                    <?php
                    if (!isset($breadcrumbs)) {
                        $breadcrumbs = [];
                        $breadcrumbs[ucwords($this->request->params['controller'])] = ['controller' => $this->request->params['controller']];
                        if ($this->request->params['action'] != 'index') {
                            $breadcrumbs[ucwords($this->request->params['action'])] = [
                                'controller' => $this->request->params['controller'],
                                'action' => $this->request->params['action']
                            ];
                        }
                    }
                    foreach ($breadcrumbs as $bcK => $bcV) {
                        if (is_array($bcV)) {
                            $bcV = '/' . implode('/', $bcV);
                        }
                        $newstr = preg_replace('/([a-z])([A-Z])/s', '$1 $2', $bcK);
                        $this->Html->addCrumb($newstr, $bcV);
                    }

                    echo $this->Html->getCrumbList(
                        [
                            'firstClass' => false,
                            'lastClass' => 'active',
                            'class' => 'breadcrumbs',
                            'escape' => false,
                            'separator' => false
                        ], '<i class="fa fa-home"></i>'
                    );
                    ?>

                    <!--a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a-->
                </div>
            </header>

            <div id="main-app">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>

            <div id="modalbox" class="modal-block modal-block-md mfp-hide">
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">Loading</h2>
                    </header>
                    <div class="panel-body">
                        <div class="modal-wrapper">
                            <div class="modal-text">
                                <p>Loading ...</p>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <!--button class="btn btn-primary modal-confirm">Confirm</button-->
                                <button class="btn btn-default modal-dismiss">Cancel</button>
                            </div>
                        </div>
                    </footer>
                </section>
            </div>
        </section>
    </div>

    <!--aside id="sidebar-right" class="sidebar-right">
                <div class="nano">
                    <div class="nano-content">
                        <a href="#" class="mobile-close visible-xs">
                            Collapse <i class="fa fa-chevron-right"></i>
                        </a>

                        <div class="sidebar-right-wrapper">

                            <div class="sidebar-widget widget-calendar">
                                <h6>Upcoming Tasks</h6>
                                <div data-plugin-datepicker data-plugin-skin="dark" ></div>

                                <ul>
                                    <li>
                                        <time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
                                        <span>Company Meeting</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="sidebar-widget widget-friends">
                                <h6>Friends</h6>
                                <ul>
                                    <li class="status-online">
                                        <figure class="profile-picture">
                                            <img src="<?= $webroot ?>assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-online">
                                        <figure class="profile-picture">
                                            <img src="<?= $webroot ?>assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-offline">
                                        <figure class="profile-picture">
                                            <img src="<?= $webroot ?>assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                    <li class="status-offline">
                                        <figure class="profile-picture">
                                            <img src="<?= $webroot ?>assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                        </figure>
                                        <div class="profile-info">
                                            <span class="name">Joseph Doe Junior</span>
                                            <span class="title">Hey, how are you?</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </aside-->
</section>

<script src="<?= $webroot ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="<?= $webroot ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="<?= $webroot ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="<?= $webroot ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?= $webroot ?>assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?= $webroot ?>assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>

<script src="<?= $webroot ?>assets/vendor/select2/js/select2.js"></script>
<script src="<?= WEBROOT ?>assets/vendor/jquery-maskedinput/jquery.maskedinput.js">
    <
    script
    src = "<?= $webroot ?>assets/vendor/pnotify/pnotify.custom.js" ></script>
<!-- Theme Base, Components and Settings -->
<script src="<?= $webroot ?>assets/javascripts/theme.js"></script>

<script src="<?= $webroot ?>assets/javascripts/theme.custom.js"></script>

<script src="<?= $webroot ?>assets/javascripts/theme.init.js"></script>

</body>
</html>
