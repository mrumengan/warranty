<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserParts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-parts-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-body">
        <?= $form->field($model, 'type')->textInput() ?>

        <?= $form->field($model, 'version')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'parts_code')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'notes')->textArea(['maxlength' => true]) ?>

        <?php if ($missing->id): ?>
        <?= $form->field($missing, 'status')->dropdownList([0 => '-', 10 => 'Missing', 20 => 'Found'],
            array('labelOptions' => array('style' => 'display:inline'), 'separator' => '  ')) ?>
        <?php endIf; ?>

        <div class="form-group text-right">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
        
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
