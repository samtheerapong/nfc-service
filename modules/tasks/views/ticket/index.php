<?php

use app\components\HandleUploads;
use app\components\StaticHelper;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = Yii::t('app', 'รายการแจ้งซ่อม');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">
    <p><?= Html::a('<i class="fa-solid fa-home"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary btn-sm btn-w100']) ?>
        <?= Html::a('<i class="fa-solid fa-triangle-exclamation"></i> ' . Yii::t('app', 'เพิ่มการแจ้งซ่อม'), ['create'], ['class' => 'btn btn-danger btn-sm btn-w100']) ?></p>
    <div class="card">
        <div class="card-header text-white bg-danger">
            <?= $this->title  ?>
        </div>
        <div class="card-body">
            <div class="row">
                <?php foreach ($dataProvider->models as $model): ?>
                    <div class="col-lg-3 col-md-4 mb-3">
                        <?php $color = $model->status->color ?? '#ccc'; ?>
                        <div class="card shadow-sm border-left-<?= $color ?>" style="border-left: 5px solid <?= $color ?>; height: 100%;">
                            <div class="card-body" style="background-color: <?= $color ?>10;">
                                <div class="card-footer text-center">
                                    <ul class="list-unstyled text-left">
                                        <?php
                                        $items = array_filter([
                                            $model->status_id ? $model->formatStatus() . ' ' . $model->getImpactView() : '',
                                            $model->ticket_code ? '<i class="fa-solid fa-screwdriver-wrench"></i> <strong>รหัส:</strong> ' . Html::a($model->ticket_code, ['/tasks/ticket/view', 'id' => $model->id], ['class' => 'text-primary']) : '',
                                            $model->title ? '<i class="fas fa-tags"></i> <strong>หัวข้อ:</strong> ' . Html::a($model->title, ['/tasks/ticket/view', 'id' => $model->id], ['class' => 'text-primary']) : '',
                                            $model->ticket_date ? '<i class="fas fa-calendar-alt"></i> <strong>วันที่ต้องการ:</strong> ' . Yii::$app->thaiFormatter->asDate($model->ticket_date, 'long') : '',
                                            $model->location ? '<i class="fas fa-map-marker-alt"></i> <strong>สถานที่:</strong> ' . $model->location : '',
                                            $model->request_by ? '<i class="fas fa-user"></i> <strong>ผู้ร้องขอ:</strong> ' . $model->request_by : '',
                                            $model->created_at ? '<i class="fa-solid fa-pen"></i> <strong>วันที่บันทึก:</strong> ' . Yii::$app->thaiFormatter->asDate($model->created_at, 'long') : '',
                                            $model->remask ? '<p class="text-danger"><i> หมายเหตุ: ' . $model->remask . '</i></p>' : ''
                                        ]);
                                        echo implode("\n", array_map(fn($item) => "<li>$item</li>", $items));
                                        ?>
                                    </ul>

                                    <div class="btn-group btn-group-sm">
                                        <?= Html::a('<i class="fas fa-list"></i>', ['/tasks/ticket/view', 'id' => $model->id], ['class' => 'btn btn-secondary',  'title' => 'รายละเอียด',]) ?>
                                        <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $model->id], [
                                            'class' => 'btn btn-warning',
                                            'title' => 'แก้ไข',
                                            'onclick' => "Swal.fire({title: 'ต้องการแก้ไขหรือไม่?', icon: 'warning', showCancelButton: true, confirmButtonText: 'ยืนยัน', cancelButtonText: 'ยกเลิก'})
                                            .then(result => { if (result.isConfirmed) window.location.href = '" . Yii::$app->urlManager->createUrl(['/tasks/ticket/update', 'id' => $model->id]) . "'; }); return false;"
                                        ]) ?>
                                        <?= Html::a('<i class="fa-solid fa-plug-circle-xmark"></i>', ['canceled', 'id' => $model->id], [
                                            'class' => 'btn btn-danger',
                                            'title' => 'ยกเลิก',
                                            'onclick' => "Swal.fire({title: 'คุณต้องการยกเลิกหรือไม่?', icon: 'warning', showCancelButton: true, confirmButtonText: 'ยืนยัน', cancelButtonText: 'ยกเลิก'})
                                            .then(result => { if (result.isConfirmed) window.location.href = '" . Yii::$app->urlManager->createUrl(['/tasks/ticket/canceled', 'id' => $model->id]) . "'; }); return false;"
                                        ]) ?>

                                        </p>
                                    </div>
                                </div>

                                <div class="text-center mt-2">
                                    <?= !empty($model->getUploadedFiles()->all()) ? Html::a($model->getAvatar(), ['/tasks/ticket/view', 'id' => $model->id], ['class' => 'text-primary']) : HandleUploads::getNoImage(); ?>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                <?= LinkPager::widget(StaticHelper::getGridPagerConfig() + ['pagination' => $dataProvider->pagination]) ?>
            </div>
        </div>
    </div>
</div>