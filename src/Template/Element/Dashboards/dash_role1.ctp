<?php

use Cake\View\Helper\UrlHelper;

$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$user = &$userinfo;
$webroot = $this->Url->build('/', true);

//User Role    
?>
<div class="col-md-12">

    <div class="row">

        <div class="col-md-12 col-lg-12 col-xl-12">
            <section class="panel panel-info">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                    </div>

                    <h2 class="panel-title"><?= __('About Your Dashboard') ?></h2>
                </header>
                <div class="panel-body">
                    <p class="lead"><?= __('Hello ') ?><span class="alternative-font"><?= $userinfo['first_name'] ?></span>,</p>
                    <p class="lead">This dashboard is a quick and easy way to see your account activity. Here you can see how many points you have accumulated so far and if there are any new receipts.</p>
                    <p>
                        <?php if ($loyaltyPointsToday == 0) { ?>
                            As you can see below, you have not earned any loyalty points today.
                        <?php } else { ?>
                            As you can see below, you have earned <?= $loyaltyPointsToday ?> loyalty point<?= ($loyaltyPointsToday <= 1 ? '' : 's') ?> today.
                        <?php } ?>
                        Once you have accumulated enough points, a check will be sent to you so please ensure you have the correct address entered in your profile.
                    </p>
                    <p><?= __('If you would like to update your profile, ') ?> <?= $this->Html->link(__('click here to update your profile.'), ['controller' => 'users', 'action' => 'myProfile'], ['class' => 'btn btn-sm btn-primary']); ?></p>
                </div>
            </section>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-primary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-primary">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title"><?= __('Total Receipts') ?></h4>
                                <div class="info">
                                    <strong class="amount"><?= $receiptCnt ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <?= $this->Html->link(__('View My Receipts'), ['controller' => 'Receipts'/* , 'action' => 'signup' */], ['class' => 'text-muted text-uppercase']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-md-6 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-quartenary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-quartenary">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title"><?= __('New Receipts') ?></h4>
                                <div class="info">
                                    <strong class="amount"><?= $receiptNewCnt ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <?= $this->Html->link(__('View My Receipts'), ['controller' => 'Receipts'/* , 'action' => 'signup' */], ['class' => 'text-muted text-uppercase']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-md-6 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-tertiary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-tertiary">
                                <i class="fa fa-money"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title"><?= __('Total Loyalty Points') ?></h4>
                                <div class="info">
                                    <strong class="amount">$<?= $loyaltyPoints ? $loyaltyPoints : 0 ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <?= $this->Html->link(__('View My Receipts'), ['controller' => 'Receipts'/* , 'action' => 'signup' */], ['class' => 'text-muted text-uppercase']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="col-md-6 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-secondary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-secondary">
                                <i class="fa fa-money"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title"><?= __('Total Loyalty Points Earn Today') ?></h4>
                                <div class="info">
                                    <strong class="amount">$<?= $loyaltyPointsToday ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <?= $this->Html->link(__('View My Receipts'), ['controller' => 'Receipts'/* , 'action' => 'signup' */], ['class' => 'text-muted text-uppercase']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


    </div>

</div>