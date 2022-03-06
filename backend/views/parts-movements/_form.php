<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Parts;
use common\models\Supplier;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\PartsMovement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parts-movement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parts_id')->dropDownList(ArrayHelper::map(Parts::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'type')->dropDownList(['CONSUMED' => 'Consumed', 'ADDED' => 'Added']) ?>

    <?= $form->field($model, 'supplier_id')->dropDownList(ArrayHelper::map(Supplier::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'batch_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
