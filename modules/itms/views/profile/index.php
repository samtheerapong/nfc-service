<?php

use app\modules\itms\models\Profile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\search\ProfileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Profiles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Profile'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'title_name',
            'thai_name',
            'english_name',
            //'nickname',
            //'date_of_birth',
            //'start_date',
            //'position',
            //'department_id',
            //'email:email',
            //'line_id',
            //'phone_number',
            //'employee_id',
            //'role_id',
            //'pdpa',
            //'reason',
            //'created_at',
            //'updated_at',
            //'status_id',
            //'leave_date',
            //'approve_name',
            //'approve_date',
            //'ref_code',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Profile $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
