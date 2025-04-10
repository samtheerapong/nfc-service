<?php

use app\modules\itms\models\Printers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\search\PrintersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Printers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="printers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Printers'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'printer_name',
            'connectivity_types_id',
            //'brand',
            //'model',
            //'serial_number',
            //'location',
            //'purchase_date',
            //'warranty_expiry',
            //'created_at',
            //'updated_at',
            //'status_id',
            //'ref_code',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Printers $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
