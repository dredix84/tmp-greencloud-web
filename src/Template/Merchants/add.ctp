<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);

/** @var \App\Service\Address $address */
/** @var \App\Model\Entity\Merchant $merchant */
/** @var array $userinfo */
/** @var array $countries */
/** @var array $industries */

$emode = (isset($merchant['id']) ? 'Edit' : 'Add');  //Used to determine what mode the form is in
use Cake\Core\Configure; ?>

<div class="merchants form large-9 medium-8 columns content">
    <div class="row">
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?php echo _($emode . ' Merchant'); ?></h2>
                </header>
                <div class="panel-body">

                    <?= $this->Form->create($merchant) ?>
                    <?php

                    echo $this->Porto->addHeader('General Details', 3);

                    echo $this->Form->input('name', [
                        'class' => 'form-control input-md',
                        'label' => _('Company Name'),
                        'placeholder' => _('Company Name'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);

                    $emailLink = $this->Html->link(_('Contact Us'), ['controller' => 'Pages', 'action' => 'contact'],
                        ['class' => 'btn btn-info btn-sm', 'target' => '_blank']);
                    echo $this->Porto->addAlert(_('If you are in an industry which does not appear in the drop down below, please use the form in the link below to send us an email indictating the industry you wish to have in the list.<br>' . $emailLink),
                        'info', false, 'col-md-12');
                    echo $this->Form->input('industry_id', [
                        'options' => $industries,
                        'empty' => true,
                        'class' => 'form-control input-md summernote',
                        'data-plugin-summernote',
                        'data-plugin-options' => '{ "height": 180, "codemirror": { "theme": "ambiance" } }',
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);

                    echo $this->Porto->addAlert(_('This information entered in the <strong>About</strong> field will be displayed to your customers when they click your company name so do not enter information you would not like your customers to see.'),
                        'info', false, 'col-md-12');
                    echo $this->Form->input('about', [
                        'class' => 'form-control input-md',
                        'placeholder' => _('About'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);

                    if('Add' === $emode){
                        echo $this->Porto->addAlert(_('This currency will determine what currency Greencloud will calculate credit usage and ultimately what currency invoices to this merchant are generate in.'),
                            'info', false, 'col-md-12');
                        echo $this->Form->input('currency', [
                            'class' => 'form-control input-md',
                            'empty' => '',
                            'options' => Configure::read('currency.currency_list'),
                            'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                        ]);
                    }


                    echo $this->Porto->addHr('dotted');
                    echo $this->Porto->addHeader('Contact Details', 3);

                    echo $this->Form->input('contact_name', [
                        'class' => 'form-control input-md',
                        'placeholder' => _('Contact Name'),
                        'default' => $userinfo['first_name'] . ' ' . $userinfo['last_name'],
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('contact_position', [
                        'class' => 'form-control input-md',
                        'placeholder' => _('Contact Position'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('contact_phone', [
                        'class' => 'form-control input-md',
                        'placeholder' => _('Contact Phone'),
                        'default' => $userinfo['phone'],
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('contact_email', [
                        'class' => 'form-control input-md',
                        'placeholder' => _('Contact Email'),
                        'default' => $userinfo['email'],
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                    ]);
                    echo $this->Form->input('website', [
                        'class' => 'form-control input-md',
                        'placeholder' => _('Website'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);

                    echo $this->Porto->addHr('dotted');
                    echo $this->Porto->addHeader('Address Details', 3);
                    echo $this->Porto->addAlert(_('Please note the address entered below is displayed to your customers.'),
                        'warning', false, 'col-md-12');

                    echo $this->Form->input('address_line_1', [
                        'class' => 'form-control input-md',
                        'placeholder' => _('Address Line 1'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('address_line_2', [
                        'class' => 'form-control input-md',
                        'placeholder' => _('Address Line 2'),
                        'templateVars' => ['divClass' => 'col-sm-12 mb-lg']
                    ]);
                    echo $this->Form->input('city', [
                        'class' => 'form-control input-md',
                        'placeholder' => _('City'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg'],
                        'default' => $address->getCity()
                    ]);
                    echo $this->Form->input('parish_state', [
                        'class' => 'form-control input-md',
                        'placeholder' => _('Parish/State/Province'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg'],
                        'default' => $address->getRegion()
                    ]);
                    echo $this->Form->input('country_id', [
                        'class' => 'form-control input-md',
                        'options' => $countries,
                        'empty' => _('Select Country'),
                        'templateVars' => ['divClass' => 'col-sm-6 mb-lg'],
                        'default' => $address->getCountryId()
                    ]);

                    echo $this->Form->input('return_url', ['type' => 'hidden', 'value' => 'true']);
                    ?>

                    <?= $this->Porto->addHr('dotted'); ?>
                    <?= $this->Porto->addHeader($merchant->name . ' Account Setting', 3); ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tabs tabs-vertical tabs-left tab-primary">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#tab-credits" data-toggle="tab">Credits</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-mobile" data-toggle="tab">Mobile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#tab-sms" data-toggle="tab">SMS</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-credits" class="tab-pane active">
                                        <?php
                                        echo $this->Porto->addHeader('Credits', 4);
                                        echo $this->Porto->addAlert(_('The <strong>Low credit amount</strong> is used to determine when an alert should be sent to your email notifying you that credit for the specific merchant account is running low. <br>If you do not want email alerts for low credit sent to you email, uncheck the checkbox below.'),
                                            'info', false, 'col-md-12');
                                        echo $this->Form->input('low_credit_alert_amount', [
                                            'class' => 'form-control input-md',
                                            'label' => _('Low credit amount'),
                                            'min' => 1,
                                            'default' => 10,
                                            'templateVars' => ['divClass' => 'col-sm-6 mb-lg']
                                        ]);
                                        echo $this->Porto->addCheckbox('Send low credit alert?',
                                            'send_low_credit_email', $merchant, 'col-md-6', 'col-md-12', 'col-md-12');
                                        ?>
                                    </div>
                                    <div id="tab-mobile" class="tab-pane">
                                        <?php
                                        echo $this->Porto->addHeader('Mobile Setting', 4);
                                        echo $this->Porto->addAlert(__('This area allows you to control settings related to the behaviour of the mobile application.<br /> Don\'t worry, we already set defaults which will work well for your business.'),
                                            'info', false, 'col-md-12');

                                        echo $this->Form->input('receipt_timeout', [
                                            'class' => 'form-control input-md',
                                            'placeholder' => __('Receipt timeout'),
                                            'templateVars' => ['divClass' => 'col-sm-6 mb-lg'],
                                            'min' => 1,
                                            'max' => 15,
                                            'title' => __('Time the mobile application should wait for signing before it cancels the receipt and returns to the waiting screen.'),
                                            'default' => 2
                                        ]);

                                        echo $this->Form->input('feedback_timeout', [
                                            'class' => 'form-control input-md',
                                            'placeholder' => __('Feedback timeout'),
                                            'templateVars' => ['divClass' => 'col-sm-6 mb-lg'],
                                            'min' => 1,
                                            'max' => 15,
                                            'title' => _('Time the mobile application should wait for user feedback before it returns to the waiting screen.'),
                                            'default' => 2
                                        ]);

                                        ?>
                                    </div>
                                    <div id="tab-sms" class="tab-pane">
                                        <?php
                                        echo $this->Porto->addHeader('SMS', 4);
                                        echo $this->Porto->addAlert(_('Options under this area allow you to control whether text messages (SMS) are sent to your customers when a receipt is recieved for the specific customer.'),
                                            'info', false, 'col-md-12');

                                        echo $this->Porto->addCheckbox('Send text message to customers?', 'send_sms',
                                            $merchant, 'col-md-8', 'col-md-12', 'col-md-12');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    echo $this->Form->button(_('Submit'), [
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
