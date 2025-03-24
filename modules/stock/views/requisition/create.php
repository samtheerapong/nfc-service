<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'ขอเบิกอุปกรณ์';
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'equipment_id')->dropDownList(
    ArrayHelper::map($equipments, 'id', 'name'),
    ['prompt' => 'เลือกอุปกรณ์']
) ?>

<?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'quantity')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>