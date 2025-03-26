<?php

use yii\helpers\Html;
?>

<div class="card border-secondary mb-3" style="max-width: 18rem;">
    <div class="card-header text-white bg-secondary">
        <?= Html::encode($model->equipment ? $model->equipment->name : '-') ?>
    </div>
    <div class="card-body text-dark">
        <div class="text-center">
            <span class="badge 
                <?= $model->status_id == 1 ? 'badge-warning' : ($model->status_id == 2 ? 'badge-success' : ($model->status_id == 3 ? 'badge-dark' : 'badge-danger')) ?>">
                <?= Html::encode($model->status ? $model->status->name : '-') ?>
            </span>
        </div>
        <hr>
        <div><strong><?= Yii::t('app', 'ผู้เบิก: ') ?></strong> <?= Html::encode($model->user_name) ?></div>
        <div><strong><?= Yii::t('app', 'จำนวน: ') ?></strong> <?= Html::encode($model->quantity) ?></div>
        <div><strong><?= Yii::t('app', 'เบิกเมื่อ: ') ?></strong> <?= Yii::$app->thaiFormatter->asDate($model->created_at, 'medium') ?></div>
        <?php if ($model->status_id == 2): ?>
            <div><strong><?= Yii::t('app', 'ผู้อนุมัติ: ') ?></strong><?= Html::encode($model->approved_by) ?></div>
            <div><strong><?= Yii::t('app', 'อนุมัติเมื่อ: ') ?></strong><?= Yii::$app->thaiFormatter->asDate($model->approved_at, 'medium') ?></div>
        <?php endif; ?>


        <?php if ($model->status_id == 1): ?>
            <hr>
            <div class="text-center">
                <div class="btn-group btn-group-xs">
                    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-xs btn-warning']) ?>
                    <?= Html::a(Yii::t('app', 'Cancel'), ['cancel', 'id' => $model->id], [
                        'class' => 'btn btn-xs btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to cancel this request?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>

        <?php endif; ?>
    </div>
</div>