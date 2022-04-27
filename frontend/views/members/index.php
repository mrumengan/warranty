<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Members');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="text-right">
        <?= Html::a(
            '<i class="fa fa-plus" aria-hidden="true"></i> New User',
            ['/users/create'],
            ['class' => 'btn btn-primary btn-sm']
        ) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email:email',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status == 10 ? 'Active' : 'Inactive';
                }
            ],
            [
                'label' => 'Role',
                'value' => function ($model) {
                    $my_role = '';
                    $my_roles = Yii::$app->authManager->getRolesByUser($model->id);
                    foreach ($my_roles as $role => $role_detail) {
                        $my_role .= '<div>' . $role . '</div>';
                    }

                    return $my_role;
                },
                'format' => 'html'
            ],
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>