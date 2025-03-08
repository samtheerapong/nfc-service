<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\Technician $model */

$this->title = Yii::t('app', 'Update : {name}', [
    'name' => $model->thainame,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Technicians'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="technician-update">

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
        'initialPreview' => $initialPreview,
        'initialPreviewConfig' => $initialPreviewConfig
    ]) ?>

</div>