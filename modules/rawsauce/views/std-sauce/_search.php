<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\search\StdSauceSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="std-sauce-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'sauce_type') ?>

    <?= $form->field($model, 'std_ph') ?>

    <?= $form->field($model, 'std_nacl') ?>

    <?php // echo $form->field($model, 'std_tn') ?>

    <?php // echo $form->field($model, 'std_color') ?>

    <?php // echo $form->field($model, 'std_alcohol') ?>

    <?php // echo $form->field($model, 'std_ppm') ?>

    <?php // echo $form->field($model, 'std_brix') ?>

    <?php // echo $form->field($model, 'remask') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
