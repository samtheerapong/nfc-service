<?php

use app\modules\itms\models\Profile;
use kartik\widgets\Select2;
use yii\helpers\BaseArrayHelper;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

?>

<div class="user-client-auth-form">
    <?php
    $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fieldConfig' => [
            'template' => '{label}<div class="col-md-9">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-form-label has-star col-md-3 text-md-right text-left'],
        ],
        'options' => [
            'enctype' => 'multipart/form-data',
            // 'id' => 'dynamic-form'
        ]
    ]);
    ?>

    <div class="card">
        <div class="card-header text-white bg-danger">
            <?= Html::encode($this->title) ?>
        </div>

        <div class="card-body">


            <?= $form->field($model, 'profile_id')->widget(Select2::class, [
                'data' => BaseArrayHelper::map(
                    Profile::find()->where(['status_id' => 1])->all(),
                    'id',
                    function ($dataValue, $defaultValue) {
                        $msg = $dataValue->thai_name . ($dataValue->department_id && $dataValue->department0 ?  ' แผนก' . $dataValue->department0->name : '');
                        return  $msg;
                    }
                ),
                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

            <div class="mb-3 row highlight-addon field-notify-unit">
                <label class="col-form-label has-star col-md-3 text-md-right text-left"></label>
                <div class="col-md-9">
                    <strong>User: Computer, data center, Internet, web application</strong>
                </div>
            </div>
            <?= $form->field($model, 'user_login')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'user_login_pass')->textInput(['maxlength' => true]) ?>


            <div class="mb-3 row highlight-addon field-notify-unit">
                <label class="col-form-label has-star col-md-3 text-md-right text-left"></label>
                <div class="col-md-9">
                    <strong>Company Email: </strong>
                </div>
            </div>
            <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'company_email_pass')->textInput(['maxlength' => true]) ?>

            <div class="mb-3 row highlight-addon field-notify-unit">
                <label class="col-form-label has-star col-md-3 text-md-right text-left"></label>
                <div class="col-md-9">
                    <strong>MRP: </strong>
                </div>
            </div>
            <?= $form->field($model, 'mrp_user_login')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'mrp_user_login_pass')->textInput(['maxlength' => true]) ?>
            <div class="mb-3 row highlight-addon field-notify-unit">
                <label class="col-form-label has-star col-md-3 text-md-right text-left"></label>
                <div class="col-md-9">
                    <strong>Other: </strong>
                </div>
            </div>
            <?= $form->field($model, 'printer_code')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>


        </div>
        <div class="card-footer">
            <div class="d-grid gap-2">
                <?= Html::submitButton(
                    '<i class="fas fa-save"></i> ' . Yii::t('app', 'Save'),
                    ['class' => 'btn btn-success']
                ) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
</div>