<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Repair */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repair-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_parts_id')->textInput() ?>

    <?= $form->field($model, 'problem')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'received_at')->textInput() ?>

    <?= $form->field($model, 'notification_at')->textInput() ?>

    <?= $form->field($model, 'tech_recevied_at')->textInput() ?>

    <?= $form->field($model, 'action_taken')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tech_done_at')->textInput() ?>

    <?= $form->field($model, 'admin_tested_at')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
