<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Create Ticket');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="approve-form">
    <p>
        <?= Html::button(
            '<i class="fas fa-circle-left"></i> ' . Yii::t('app', 'Go Back'),
            [
                'class' => 'btn btn-primary btn-sm btn-w100',
                'onclick' => 'window.history.back();',
                'aria-label' => Yii::t('app', 'Go Back')
            ]
        ) ?>

    </p>

    <?php
    $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fieldConfig' => [
            'template' => '{label}<div class="col-md-9">{input}{error}</div>',
            'labelOptions' => ['class' => 'col-form-label has-star col-md-3 text-md-right text-left'],
        ],
        'options' => [
            'enctype' => 'multipart/form-data',
            // 'id' => 'dynamic-form'
        ]
    ]);
    ?>
    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>

        <div class="card-body">

            <?= $form->field($model, 'approve_comment')->textarea(['rows' => 3]) ?>

        </div>

        <div class="card-footer">
            <div class="d-grid gap-2">
                <?= Html::submitButton(
                    '<i class="fas fa-check"></i> ' . Yii::t('app', 'Approve'),
                    ['class' => 'btn btn-success']
                ) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>