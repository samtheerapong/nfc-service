<?php

use app\modules\itms\models\Monitors;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\search\MonitorsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Monitors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitors-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Monitors'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'computer_id',
            'asset_code',
            'monitor_name',
            'monitor_type',
            //'screen_size_inch',
            //'connectivity_types_id',
            //'brand',
            //'model',
            //'serial_number',
            //'purchase_date',
            //'warranty_expiry',
            //'created_at',
            //'updated_at',
            //'status_id',
            //'ref_code',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Monitors $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
