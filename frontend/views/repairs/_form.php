<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Repair */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repair-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <?= $form->field($parts, 'type')->textInput(['maxlength' => true]) ?>

                <?= $form->field($parts, 'version')->textInput(['maxlength' => true]) ?>

                <?= $form->field($parts, 'parts_code')->textInput(['maxlength' => true]) ?>                    

                <?= $form->field($model, 'problem')->textArea(['maxlength' => true]) ?>


                </div>

                <div class="card-footer">
                    <div class="form-group text-right">
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
