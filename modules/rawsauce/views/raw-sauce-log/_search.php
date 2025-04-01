<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\search\RawSauceLogSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="raw-sauce-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tank_id') ?>

    <?= $form->field($model, 'ref_code') ?>

    <?= $form->field($model, 'batch') ?>

    <?= $form->field($model, 'current_value') ?>

    <?php // echo $form->field($model, 'sauce_type_id') ?>

    <?php // echo $form->field($model, 'record_by') ?>

    <?php // echo $form->field($model, 'updated_date') ?>

    <?php // echo $form->field($model, 'incoming_value') ?>

    <?php // echo $form->field($model, 'incoming_date') ?>

    <?php // echo $form->field($model, 'outgoing_value') ?>

    <?php // echo $form->field($model, 'outgoing_date') ?>

    <?php // echo $form->field($model, 'remask') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
