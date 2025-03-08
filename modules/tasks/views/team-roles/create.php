<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\TeamRoles $model */

$this->title = Yii::t('app', 'Create Team Roles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Team Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-roles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
