

<div class="autoActions view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($autoAction->title) ?></h2>
                </header>
                <div class="panel-body">

                    <table class="vertical-table table table-hover">
                        <tr>
                            <th><?= __('Title') ?></th>
                            <td><?= h($autoAction->title) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Action Type') ?></th>
                            <td><?= h($autoAction->action_type) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <td><?= $this->Number->format($autoAction->id) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Row Count') ?></th>
                            <td><?= $this->Number->format($autoAction->row_count) ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Created') ?></th>
                            <td><?= h($autoAction->created) ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td><?= h($autoAction->modified) ?></td>
                        </tr>


                        <tr>
                            <th><?= __('Note') ?></th>
                            <td><?= $this->Text->autoParagraph(h($autoAction->note)); ?></td>
                        </tr>
                        <tr>
                            <th><?= __('Data') ?></th>
                            <td><pre><?= h($autoAction->data); ?></pre></td>
                        </tr>
                    </table>

                </div>
            </section>
        </div>
    </div>                    




</div>
