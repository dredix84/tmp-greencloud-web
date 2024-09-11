
<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

$emode = (isset($receiptItem['id'])?'Edit':'Add');  //Used to determine what mode the form is in
?>
    
        
 
<div class="receiptItems form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class = "panel panel-primary">
            <header class = "panel-heading">
                <div class = "panel-actions">
                </div>

                <h2 class = "panel-title"><?php echo  __($emode . ' Receipt Item'); /* Add */ ?></h2>
            </header>
            <div class = "panel-body">


    <?= $this->Form->create($receiptItem) ?>
        <?php
            echo $this->Form->input('receipt_id', [
                'options' => $receipts,
                'class' => 'form-control input-md',
                'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('sku', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Sku'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('description', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Description'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('quantity', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Quantity'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('weight', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Weight'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('unit_price', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Unit Price'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
            echo $this->Form->input('total', [
                    'class' => 'form-control input-md',
                    'placeholder' => __('Total'),
                    'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                ]);
        ?>
    <?php
    echo $this->Form->button(__('Submit'), [
        'class' => 'mb-xs mt-xs mr-xs btn btn-success',
        'templateVars' => ['divClass' => 'col-sm-12']
        ]);
    echo $this->Form->end();
    ?>
            </div>
            </section>
        </div>    
    </div>
</div>

<script>
/*$(function() {

});*/
</script>