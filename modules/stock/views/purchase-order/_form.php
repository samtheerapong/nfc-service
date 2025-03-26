<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\stock\models\PurchaseOrder $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="purchase-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'equipment_id')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'pending' => 'Pending', 'ordered' => 'Ordered', 'received' => 'Received', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'ordered_at')->textInput() ?>

    <?= $form->field($model, 'received_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
