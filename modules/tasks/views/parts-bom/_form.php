<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\PartsBom $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="parts-bom-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_part_id')->textInput() ?>

    <?= $form->field($model, 'child_part_id')->textInput() ?>

    <?= $form->field($model, 'quantity_required')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
