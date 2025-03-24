<?php
use yii\helpers\Html;

$this->title = 'รายการสั่งซื้อ';
?>
<h1><?= Html::encode($this->title) ?></h1>

<p><?= Html::a('ดูสรุปความต้องการ', ['summary'], ['class' => 'btn btn-info']) ?></p>

<table class="table">
    <tr>
        <th>อุปกรณ์</th>
        <th>จำนวน</th>
        <th>สถานะ</th>
        <th>วันที่สร้าง</th>
        <th>การจัดการ</th>
    </tr>
    <?php foreach ($purchaseOrders as $po): ?>
    <tr>
        <td><?= Html::encode($po->equipment->name) ?></td>
        <td><?= Html::encode($po->quantity) ?></td>
        <td>
            <?php
            if ($po->status == 'pending') echo '<span class="badge badge-warning">รอสั่ง</span>';
            elseif ($po->status == 'ordered') echo '<span class="badge badge-primary">สั่งแล้ว</span>';
            else echo '<span class="badge badge-success">รับแล้ว</span>';
            ?>
        </td>
        <td><?= Html::encode($po->created_at) ?></td>
        <td>
            <?php if ($po->status == 'pending'): ?>
                <?= Html::a('สั่งซื้อ', ['mark-ordered', 'id' => $po->id], ['class' => 'btn btn-sm btn-primary']) ?>
            <?php elseif ($po->status == 'ordered'): ?>
                <?= Html::a('รับสินค้า', ['mark-received', 'id' => $po->id], ['class' => 'btn btn-sm btn-success']) ?>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>