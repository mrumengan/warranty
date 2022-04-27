<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
$model->username = $user->username;
$model->status = $user->status;
$model->email = $user->email;

$my_roles = Yii::$app->authManager->getRolesByUser($user->id);
$model->roles = key($my_roles);

$roles = Yii::$app->authManager->getRoles();

foreach($roles as $key => $role) {
    if($key != 'SuperAdmin') {
        $available_roles[] = ['id' => $key, 'name' => $role->name];
    }
}
$role_options = [];
foreach($my_roles as $role => $role_detail) {
    $role_options[$role] = ['selected' => true];
}

?>
<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <?= $form->field($model, 'username')->textInput(['readonly' => $user->isNewRecord ? false : true]) ?>

                    <?= $form->field($model, 'email')->textInput() ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($profile, 'address')->textArea(['maxlength' => true]) ?>

                    <?= $form->field($profile, 'mobile')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($profile, 'notes')->textArea(['maxlength' => true]) ?>

                </div>
            </div>
        </div>
    </div>

    <div class="form-group text-right">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
