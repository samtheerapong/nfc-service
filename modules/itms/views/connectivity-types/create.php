<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\ConnectivityTypes $model */

$this->title = Yii::t('app', 'Create Connectivity Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Connectivity Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="connectivity-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
