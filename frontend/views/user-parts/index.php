<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserPartsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Hexohms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-parts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a(Yii::t('app', 'New Hexohm'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_view',
        // 'itemView' => function ($model, $key, $index, $widget) {
        //     return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
        // },
    ]) ?>


</div>
