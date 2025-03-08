<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = Yii::t('app', 'Login');
?>
<div class="site-login">
    <div class="mt-5 offset-lg-3 col-lg-6">
        <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

        <p class="text-center">Please enter your credentials to login</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control']) ?>

        <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control']) ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group text-center">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>