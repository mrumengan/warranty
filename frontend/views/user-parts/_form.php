<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserParts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-parts-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'version')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'parts_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notes')->textArea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
