<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\MachineBom $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="machine-bom-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'machine_id')->textInput() ?>

    <?= $form->field($model, 'parent_part_id')->textInput() ?>

    <?= $form->field($model, 'child_part_id')->textInput() ?>

    <?= $form->field($model, 'quantity_required')->textInput() ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bom_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
