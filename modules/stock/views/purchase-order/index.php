<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'รายการสั่งซื้อ';
?>

<div class="purchase-order">
    <div style="display: flex; justify-content: space-between;">
        <p><?= Html::a('<i class="fa-solid fa-chart-simple"></i> ดูสรุปความต้องการ', ['summary'], ['class' => 'btn btn-primary']) ?></p>
        <p style="text-align: right;">
            <?= Html::a('<i class="fa fa-refresh"></i>', [''], ['class' => 'btn btn-warning btn-sm', 'title' => Yii::t('app', 'Refresh'), 'data-toggle' => 'tooltip']) ?>
        </p>
    </div>

    <div class="card">
        <div class="card-header text-white bg-info">
            <div style="display: flex; justify-content: space-between;">
                <div>
                    <?= $this->title  ?>
                </div>
                <div style="text-align: right;">
                </div>
            </div>
        </div>
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'responsive' => true,
                'hover' => true,
                'columns' => [
                    [
                        'class' => 'kartik\grid\SerialColumn',
                        'header' => 'ลำดับ',
                    ],
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
                        'attribute' => 'quantity',
                        'label' => 'จำนวน',
                        'hAlign' => 'right',
                        'format' => 'integer',
                    ],
                    [
                        'attribute' => 'status',
                        'label' => 'สถานะ',
                        'format' => 'html',
                        'value' => function ($model) {
                            if ($model->status == 'pending') {
                                return '<span class="badge badge-warning">รอสั่ง</span>';
                            } elseif ($model->status == 'ordered') {
                                return '<span class="badge badge-primary">สั่งแล้ว</span>';
                            } else {
                                return '<span class="badge badge-success">รับแล้ว</span>';
                            }
                        },
                        'filter' => \app\modules\stock\models\PurchaseOrder::optsStatus(),
                    ],
                    [
                        'attribute' => 'created_at',
                        'label' => 'วันที่สร้าง',
                        'format' => ['datetime', 'php:d/m/Y H:i'],
                        'filterType' => GridView::FILTER_DATE,
                        'filterWidgetOptions' => [
                            'pluginOptions' => [
                                'format' => 'dd/mm/yyyy',
                                'autoclose' => true,
                            ]
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'header' => 'การจัดการ',
                        'template' => '{ordered} {received}',
                        'buttons' => [
                            'ordered' => function ($url, $model) {
                                if ($model->status == 'pending') {
                                    return Html::a('สั่งซื้อ', ['mark-ordered', 'id' => $model->id], [
                                        'class' => 'btn btn-xs btn-primary',
                                        'data' => [
                                            'confirm' => 'ยืนยันการสั่งซื้อ?',
                                            'method' => 'post',
                                        ],
                                    ]);
                                }
                                return '';
                            },
                            'received' => function ($url, $model) {
                                if ($model->status == 'ordered') {
                                    return Html::a('รับสินค้า', ['mark-received', 'id' => $model->id], [
                                        'class' => 'btn btn-xs btn-success',
                                        'data' => [
                                            'confirm' => 'ยืนยันการรับสินค้า?',
                                            'method' => 'post',
                                        ],
                                    ]);
                                }
                                return '';
                            },
                        ],
                        'contentOptions' => ['style' => 'width:150px;'],
                    ],
                ],

            ]); ?>
        </div>
    </div>
</div>