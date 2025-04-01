<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\StdSauce $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="std-sauce-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sauce_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_ph')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_nacl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_tn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_alcohol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_ppm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'std_brix')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remask')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
