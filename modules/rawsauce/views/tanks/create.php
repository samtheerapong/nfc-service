<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\Tanks $model */

$this->title = Yii::t('app', 'Create Tanks');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tanks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tanks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
