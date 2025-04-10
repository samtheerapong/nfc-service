<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\Profile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'title_name')->textInput() ?>

    <?= $form->field($model, 'thai_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'english_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_of_birth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department_id')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role_id')->textInput() ?>

    <?= $form->field($model, 'pdpa')->textInput() ?>

    <?= $form->field($model, 'reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'leave_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
