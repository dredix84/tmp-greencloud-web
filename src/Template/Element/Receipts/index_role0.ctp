<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
$receiptPath = \Cake\Core\Configure::read('receipts_file_path');
$webroot = $this->Url->build('/', true);
$count = $this->Paginator->params()['count'];
?>
<script src="<?= $webroot ?>assets/vendor/select2/js/select2.js"></script>
<div class="receipts index large-9 medium-8 columns content">

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
                    <?= $this->Form->create(null, ['type' => 'get']) ?>
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

                    echo $this->Form->input('Receipts.provider_id', [
                        'label' => false,
                        'class' => 'form-control input-md populate',
                        'empty' => 'Provider',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);

                    echo $this->Form->input('Receipts.merchant_id', [
                        'label' => false,
                        //'data-plugin-selectTwo',
                        'class' => 'form-control input-md populate',
                        'placeholder' => __('Merchant'),
                        'empty' => 'Merchant',
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);

                    echo $this->Form->input('claim_number', [
                        'label' => false,
                        'class' => 'form-control input-md',
                        'placeholder' => __('Claim Number'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);

                    echo $this->Form->input('authorize_number', [
                        'label' => false,
                        'class' => 'form-control input-md',
                        'placeholder' => __('Authorization Number'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);

                    echo $this->Form->input('receipt_date', [
                        'label' => false,
                        'class' => 'form-control input-md',
                        'placeholder' => __('Date (yyyy-mm-dd)'),
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

                    echo $this->Form->button(__('Preform Search'), [
                        'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                        'templateVars' => ['divClass' => 'col-sm-3']
                    ]);
                    echo $this->Form->button(__('Export Search to Excel'), [
                        'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                        'templateVars' => ['divClass' => 'col-sm-3']
                    ]);
                    echo $this->Form->input('a', ['type' => 'hidden', 'value' => 'search']);
                    echo $this->Form->end();
                    ?>
                </div>
            </section>


            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('My Receipts') ?> <small>(<?= $count ?> <?= $count == 1 ? __('Record found') : __('Records found') ?> )</small></h2>
                </header>
                <div class="panel-body">
                    <div class="_table-responsive">

                        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover mb-none">
                            <thead>
                                <tr>
                                    <th><?= $this->Paginator->sort('user') ?></th>
                                    <th><?= $this->Paginator->sort('receipt_number', 'Receipt #') ?></th>
                                    <th><?= $this->Paginator->sort('merchant_id') ?></th>
                                    <th><?= $this->Paginator->sort('provider_id') ?></th>
                                    <th><?= $this->Paginator->sort('terminal') ?></th>
                                    <th><?= $this->Paginator->sort('receipt_date') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th><?= $this->Paginator->sort('total') ?></th>
                                    <th><?= $this->Paginator->sort('loyalty_cost', 'Loyalty') ?></th>
                                    <th><?= $this->Paginator->sort('credits_used') ?></th>
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($receipts as $receipt): ?>
                                    <tr>
                                        <td><?= h($receipt->user->username) ?></td>
                                        <td><?= h($receipt->receipt_number) ?></td>
                                        <td><?= $receipt->has('merchant') ? $this->Html->link($receipt->merchant->business_title, ['controller' => 'Merchants', 'action' => 'view', $receipt->merchant->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) : '' ?></td>
                                        <td><?= $receipt->has('provider') ? $receipt->provider->name : '' ?></td>
                                        <td><?= h($receipt->terminal) ?></td>
                                        <td><?= h($receipt->receipt_date) ?></td>
                                        <td><?= h($receipt->created) ?></td>
                                        <td><?= __('$') . h($receipt->total) ?></td>
                                        <td><?= __('$') . h($receipt->loyalty_cost) ?></td>
                                        <td><?= $receipt->credits_used ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link(__('Summary'), ['action' => 'view', $receipt->id], ['escape' => false, 'class' => 'modalbox mb-xs mt-xs mr-xs btn-xs btn-primary', 'data-ajaxlink' => '#modalbox']) ?>
                                            <?php
                                            if (file_exists($receiptPath . $receipt->id . '.pdf')) {
                                                echo $this->Html->link(__('Receipt'), ['action' => 'preview_receipt', $receipt->id, $receipt->security_key], ['escape' => false, 'target' => '_blank', 'class' => 'modalbox_ mb-xs mt-xs mr-xs btn-xs btn-primary'/* , 'data-ajaxlink' => '#modalbox' */]);
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>
    </div>                            




    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev(__('previous'), ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next'), ['escape' => false]) ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
