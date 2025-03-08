<?php

use app\modules\tasks\models\TeamRoles;
use app\modules\tasks\models\Technician;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="technician-search">
    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get', 'options' => ['class' => 'd-flex align-items-end']]); ?>
    <div class="row w-100">
        <div class="col-md-3">
            <?= $form->field($model, 'role_id')->widget(Select2::class, [
                'data' => ArrayHelper::map(TeamRoles::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => Yii::t('app', 'บทบาท')],
                'pluginOptions' => ['allowClear' => true],
            ])->label(false) ?></div>
        <div class="col-md-3">
            <?= $form->field($model, 'active')->widget(Select2::class, [
                'data' => Technician::getStatusOptions(),
                'options' => ['placeholder' => Yii::t('app', 'สถานะ')],
                'pluginOptions' => ['allowClear' => true],
            ])->label(false) ?>
        </div>
        <div class="col-md-6 d-flex align-items-start mt-1 gap-1">
            <?= Html::submitButton('<i class="fas fa-search"></i> ' . Yii::t('app', 'Filter'), ['class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a('<i class="fa fa-refresh"></i> ' . Yii::t('app', 'Reset'), [''], ['class' => 'btn btn-warning btn-sm', 'title' => Yii::t('app', 'Reset'), 'data-toggle' => 'tooltip']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>