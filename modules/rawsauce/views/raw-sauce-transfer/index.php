<?php

use app\modules\rawsauce\models\RawSauceTransfer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\search\RawSauceTransferSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Raw Sauce Transfers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raw-sauce-transfer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Raw Sauce Transfer'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'log_id',
            'incoming_tank',
            'incoming_value',
            'incoming_date',
            //'outgoing_tank',
            //'outgoing_value',
            //'outgoing_date',
            //'ref_code',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RawSauceTransfer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
