<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\stock\models\Equipment $model */

$this->title = Yii::t('app', 'Create Equipment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Equipments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
