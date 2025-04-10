<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\Computers $model */

$this->title = Yii::t('app', 'Create Computers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Computers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="computers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
