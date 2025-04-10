<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\search\SoftwareSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="software-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'software_id') ?>

    <?= $form->field($model, 'computer_id') ?>

    <?= $form->field($model, 'asset_code') ?>

    <?= $form->field($model, 'software_name') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'version') ?>

    <?php // echo $form->field($model, 'license_key') ?>

    <?php // echo $form->field($model, 'installation_date') ?>

    <?php // echo $form->field($model, 'expiry_date') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'ref_code') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
