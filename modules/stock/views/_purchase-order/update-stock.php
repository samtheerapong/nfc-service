<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\stock\models\Equipment */

$this->title = 'ปรับปรุงสต็อก: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'จัดการสต็อก', 'url' => ['manage-stock']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="stock-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <div class="stock-form">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'stock')->textInput(['type' => 'number', 'min' => 0])->label('สต็อกปัจจุบัน') ?>

        <div class="form-group">
            <label>เหตุผลการปรับปรุง (ถ้ามี)</label>
            <?= Html::textInput('reason', '', ['class' => 'form-control']) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
            <?= Html::a('ยกเลิก', ['manage-stock'], ['class' => 'btn btn-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>