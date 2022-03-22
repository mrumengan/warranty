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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Parts',
                'value' => function ($model) {
                    return $model->userParts->type;
                }
            ],
            'problem:ntext',
            'received_at:datetime',
            'notification_at:datetime',
            'tech_recevied_at',
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