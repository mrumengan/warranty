<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\PartsMovement;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parts Movements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parts-movement-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Create Parts Movement', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Parts',
                'value' => function($model) {
                    return $model->parts->name;
                }
            ],
            [
                'label' => 'Type',
                'value' => function($model) {
                    return PartsMovement::$types[$model->type];
                }
            ],
            [
                'label' => Yii::t('app', 'Supplier'),
                'value' => function($model) {
                    return $model->supplier->name;
                }
            ],
            'batch_no',
            [
                'label' => Yii::t('app', 'Receiver'),
                'value' => function($model) {
                    return $model->createdBy->username;
                }
            ],
            [
                'attribute' => 'qty',
                'value' => function($model) {
                    return Yii::$app->formatter->asDecimal($model->qty);
                },
                'contentOptions'=>['style'=>'text-align: right']
            ],
            //'price',
            //'updated_at',
            //'updated_by',
            // 'created_at',
            // 'created_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PartsMovement $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
