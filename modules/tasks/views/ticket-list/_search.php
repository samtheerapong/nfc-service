<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\ticket\models\search\TicketListSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="ticket-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ticket_code') ?>

    <?= $form->field($model, 'details') ?>

    <?= $form->field($model, 'remask') ?>

    <?= $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'ticket_date') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
