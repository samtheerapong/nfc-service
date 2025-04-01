<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\RawSauceQuality $model */

$this->title = Yii::t('app', 'Create Raw Sauce Quality');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Raw Sauce Qualities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raw-sauce-quality-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
