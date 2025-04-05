<?php

use app\modules\tasks\models\Priority;
use app\modules\tasks\models\Teams;
use app\modules\tasks\models\Ticket;
use app\modules\tasks\models\WorkType;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>

<div class="work-order-form">

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
        <div class="card-header text-white bg-warning">
            <?= Html::encode($this->title) ?>
        </div>

        <div class="card-body">

            <?= $form->field($model, 'ticket_id')->dropDownList(
                ArrayHelper::map(Ticket::find()->all(), 'id', 'ticket_code'),
                ['disabled' => true]
            ) ?>

            <?= $form->field($model, 'work_detail')->textarea(['rows' => 3]) ?>

            <?= $form->field($model, 'priority_id')->dropDownList(
                ArrayHelper::map(Priority::find()->all(), 'id', function ($dataValue, $defaultValue) {
                    return  $dataValue->name . ' : ' . $dataValue->detail;
                }),
                // ['prompt' => Yii::t('app', 'Select...')]
            ) ?>




            <?= $form->field($model, 'teamwork')->dropDownList(
                ArrayHelper::map(Teams::find()->all(), 'id', 'name'),
                ['prompt' => Yii::t('app', 'Select...')]
            ) ?>

            <?= $form->field($model, 'start_date')->widget(
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
                        // 'startDate' => date('Y-m-d', strtotime('+0 days')), // ไม่ให้เลือกวันที่ก่อนหน้าวันปัจจุบัน
                        // 'daysOfWeekDisabled' => [0, 6], // ปิดใช้งานวันอาทิตย์ (0 = อาทิตย์, 1 = จันทร์, ..., 6 = เสาร์)
                    ]
                ]
            ); ?>

            <?= $form->field($model, 'end_date')->widget(
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
                        // 'startDate' => date('Y-m-d', strtotime('+0 days')), // ไม่ให้เลือกวันที่ก่อนหน้าวันปัจจุบัน
                        // 'daysOfWeekDisabled' => [0, 6], // ปิดใช้งานวันอาทิตย์ (0 = อาทิตย์, 1 = จันทร์, ..., 6 = เสาร์)
                    ]
                ]
            ); ?>

            <?= $form->field($model, 'hours')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'work_type_id')->dropDownList(
                ArrayHelper::map(WorkType::find()->all(), 'id', 'name'),
                ['prompt' => Yii::t('app', 'Select...')]
            ) ?>


            <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

            <div class="mb-3 row highlight-addon field-notify-unit">
                <label class="col-form-label has-star col-md-3 text-md-right text-left"><?php echo Yii::t('app', 'Uploads') ?></label>
                <div class="col-md-9">
                    <?php echo \kartik\widgets\FileInput::widget([
                        'name'          => 'upload_file[]',
                        'options'       => [
                            'multiple' => true,
                            'accept' => '.jpg,.jpeg,.png,.pdf'
                        ],

                        'pluginOptions' => [
                            'initialPreview'           => $initialPreview,
                            'initialPreviewConfig'     => $initialPreviewConfig,
                            'uploadUrl'                => Url::to(['upload']),
                            'uploadExtraData'          => ['ref' => $model->work_order_code],
                            'maxFileCount'             => 5,
                            'language'                 => 'th',
                            'browseLabel'              => 'เลือกไฟล์...', // ใช้ browseLabel แทน placeholder
                            'msgPlaceholder'           => 'เลือกไฟล์ได้สูงสุด 3 ไฟล์', // เพิ่ม msgPlaceholder สำหรับ kartik FileInput
                        ],
                    ]) ?>
                </div>
            </div>
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