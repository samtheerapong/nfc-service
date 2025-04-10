<?php

use yii\helpers\Html;
?>

<div class="card">
    <div class="img-thumbnail text-center">
        <?= Html::a($model->getAvatar(), ['view', 'id' => $model->id]) ?>
    </div>
    <div class="card-body text-center">
        <strong>
            <div class="card-text">
                <p><?= Html::encode($model->ref_code) ?> :
                    <span class="badge" style="background-color: <?= Html::encode($model->taskStatus->color) ?>">
                        <?= Html::encode($model->taskStatus->name) ?>
                    </span>
                </p>
            </div>

        </strong>

        <p><b><?= Yii::t('app', 'Title') ?>:</b> <?= Html::encode($model->title) ?></p>
        <p><b><?= Yii::t('app', 'Date') ?>:</b> <?= Yii::$app->formatter->asDate($model->task_date) ?></p>
        <p><b><?= Yii::t('app', 'User Request') ?>:</b> <?= Html::encode($model->user_request ?? 'N/A') ?></p>

        <div class="btn-group" role="group">
            <?= Html::a(
                Yii::t('app', 'Details'),
                ['view', 'id' => $model->id],
                ['class' => 'btn btn-secondary btn-sm']
            ) ?>
            <?= Html::a(
                Yii::t('app', 'Update'),
                ['update', 'id' => $model->id],
                [
                    'class' => 'btn btn-warning btn-sm',
                    'data' => [
                        'confirm' => Yii::t('app', 'Do you want to confirm?'),
                        'method' => 'post'
                    ]
                ]
            ) ?>
            <?= Html::a(
                Yii::t('app', 'Action'),
                ['task-action', 'id' => $model->id],
                [
                    'class' => 'btn btn-success btn-sm',
                    'data' => ['confirm' => Yii::t('app', 'Do you want to confirm?')]
                ]
            ) ?>
        </div>
    </div>
</div>