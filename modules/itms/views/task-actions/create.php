<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\TaskActions $model */

$this->title = Yii::t('app', 'Create Task Actions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Task Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-actions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
