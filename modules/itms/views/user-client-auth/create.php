<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\UserClientAuth $model */

$this->title = Yii::t('app', 'Create User Client Auth');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Client Auths'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-client-auth-create">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
