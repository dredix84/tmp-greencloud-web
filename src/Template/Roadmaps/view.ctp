

<div class="roadmaps view large-9 medium-8 columns content">

    <table class="vertical-table table table-hover">
        <tr>
            <th><?= __('Category') ?></th>
            <td><?= h($roadmap->category) ?></td>
        </tr>
        <tr>
            <th><?= __('Assigned User') ?></th>
            <td><?= $roadmap->has('user') ? $this->Html->link($roadmap->user->username, ['controller' => 'Users', 'action' => 'view', $roadmap->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Tags') ?></th>
            <td><?= h($roadmap->tags) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= $statuses[$roadmap->status] ?></td>
        </tr>
        <tr>
            <th><?= __('Priority') ?></th>
            <td><?= $priorities[$roadmap->priority] ?></td>
        </tr>

        <tr>
            <th><?= __('Delivery Date') ?></th>
            <td><?= h($roadmap->delivery_date) ?></td>
        </tr>

        <tr>
            <th><?= __('Description') ?></th>
            <td><?= $roadmap->description; ?></td>
        </tr>
        <tr>
            <th><?= __('Comments') ?></th>
            <td><?= $this->Text->autoParagraph(h($roadmap->comments)); ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($roadmap->created) ?></td>
        </tr>
    </table>




</div>
