<?php

use app\modules\rawsauce\models\RawSauceQuality;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\search\RawSauceQualitySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Raw Sauce Qualities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raw-sauce-quality-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Raw Sauce Quality'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'log_id',
            'qc_by',
            'qc_date',
            'sediment',
            //'color_value',
            //'color_ratio',
            //'nacl_value',
            //'ph_value',
            //'alcohol_value',
            //'tn_value',
            //'brix_value',
            //'ncr',
            //'remask',
            //'ref_code',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RawSauceQuality $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
