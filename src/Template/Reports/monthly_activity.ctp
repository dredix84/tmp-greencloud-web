<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
$webroot = $this->Url->build('/', true);

$amountData = [];
$countData = [];
$cntData = [];
foreach ($data as $d) {
    $countData[] = [$d['txn_date'], (integer) $d['cnt']];
    $amountData[] = [$d['txn_date'], (integer) $d['amount']];

    $nDate = new stdClass();
    $nDate->y = $d['txn_date'];
    $nDate->a = (integer) $d['cnt'];
    $cntData[] = $nDate;
}
?>


<div class="row">
    <div class="col-md-12">
        <?php if (!$this->request->isAjax()) { ?>
            <section class="panel panel-info">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Search'); ?> <?= __('Receipts') ?></h2>
                </header>
                <div class="panel-body">
                    <?= $this->Form->create() ?>
                    <div class="col-md-6">
                        <div class="input-group mb-md">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="search" name="search_term" id="search_term" placeholder="<?= __('Enter your search term') ?>" class="form-control" value="<?= (isset($_REQUEST['search_term']) ? $_REQUEST['search_term'] : '') ?>">
                        </div>    
                    </div>

                    <?php
                    echo $this->Form->input('policy_number', [
                        'label' => false,
                        'class' => 'form-control input-md',
                        'placeholder' => __('Policy Number'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);

                    echo $this->Form->input('claim_number', [
                        'label' => false,
                        'class' => 'form-control input-md',
                        'placeholder' => __('Claim Number'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);

                    if ($this->Permission->inRole([3, 1]) || $this->Permission->isAdmin()) {
                        echo $this->Form->input('merchant_id', [
                            'label' => false,
                            'class' => 'form-control input-md populate',
                            'empty' => __('Merchant'),
                            'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                        ]);
                    }

                    if ($this->Permission->inRole(2) || $this->Permission->isAdmin()) {
                        echo $this->Form->input('provider_id', [
                            'label' => false,
                            'class' => 'form-control input-md populate',
                            'empty' => __('Provider'),
                            'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                        ]);
                    }

                    echo $this->Form->input('receipt_date', [
                        'label' => false,
                        'class' => 'form-control input-md',
                        'placeholder' => __('Date (yyyy-mm-dd)'),
                        'autocomplete' => 'off',
                        'data-plugin-datepicker' => '',
                        'data-plugin-options' => '{ "format": "yyyy-mm-dd" }',
                        'templateVars' => ['divClass' => 'col-sm-3 mb-lg']
                    ]);

                    echo $this->Form->input('total', [
                        'label' => false,
                        'class' => 'form-control input-md',
                        'placeholder' => __('Total ($)'),
                        'templateVars' => ['divClass' => 'col-sm-3 mb-lg']
                    ]);
                    ?>

                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="input-daterange input-group" data-plugin-datepicker>
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <?php
                                echo $this->Form->input('start-date', [
                                    'label' => false,
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'placeholder' => __('Start date')
                                ]);
                                ?>
                                <span class="input-group-addon">to</span>
                                <?php
                                echo $this->Form->input('end-date', [
                                    'label' => false,
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'placeholder' => __('End date')
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    echo $this->Form->button(__('Preform Search'), [
                        'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                        'templateVars' => ['divClass' => 'col-sm-3']
                    ]);
                    echo $this->Form->button(__('Export Search to Excel'), [
                        'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                        'templateVars' => ['divClass' => 'col-sm-3']
                    ]);
                    echo $this->Form->end();
                    ?>
                </div>
            </section>
        <?php } ?>

        <section class="panel panel-success">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                </div>

                <h2 class="panel-title"><?= __('Monthly Activity Report') ?></h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Month-Year</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $d) { ?>
                                <tr>
                                    <td><?= $d['txn_date'] ?></td>
                                    <td><?= $d['cnt'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>



        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>

                <h2 class="panel-title">Monthly Receipt Count</h2>
                <p class="panel-subtitle">This chart shows the receipt count for each month.</p>
            </header>
            <div class="panel-body">

                <div class="chart chart-md" id="flotBasic"></div>
                <script type="text/javascript">

                    var flotBasicData = [{
                            data: <?= json_encode($countData); ?>,
                            color: "#0088cc"
                        }];


                </script>

            </div>
        </section>
    </div>

    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>

                <h2 class="panel-title">Monthly Receipt $ Amount</h2>
                <p class="panel-subtitle">This chart shows the sum of receipts for each month.</p>
            </header>

            <div class="panel-body">

                <div class="chart chart-md" id="flotBasic2"></div>
                <script type="text/javascript">

                    var flotBasicData2 = [{
                            data: <?= json_encode($amountData); ?>,
                            color: "#0088cc"
                        }];


                </script>

            </div>


    </div>
</div>

<script src="<?= $webroot ?>assets/vendor/jquery-appear/jquery-appear.js"></script>
<script src="<?= $webroot ?>assets/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="<?= $webroot ?>assets/vendor/flot/jquery.flot.js"></script>
<script src="<?= $webroot ?>assets/vendor/flot.tooltip/flot.tooltip.js"></script>
<script src="<?= $webroot ?>assets/vendor/flot/jquery.flot.pie.js"></script>
<script src="<?= $webroot ?>assets/vendor/flot/jquery.flot.categories.js"></script>
<script src="<?= $webroot ?>assets/vendor/flot/jquery.flot.resize.js"></script>
<script src="<?= $webroot ?>assets/vendor/jquery-sparkline/jquery-sparkline.js"></script>
<script src="<?= $webroot ?>assets/vendor/raphael/raphael.js"></script>
<script src="<?= $webroot ?>assets/vendor/morris.js/morris.js"></script>
<script src="<?= $webroot ?>assets/vendor/gauge/gauge.js"></script>
<script src="<?= $webroot ?>assets/vendor/snap.svg/snap.svg.js"></script>
<script src="<?= $webroot ?>assets/vendor/liquid-meter/liquid.meter.js"></script>
<script src="<?= $webroot ?>assets/vendor/chartist/chartist.js"></script>


<script>
                    (function ($) {

                        'use strict';

                        var flotDashSales1 = $.plot('#flotBasic', flotBasicData, {
                            series: {
                                lines: {
                                    show: true,
                                    lineWidth: 2
                                },
                                points: {
                                    show: true
                                },
                                shadowSize: 0
                            },
                            grid: {
                                hoverable: true,
                                clickable: true,
                                borderColor: 'rgba(0,0,0,0.1)',
                                borderWidth: 1,
                                labelMargin: 15,
                                backgroundColor: 'transparent'
                            },
                            yaxis: {
                                min: 0,
                                color: 'rgba(0,0,0,0.1)'
                            },
                            xaxis: {
                                mode: 'categories',
                                color: 'rgba(0,0,0,0)'
                            },
                            legend: {
                                show: false
                            },
                            tooltip: true,
                            tooltipOpts: {
                                content: '%x: %y',
                                shifts: {
                                    x: -30,
                                    y: 25
                                },
                                defaultTheme: false
                            }
                        });

                        //Chart showing $ amount
                        var flotDashSales2 = $.plot('#flotBasic2', flotBasicData2, {
                            series: {
                                lines: {
                                    show: true,
                                    lineWidth: 2
                                },
                                points: {
                                    show: true
                                },
                                shadowSize: 0
                            },
                            grid: {
                                hoverable: true,
                                clickable: true,
                                borderColor: 'rgba(0,0,0,0.1)',
                                borderWidth: 1,
                                labelMargin: 15,
                                backgroundColor: 'transparent'
                            },
                            yaxis: {
                                min: 0,
                                color: 'rgba(0,0,0,0.1)'
                            },
                            xaxis: {
                                mode: 'categories',
                                color: 'rgba(0,0,0,0)'
                            },
                            legend: {
                                show: false
                            },
                            tooltip: true,
                            tooltipOpts: {
                                content: '%x: $%y',
                                shifts: {
                                    x: -30,
                                    y: 25
                                },
                                defaultTheme: false
                            }
                        });

                    }).apply(this, [jQuery]);

</script>
