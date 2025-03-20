<?php

use app\models\User;
use app\models\Users;
use app\modules\tasks\models\Technician;
use app\modules\ticket\models\TicketGroup;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use kidzen\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="ticket-form">
    <?php
    $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fieldConfig' => [
            'template' => '{label}<div class="col-md-10">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-form-label has-star col-md-2 text-right'],
        ],
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'dynamic-form'
        ]
    ]);
    ?>

    <div class="card border-secondary">
        <!-- Card Header -->
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <!-- Main Form Fields -->

            <?= $form->field($model, 'ticket_group')->dropDownList(
                ArrayHelper::map(TicketGroup::find()->all(), 'id', 'name'), // ['prompt' => Yii::t('app', 'Select...')]
            ) ?>

            <?= $form->field($model, 'ticket_date')->widget(
                DatePicker::class,
                [
                    'options' => [
                        'required' => true,
                    ],
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'autoclose' => true,
                        'timezone' => 'Asia/Bangkok', // Set Bangkok timezone
                        'orientation' => 'bottom', // เลื่อนลงด้านล่าง
                        'todayBtn' => "linked",
                        'startDate' => date('Y-m-d', strtotime('+0 days')), // ไม่ให้เลือกวันที่ก่อนหน้าวันปัจจุบัน
                        // 'daysOfWeekDisabled' => [0, 6], // ปิดใช้งานวันอาทิตย์ (0 = อาทิตย์, 1 = จันทร์, ..., 6 = เสาร์)
                    ]
                ]
            ); ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
            <?= $form->field($model, 'remask')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'request_by')->widget(Select2::class, [
                'data' => ArrayHelper::map(
                    Users::find()->where(['status' => 10])->orderBy(['thai_name' => 'SORT_ACE'])->all(),
                    'thai_name',
                    function ($dataValue, $defaultValue) {
                        return  $dataValue->thai_name;
                    }
                ),
                'options' => ['placeholder' => Yii::t('app', 'Select...')],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

            <div class="mb-3 row highlight-addon field-notify-unit">
                <label class="col-form-label has-star col-md-2 text-right" for="upload_file[]"> <?= Yii::t('app', 'Uploads') ?> </label>
                <div class="col-md-10">
                    <?= FileInput::widget([
                        'name' => 'upload_file[]',
                        'options' => ['multiple' => true, 'accept' => '.docx,.doc,.jpg,.jpeg,.png,.pdf'],
                        'pluginOptions' => [
                            'showPreview' => true,
                            'overwriteInitial' => false,
                            'initialPreviewShowDelete' => true,
                            // 'initialPreview' => $initialPreview,
                            // 'initialPreviewConfig' => $initialPreviewConfig,
                            'uploadUrl' => Url::to(['upload']),
                            'uploadExtraData' => [
                                'ref' => $model->ticket_code,
                            ],
                            'maxFileCount' => 10
                        ]
                    ]); ?>
                </div>
            </div>

            <?php
            // Dynamic Form Widget Configuration
            DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper',
                'widgetBody' => '.container-items',
                'widgetItem' => '.item',
                'limit' => 10,
                'min' => 1,
                'insertButton' => '.add-item',
                'deleteButton' => '.remove-item',
                'model' => $modelsList[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'ticket_code',
                    'details',
                    'remask',
                    'location',
                    'ticket_date',
                    'quantity',
                ],
            ]);
            ?>

            <!-- Dynamic Form Section -->
            <div class="card border-secondary">
                <div class="card-header text-xs text-white bg-info">
                    <?= 'รายละเอียด' ?>
                </div>
                <div class="card-body table-responsive">
                    <div class="container-items">
                        <div class="item card">
                            <div class="card-body">
                                <?php foreach ($modelsList as $i => $modelList) : ?>
                                    <?php
                                    if (!$modelList->isNewRecord) {
                                        echo Html::activeHiddenInput($modelList, "[{$i}]id");
                                    }
                                    ?>

                                    <!-- Action Buttons -->
                                    <div type="button" class="add-item btn btn-primary btn-xs">
                                        <i class="fa fa-plus"></i>
                                    </div>
                                    <div type="button" class="remove-item btn btn-danger btn-xs">
                                        <i class="fa fa-x"></i>
                                    </div>

                                    <!-- Dynamic Form Fields -->
                                    <?= $form->field($modelList, "[{$i}]details")->textInput([
                                        'required' => true,
                                        'placeholder' => 'รายละเอียด'
                                    ]) ?>

                                    <?= $form->field($modelList, "[{$i}]quantity")->textInput([
                                        'maxlength' => true,
                                        'type' => 'number',
                                        'value' => '1',
                                        'placeholder' => 'จำนวน'
                                    ]) ?>

                                    <?= $form->field($modelList, "[{$i}]remask")->textInput([
                                        'placeholder' => 'หมายเหตุ'
                                    ]) ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>

        <!-- Card Footer -->
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