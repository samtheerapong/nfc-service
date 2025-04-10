<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\search\AccessoriesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="accessories-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'computer_id') ?>

    <?= $form->field($model, 'asset_code') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'accessory_name') ?>

    <?php // echo $form->field($model, 'brand') ?>

    <?php // echo $form->field($model, 'model') ?>

    <?php // echo $form->field($model, 'serial_number') ?>

    <?php // echo $form->field($model, 'purchase_date') ?>

    <?php // echo $form->field($model, 'warranty_expiry') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'ref_code') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
