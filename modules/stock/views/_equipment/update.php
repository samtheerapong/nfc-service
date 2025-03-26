<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'แก้ไขอุปกรณ์: ' . $model->name;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'stock')->textInput() ?>
<?= $form->field($model, 'low_stock_level')->textInput() ?>

<div class="form-group">
    <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>