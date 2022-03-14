<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PartsMovement;

/* @var $this yii\web\View */
/* @var $model common\models\PartsMovement */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Parts Movements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="parts-movement-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Parts',
                'value' => function($model) {
                    return $model->parts->name;
                }
            ],
            [
                'attribute' => 'type',
                'value' => function($model) {
                    return PartsMovement::$types[$model->type];
                }
            ],
            [
                'label' => 'Supplier',
                'value' => function($model) {
                    return $model->supplier->name;
                }
            ],
            'batch_no',
            'qty',
            'price',
            'remarks:text',
            'moved_at:datetime',
            [
                'label' => Yii::t('app', 'Receiver'),
                'value' => function($model) {
                    return $model->createdBy->username;
                }
            ],
        ],
    ]) ?>

</div>
