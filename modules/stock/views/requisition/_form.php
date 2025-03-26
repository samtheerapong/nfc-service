<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\stock\models\Requisition $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="requisition-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'equipment_id')->textInput() ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'approved_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approved_at')->textInput() ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
