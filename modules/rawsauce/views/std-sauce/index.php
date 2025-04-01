<?php

use app\modules\rawsauce\models\StdSauce;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\search\StdSauceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Std Sauces');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="std-sauce-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Std Sauce'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'sauce_type',
            'std_ph',
            'std_nacl',
            //'std_tn',
            //'std_color',
            //'std_alcohol',
            //'std_ppm',
            //'std_brix',
            //'remask',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, StdSauce $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
