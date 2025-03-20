<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ticket\models\TicketList $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ticket-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ticket_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remask')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput() ?>

    <?= $form->field($model, 'ticket_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
