<?php

use app\modules\tasks\models\Parts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\search\PartsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Parts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Parts'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'name',
            'description:ntext',
            'group_id',
            //'category_id',
            //'type_id',
            //'location',
            //'serial_code',
            //'asset_code',
            //'last_install',
            //'quantity_in_stock',
            //'unit_cost',
            //'unit',
            //'min_stock',
            //'last_update',
            //'remask',
            //'status_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Parts $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
