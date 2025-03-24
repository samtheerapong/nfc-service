<?php
use yii\helpers\Html;

$this->title = 'รายการขอเบิก';
?>
<h1><?= Html::encode($this->title) ?></h1>

<p><?= Html::a('สร้างคำขอเบิก', ['create'], ['class' => 'btn btn-success']) ?></p>

<table class="table">
    <tr>
        <th>อุปกรณ์</th>
        <th>ผู้ขอ</th>
        <th>จำนวน</th>
        <th>สถานะ</th>
        <th>การจัดการ</th>
    </tr>
    <?php foreach ($requisitions as $req): ?>
    <tr>
        <td><?= Html::encode($req->equipment->name) ?></td>
        <td><?= Html::encode($req->user_name) ?></td>
        <td><?= Html::encode($req->quantity) ?></td>
        <td>
            <?php
            if ($req->status == 'pending') echo '<span class="badge badge-warning">รอ</span>';
            elseif ($req->status == 'approved') echo '<span class="badge badge-success">อนุมัติ</span>';
            else echo '<span class="badge badge-danger">ปฏิเสธ</span>';
            ?>
        </td>
        <td>
            <?php if ($req->status == 'pending'): ?>
                <?= Html::a('อนุมัติ', ['approve', 'id' => $req->id], ['class' => 'btn btn-sm btn-success']) ?>
                <?= Html::a('ปฏิเสธ', ['reject', 'id' => $req->id], ['class' => 'btn btn-sm btn-danger']) ?>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>