<?php

use app\modules\itms\models\Software;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\search\SoftwareSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Softwares');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="software-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Software'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'software_id',
            'computer_id',
            'asset_code',
            'software_name',
            //'description:ntext',
            //'version',
            //'license_key',
            //'installation_date',
            //'expiry_date',
            //'created_at',
            //'updated_at',
            //'ref_code',
            //'status_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Software $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
