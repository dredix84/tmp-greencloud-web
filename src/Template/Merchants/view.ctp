<?php

/**
 * @var \App\Model\Entity\Merchant $merchant
 * @var float $remainingCredits
 */

$address = [
    $merchant->address_line_1,
    $merchant->address_line_2,
    $merchant->city,
    $merchant->parish_state,
];
if ($merchant->has('country')) {
    $address[] = $merchant->country->title;
}
$address = array_filter($address);
?>
<div class="merchants view large-9 medium-8 columns content">

    <div>
        <?php if ($this->Permission->isAdmin()) { ?>
            <div class="col-md-12">
                <section class="panel panel-featured-left panel-featured-secondary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-secondary">
                                    <i class="fa fa-usd"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title"><?= __('Outstanding Balance') ?></h4>
                                    <div class="info">
                                        <strong class="amount">
                                            $<?= number_format($remainingCredits, 2) ?> <?= $merchant->currency ?>
                                        </strong>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <!--a class="text-muted text-uppercase">(withdraw)</a-->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        <?php } ?>

        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($merchant->name) ?></h2>
                </header>
                <div class="panel-body">

                    <table class="vertical-table table table-hover">
                        <?php if ($this->Permission->isAdmin()) { ?>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <td><?= $this->Number->format($merchant->id) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Code') ?></th>
                                <td><?= h($merchant->code) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Outstanding Balance') ?></th>
                                <td>
                                    $<?= number_format($remainingCredits, 2) ?>  <?= $merchant->currency ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th><?= __('Name') ?></th>
                            <td><?= h($merchant->business_title) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Industry') ?></th>
                            <td><?= $merchant->has('industry') ? $merchant->industry->title : '' ?></td>
                        </tr>
                        <?php if (count($address) > 0) { ?>
                            <tr>
                                <th><?= __('Address') ?></th>
                                <td><?= implode(', ', $address) ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($this->Permission->isAdmin()) { ?>
                            <tr>
                                <th><?= __('Payment Structure') ?></th>
                                <td><?= $merchant->has('payment_structure') ? $this->Html->link($merchant->payment_structure->title,
                                        [
                                            'controller' => 'PaymentStructures',
                                            'action' => 'view',
                                            $merchant->payment_structure->id
                                        ]) : '' ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Loyalty Program') ?></th>
                                <td><?= $merchant->has('loyalty_program') ? $this->Html->link($merchant->loyalty_program->title,
                                        [
                                            'controller' => 'LoyaltyPrograms',
                                            'action' => 'view',
                                            $merchant->loyalty_program->id
                                        ]) : '' ?></td>
                            </tr>
                        <?php } ?>

                        <?php if ($this->Permission->isAdmin() || $this->Permission->inRole(2)) { ?>
                            <tr>
                                <th><?= __('Contact Name') ?></th>
                                <td><?= h($merchant->contact_name) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Contact Phone') ?></th>
                                <td><?= h($merchant->contact_phone) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Contact Position') ?></th>
                                <td><?= h($merchant->contact_position) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Contact Email') ?></th>
                                <td><?= h($merchant->contact_email) ?></td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <th><?= __('Website') ?></th>
                            <td><?= h($merchant->website) ?></td>
                        </tr>

                        <?php if ($this->Permission->hasPermission('merchants.viewapicredentials') || $this->Permission->isAdmin()) { ?>
                            <tr>
                                <th><?= __('Username') ?></th>
                                <td><?= h($merchant->username) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Password') ?></th>
                                <td><?= h($merchant->password) ?></td>
                            </tr>
                        <?php } ?>

                        <?php if ($this->Permission->isAdmin() || $this->Permission->inRole(2)) { ?>
                            <tr>
                                <th><?= __('Send SMS') ?></th>
                                <td><?= $merchant->send_sms ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Currency') ?></th>
                                <td><?= h($merchant->currency) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Created') ?></th>
                                <td><?= h($merchant->created) ?></td>
                            </tr>
                        <?php } ?>

                        <?php if ($this->Permission->isAdmin()) { ?>
                            <tr>
                                <th><?= __('Modified') ?></th>
                                <td><?= h($merchant->modified) ?></td>
                            </tr>

                            <tr>
                                <th><?= __('Is Active') ?></th>
                                <td><?= $merchant->is_active ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Is Locked') ?></th>
                                <td><?= $merchant->is_locked ? '<span class="label label-danger">Yes</span>' : '<span class="label label-success">No</span>'; ?></td>
                            </tr>
                        <?php } ?>

                        <?php if ($this->Permission->isOwnID($merchant->created_by) || $this->Permission->isAdmin()) { ?>
                            <tr>
                                <th><?= __('Low Credit Amount') ?></th>
                                <td>
                                    <span class="label label-danger"><?= $merchant->low_credit_alert_amount ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th><?= __('Send Low Credit Email') ?></th>
                                <td><?= $merchant->send_low_credit_email ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <th><?= __('About') ?></th>
                            <td><?= $this->Text->autoParagraph(h($merchant->about)); ?></td>
                        </tr>

                        <?php if ($this->Permission->isAdmin()) { ?>
                            <tr>
                                <th><?= __('Logo') ?></th>
                                <td><?= $this->Text->autoParagraph(h($merchant->logo)); ?></td>
                            </tr>
                        <?php } ?>
                    </table>

                </div>
            </section>
        </div>

        <?php if ($this->Permission->isAdmin() || $this->Permission->inRole(2)) { ?>
            <div class="col-md-12">
                <section class="panel panel-primary">
                    <header class="panel-heading">
                        <div class="panel-actions">
                        </div>
                        <h2 class="panel-title"><?= __('Mobile Signing App Settings') ?></h2>
                    </header>
                    <div class="panel-body">
                        <table class="vertical-table table table-hover">
                            <tr>
                                <th><?= __('Receipt Timeout') ?></th>
                                <td><?= h($merchant->receipt_timeout) ?> <?= __('minute(s)') ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Feedback Timeout') ?></th>
                                <td><?= h($merchant->feedback_timeout) ?> <?= __('minute(s)') ?></td>
                            </tr>
                        </table>
                    </div>
                </section>
            </div>
        <?php } ?>

        <?php if ($this->Permission->hasPermission('merchants.viewuser') && $merchant->has('users')) { ?>
            <div class="col-md-12">
                <section class="panel panel-primary">
                    <header class="panel-heading">
                        <div class="panel-actions">
                        </div>

                        <h2 class="panel-title"><?= _('User') ?></h2>
                    </header>
                    <div class="panel-body">

                        <table class="vertical-table table table-hover">
                            <tr>
                                <th><?= __('Name') ?></th>
                                <td><?= $this->Html->link($merchant->users[0]->fullName,
                                        ['controller' => 'Users', 'action' => 'view', $merchant->users[0]->id],
                                        ['title' => _('View full details on user')]) ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Email') ?></th>
                                <td><?= $merchant->users[0]->email ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Registered On') ?></th>
                                <td><?= $merchant->users[0]->register_date ? $merchant->users[0]->register_date->nice() : '' ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Active') ?></th>
                                <td><?= $merchant->users[0]->is_active ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>'; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Is Locked') ?></th>
                                <td><?= $merchant->users[0]->is_locked ? '<span class="label label-danger">Yes</span>' : '<span class="label label-success">No</span>'; ?></td>
                            </tr>

                        </table>
                    </div>
                </section>
            </div>
        <?php } ?>
    </div>
</div>
