<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PartsMovement;
use common\models\Parts;
use common\models\Supplier;
use yii\helpers\ArrayHelper;



$this->registerCssFile('https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css');

$this->registerJsFile('https://cdn.jsdelivr.net/momentjs/latest/moment.min.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile('https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile('@web/js/parts-movements._form.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);


/* @var $this yii\web\View */
/* @var $model common\models\PartsMovement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="parts-movement-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'parts_id')->dropDownList(ArrayHelper::map(Parts::find()->all(), 'id', 'name')) ?>
    </div>

    <div class="col-md-3">
    <?= $form->field($model, 'type')->dropDownList(PartsMovement::$types) ?>
    </div>

    <div class="col-md-6">
    <?= $form->field($model, 'supplier_id')->dropDownList(ArrayHelper::map(Supplier::find()->all(), 'id', 'name')) ?>
    </div>

    <div class="col-md-2">
    <?= $form->field($model, 'batch_no')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-2">
    <?= $form->field($model, 'qty')->textInput(['class' => 'form-control text-right']) ?>
    </div>

    <div class="col-md-2">
    <?= $form->field($model, 'price')->textInput(['class' => 'form-control text-right']) ?>
    </div>

    <div class="col-md-7">
    <?= $form->field($model, 'remarks')->textArea(['maxlength' => 500, 'rows' => 5]) ?>
    </div>

    <div class="col-md-3">
        <?php if(!$model->isNewRecord) $model->moved_at = date('m/d/Y H:i', strtotime($model->moved_at)) ?>
        <?= $form->field($model, 'moved_at')->textInput(['readonly' => true, 'class' => 'form-control text-center']) ?>
    </div>

    <div class="form-group text-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
