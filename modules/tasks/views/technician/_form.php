<?php

use app\models\Users;
use app\modules\tasks\models\TeamRoles;
use app\modules\tasks\models\Technician;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="technician-form">
    <?php $form = ActiveForm::begin([
        'type'        => ActiveForm::TYPE_HORIZONTAL,
        'options'     => ['enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template'     => '{label}<div class="col-md-10">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-form-label has-star col-md-2 text-right'],
        ],
    ]) ?>
    <div class="card">
        <div class="card-header text-white bg-secondary">
            <?php echo Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <div class="row">
                <?php
                if (!$model->isNewRecord) {
                    echo $form->field($model, 'ref')->textInput(['maxlength' => true, 'required' => true]);
                }
                ?>
                <?php echo $form->field($model, 'user_id')->widget(Select2::class, [
                    'data'          => ArrayHelper::map(Users::find()->all(), 'id', 'thai_name'),
                    'options'       => ['placeholder' => Yii::t('app', 'Select...')],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>

                <?php
                if (!$model->isNewRecord) {
                    echo $form->field($model, 'thainame')->textInput(['maxlength' => true]);
                }
                ?>
                <?php echo $form->field($model, 'role_id')->widget(Select2::class, [
                    'data'          => ArrayHelper::map(TeamRoles::find()->all(), 'id', 'name'),
                    'options'       => ['placeholder' => Yii::t('app', 'Select...')],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
                <?php echo $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'api')->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'active')->dropDownList(Technician::getStatusOptions(), ['prompt' => Yii::t('app', 'Select...')]) ?>
                <div class="mb-3 row highlight-addon field-notify-unit">
                    <label class="col-form-label has-star col-md-2 text-right"><?php echo Yii::t('app', 'Uploads') ?></label>
                    <div class="col-md-10">
                        <?php echo \kartik\widgets\FileInput::widget([
                            'name'          => 'upload_file[]',
                            'options'       => ['multiple' => true, 'accept' => '.xlsx,.xlsx,.docx,.doc,.jpg,.jpeg,.png,.pdf'],
                            'pluginOptions' => [
                                'showPreview'              => true,
                                'overwriteInitial'         => false,
                                'initialPreviewShowDelete' => true,
                                'initialPreview'           => $initialPreview,
                                'initialPreviewConfig'     => $initialPreviewConfig,
                                'uploadUrl'                => Url::to(['upload']),
                                'uploadExtraData'          => ['ref' => $model->ref],
                                'maxFileCount'             => 10,
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="form-group">
                    <div class="d-grid gap-2">
                        <?php echo Html::submitButton('<i class="fas fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>