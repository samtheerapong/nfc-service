<?php
 
use yii\helpers\Html;

$images = $model->getShowImages();

?>
<div class="content-wrapper">
    <table class="table_border_less">
        <tr>
            <td colspan="2" class="text-left">
                <h4>บริษัท นอร์ธเทอร์น ฟู้ด คอมเพล็กซ์ จำกัด</h4>
            </td>
            <td colspan="2" class="text-right" style="font-size: 10pt;">

            </td>
        </tr>
    </table>

    <!--------------------------------- Title --------------------------------->
    <table class="table_border_less">
        <tr>
            <td colspan="3" class="center">
                <h2>ใบแจ้งซ่อม</h2>
            </td>
        </tr>
        <tr>
            <td style="width: 220px;"><b>วันที่ : </b><?= $model->ticket_date ?  Yii::$app->thaiFormatter->asDate($model->ticket_date, 'long') : '' ?></td>
            <td><b>ผู้ร้องขอ : </b><?= $model->request_by ? $model->request_by : '' ?></td>
            <td style="width: 220px;"><b>เลขที่เอกสาร :</b> <i><?= $model->ticket_code ?: '' ?></i></td>

        </tr>
        <tr>
            <td colspan="2"><b>ผลกระทบ :</b> <?= $model->priority->name . ' - '. $model->priority->detail ?: '' ?></td>
            <td><b>สถานที่ :</b> <?= $model->location ? $model->location : '' ?></td>
        </tr>
        <tr>
            <td colspan="2"><b>หัวเรื่อง :</b> <?= $model->title ?: '' ?></td>
            <td><b>แผนกที่รับเรื่อง :</b> <?= $model->ticket_group ? $model->group->name : '' ?></td>
        </tr>

    </table>

    <!--------------------------------- Detail --------------------------------->
    <table class="table_border_less">
        <thead>
            <tr>
                <th style="width: 250px; text-align: center;">รายละเอียด</th>
                <th style="text-align: center;">วันที่ต้องการ</th>
                <th style="text-align: center;">วันที่เสีย</th>
                <th style="text-align: center;">สถานที่</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 1px; white-space: nowrap; text-align: center;"><?= $model->description ? $model->description : $model->title ?></td>
                <td style="width: 1px; white-space: nowrap; text-align: center;">
                    <?= $model->ticket_date ? Yii::$app->thaiFormatter->asDate($model->ticket_date, 'medium') : '' ?>
                </td>
                <td style="width: 1px; white-space: nowrap; text-align: center;">
                    <?= $model->broken_date ? Yii::$app->thaiFormatter->asDate($model->broken_date, 'medium') : '' ?>
                </td>
                <td style="width: 150px;">
                    <?= $model->location ? $model->location : '' ?>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>

    <!--------------------------------- Images --------------------------------->
    <div>
        <table class="table_border_less">
            <tr>
                <td class="center">
                    <div><b><?= !empty($images) ? 'รูปภาพประกอบ' : 'ไม่มีรูปภาพประกอบ' ?></b></div>
                    <div>
                        <?php if (!empty($images)): ?>
                            <?php foreach ($images as $image): ?>
                                <?php
                                $filePath = Html::encode($image['src']);
                                $fileExt = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];

                                if (in_array($fileExt, $allowedExtensions)): ?>
                                    <?= Html::img($filePath, array_merge($image['options'], [
                                        'class' => 'img-thumbnail rounded mx-auto d-block',
                                        'style' => 'height: 200px; object-fit: cover; margin: 1px'
                                    ])) ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <hr>
    <!--------------------------------- sing --------------------------------->
    <div class="footer">
        <table class="table_border_less">
            <tr>
                <td class="center" style="width: 250px;">
                    <br>

                    <br> ___________________________
                    <br>
                    ผู้ร้องขอ : <?= $model->request_by ?>
                    <br>
                    วันที่ : <?= Yii::$app->thaiFormatter->asDate($model->created_at, 'long') ?>
                </td>
                <td class="center" style="width: 250px;">
                    <br>
                    <br> ___________________________
                    <br>
                    ผู้อนุมัติ : <?= $model->approve_name ? $model->approve_name : '__________________' ?>
                    <br>
                    วันที่ : <?= $model->approve_date ? Yii::$app->thaiFormatter->asDate($model->approve_date, 'long') : '______/________/_______' ?>
                </td>
                <td class="center" style="width: 250px;">
                    <br>


                    <br>
                    ความคิดเห็นผู้อนุมัติ : <br> <?= $model->approve_comment ? $model->approve_comment : '____________________' ?>


                </td>
            </tr>
            <tr>

                <td colspan="2" style="border:none; text-align: left;">
                    <?php
                    $currentDate = date('Y-m-d H:i');
                    $dt = date_create($currentDate, new DateTimeZone('Asia/Bangkok'))
                        ->setTimeZone(new DateTimeZone('UTC'))
                    ?>
                    <br>
                    <small>Date : <?= Yii::$app->thaiFormatter->asDateTime($dt, 'short') ?></small>
                </td>
                <td style="border:none; text-align: right;">
                    <small> สถานะ : <?= $model->status_id ? $model->status->name : '' ?></small>
                </td>
                </td>
            </tr>
        </table>
    </div>
</div>