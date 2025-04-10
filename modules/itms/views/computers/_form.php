<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\Computers $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="computers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'profile_id')->textInput() ?>

    <?= $form->field($model, 'asset_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'computer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purchase_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'warranty_expiry')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cpu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ram')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'capacity_storage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wifi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'network_ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nework_mac_addr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
