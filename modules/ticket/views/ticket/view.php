<?php

use app\components\HandleUploads;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\ticket\models\ticket $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ticket-view">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('app', 'เพิ่มข้อมูล'), ['create'], ['class' => 'btn btn-danger']) ?>
        </p>

        <p style="text-align: right;" class="btn-group btn-group-xs" role="group">

            <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-warning', 'style' => 'border-color: #666666;']) ?>

            <?= Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-outline-danger',
                'style' => 'border-color: #666666',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>

    <div class="card">
        <div class="card-header text-white bg-secondary">
            <?= $this->title  ?>
        </div>
        <div class="card-body">
            <div class="row">
              
                <div class="col-lg-10">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th class="text-right" style="width: 1px; white-space: nowrap">{label} : </th><td> {value}</td></tr>',
                        'attributes' => [
                            [
                                'attribute' => 'ticket_group',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model->group ?  $model->group->name : '';
                                },
                            ],
                            'ticket_code',
                            'ticket_date:date',
                            'title',
                            'description:ntext',
                            'remask',
                            'request_by',
                            'created_at',
                            'approve_name',
                            'approve_date',
                            'approve_comment:ntext',
                            'status_id',
                        ],
                    ]) ?>

                </div>
                <div class="col-md-2 img-thumbnail text-center">
                    <?php
                    $uploadedFiles = $model->getUploadedFiles()->all();
                    if (!empty($uploadedFiles)) {
                        echo \dosamigos\gallery\Gallery::widget([
                            'items' => $model->getShowImages($model->ticket_code),
                        ]); ?>
                    <?php } else { ?>
                        <?= HandleUploads::getNoImage(); ?>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>