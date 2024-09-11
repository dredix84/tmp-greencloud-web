<div class="row">

    <div class="col-md-6 col-lg-6 col-xl-6">
        <section class="panel panel-featured-left panel-featured-tertiary">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-tertiary">
                            <i class="fa fa-money"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= __('Lifetime Credits Used') ?></h4>
                            <div class="info">
                                <strong class="amount"><?= $totals['credits_used'] ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="panel panel-success">
            <header class="panel-heading">
                <h2 class="panel-title">Credit used over last <?= $periodlimit ?> <?= $reporttype ?>(s)</h2>
            </header>
            <div class="panel-body">
                <table class="table table-bordered table-condensed table-hover table-striped">
                    <thead>
                        <tr>
                            <td>Period</td>
                            <td>Used</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usageData as $ud) { ?>
                            <tr>
                                <td><?= $ud['date_period'] ?></td>
                                <td><?= $ud['credits_used'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>        
    </div>

    
    <div class="col-md-6 col-lg-6 col-xl-6">
        <section class="panel panel-featured-left panel-featured-tertiary">
            <div class="panel-body">
                <div class="widget-summary">
                    <div class="widget-summary-col widget-summary-col-icon">
                        <div class="summary-icon bg-tertiary">
                            <i class="fa fa-money"></i>
                        </div>
                    </div>
                    <div class="widget-summary-col">
                        <div class="summary">
                            <h4 class="title"><?= __('Lifetime Credits Purchased') ?></h4>
                            <div class="info">
                                <strong class="amount"><?= $totals['credits_purchased'] ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="panel panel-success">
            <header class="panel-heading">
                <h2 class="panel-title">Credit purchased over last <?= $periodlimit ?> <?= $reporttype ?>(s)</h2>
            </header>
            <div class="panel-body">
                <table class="table table-bordered table-condensed table-hover table-striped">
                    <thead>
                        <tr>
                            <td>Period</td>
                            <td>Purchased</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($purchaseData as $ud) { ?>
                            <tr>
                                <td><?= $ud['date_period'] ?></td>
                                <td><?= $ud['credits_purchased'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section> 
    </div>
</div>
