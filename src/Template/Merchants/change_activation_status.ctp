<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
?>

<?php echo $this->Porto->addAlert('This page allows you to change the activation status of  a merchant account and also send a message to the merchant about the status change.', 'info', false, 'col-md-12'); ?>

<div class="col-md-12">
    <section class="panel panel-info">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
            </div>

            <h2 class="panel-title">Reactivate Merchant Account</h2>
        </header>
        <div class="panel-body">
            <?= $this->Form->create($merchant) ?>

            <?php
            $dstatus = $merchant->is_active == 1 && $merchant->is_locked == 0 ? true : false;

            echo $this->Form->input('new_status', [
                'class' => 'form-control input-md',
                'options' => ['Deactived', 'Activated'],
                'default' => $dstatus ? 0 : 1,
                'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
            ]);
            echo $this->Form->input('send_email', [
                'class' => 'form-control input-md',
                'options' => ['No', 'Yes'],
                'default' => 1,
                'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
            ]);
            echo $this->Form->input('admin_note', [
                'class' => 'form-control input-md',
                'default' => $merchant->admin_note,
                'plaveholder' => 'Please note the date and reason for changing the status of this account.',
                'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
            ]);

            echo $this->Porto->addHr('dotted', 'col-md-12');
            echo $this->Porto->addHeader('Email Details', 3, 'col-md-12');

            $emails = [];
            if (!empty($merchant->contact_email)) {
                $emails[$merchant->contact_email] = $merchant->contact_email . ' - ' . __('Merchant Account');
            }
            if ($merchant->has('user')) {
                $emails[$merchant->user->email] = $merchant->user->email . ' - ' . __('User Account');
            }
            if ($merchant->has('crated_by_user')) {
                $emails[$merchant->crated_by_user->email] = $merchant->crated_by_user->email . ' - ' . __('User Account');
            }

            echo $this->Form->input('email_to', [
                'class' => 'form-control input-md',
                'options' => $emails,
                'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
            ]);
            echo $this->Form->input('subject', [
                'class' => 'form-control input-md',
                'default' => __('Merchant Account Activation Status Change'),
                'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
            ]);


            $message = 'Hello' . (!empty($merchant->contact_name) ? ' ' . $merchant->contact_name : '0') . ', <br />'
                    . 'This email serves to inform you that your merchant account "<strong>' . $merchant->name . '</strong>" have been ' . ($dstatus ? 'deactivated' : 'activated') . '.<br />'
                    . 'If you have any questions, please contact a ' . \Cake\Core\Configure::read('app_name') . ' representative.<br /><br />'
                    . '<a href="' . WEBROOT . 'login">Click here</a> to log in and view your merchant account details.';
            echo $this->Form->input('message', [
                'class' => 'form-control input-md summernote',
                'default' => $message,
                'type' => 'textarea',
                'data-plugin-summernote',
                'data-plugin-options' => '{ "height": 180, "codemirror": { "theme": "ambiance" } }',
                'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
            ]);

            echo $this->Form->button(__('Change Activation Status'), [
                'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                'templateVars' => ['divClass' => 'col-sm-12']
            ]);
            echo $this->Form->end();
            ?>
        </div>
    </section>
</div>


<link rel="stylesheet" href="<?= WEBROOT ?>assets/vendor/summernote/summernote.css" />
<link rel="stylesheet" href="<?= WEBROOT ?>assets/vendor/summernote/summernote-bs3.css" />
<script src="<?= WEBROOT ?>assets/vendor/summernote/summernote.js"></script>

<script>
    $('#new-status').change(function(){
        alert('You have changed the activation status so please remember to update the body of the email if you intent to sent an email.');
    });
</script>