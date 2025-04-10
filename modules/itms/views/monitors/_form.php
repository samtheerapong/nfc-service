<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\Monitors $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="monitors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'computer_id')->textInput() ?>

    <?= $form->field($model, 'asset_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'monitor_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'monitor_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'screen_size_inch')->textInput() ?>

    <?= $form->field($model, 'connectivity_types_id')->textInput() ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purchase_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'warranty_expiry')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'ref_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
