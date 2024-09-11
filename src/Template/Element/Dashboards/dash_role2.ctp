<?php ?>
<?php use Cake\Core\Configure;

if ($userinfo['merchant_id'] == -1) { ?>
    <a href="<?= WEBROOT ?>merchants/add?return_url=<?= WEBROOT ?>Dashboards" class="modalbox" data-ajaxlink="#modalbox"
       data-title="<?= __('Setup Merchant Account') ?>">
        <div class="col-md-12 col-lg-12 col-xl-6">
            <section class="panel panel-horizontal">
                <header class="panel-heading bg-success">
                    <div class="panel-heading-icon">
                        <i class="fa fa-cart-plus"></i>
                    </div>
                </header>
                <div class="panel-body p-lg">
                    <h3 class="text-weight-semibold mt-sm"><?= __('Setup Merchant Account') ?></h3>
                    <p><?= __('Click here to setup your merchant account. This will allow you to start processing transactions.') ?></p>
                </div>
            </section>
        </div>
    </a>

<?php } else {    //Merchant account was created   ?>
<div class="col-md-12">
    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
            </div>

            <h2 class="panel-title"><?= __('Merchant API Details for ') ?> <?= $userinfo['merchant']['name'] ?>
                - <?= $userinfo['merchant']['city'] ?></h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= __('Use the details below in the PrintSling desktop application to start transmitting receipt data. If you would like to learn more about setting up the desktop application, please see the link below.') ?>
                        <br/>
                        <?= $this->Html->link(__('<i class="fa fa-info-circle"></i> Setup Desktop Application'),
                            ['controller' => 'Pages', 'action' => 'setup_desktop_application'],
                            ['class' => 'btn btn-info', 'escape' => false]); ?>
                    </p>
                    <div class="row">
                        <?php
                        echo $this->Form->input('username', [
                            'class' => 'form-control input-md',
                            'value' => $userinfo['merchant']['username'],
                            'templateVars' => ['divClass' => 'col-sm-6 mb-lg'],
                            'readonly' => 'readonly'
                        ]);
                        echo $this->Form->input('password', [
                            'class' => 'form-control input-md',
                            'type' => 'text',
                            'value' => $userinfo['merchant']['password'],
                            'templateVars' => ['divClass' => 'col-sm-6 mb-lg'],
                            'readonly' => 'readonly'
                        ]);
                        ?>
                        <div class="col-md-12">
                            <?= $this->Html->link(__('<i class="fa fa-edit"></i> Edit'),
                                ['controller' => 'merchants', 'action' => 'edit', $userinfo['merchant']['id']], [
                                    'class' => 'btn btn-warning modalbox',
                                    'escape' => false,
                                    'data-ajaxlink' => "#modalbox"
                                ]); ?>
                            <?= $this->Html->link(__('<i class="fa fa-key"></i> Reset API Password'), [
                                'controller' => 'merchants',
                                'action' => 'resetApiPassword',
                                $userinfo['merchant']['id']
                            ], [
                                'class' => 'btn btn-warning',
                                'escape' => false,
                                'confirm' => __('Are you sure you want to reset the password for this merchant account?')
                            ]); ?>
                            <?php
                            echo $this->Html->link(
                                '<i class="fa fa-signature"></i> Launch Web Signer',
                                ['controller' => 'pages', 'action' => 'launchWebSigner'],
                                [
                                    'class' => 'btn btn-success',
                                    'target' => '_blank',
                                    'escape' => false,
                                    'title' => __('Launch web interface used to sign receipts'),
                                    'data' => [
                                        'token' => sprintf(
                                            '%s:%s',
                                            $userinfo['merchant']['username'],
                                            $userinfo['merchant']['password']
                                        )
                                    ],
                                    'confirm' => 'This will launch the Web Signer in a new tab. Are you sure?'
                                ]
                            );
                            ?>

                            <?= $this->Html->link(__('Setup Additional Merchant Account'),
                                ['controller' => 'merchants', 'action' => 'add', $userinfo['merchant']['id']], [
                                    'class' => 'btn btn-success modalbox right',
                                    'escape' => false,
                                    'data-ajaxlink' => "#modalbox",
                                    'data-title' => __('Setup Additional Merchant Account')
                                ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-6">
            <section class="panel panel-featured-left panel-featured-tertiary">
                <div class="panel-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-tertiary">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title"><?= __('Number of Transactions for ') . date('M, d Y') ?></h4>
                                <div class="info">
                                    <strong class="amount"><?= $txnCount ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <?= $this->Html->link(__('View My Receipts'),
                                    ['controller' => 'Receipts'/* , 'action' => 'signup' */],
                                    ['class' => 'text-muted text-uppercase']); ?>
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
                                <i class="fa fa-usd"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title"><?= __('Total Transactions $ for ') . date('M, d Y') ?></h4>
                                <div class="info">
                                    <strong
                                        class="amount"><?= __('$') ?><?= ($txnAmount > 0 ? $txnAmount : 0) ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <?= $this->Html->link(__('View My Receipts'),
                                    ['controller' => 'Receipts'/* , 'action' => 'signup' */],
                                    ['class' => 'text-muted text-uppercase']); ?>
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
                                <h4 class="title"><?= __('Credits Remaining') ?></h4>
                                <div class="info">
                                    <strong class="amount"><?= $creditsRemaining ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <?= $this->Html->link(__('See your usage here'),
                                    ['controller' => 'reports', 'action' => 'creditUsageSummary', 'month', 6],
                                    ['class' => 'text-muted text-uppercase']); ?>
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
                                <h4 class="title"><?= __('Credits used Today') ?></h4>
                                <div class="info">
                                    <strong class="amount"><?= $creditsUsedToday ?></strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <?= $this->Html->link(__('See your usage here'),
                                    ['controller' => 'reports', 'action' => 'creditUsageSummary', 'day', 120],
                                    ['class' => 'text-muted text-uppercase']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php } ?>
