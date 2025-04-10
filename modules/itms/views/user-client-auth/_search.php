<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\search\UserClientAuthSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-client-auth-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?= $form->field($model, 'user_login') ?>

    <?= $form->field($model, 'user_login_pass') ?>

    <?= $form->field($model, 'company_email') ?>

    <?php // echo $form->field($model, 'company_email_pass') ?>

    <?php // echo $form->field($model, 'mrp_user_login') ?>

    <?php // echo $form->field($model, 'mrp_user_login_pass') ?>

    <?php // echo $form->field($model, 'printer_code') ?>

    <?php // echo $form->field($model, 'phone_number') ?>

    <?php // echo $form->field($model, 'operator_name') ?>

    <?php // echo $form->field($model, 'operator_date') ?>

    <?php // echo $form->field($model, 'operator_comment') ?>

    <?php // echo $form->field($model, 'recorder_date') ?>

    <?php // echo $form->field($model, 'ref_code') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
