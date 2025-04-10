<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\UserClientAuth $model */

$this->title = Yii::t('app', 'Update User Client Auth: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Client Auths'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-client-auth-update">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
