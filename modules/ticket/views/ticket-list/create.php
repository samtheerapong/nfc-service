<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ticket\models\TicketList $model */

$this->title = Yii::t('app', 'Create Ticket List');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ticket Lists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
