<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\search\RawSauceTransferSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="raw-sauce-transfer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'log_id') ?>

    <?= $form->field($model, 'incoming_tank') ?>

    <?= $form->field($model, 'incoming_value') ?>

    <?= $form->field($model, 'incoming_date') ?>

    <?php // echo $form->field($model, 'outgoing_tank') ?>

    <?php // echo $form->field($model, 'outgoing_value') ?>

    <?php // echo $form->field($model, 'outgoing_date') ?>

    <?php // echo $form->field($model, 'ref_code') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
