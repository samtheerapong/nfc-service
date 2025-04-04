<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\maintenance\models\MaintenanceSchedule $model */

$this->title = Yii::t('app', 'Create Maintenance Schedule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Maintenance Schedules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maintenance-schedule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
