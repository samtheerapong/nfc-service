<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\Monitors $model */

$this->title = Yii::t('app', 'Create Monitors');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Monitors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
