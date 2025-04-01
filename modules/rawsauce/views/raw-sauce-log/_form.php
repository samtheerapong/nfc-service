<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\RawSauceLog $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="raw-sauce-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tank_id')->textInput() ?>

    <?= $form->field($model, 'ref_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'batch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'current_value')->textInput() ?>

    <?= $form->field($model, 'sauce_type_id')->textInput() ?>

    <?= $form->field($model, 'record_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'incoming_value')->textInput() ?>

    <?= $form->field($model, 'incoming_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'outgoing_value')->textInput() ?>

    <?= $form->field($model, 'outgoing_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remask')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
