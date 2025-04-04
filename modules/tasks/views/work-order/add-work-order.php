<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\WorkOrder $model */

$this->title = Yii::t('app', 'Work Order: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Work Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Work Order');
?>
<div class="work-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_add-work-order', [
        'model' => $model,
        'initialPreview' => [],
        'initialPreviewConfig' => []
    ]) ?>

</div>
