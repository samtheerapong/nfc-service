<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\PartsBom $model */

$this->title = Yii::t('app', 'Create Parts Bom');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parts Boms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parts-bom-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
