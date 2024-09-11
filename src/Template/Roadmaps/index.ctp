<?php
$this->loadHelper('Form', [
    'templates' => 'general_form',
]);
?>

<style>
    .line-through{
        text-decoration: line-through;
    }
</style>
<div class="roadmaps index large-9 medium-8 columns content">

    <div class="row">
        <div class="col-md-12">

            <section class="panel panel-info panel-search">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                        <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                    </div>

                    <h2 class="panel-title"><?= __('Search'); ?> <?= __('Roadmaps') ?></h2>
                </header>
                <div class="panel-body">
                    <?= $this->Form->create(null, ['type' => 'get']) ?>
                    <div class="col-md-6">
                        <div class="input-group mb-md">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            <input type="search" name="search_term" id="search_term" placeholder="<?= __('Enter your search term') ?>" class="form-control">
                        </div>    
                    </div>

                    <?php
                    echo $this->Form->button(__('Preform Search'), [
                        'class' => 'mb-xs mt-xs mr-xs btn btn-success',
                        'templateVars' => ['divClass' => 'col-sm-3']
                    ]);
                    echo $this->Form->input('a', ['type' => 'hidden', 'value' => 'search']);
                    echo $this->Form->end();
                    ?>
                </div>
            </section>

        </div>
    </div>                            

</div>




<?php
$lastDateSec = '';
$nowDateSec = false;
$cnt = 0;
?>

<div class="row">

    <div class="col-xl-6 col-lg-12">
        <section class="panel">
            <header class="panel-heading panel-heading-transparent">
                <div class="panel-actions">
                    <a data-panel-toggle="" class="panel-action panel-action-toggle" href="#"></a>
                    <a data-panel-dismiss="" class="panel-action panel-action-dismiss" href="#"></a>
                </div>

                <h2 class="panel-title"><?= __('Roadmap') ?></h2>
                
                <?= $this->Html->link(__('New Roadmap <i class="fa fa-plus"></i>'), ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success modalbox', 'data-ajaxlink' => '#modalbox']) ?>
            </header>
            <div class="panel-body">
                <div class="timeline timeline-simple mt-xlg mb-md">
                    <div class="tm-body">
                        <?php foreach ($roadmaps as $roadmap): ?>

                            <?php
                            $nowDateSec = $roadmap->delivery_date->format('F Y');
                            if ($nowDateSec != $lastDateSec):
                                /*if ($cnt != 0) {
                                    echo '</ol>';
                                }*/
                                $lastDateSec = $nowDateSec;
                                $nowDateSec = true;
                                echo '<div class="tm-title"><h3 class="h5 text-uppercase">' . $lastDateSec . '</h3></div>';

                                /*if ($cnt == 0) {
                                    echo '<ol class="tm-items">';
                                }*/
                            endif;
                            $nowDate = new DateTime($roadmap->delivery_date->format('Y-m-d'));
                            $taskDate = new DateTime(date('Y-m-d'));
                            $dDiff = $taskDate->diff($nowDate);

                            $pClass = ($roadmap->status == 2 ? 'line-through' : '');
                            ?>
                            <ol class="tm-items">
                                <li>
                                    <div class="tm-box">
                                        <p class="text-muted mb-none"><?= $dDiff->format("%a"); ?> <?= $dDiff->format("%r") == '-' ? _(' days ago') : _(' days to go') ?></p>
                                        <p>
                                            <strong class="<?=$pClass?>"><?= $this->Html->link(h($roadmap->title), ['action' => 'view', $roadmap->id], ['escape' => false, 'class' => 'modalbox', 'data-ajaxlink' => '#modalbox']) ?></strong> 
                                            <small><span class="label label-<?=$statusClass[$roadmap->status]?>">(<?=$statuses[$roadmap->status]?>)</span></small>
                                        </p>
                                        <div class="btn-group" style="float: right">
                                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $roadmap->id], ['escape' => false, 'class' => 'modalbox mb-xs mt-xs mr-xs btn btn-xs btn-primary', 'data-ajaxlink' => '#modalbox']) ?>
                                            <?php /* $this->Html->link(__('Delete'), ['action' => 'delete', $roadmap->id], ['escape' => false, 'class' => 'ajaxrowdelete mb-xs mt-xs mr-xs btn btn-xs btn-warning']) */?>
                                        </div>
                                        
                                        <div class="<?=$pClass?>">
                                            <?= ($roadmap->description) ?>
                                        </div>
                                        
                                    </div>
                                </li>
                            </ol>
                            <?php
                            $cnt++;
                            $nowDateSec = false;
                            ?>

                        <?php endforeach; ?>
                        </ol>

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>