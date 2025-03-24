<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Equipment */

$this->title = 'เพิ่มอุปกรณ์ใหม่';
$this->params['breadcrumbs'][] = ['label' => 'อุปกรณ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="equipment-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="equipment-form">
        <?php $form = ActiveForm::begin([
            'id' => 'equipment-create-form',
            'options' => ['class' => 'form-horizontal'],
        ]); ?>

        <?= $form->field($model, 'name')->textInput([
            'maxlength' => true,
            'placeholder' => 'เช่น ปากกา, กระดาษ A4'
        ])->label('ชื่ออุปกรณ์') ?>

        <?= $form->field($model, 'stock')->textInput([
            'type' => 'number',
            'min' => 0,
            'value' => 0
        ])->label('จำนวนในสต็อก') ?>

        <?= $form->field($model, 'low_stock_level')->textInput([
            'type' => 'number',
            'min' => 1,
            'value' => 10
        ])->label('ระดับสต็อกต่ำ') ?>

        <div class="form-group">
            <?= Html::submitButton('บันทึก', [
                'class' => 'btn btn-success',
                'name' => 'create-button'
            ]) ?>
            <?= Html::a('ยกเลิก', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>