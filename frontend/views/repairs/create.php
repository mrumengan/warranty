<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Repair */

$this->title = Yii::t('app', 'New Repair');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Repairs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repair-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'parts' => $parts
    ]) ?>

</div>
