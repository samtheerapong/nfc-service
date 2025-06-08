<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\msw\models\Budget $model */

$this->title = Yii::t('app', 'Create Budget');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Budgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
