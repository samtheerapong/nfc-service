<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\RawSauceTransfer $model */

$this->title = Yii::t('app', 'Create Raw Sauce Transfer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Raw Sauce Transfers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raw-sauce-transfer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
