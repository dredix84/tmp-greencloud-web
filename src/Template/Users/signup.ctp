<?php
$this->layout = 'login_signup';
$this->loadHelper('Form', [
    'templates' => 'login_form',
]);

$webroot = &$this->request->webroot;
?>

<style>
    .panel-body .panel .fa {
        margin-top: 25px;
    }
</style>

<div class="panel panel-sign">
    <div class="panel-title-sign mt-xl text-right">
        <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> <?= __('Sign Up') ?></h2>
    </div>
    <div class="panel-body">

        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <a href="<?= $webroot ?>users/registeruser">
                    <section class="panel">
                        <header class="panel-heading bg-info">
                            <div class="panel-heading-icon bg-primary mt-sm">
                                <i class="fa fa-user"></i>
                            </div>
                        </header>
                        <div class="panel-body">
                            <h3 class="text-weight-semibold mt-none text-center"><?= __('User Sign Up') ?></h3>
                            <p class="text-center"><?= __('If you are a user and wish to get access to your previous receipts sent to email, click here to sign up.') ?></p>
                        </div>
                    </section>
                </a>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <a href="<?= $webroot ?>users/registermerchant">
                    <section class="panel">
                        <header class="panel-heading bg-primary">
                            <div class="panel-heading-icon">
                                <i class="fa fa-building"></i>
                            </div>
                        </header>
                        <div class="panel-body text-center">
                            <h3 class="text-weight-semibold mt-sm text-center"><?= __('Merchant Sign Up') ?></h3>
                            <p class="text-center"><?= __('Are you a merchant and who would like to offer receipt to email service to your customers? If yes, then click here to sign up.') ?></p>
                        </div>
                    </section>
                </a>
            </div>

        </div>


    </div>
</div>