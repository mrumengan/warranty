<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserParts */

$this->title = Yii::t('app', 'Update User Hexohm: {type} {version}', [
    'type' => $model->type,
    'version' => $model->version
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Hexohms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nicename, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-parts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'missing' => $missing
    ]) ?>

</div>
