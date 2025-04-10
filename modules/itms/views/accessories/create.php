<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\Accessories $model */

$this->title = Yii::t('app', 'Create Accessories');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accessories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accessories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
