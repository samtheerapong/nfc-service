<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\itms\models\Profile $model */

$color = $model->status->color ?? '#ccc';
$link = Html::a($model->thai_name, ['view', 'id' => $model->id], ['class' => 'text-primary']);
?>

<div class="card shadow-sm border-left-<?= $color ?> card-animate" style="border-left: 5px solid <?= $color ?>; height: 100%;">
    <div class="card-body" style="background-color: <?= $color ?>10;">
    <ul class="list-unstyled text-left mb-0 fs-6">
            <li><i class="fa-solid fa-user"></i> <strong>ชื่อ-สกุล:</strong> <?= $link ?></li>
            <li><i class="fa-solid fa-briefcase"></i> <strong>ตำแหน่ง:</strong> <?= Html::encode($model->position) ?></li>
            <li><i class="fa-solid fa-building"></i> <strong>แผนก:</strong> <?= Html::encode($model->department0->name ?? '-') ?></li>
            <li><i class="fa-solid fa-phone-volume"></i> <strong>เบอร์:</strong> <?= Html::encode($model->phone_number) ?></li>
            <li><i class="fa-solid fa-envelope"></i> <strong>อีเมล:</strong> <?= Html::encode($model->email) ?></li>
            <li><i class="fa-solid fa-calendar-day"></i> <strong>เริ่มงาน:</strong> <?= Html::encode($model->start_date) ?></li>
            <li><i class="fa-solid fa-circle-info"></i> <strong>สถานะ:</strong> <?= Html::encode($model->status->name ?? '-') ?></li>
        </ul>
    </div>
</div>