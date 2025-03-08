<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\Teams $model */

$this->title = Yii::t('app', 'Create Teams');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Teams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teams-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
