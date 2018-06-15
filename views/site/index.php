<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?=\Yii::t('app','Welcome, to Warehouse')?></h1>

        <p class="lead"><?=\Yii::t('app','This page is an index of test assignment called warehouse')?></p>


        <!-- EXAMPLE USAGE OF CORRECT DATE FORMATTING -->
        <p><?=\Yii::t('app','Current date:')?> <?=\Yii::$app->formatter->asDate(date('Y-m-d H:i:s'),'long')?></p>


        <p><a class="btn btn-lg btn-success" href="/web/index.php/product/"><?=\Yii::t('app','Manage Warehouse')?></a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">

                <!-- Example of proper plural trans blocks -->
                <h2><?= \Yii::t('app', 'Have a look @ our {n,plural,=0{Product} =1{Products}}!', ['n' => 1]); ?></h2>

                <p>Text above is the example of plural translation.</p>
            </div>
            <div class="col-lg-4">
                <h2>Block</h2>

                <p>Only here not to mess up bootstrap cols.</p>

            </div>
            <div class="col-lg-4">
                <h2>Block</h2>

                <p>Only here not to mess up bootstrap cols.</p>

            </div>
        </div>

    </div>
</div>
