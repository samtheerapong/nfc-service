<?php
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จัดการสต็อก';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="stock-manage">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'label' => 'ชื่ออุปกรณ์',
            ],
            [
                'attribute' => 'stock',
                'label' => 'สต็อกปัจจุบัน',
                'hAlign' => 'right',
                'format' => 'integer',
            ],
            [
                'attribute' => 'low_stock_level',
                'label' => 'ระดับสต็อกต่ำ',
                'hAlign' => 'right',
                'format' => 'integer',
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {history}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('ปรับปรุง', ['update-stock', 'id' => $model->id], [
                            'class' => 'btn btn-sm btn-primary',
                        ]);
                    },
                    'history' => function ($url, $model) {
                        return Html::a('ประวัติ', ['stock-history', 'equipment_id' => $model->id], [
                            'class' => 'btn btn-sm btn-info',
                        ]);
                    },
                ],
            ],
        ],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => false,
        ],
        'responsive' => true,
        'hover' => true,
        'pjax' => true,
    ]) ?>
</div>