<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Users; // Assuming this is where your Users model is
use app\modules\tasks\models\TeamRoles; // Assuming this is where your TeamRoles model is

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\Teams $model */
/** @var kartik\form\ActiveForm $form */
?>

<div class="teams-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'team_header')->widget(Select2::class, [
        'data' => ArrayHelper::map(Users::find()->all(), 'id', 'thai_name'),
        'options' => [
            'placeholder' => Yii::t('app', 'Select...'),
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'team_role')->widget(Select2::class, [
        'data' => ArrayHelper::map(TeamRoles::find()->all(), 'id', 'name'),
        'options' => [
            'placeholder' => Yii::t('app', 'Select...'),
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'team_email')->input('email', ['maxlength' => true]) ?>

    <?= $form->field($model, 'api')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>