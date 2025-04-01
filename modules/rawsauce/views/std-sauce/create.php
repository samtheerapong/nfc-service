<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\StdSauce $model */

$this->title = Yii::t('app', 'Create Std Sauce');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Std Sauces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="std-sauce-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
