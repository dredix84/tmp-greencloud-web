<?php
$ruNames = ['Unregistered', 'Registered'];
?>
<div class="row">
    <div class="col-md-6">
        <section class="panel panel-primary">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                </div>

                <h2 class="panel-title">User Count by Role</h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-none">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>User Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($roleUserCount as $ruc) { ?>
                                <tr>
                                    <td><?= $ruc['title'] ?></td>
                                    <td><?= $ruc['user_count'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <div class="col-md-6">
        <section class="panel panel-success">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                </div>

                <h2 class="panel-title">Registered Vs Unregistered</h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-none">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($registeredVsUnregisteredUser as $ru) { ?>
                                <tr>
                                    <td><?= $ruNames[$ru['user_registered']] ?></td>
                                    <td><?= $ru['user_count'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>


<div class="row">
    <div class="col-md-6">

        <section class="panel panel-info">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                </div>

                <h2 class="panel-title">Today's Receipts & SMSs</h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <?php if (empty($todaysTxnByMerchant)) { ?>
                        <div class="alert alert-warning">
                            <strong>Nothing!</strong> No receipts for this date.
                        </div>
                    <?php } else { ?>
                        <table class="table table-bordered mb-none">
                            <thead>
                                <tr>
                                    <th>Merchant</th>
                                    <th>Receipt Count</th>
                                    <th>SMS Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $todayTotal = 0;
                                $todaySmsTotal = 0;
                                foreach ($todaysTxnByMerchant as $ti) {
                                    $todayTotal += $ti['receipt_count'];
                                    $todaySmsTotal += $ti['sms_count'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $this->Html->link(h($ti['name']), ['controller' => 'merchants', 'action' => 'view', $ti['merchant_id']], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                                        </td>
                                        <td>
                                            <?= $this->Html->link(h($ti['receipt_count']), ['controller' => 'reports', 'action' => 'monthly-activity', 'merchant_id' => $ti['merchant_id'], '_method' => 'GET'], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                                        </td>
                                        <td>
                                            <?= $ti['sms_count'] ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td><?= __('Total') ?></td>
                                    <td><?= $todayTotal ?></td>
                                    <td><?= $todaySmsTotal ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </section>
    </div>


    <div class="col-md-6">

        <section class="panel panel-info">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
                </div>

                <h2 class="panel-title">Yesterday's Receipts</h2>
            </header>
            <div class="panel-body">
                <div class="table-responsive">
                    <?php if (empty($yesterdayTxnByMerchant)) { ?>
                        <div class="alert alert-warning">
                            <strong>Nothing!</strong> No receipts for this date.
                        </div>
                    <?php } else { ?>
                        <table class="table table-bordered mb-none">
                            <thead>
                                <tr>
                                    <th>Merchant</th>
                                    <th>Receipt Count</th>
                                    <th>SMS Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $yesterTotal = 0;
                                $yesterSmsTotal = 0;
                                foreach ($yesterdayTxnByMerchant as $ti) {
                                    $yesterTotal += $ti['receipt_count'];
                                    $yesterSmsTotal += $ti['sms_count'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $this->Html->link(h($ti['name']), ['controller' => 'merchants', 'action' => 'view', $ti['merchant_id']], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                                        </td>
                                        <td>
                                            <?= $this->Html->link(h($ti['receipt_count']), ['controller' => 'reports', 'action' => 'monthly-activity', 'merchant_id' => $ti['merchant_id'], '_method' => 'GET'], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?>
                                        </td>
                                        <td>
                                            <?= $ti['sms_count'] ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td><?= __('Total') ?></td>
                                    <td><?= $yesterTotal ?></td>
                                    <td><?= $yesterSmsTotal ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </section>


    </div>
</div>
