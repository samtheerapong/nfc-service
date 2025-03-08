<?php

use app\components\HandleUploads;
use app\modules\tasks\models\Technician;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\DetailView;
 

$this->title = $model->thainame;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Technicians'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="technician-view">

    <div class="items-view">
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
                    <div class="col-md-2 img-thumbnail text-center">
                        <?php
                        $uploadedFiles = $model->getUploadedFiles()->all();
                        if (!empty($uploadedFiles)) {
                            echo \dosamigos\gallery\Gallery::widget([
                                'items' => $model->getShowImages($model->ref),
                            ]); ?>
                        <?php } else { ?>
                            <?= HandleUploads::getNoImage(); ?>
                        <?php } ?>
                    </div>

                    <div class="col-lg-10">
                        <?= DetailView::widget([
                            'model' => $model,
                            'template' => '<tr><th class="text-right" style="width: 1px; white-space: nowrap">{label} : </th><td> {value}</td></tr>',
                            'attributes' => [
                                // 'id',
                                'ref',
                                [
                                    'attribute' => 'user_id',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return $model->user_id ?  $model->users->username : '';
                                    },
                                ],
                                'thainame',
                                [
                                    'attribute' => 'role_id',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return $model->role_id ?  $model->roles->name : '';
                                    },
                                ],
                                'tel',
                                'email:email',
                                'api',
                                [
                                    'attribute' => 'active',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if ($model->active === 'yes') {
                                            return '<span class="badge bg-success">Yes</span>';
                                        }
                                        return '<span class="badge bg-danger">No</span>';
                                    },
                                ],
                                [
                                    'label' => 'ดาวน์โหลดไฟล์',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        $uploadedFiles = $model->getUploadedFiles()->all();
                                        if (!empty($uploadedFiles)) {
                                            $fileButtons = '';
                                            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp']; // Allowed image formats

                                            foreach ($uploadedFiles as $file) {
                                                $ext = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION)); // Extract file extension

                                                // Choose button class based on file type
                                                $btnClass = in_array($ext, $imageExtensions)
                                                    ? 'btn btn-warning btn-xs'   // Image files
                                                    : 'btn btn-primary btn-xs';  // Non-image files

                                                $fileButtons .= '<span>'
                                                    . Html::a(
                                                        '<i class="fa fa-download"></i> ' . Html::encode($file->file_name),
                                                        ['download', 'id' => $file->id],
                                                        [
                                                            'class' => $btnClass,
                                                            'target' => '_blank'
                                                        ]
                                                    )
                                                    . '</span> ';
                                            }
                                            return $fileButtons;
                                        } else {
                                            return Yii::t('app', 'No files uploaded');
                                        }
                                    },
                                ],
                            ],

                        ]) ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>