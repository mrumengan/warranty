<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Repair */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Repairs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="repair-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-right">
        <?= Html::a('Receive', ['receive', 'id' => $model->id], [
            'class' => 'btn btn-primary btn-sm',
            'data' => [
                'confirm' => 'Are you sure you want to receive this item to be repaired?',
                'method' => 'post',
            ],
        ]) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Repair Item',
                'value' => function ($model) {
                    return "{$model->userParts->type}, {$model->userParts->version} [{$model->userParts->parts_code}]";
                }
            ],
            'problem:ntext',
            'received_at',
            'notification_at',
            'tech_recevied_at',
            'action_taken:ntext',
            'tech_done_at',
            'admin_tested_at',
            [
                'label' => 'Reported At',
                'value' => function($model) {
                    return Yii::$app->formatter->asDateTime($model->created_at);
                }
            ]
        ],
    ]) ?>

</div>
