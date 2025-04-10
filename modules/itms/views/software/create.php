<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\Software $model */

$this->title = Yii::t('app', 'Create Software');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Softwares'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="software-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
