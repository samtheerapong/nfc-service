<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\ColorRatio $model */

$this->title = Yii::t('app', 'Create Color Ratio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Color Ratios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="color-ratio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
