<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserParts */

?>

<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <strong><?= $model->type ?></strong>
            <div><label class="label label-title">Version: </label><?= $model->version ?></div>
            <div><label class="label label-title">Code: </label><?= $model->parts_code ?></div>
            <div><label class="label label-title">Notes: </label><?= $model->notes ?></div>
        </div>
    </div>
</div>
