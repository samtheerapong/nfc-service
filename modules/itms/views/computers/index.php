<?php

use app\modules\itms\models\Computers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\search\ComputersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Computers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="computers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Computers'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'profile_id',
            'asset_code',
            'computer_name',
            'brand',
            //'model',
            //'serial_number',
            //'purchase_date',
            //'warranty_expiry',
            //'cpu',
            //'ram',
            //'capacity_storage',
            //'lan',
            //'wifi',
            //'network_ip',
            //'nework_mac_addr',
            //'status_id',
            //'created_at',
            //'updated_at',
            //'ref_code',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Computers $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
