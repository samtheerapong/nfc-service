<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\ticket\models\ticket $model */

$this->title = Yii::t('app', 'Create Ticket');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-create">

    <p>
        <?= Html::button(
            '<i class="fas fa-circle-left"></i> ' . Yii::t('app', 'Go Back'),
            [
                'class' => 'btn btn-primary',
                'onclick' => 'window.history.back();',
                'aria-label' => Yii::t('app', 'Go Back')
            ]
        ) ?>

    </p>

    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview' => [],
        'initialPreviewConfig' => []
    ]) ?>

</div>