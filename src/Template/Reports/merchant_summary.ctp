<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
$webroot = $this->Url->build('/', true);

$amountData = [];
$countData = [];
$cntData = [];
?>


<div class="row">
    <div class="col-md-12">

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
                <?php
                if ($this->Permission->inRole([3, 1]) || $this->Permission->isAdmin()) {
                    echo $this->Form->input('merchant_id', [
                        'label' => false,
                        'class' => 'form-control input-md populate',
                        'empty' => __('Merchant'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                }

                /* if ($this->Permission->inRole(2) || $this->Permission->isAdmin()) {
                  echo $this->Form->input('provider_id', [
                  'label' => false,
                  'class' => 'form-control input-md populate',
                  'empty' => __('Provider'),
                  'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                  ]);
                  } */
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



        <section class="panel panel-success">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                </div>

                <h2 class="panel-title"><?=__('Merchant Summary Report')?></h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table mb-none">
                        <thead>
                            <tr>
                                <th>Merchant</th>
                                <th>Count</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
<?php foreach ($data as $d) { ?>
                                <tr>
                                    <td><?= $d['name'] ?></td>
                                    <td><?= $d['cnt'] ?></td>
                                    <td>$<?= $d['amount'] ?></td>
                                </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>




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


