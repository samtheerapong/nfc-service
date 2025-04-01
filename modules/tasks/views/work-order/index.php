<?php

use app\modules\tasks\models\WorkOrder;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\search\WorkOrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Work Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Work Order'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ticket_id',
            'work_order_code',
            'work_detail:ntext',
            'priority_id',
            //'teamwork',
            //'start_date',
            //'end_date',
            //'hours',
            //'work_type_id',
            //'cost',
            //'approve_name',
            //'approve_date',
            //'approve_comment',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, WorkOrder $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
