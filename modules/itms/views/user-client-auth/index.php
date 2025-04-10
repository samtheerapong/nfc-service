<?php

use app\modules\itms\models\UserClientAuth;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\search\UserClientAuthSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'User Client Auths');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-client-auth-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create User Client Auth'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'profile_id',
            'user_login',
            'user_login_pass',
            'company_email:email',
            //'company_email_pass:email',
            //'mrp_user_login',
            //'mrp_user_login_pass',
            //'printer_code',
            //'phone_number',
            //'operator_name',
            //'operator_date',
            //'operator_comment:ntext',
            //'recorder_date',
            //'ref_code',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, UserClientAuth $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
