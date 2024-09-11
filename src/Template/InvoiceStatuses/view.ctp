

<div class="invoiceStatuses view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($invoiceStatus->title) ?></h2>
                </header>
                <div class="panel-body">

                    <table class="vertical-table table table-hover">
                        <tr>
                            <th><?= __('Title') ?></th>
                            <td><?= h($invoiceStatus->title) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Description') ?></th>
                            <td><?= h($invoiceStatus->description) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <td><?= $this->Number->format($invoiceStatus->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Created By') ?></th>
                            <td><?= $invoiceStatus->modified_by_user->username ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified By') ?></th>
                            <td><?= $invoiceStatus->created_by_user->username ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= h($invoiceStatus->created) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td><?= h($invoiceStatus->modified) ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Disable Edits') ?></th>
                            <td><?= $invoiceStatus->disable_edits ? __('Yes') : __('No'); ?></td>
                        </tr>

                    </table>

                </div>
            </section>
        </div>
    </div>                    

</div>
