<?php

use app\modules\itms\models\TaskActions;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\search\TaskActionsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Task Actions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-actions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Task Actions'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'task_code',
            'action_code',
            'process_fixed:ntext',
            'comment:ntext',
            //'start_date',
            //'end_date',
            //'operator',
            //'item',
            //'cost',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TaskActions $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
