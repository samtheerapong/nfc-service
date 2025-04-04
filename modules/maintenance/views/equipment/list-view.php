<?php

use app\modules\maintenance\models\Equipment;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\modules\maintenance\models\search\EquipmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

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
    <div class="card-header"">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class=" card">
        <div class="card-header text-white bg-info">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="card-body">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions'  => ['class' => "col-md-6 col-lg-4 item-hover"],
                'layout' => '<div class="list-view d-flex flex-wrap">{items}</div><div class="text-center">{pager}</div>',
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_equipment_item', [
                        'model' => $model,
                        'index' => $index,
                    ]);
                },
            ]) ?>
 

        </div>
    </div>
</div>