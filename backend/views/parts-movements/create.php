<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PartsMovement */

$this->title = 'Create Parts Movement';
$this->params['breadcrumbs'][] = ['label' => 'Parts Movements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parts-movement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
