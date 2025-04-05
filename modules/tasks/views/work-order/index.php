<?php

use app\components\HandleUploads;
use app\components\StaticHelper;
use app\modules\tasks\models\WorkOrder;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\modules\tasks\models\search\WorkOrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Work Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-order-index">
    <p>
        <?= Html::a('<i class="fa-solid fa-home"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary btn-sm btn-w100']) ?>
    </p>
    <div class="card">
        <div class="card-header text-white bg-warning">
            <?= $this->title  ?>
        </div>
        <div class="card-body">
            <div class="row">
                <?php foreach ($dataProvider->models as $model): ?>
                    <div class="col-lg-3 col-md-4 mb-3">
                        <?php $color = $model->status->color ?? '#666666'; ?>
                        <div class="card shadow-sm border-left-<?= $color ?>" style="border-left: 5px solid <?= $color ?>; height: 100%;">
                            <div class="card-body" style="background-color: <?= $color ?>10;">
                                <ul class="list-unstyled text-left">
                                    <?php
                                    $items = array_filter([
                                        // $model->ticket->status_id ? $model->ticket->formatStatus() . ' ' . $model->ticket->getImpactView() : '',
                                        $model->work_order_code ? '<i class="fa-solid fa-screwdriver-wrench text-primary"></i> <strong class="text-primary">รหัสสั่งซ่อม:</strong> ' . Html::a($model->work_order_code, ['/tasks/work-order/view', 'id' => $model->id], ['class' => 'badge badge-xs badge-primary']) : '',
                                        // $model->title ? '<i class="fas fa-tags"></i> <strong>หัวข้อ:</strong> ' . Html::a($model->title, ['/tasks/ticket/view', 'id' => $model->id], ['class' => 'text-primary']) : '',
                                        // $model->ticket_date ? '<i class="fas fa-calendar-alt"></i> <strong>วันที่ต้องการ:</strong> ' . Yii::$app->thaiFormatter->asDate($model->ticket_date, 'long') : '',
                                        $model->work_detail ? '<i class="fa-solid fa-list-check text-primary"></i> <strong class="text-primary">รายละเอียด:</strong> ' . $model->work_detail : '',
                                        $model->work_type_id ? '<i class="fa-solid fa-gears text-primary"></i> <strong class="text-primary">ประเภท:</strong> ' . $model->workType->name : '',
                                        $model->teamwork ? '<i class="fa-solid fa-people-group text-primary"></i> <strong class="text-primary">ทีมงาน:</strong> ' . $model->team->name : '',
                                        $model->start_date ? '<i class="fa-solid fa-play text-primary"></i> <strong class="text-primary">วันที่เริ่มซ่อม:</strong> ' . Yii::$app->thaiFormatter->asDate($model->start_date, 'long') : '',
                                        $model->end_date ? '<i class="fa-solid fa-flag-checkered text-primary"></i> <strong class="text-primary">วันที่ซ่อมเสร็จ:</strong> ' . Yii::$app->thaiFormatter->asDate($model->end_date, 'long') : '',
                                        $model->hours ? '<i class="fas fa-clock text-primary"></i> <strong class="text-primary">ชั่วโมงในการซ่อม:</strong> ' . $model->hours . ' ชั่วโมง' : '',
                                        $model->cost ? '<i class="fa-solid fa-baht-sign text-primary"></i> <strong class="text-primary">ค่าใช้จ่าย:</strong> ' . $model->cost . ' บาท' : '',
                                        $model->approve_name ? '<i class="fa-solid fa-square-check text-success"></i> <strong class="text-success">ผู้อนุมัติ:</strong> ' . $model->approve_name : '',
                                        $model->approve_date ? '<i class="fa-solid fa-square-check text-success"></i> <strong class="text-success">วันที่อนุมัติ:</strong> ' . Yii::$app->thaiFormatter->asDate($model->approve_date, 'long') : '',
                                        $model->approve_comment ? '<i class="fa-solid fa-square-check text-success"></i> <strong class="text-success">ความคิดเห็น:</strong> ' . $model->approve_comment : '',
                                        $model->ticket->ticket_code ? '<i class="fa-solid fa-triangle-exclamation text-danger"></i> <strong class="text-danger">รหัสแจ้งซ่อม:</strong> ' . Html::a($model->ticket->ticket_code, ['/tasks/ticket/view', 'id' => $model->ticket_id], ['class' => 'badge badge-xs badge-danger', 'target' => '_blank']) : '',

                                        // $model->remask ? '<p class="text-danger"><i> หมายเหตุ: ' . $model->remask . '</i></p>' : ''
                                    ]);
                                    echo implode("\n", array_map(fn($item) => "<li>$item</li>", $items));
                                    ?>
                                </ul>
                                <div class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <?= Html::a('<i class="fas fa-list"></i>', ['/tasks/work-order/view', 'id' => $model->id], ['class' => 'btn btn-secondary',  'title' => 'รายละเอียด',]) ?>
                                        <?= Html::a('<i class="fas fa-edit"></i>', ['/tasks/work-order/update', 'id' => $model->id], [
                                            'class' => 'btn btn-warning',
                                            'title' => 'แก้ไข',
                                            'onclick' => "Swal.fire({title: 'ต้องการแก้ไขหรือไม่?', icon: 'warning', showCancelButton: true, confirmButtonText: 'ยืนยัน', cancelButtonText: 'ยกเลิก'})
                                            .then(result => { if (result.isConfirmed) window.location.href = '" . Yii::$app->urlManager->createUrl(['/tasks/work-order/update', 'id' => $model->id]) . "'; }); return false;"
                                        ]) ?>
                                        <?= Html::a('<i class="fa-solid fa-check"></i>', ['/tasks/work-order/approved', 'id' => $model->id], [
                                            'class' => 'btn btn-success',
                                            'title' => 'อนุมัติ',
                                            'onclick' => "Swal.fire({title: 'คุณต้องการอนุมัติหรือไม่?', icon: 'warning', showCancelButton: true, confirmButtonText: 'ยืนยัน', cancelButtonText: 'ยกเลิก'})
                                            .then(result => { if (result.isConfirmed) window.location.href = '" . Yii::$app->urlManager->createUrl(['/tasks/work-order/approved', 'id' => $model->id]) . "'; }); return false;"
                                        ]) ?>

                                        </p>
                                    </div>
                                </div>


                                <div class="text-center mt-2">
                                    <?= !empty($model->getUploadedFiles()->all()) ? Html::a($model->getAvatar(), ['/tasks/work-order/view', 'id' => $model->id], ['class' => 'text-primary']) : HandleUploads::getNoImage(); ?>
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