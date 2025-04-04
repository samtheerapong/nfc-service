<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\maintenance\models\search\MaintenanceScheduleSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="maintenance-schedule-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'schedule_id') ?>

    <?= $form->field($model, 'equipment_id') ?>

    <?= $form->field($model, 'technician_id') ?>

    <?= $form->field($model, 'scheduled_date') ?>

    <?= $form->field($model, 'type_id') ?>

    <?php // echo $form->field($model, 'frequency_id') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
