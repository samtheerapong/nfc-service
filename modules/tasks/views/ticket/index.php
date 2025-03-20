<?php

use app\components\HandleUploads;
use app\modules\tasks\models\ticket;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\modules\ticket\models\search\TicketSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Tickets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-index">
    

    <p>
        <?= Html::a(Yii::t('app', 'Create Ticket'), ['create'], ['class' => 'btn btn-success btn-sm btn-w100']) ?>
    </p>

    <div class="row">
        <?php foreach ($dataProvider->models as $model): ?>
            <div class="col-lg-3 col-md-4 mb-3">
                <?php $color = $model->status ? $model->status->color : '#cccccc'; ?>
                <div class="card shadow-sm border-left-<?= $color ?> d-flex flex-column" style="border-left: 5px solid <?= $color ?>; height: 100%;">
                    <!-- เนื้อหา -->
                    <div class="card-body flex-grow-1" style="background-color: <?= $color ?>20;">
                        <ul class="list-unstyled text-left">
                            <?php if (!empty($model->status_id)): ?>
                                <li><?= $model->formatStatus(); ?></li>
                            <?php endif; ?>
                            <?php if (!empty($model->ticket_code)): ?>
                                <li><i class="fas fa-hashtag"></i> <strong>รหัส:</strong> <?= $model->ticket_code ?></li>
                            <?php endif; ?>
                            <?php if (!empty($model->ticket_date)): ?>
                                <li><i class="fas fa-calendar-alt"></i> <strong>วันที่ต้องการ:</strong> <?= Yii::$app->thaiFormatter->asDate($model->ticket_date, 'long')  ?></li>
                            <?php endif; ?>
                            <?php if (!empty($model->title)): ?>
                                <li><i class="fas fa-file-alt"></i> <strong>หัวข้อ:</strong> <?= $model->title ?></li>
                            <?php endif; ?>
                            <?php if (!empty($model->location)): ?>
                                <li><i class="fas fa-map-marker-alt"></i> <strong>สถานที่:</strong> <?= $model->location ?></li>
                            <?php endif; ?>
                            <?php if (!empty($model->request_by)): ?>
                                <li><i class="fas fa-user"></i> <strong>ผู้ขอ:</strong> <?= $model->request_by ?></li>
                            <?php endif; ?>
                            <?php if (!empty($model->created_at)): ?>
                                <li><i class="fas fa-clock"></i> <strong>วันที่บันทึก:</strong> <?= Yii::$app->thaiFormatter->asDate($model->created_at, 'long') ?></li>
                            <?php endif; ?>
                            <?php if (!empty($model->remask)): ?>
                                <li><i class="fas fa-sticky-note"></i> <strong>หมายเหตุ:</strong> <span class="text-danger"><?= $model->remask ?></span></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- รูปภาพ -->
                    <div class="text-center mt-2">
                        <?= !empty($model->getUploadedFiles()->all()) ? $model->getAvatar() : HandleUploads::getNoImage(); ?>
                    </div>
                    <!-- ปุ่ม -->
                    <div class="card-footer text-center">
                        <div class="btn-group btn-group-sm" role="group">
                            <?= Html::a('<i class="fas fa-list"></i>', ['/tasks/ticket/view', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
                            <?= Html::a('<i class="fas fa-edit"></i>', '#', [
                                'class' => 'btn btn-warning',
                                'onclick' => '
                                    Swal.fire({
                                        title: "ต้องการแก้ไขหรือไม่?",
                                        // text: "โปรดตรวจสอบข้อมูลให้ครบถ้วน",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonText: "ยืนยัน",
                                        cancelButtonText: "ยกเลิก"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = "' . Yii::$app->urlManager->createUrl(['/tasks/ticket/update', 'id' => $model->id]) . '";
                                        }
                                    });
                                    return false;
                                ',
                            ]) ?>
                            <?= Html::a('<i class="fas fa-times"></i>', '#', [
                                'class' => 'btn btn-danger',
                                'onclick' => '
                                    Swal.fire({
                                        title: "คุณต้องการยกเลิกหรือไม่?",
                                        // text: "ระบบจะไม่สามารถแก้ไขได้ภายหลัง",
                                        icon: "warning",
                                        showCancelButton: true,
                                        confirmButtonText: "ยืนยัน",
                                        cancelButtonText: "ยกเลิก"
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = "' . Yii::$app->urlManager->createUrl(['/tasks/ticket/canceled', 'id' => $model->id]) . '";
                                        }
                                    });
                                    return false;
                                ',
                            ]) ?>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div class="mt-3 d-flex justify-content-center">
        <?= yii\widgets\LinkPager::widget(app\components\StaticHelper::getGridPagerConfig() + ['pagination' => $dataProvider->pagination]) ?>
    </div>

</div>