<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\stock\models\Requisition $model */

$this->title = Yii::t('app', 'Create Requisition');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requisitions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
