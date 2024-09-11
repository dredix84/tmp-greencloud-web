<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

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

                    <?php

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

        



        
    </div>

</div>