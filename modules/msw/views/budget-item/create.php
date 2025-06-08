<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\msw\models\BudgetItem $model */

$this->title = Yii::t('app', 'Create Budget Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Budget Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
