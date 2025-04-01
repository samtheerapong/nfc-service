<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\RawSauceTransfer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="raw-sauce-transfer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'log_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'incoming_tank')->textInput() ?>

    <?= $form->field($model, 'incoming_value')->textInput() ?>

    <?= $form->field($model, 'incoming_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'outgoing_tank')->textInput() ?>

    <?= $form->field($model, 'outgoing_value')->textInput() ?>

    <?= $form->field($model, 'outgoing_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
