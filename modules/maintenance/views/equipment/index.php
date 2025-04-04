<?php
 
use kartik\grid\GridView;
use yii\helpers\Html;
 

$this->title = Yii::t('app', 'Equipments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-index">

    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fas fa-plus"></i> ' . Yii::t('app', 'เพิ่มข้อมูล'), ['create'], ['class' => 'btn btn-danger']) ?>
        </p>

    </div>

    <div class=" card">
        <div class="card-header text-white bg-info">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
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
                                return Html::a('<i class="fa-solid fa-eye"></i>', ['view', 'id' => $model->equipment_id], [
                                    'title' => Yii::t('app', 'View'),
                                    'class' => 'btn btn-info btn-sm',
                                    // 'style' => 'border-color: #666666;',
                                ]);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a('<i class="fa-solid fa-edit"></i>', ['update', 'id' => $model->equipment_id], [
                                    'title' => Yii::t('app', 'Update'),
                                    'class' => 'btn btn-warning btn-sm',
                                    // 'style' => 'border-color: #666666;',
                                ]);
                            },
                            'task-action' => function ($url, $model, $key) {
                                return Html::a('<i class="fa-solid fa-wrench"></i>', ['task-action', 'id' => $model->equipment_id], [
                                    'title' => Yii::t('app', 'Action'),
                                    'class' => 'btn btn-success btn-sm',
                                    // 'style' => 'border-color: #666666;',
                                ]);
                            },
                        ],
                    ],
                    // 'equipment_id',
                    'equipment_name',
                    'asset_code',
                    // 'serial_number',
                    [
                        'attribute' => 'type_id',
                        'value' => 'type.type_name'
                    ],
                    [
                        'attribute' => 'status_id',
                        'value' => 'status.status_name'
                    ],
                    [
                        'attribute' => 'status_id',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width: 120px; white-space: nowrap;'],
                        'format' => 'html',
                        'value' => function ($model) {
                            $name = $model->status->status_name;
                            if ($name == 'Active') {
                                $color = 'success';
                            } else if ($name == 'Inactive') {
                                $color = 'danger';
                            } else {
                                $color = 'warning';
                            }
                            return '<span class="badge badge-' . $color . '">' . $name . '</span>';
                        },
                    ],
                    // 'purchase_date',
                    // 'warranty_end_date',
                    'location',

                ],
            ]);
            ?>

        </div>
    </div>
</div>