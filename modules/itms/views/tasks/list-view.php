<?php

use app\components\StaticHelper;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = Yii::t('app', 'Technician');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="technician-index">

    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fas fa-plus"></i> ' . Yii::t('app', 'เพิ่มข้อมูล'), ['create'], ['class' => 'btn btn-danger']) ?>
        </p>

    </div>
    <div class="card-header"">
            <?php //  echo $this->render('_search', ['model' => $searchModel]);  ?>
        </div>
    <div class="card">
        <div class="card-header text-white bg-info">
            <?= Html::encode($this->title) ?>
        </div>
      
        <div class="card-body" style="background-color:#497D7420;">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'pager' => StaticHelper::getGridPagerConfig(),
                'itemOptions'  => ['class' => "col-sm-4 col-md-4 col-lg-3 item-hover"],
                'layout' => '<div class="list-view d-flex flex-wrap">{items}</div><div class="text-center">{pager}</div>',
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_list', [
                        'model' => $model,
                        'index' => $index,
                    ]);
                },
            ]); ?>
        </div>
    </div>
</div>