<?php
use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Technicians');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="technician-index">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-circle-plus text-yellow"></i> ' . Yii::t('app', 'Create New'), ['create'], ['class' => 'btn btn-danger']) ?>
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
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width:45px;'], //กำหนด ความกว้างของ #
                    ],

                    // 'id',
                    [
                        'attribute' => 'images',
                        'label' => Yii::t('app', 'Image'),
                        'format' => 'raw',
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center', 'style' => 'width: 100px;'],
                        'value' => function ($model) {
                            return $model->getAvatar();
                        },
                        'filter' => false,
                    ],

                   
                    'ref',
                    'user_id',
                    'thainame',
                    'role_id',
                    //'tel',
                    //'email:email',
                    //'api',
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'headerOptions' => ['style' => 'width:250px;'],
                        'contentOptions' => ['class' => 'text-center'],
                        'buttonOptions' => ['class' => 'btn btn-outline-dark btn-sm'],
                        'template' => '<div class="btn-group" role="group">{view} {update} {delete}</div>',
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>