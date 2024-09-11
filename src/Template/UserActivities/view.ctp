

<div class="userActivities view large-9 medium-8 columns content">

    <div>
        <div class="col-md-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                    </div>

                    <h2 class="panel-title"><?= h($userActivity->title) ?></h2>
                </header>
                <div class="panel-body">
    
    <table class="vertical-table table table-hover">
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($userActivity->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Controller') ?></th>
            <td><?= h($userActivity->controller) ?></td>
        </tr>
        <tr>
            <th><?= __('Action') ?></th>
            <td><?= h($userActivity->action) ?></td>
        </tr>
        <tr>
            <th><?= __('After Action') ?></th>
            <td><?= h($userActivity->after_action) ?></td>
        </tr>
        <tr>
            <th><?= __('Ip Address') ?></th>
            <td><?= h($userActivity->ip_address) ?></td>
        </tr>
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($userActivity->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Note') ?></th>
            <td><?= h($userActivity->note) ?></td>
        </tr>
        <tr>
            <th><?= __('Other Data') ?></th>
            <td><?= h($userActivity->other_data) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($userActivity->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Risk') ?></th>
            <td><?= $this->Number->format($userActivity->risk) ?></td>
        </tr>
        <tr>
            <th><?= __('Flag') ?></th>
            <td><?= $this->Number->format($userActivity->flag) ?></td>
        </tr>



    </table>
			
                    </div>
                </section>
            </div>
        </div>                    
                    
                    
                    

</div>
