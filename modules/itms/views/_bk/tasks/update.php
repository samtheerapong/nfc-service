<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\Tasks $model */

$this->title = Yii::t('app', 'Update Tasks: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tasks-update">

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
    ]) ?>

</div>