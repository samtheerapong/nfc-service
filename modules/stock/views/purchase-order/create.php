<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\stock\models\PurchaseOrder $model */

$this->title = Yii::t('app', 'Create Purchase Order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Purchase Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
