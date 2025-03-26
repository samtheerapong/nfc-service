<?php

use app\components\StaticHelper;
use app\modules\stock\models\Equipment;
use app\modules\stock\models\Requisition;
use app\modules\stock\models\RequisitionStatus;
use kartik\widgets\Select2;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Requisitions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requisition-index">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary  btn-sm']) ?>
            <?= Html::a('<i class="fa fa-circle-plus text-yellow"></i> ' . Yii::t('app', 'สร้างคำขอเบิก'), ['create'], ['class' => 'btn btn-danger btn-sm']) ?>
        </p>
        <p style="text-align: right;">
            <?= Html::a('<i class="fa fa-refresh"></i>', ['index'], [
                'class' => 'btn btn-warning btn-sm',
                'title' => Yii::t('app', 'Refresh'),
                'data-toggle' => 'tooltip'
            ]) ?>
        </p>
    </div>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'hover' => true,
                'pager' => StaticHelper::getGridPagerConfig(),
                'responsive' => true,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => [
                            'class' => 'text-center',
                            'style' => 'width:45px;'
                        ],
                    ],
                    // 'id',
                    [
                        'attribute' => 'equipment_id',
                        'headerOptions' => ['style' => 'width:450px;'], //กำหนด ความกว้างของ #
                        'value' => function ($model) {
                            return $model->equipment ? Html::encode($model->equipment->name) : '-';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'equipment_id',
                            'data' => ArrayHelper::map(Requisition::find()->select(['equipment_id'])->all(), 'equipment_id',  function ($dataValue, $defaultValue) {
                                return  $dataValue->equipment->name;
                            },),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    [
                        'attribute' => 'user_name',
                        'contentOptions' => ['style' => 'width: 220px; white-space: nowrap;'],
                        'value' => function ($model) {
                            return $model->user_name ? Html::encode($model->user_name) : '';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'user_name',
                            'data' => ArrayHelper::map(Requisition::find()->select(['user_name'])->all(), 'user_name', 'user_name'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    [
                        'attribute' => 'quantity',
                        'headerOptions' => ['style' => 'width:100px;'], //กำหนด ความกว้างของ #
                        'hAlign' => 'right',
                        'format' => 'integer',
                        'value' => function ($model) {
                            return $model->quantity ? Html::encode($model->quantity) : '';
                        },
                    ],
                    [
                        'attribute' => 'created_at',
                        'value' => function ($model) {
                            return $model->created_at ?  Yii::$app->thaiFormatter->asDate($model->created_at, 'medium') : '';
                        },
                    ],
                    [
                        'attribute' => 'approved_by',
                        'contentOptions' => ['style' => 'width: 220px; white-space: nowrap;'],
                        'value' => function ($model) {
                            return $model->approved_by ? Html::encode($model->approved_by) : '';
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'approved_by',
                            'data' => ArrayHelper::map(Requisition::find()->select(['approved_by'])->all(), 'approved_by', 'approved_by'),
                            'options' => ['placeholder' => Yii::t('app', 'Select...')],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ])
                    ],
                    [
                        'attribute' => 'approved_at',
                        'value' => function ($model) {
                            return $model->approved_at ?  Yii::$app->thaiFormatter->asDate($model->approved_at, 'medium') : '';
                        },
                    ],
                    [
                        'attribute' => 'status_id',
                        'headerOptions' => ['style' => 'width:130px;'], //กำหนด ความกว้างของ #
                        'format' => 'html',
                        'value' => function ($model) {
                            $statusName =  $model->status ? $model->status->name : '';
                            if ($model->status_id == 1) {
                                return '<span class="badge badge-warning">' . $statusName . '</span>';
                            } elseif ($model->status_id == 2) {
                                return '<span class="badge badge-success">' . $statusName . '</span>';
                            } elseif ($model->status_id == 3) {
                                return '<span class="badge badge-dark">' . $statusName . '</span>';
                            } else {
                                return '<span class="badge badge-danger">' . $statusName . '</span>';
                            }
                        },
                        'filter' => ArrayHelper::map(RequisitionStatus::find()->all(), 'id', 'name'),
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'header' => 'การจัดการ',
                        'headerOptions' => ['style' => 'width:250px;'],
                        'contentOptions' => ['class' => 'text-center'],
                        'buttonOptions' => ['class' => 'btn btn-outline-dark btn-xs'],
                        'template' => '<div class="btn-group" role="group"> {update} {cancel}</div>',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                if ($model->status_id == 1) {
                                    return Html::a('ปรับปรุง', ['update', 'id' => $model->id], [
                                        'class' => 'btn btn-xs btn-warning',
                                    ]);
                                }
                                return '';
                            },
                            'cancel' => function ($url, $model) {
                                if ($model->status_id == 1) {
                                    return Html::a('ยกเลิก', ['cancel', 'id' => $model->id], [
                                        'class' => 'btn btn-xs btn-danger',
                                        'data' => [
                                            'confirm' => 'ยืนยันการยกเลิกคำขอนี้?',
                                            'method' => 'post',
                                        ],
                                    ]);
                                }
                                return '';
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>