<?php
$this->loadHelper( 'Form', [
    'templates' => 'general_form',
] );

$emode = ( isset( $paymentStructure['id'] ) ? 'Edit' : 'Add' );  //Used to determine what mode the form is in
?>


<div class="paymentStructures form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?php echo __( $emode . ' Payment Structure' ); /* Edit */ ?></h2>
                </header>
                <div class="panel-body">

                    <div class="row">

                        <?= $this->Form->create( $paymentStructure ) ?>
                        <?php
                        echo $this->Form->input( 'title', [
                            'class'        => 'form-control input-md',
                            'placeholder'  => __( 'Title' ),
                            'templateVars' => [ 'divClass' => 'col-sm-12 mb-lg' ]
                        ] );
                        echo $this->Form->input( 'description', [
                            'class'        => 'form-control input-md',
                            'placeholder'  => __( 'Description' ),
                            'templateVars' => [ 'divClass' => 'col-sm-12 mb-lg' ]
                        ] );
                        echo $this->Form->input( 'cost_per_receipt', [
                            'class'        => 'form-control input-md',
                            'placeholder'  => __( 'Cost Per Receipt' ),
                            'templateVars' => [ 'divClass' => 'col-sm-6 mb-lg' ]
                        ] );
                        echo $this->Form->input( 'percent_per_receipt', [
                            'class'        => 'form-control input-md',
                            'placeholder'  => __( 'Percent Per Receipt' ),
                            'templateVars' => [ 'divClass' => 'col-sm-6 mb-lg' ]
                        ] );
                        echo $this->Form->input( 'cost_per_sms', [
                            'class'        => 'form-control input-md',
                            'placeholder'  => __( 'Cost Per SMS' ),
                            'step'         => .25,
                            'templateVars' => [ 'divClass' => 'col-sm-6 mb-lg' ]
                        ] );
                        echo $this->Form->input( 'currency', [
                            'class'        => 'form-control input-md',
                            'placeholder'  => __( 'Currency' ),
                            'templateVars' => [ 'divClass' => 'col-sm-6 mb-lg' ]
                        ] );
                        echo $this->Form->input( 'is_active', [
                            'class'        => 'form-control input-md',
                            'placeholder'  => __( 'Is Active' ),
                            'templateVars' => [ 'divClass' => 'col-sm-12 mb-lg' ]
                        ] );
                        echo $this->Form->input( 'is_default', [
                            'class'        => 'form-control input-md',
                            'placeholder'  => __( 'Is Default' ),
                            'templateVars' => [ 'divClass' => 'col-sm-12 mb-lg' ]
                        ] );
                        echo $this->Form->input( 'expiry_date', [ 'empty' => true ] );
                        ?>
                        <?php
                        echo $this->Form->button( __( 'Submit' ), [
                            'class'        => 'mb-xs mt-xs mr-xs btn btn-success',
                            'templateVars' => [ 'divClass' => 'col-sm-12' ]
                        ] );
                        echo $this->Form->end();
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    /*$(function() {

    });*/
</script>
