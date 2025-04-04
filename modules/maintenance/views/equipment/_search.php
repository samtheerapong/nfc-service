<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\maintenance\models\search\EquipmentSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="equipment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'equipment_id') ?>

    <?= $form->field($model, 'equipment_name') ?>

    <?= $form->field($model, 'serial_number') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'purchase_date') ?>

    <?php  echo $form->field($model, 'warranty_end_date') ?>

    <?php  echo $form->field($model, 'location') ?>

    <?php  echo $form->field($model, 'status_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
