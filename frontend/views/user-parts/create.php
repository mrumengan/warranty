<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserParts */

$this->title = Yii::t('app', 'New Hexohm');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Hexohms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-parts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'missing' => $missing
    ]) ?>

</div>
