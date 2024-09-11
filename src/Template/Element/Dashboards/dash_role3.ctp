<?php ?>

<div class="col-md-12">



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
                                <h4 class="title"><?= __('Total Transaction Today') ?></h4>
                                <div class="info">
                                    <strong class="amount"><?= $txnCount ?></strong>
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
                                <i class="fa fa-usd"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title"><?= __('Total Transaction Today $') ?></h4>
                                <div class="info">
                                    <strong class="amount"><?= __('$') ?><?= $txnAmount ?></strong>
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
