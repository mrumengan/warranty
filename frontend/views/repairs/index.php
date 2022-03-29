<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\Repair;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Repairs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repair-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a(Yii::t('app', 'New Repair'), ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'problem:ntext',
            'received_at',
            'notification_at',
            //'tech_recevied_at',
            //'action_taken:ntext',
            //'tech_done_at',
            //'admin_tested_at',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Repair $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
