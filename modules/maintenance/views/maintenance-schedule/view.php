<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\maintenance\models\MaintenanceSchedule $model */

$this->title = $model->schedule_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Maintenance Schedules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="maintenance-schedule-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'schedule_id' => $model->schedule_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'schedule_id' => $model->schedule_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'schedule_id',
            'equipment_id',
            'technician_id',
            'scheduled_date',
            'type_id',
            'frequency_id',
            'status_id',
        ],
    ]) ?>

</div>
