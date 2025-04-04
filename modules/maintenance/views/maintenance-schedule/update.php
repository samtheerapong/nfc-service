<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\maintenance\models\MaintenanceSchedule $model */

$this->title = Yii::t('app', 'Update Maintenance Schedule: {name}', [
    'name' => $model->schedule_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Maintenance Schedules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->schedule_id, 'url' => ['view', 'schedule_id' => $model->schedule_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="maintenance-schedule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
