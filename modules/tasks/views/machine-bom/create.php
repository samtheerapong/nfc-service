<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\MachineBom $model */

$this->title = Yii::t('app', 'Create Machine Bom');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Machine Boms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="machine-bom-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
