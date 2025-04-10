<?php

use app\modules\itms\models\Accessories;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\search\AccessoriesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Accessories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accessories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Accessories'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'type_id',
            'accessory_name',
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
                'urlCreator' => function ($action, Accessories $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
