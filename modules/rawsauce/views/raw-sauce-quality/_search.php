<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\search\RawSauceQualitySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="raw-sauce-quality-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'log_id') ?>

    <?= $form->field($model, 'qc_by') ?>

    <?= $form->field($model, 'qc_date') ?>

    <?= $form->field($model, 'sediment') ?>

    <?php // echo $form->field($model, 'color_value') ?>

    <?php // echo $form->field($model, 'color_ratio') ?>

    <?php // echo $form->field($model, 'nacl_value') ?>

    <?php // echo $form->field($model, 'ph_value') ?>

    <?php // echo $form->field($model, 'alcohol_value') ?>

    <?php // echo $form->field($model, 'tn_value') ?>

    <?php // echo $form->field($model, 'brix_value') ?>

    <?php // echo $form->field($model, 'ncr') ?>

    <?php // echo $form->field($model, 'remask') ?>

    <?php // echo $form->field($model, 'ref_code') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
