<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\RawSauceQuality $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="raw-sauce-quality-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'log_id')->textInput() ?>

    <?= $form->field($model, 'qc_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qc_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sediment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color_ratio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nacl_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ph_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alcohol_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tn_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brix_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ncr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remask')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
