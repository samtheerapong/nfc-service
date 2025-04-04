<?php
use yii\helpers\Html;

?>

<div class="equipment-item" style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px;">
    <h3><?= Html::encode($model->equipment_name) ?></h3>
    <p><strong>Serial Number:</strong> <?= Html::encode($model->serial_number) ?></p>
    <p><strong>Type:</strong> <?= Html::encode($model->type->type_name) ?></p>
    <p><strong>Status:</strong> <?= Html::encode($model->status->status_name) ?></p>
    <p><strong>Purchase Date:</strong> <?= Html::encode($model->purchase_date) ?></p>
    <p><strong>Warranty End Date:</strong> <?= Html::encode($model->warranty_end_date) ?></p>
    <p><strong>Location:</strong> <?= Html::encode($model->location) ?></p>
    <p>
        <?= Html::a('Update', ['update', 'equipment_id' => $model->equipment_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'equipment_id' => $model->equipment_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>