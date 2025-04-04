<?php

use app\components\HandleUploads;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\WorkOrder $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Work Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="work-order-view">
    <div class="button-container mb-3">
        <div class="btn-group-wrapper">
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary btn-sm btn-w100']) ?>
        </div>
        <div class="btn-group-wrapper">
            <?= Html::a('<i class="fas fa-check"></i> อนุมัติ', ['approval', 'id' => $model->id], [
                'class' => 'btn btn-outline-success btn-sm btn-w100',
                'style' => 'border-color: #666666',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to approve this item?'),
                    'method' => 'post',
                ],
            ]) ?>
            </p>
            <?= Html::a('<i class="fa-regular fa-file-pdf"></i> ใบสั่งซ่อม', ['export-wo', 'id' => $model->id], ['class' => 'btn btn-outline-primary btn-sm btn-w100', 'target' => '_blank',]) ?>
            <?= Html::a('<i class="fas fa-edit"></i> แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-warning btn-sm btn-w100', 'style' => 'border-color: #666666;']) ?>
            <?= Html::a('<i class="fas fa-trash"></i> ลบ', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-outline-danger btn-sm btn-w100',
                'style' => 'border-color: #666666',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
            </p>
        </div>
    </div>

    <div class="card">
        <div class="card-header text-white bg-warning">
            <?= $this->title  ?>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-lg-9">

                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th class="text-right" style="width: 1px; white-space: nowrap">{label} : </th><td> {value}</td></tr>',
                        'attributes' => array_filter([

                            'id',
                            'ticket_id',
                            'work_order_code',
                            'work_detail:ntext',
                            'priority_id',
                            'teamwork',
                            'start_date',
                            'end_date',
                            'hours',
                            'work_type_id',
                            'cost',
                            'approve_name',
                            'approve_date',
                            'approve_comment',

                        ]),
                    ]) ?>
                </div>
                <div class="col-md-3 img-thumbnail text-center">
                    <?php
                    $uploadedFiles = $model->getUploadedFiles()->all();
                    if (!empty($uploadedFiles)) {
                        echo \dosamigos\gallery\Gallery::widget([
                            'items' => $model->getShowImages($model->work_order_code),
                        ]); ?>
                    <?php } else { ?>
                        <?= HandleUploads::getNoImage(); ?>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>