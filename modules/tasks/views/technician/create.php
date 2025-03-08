<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\Technician $model */

$this->title = Yii::t('app', 'Create New');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Technicians'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="technician-create">
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