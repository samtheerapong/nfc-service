<?php
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $equipment app\modules\stock\models\Equipment */

$this->title = 'ประวัติการปรับปรุงสต็อก: ' . $equipment->name;
$this->params['breadcrumbs'][] = ['label' => 'จัดการสต็อก', 'url' => ['manage-stock']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="stock-history">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'quantity_change',
                'label' => 'การเปลี่ยนแปลง',
                'hAlign' => 'right',
                'format' => 'integer',
                'value' => function ($model) {
                    return $model->quantity_change > 0 ? '+' . $model->quantity_change : $model->quantity_change;
                },
            ],
            [
                'attribute' => 'reason',
                'label' => 'เหตุผล',
            ],
            [
                'attribute' => 'updated_by',
                'label' => 'ผู้ปรับปรุง',
            ],
            [
                'attribute' => 'updated_at',
                'label' => 'วันที่/เวลา',
                'format' => ['datetime', 'php:d/m/Y H:i'],
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

    <div class="form-group">
        <?= Html::a('กลับไปจัดการสต็อก', ['manage-stock'], ['class' => 'btn btn-secondary']) ?>
    </div>
</div>