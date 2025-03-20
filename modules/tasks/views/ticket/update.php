<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ticket\models\ticket $model */

$this->title = Yii::t('app', 'Update : {name}', [
    'name' => $model->ticket_code,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ticket-update">

    <p>
        <?= Html::button(
            '<i class="fas fa-circle-left"></i> ' . Yii::t('app', 'Go Back'),
            [
                'class' => 'btn btn-primary btn-sm',
                'onclick' => 'window.history.back();',
                'aria-label' => Yii::t('app', 'Go Back')
            ]
        ) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig
    ]) ?>

</div>