<?php

use app\components\HandleUploads;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\ticket\models\ticket $model */

$this->title = $model->ticket_code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ticket-view">
    <div class="button-container mb-3">
        <div class="btn-group-wrapper">
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary btn-sm btn-w100']) ?>
        </div>
        <div class="btn-group-wrapper">
            <?= Html::a('<i class="fa-regular fa-file-pdf"></i> ใบแจ้งซ่อม', ['export-document', 'id' => $model->id], ['class' => 'btn btn-outline-primary btn-sm btn-w100', 'target' => '_blank',]) ?>
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
                            [
                                'attribute' => 'status_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return $model->status_id ? $model->formatStatus() : '';
                                },
                            ],

                            [
                                'attribute' => 'priority_id',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model->priority_id ?  $model->getImpactView() : '';
                                },
                            ],

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
                            !empty($model->description) ? [
                                'attribute' => 'description',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    $name = $model->description ? $model->description : '';
                                    return $name;
                                },
                            ] : null,
                            'location',
                            !empty($model->remask) ? [
                                'attribute' => 'remask',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    $name = $model->remask ? $model->remask : '';
                                    return $name;
                                },
                            ] : null,
                            'request_by',
                            'created_at:date',
                            !empty($model->approve_name) ? [
                                'attribute' => 'approve_name',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $name = $model->approve_name ? $model->approve_name : '';
                                    return $name;
                                },
                            ] : null,
                            !empty($model->approve_date) ? [
                                'attribute' => 'approve_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $name = $model->approve_date ? $model->approve_date : '';
                                    return $name;
                                },
                            ] : null,
                            !empty($model->approve_comment) ? [
                                'attribute' => 'approve_comment',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    $name = $model->approve_comment ? $model->approve_comment : '';
                                    return $name;
                                },
                            ] : null,



                        ]),
                    ]) ?>

                </div>
                <div class="col-md-3 img-thumbnail text-center">
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