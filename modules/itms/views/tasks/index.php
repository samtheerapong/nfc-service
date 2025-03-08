<?php

use app\components\StaticHelper;
use app\modules\itms\models\Tasks;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
 

$this->title = Yii::t('app', 'Tasks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fa-solid fa-home"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'เพิ่มข้อมูล'), ['create'], ['class' => 'btn btn-danger']) ?>
        </p>
        <p style="text-align: right;" role="group">
            <?= Html::a('<i class="fa fa-refresh"></i>', [''], ['class' => 'btn btn-warning', 'title' => Yii::t('app', 'Refresh'), 'data-toggle' => 'tooltip']) ?>
        </p>

    </div>

    <div class="card">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'hover' => true,
                'pager' => StaticHelper::getGridPagerConfig(),
                'columns' => [
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'headerOptions' => ['style' => 'width:250px;'],
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width: 1px; white-space: nowrap;'],
                        'buttonOptions' => [
                            'class' => 'btn btn-warning btn-sm',
                            // 'style' => 'border-color: #666666;',
                        ],
                        'template' => '<div class="btn-group btn-group-xs" role="group"> {view} {update} {task-action}</div>',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a('<i class="fa-solid fa-eye"></i>', ['view', 'id' => $model->id], [
                                    'title' => Yii::t('app', 'View'),
                                    'class' => 'btn btn-info btn-sm',
                                    // 'style' => 'border-color: #666666;',
                                ]);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('<i class="fa-solid fa-edit"></i>', ['update', 'id' => $model->id], [
                                    'title' => Yii::t('app', 'Update'),
                                    'class' => 'btn btn-warning btn-sm',
                                    // 'style' => 'border-color: #666666;',
                                ]);
                            },
                            'task-action' => function ($url, $model, $key) {
                                return Html::a('<i class="fa-solid fa-wrench"></i>', ['task-action', 'id' => $model->id], [
                                    'title' => Yii::t('app', 'Action'),
                                    'class' => 'btn btn-success btn-sm',
                                    // 'style' => 'border-color: #666666;',
                                ]);
                            },
                        ],
                    ],

                    [
                        'attribute' => 'status_id',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width: 100px; white-space: nowrap;'],
                        'value' => function ($model) {
                            $color = $model->taskStatus->color;
                            $name = $model->taskStatus->name;
                            return '<span class="badge" style="background-color:' . $color . '">' . $name . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'ref_code',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width: 1px; white-space: nowrap;'],
                        'value' => function ($model) {
                            $msg = $model->ref_code;
                            return  $msg;
                        },
                    ],
                    [
                        'attribute' => 'title',
                        'format' => 'html',
                        'value' => function ($model) {
                            $msg = $model->title;
                            return  $msg;
                        },
                    ],

                    [
                        'attribute' => 'task_date',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width: 1px; white-space: nowrap;'],
                        'value' => function ($model) {
                            $msg = Yii::$app->thaiFormatter->asDate($model->task_date, 'long');
                            return  $msg;
                        },
                    ],
                    [
                        'attribute' => 'type_id',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width: 120px; white-space: nowrap;'],
                        'value' => function ($model) {
                            $color = $model->taskTypes->color;
                            $name = $model->taskTypes->name;
                            return '<span class="badge" style="background-color:' . $color . '">' . $name . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'department_id',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width: 120px; white-space: nowrap;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $color = $model->taskDepartments->color;
                            $name = $model->taskDepartments->name;
                            return '<span class="badge" style="background-color:' . $color . '">' . $name . '</span>';
                        },
                    ],
                    [
                        'attribute' => 'user_request',
                        'format' => 'html',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width: 1px; white-space: nowrap;'],
                        'value' => function ($model) {
                            $msg = $model->user_request;
                            return  $msg;
                        },
                    ],



                ],
            ]); ?>


        </div>
    </div>
</div>