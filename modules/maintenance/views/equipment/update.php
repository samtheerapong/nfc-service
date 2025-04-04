<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\maintenance\models\Equipment $model */

$this->title = Yii::t('app', 'Update Equipment: {name}', [
    'name' => $model->equipment_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Equipments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->equipment_id, 'url' => ['view', 'equipment_id' => $model->equipment_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="equipment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
