<?php

use app\models\Users;
use app\modules\itms\models\TaskStatus;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
?>

<div class="task-actions-form">
    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fieldConfig' => ['template' => '{label}<div class="col-md-10">{input}{error}</div>', 'labelOptions' => ['class' => 'col-form-label has-star col-md-2 text-right']],
        'options' => ['enctype' => 'multipart/form-data', 'id' => 'dynamic-form']
    ]); ?>
    <div class="card">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <?= $form->field($model, 'task_code')->textInput(['disabled' => true]) ?>
                <?= $form->field($modelTask, 'status_id')->widget(Select2::class, [
                    'data' => ArrayHelper::map(TaskStatus::find()->where(['id' => [3, 4, 5, 6]])->all(), 'id', 'name'),
                    'options' => ['value' => 3],
                    'pluginOptions' => ['allowClear' => true]
                ]) ?>
                <?= $form->field($model, 'process_fixed')->textarea(['rows' => 3]) ?>

                <?php $datePickerOptions = [
                    'options' => ['required' => true],
                    'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'autoclose' => true,
                        'timezone' => 'Asia/Bangkok',
                        'orientation' => 'bottom',
                        'todayBtn' => 'linked'
                    ]
                ]; ?>
                <?= $form->field($model, 'start_date')->widget(DatePicker::class, $datePickerOptions) ?>
                <?= $form->field($model, 'end_date')->widget(DatePicker::class, $datePickerOptions) ?>

                <?= $form->field($model, 'operator')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Users::find()->where(['status' => 10])->orderBy('thai_name')->all(), 'thai_name', 'thai_name'),
                    'options' => ['placeholder' => Yii::t('app', 'Select...'), 'value' => 'ธีรพงศ์ ขันตา'],
                    'pluginOptions' => ['allowClear' => true]
                ]) ?>

                <?= $form->field($model, 'item')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'cost')->textInput(['type' => 'number', 'value' => '0']) ?>
                <?= $form->field($model, 'comment')->textarea(['rows' => 1]) ?>

            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="form-group">
                    <div class="d-grid gap-2">
                        <?= Html::submitButton('<i class="fas fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>