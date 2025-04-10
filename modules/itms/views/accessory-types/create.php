<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\AccessoryTypes $model */

$this->title = Yii::t('app', 'Create Accessory Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accessory Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accessory-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
