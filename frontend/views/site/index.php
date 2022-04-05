<?php

/** @var yii\web\View $this */

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <?php if(!Yii::$app->user->isGuest): ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h3>Repair Status</h3></div>
                <div class="card-body">
                    <div class="alert alert-info">No Active Repair</div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>
