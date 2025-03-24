<?php

use app\components\StaticHelper;
use app\modules\stock\models\RequisitionStatus;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = 'รายการขอเบิก';
?>
<div class="request-index">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-circle-plus text-yellow"></i> ' . Yii::t('app', 'สร้างคำขอเบิก'), ['create'], ['class' => 'btn btn-danger']) ?>
        </p>
        <p style="text-align: right;">
            <?= Html::a('<i class="fa fa-refresh"></i>', ['index'], ['class' => 'btn btn-warning btn-sm', 'title' => Yii::t('app', 'Refresh'), 'data-toggle' => 'tooltip']) ?>
        </p>
    </div>

    <div class="card border-secondary">
        <div class="card-header text-white bg-secondary">
            <?= $this->title; ?>
        </div>
        <div class="card-body table-responsive">


            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pager' => StaticHelper::getGridPagerConfig(),
                // 'panel' => [
                //     'type' => GridView::TYPE_DEFAULT,
                //     'heading' => false,
                // ],
                'responsive' => true,
                // 'hover' => true,
                // 'pjax' => true,
                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],
                    [
                        'attribute' => 'equipment_id',
                        'label' => 'อุปกรณ์',
                        'value' => function ($model) {
                            return $model->equipment ? Html::encode($model->equipment->name) : '-';
                        },
                        'filter' => \yii\helpers\ArrayHelper::map(
                            \app\modules\stock\models\Equipment::find()->all(),
                            'id',
                            'name'
                        ),
                    ],
                    [
                        'attribute' => 'user_name',
                        'label' => 'ผู้ขอ',
                    ],
                    [
                        'attribute' => 'quantity',
                        'label' => 'จำนวน',
                        'hAlign' => 'right',
                        'format' => 'integer',
                    ],
                    [
                        'attribute' => 'status_id',
                        'label' => 'สถานะ',
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
                        'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                        'template' => '<div class="btn-group" role="group"> {approve} {reject}</div>',
                        'buttons' => [
                            'approve' => function ($url, $model) {
                                if (in_array($model->status_id, [1, 3])) {
                                    return Html::a('อนุมัติ', ['approve', 'id' => $model->id], [
                                        'class' => 'btn btn-xs btn-success',
                                    ]);
                                }
                                return '';
                            },
                            'reject' => function ($url, $model) {
                                if ($model->status_id == 1) {
                                    return Html::a('ปฏิเสธ', ['reject', 'id' => $model->id], [
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
                        'contentOptions' => ['style' => 'width: 150px;'],
                    ],
                ],

            ]) ?>


        </div>
    </div>
</div>