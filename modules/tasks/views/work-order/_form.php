<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\WorkOrder $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="work-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ticket_id')->textInput() ?>

    <?= $form->field($model, 'work_order_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'priority_id')->textInput() ?>

    <?= $form->field($model, 'teamwork')->textInput() ?>

    <?= $form->field($model, 'start_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'end_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hours')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_type_id')->textInput() ?>

    <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_comment')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
