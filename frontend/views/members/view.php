<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Members')];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status == 10 ? 'Active' : 'Inactive';
                }
            ],
            [
                'label' => 'Address',
                'value' => function($model) {
                    return $model->profile->address;
                }
            ],
            [
                'label' => 'Mobile',
                'value' => function($model) {
                    return $model->profile->mobile;
                }
            ],
            [
                'label' => 'Notes',
                'value' => function($model) {
                    return $model->profile->notes;
                }
            ],
            'updated_at:datetime',
            'created_at:datetime',
        ],
    ]) ?>

</div>