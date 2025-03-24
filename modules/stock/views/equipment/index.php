<?php
use yii\helpers\Html;

$this->title = 'รายการอุปกรณ์';
?>
<h1><?= Html::encode($this->title) ?></h1>

<p><?= Html::a('เพิ่มอุปกรณ์', ['create'], ['class' => 'btn btn-success']) ?></p>

<table class="table">
    <tr>
        <th>ชื่อ</th>
        <th>จำนวนในสต็อก</th>
    </tr>
    <?php foreach ($equipments as $equipment): ?>
    <tr>
        <td><?= Html::encode($equipment->name) ?></td>
        <td><?= Html::encode($equipment->stock) ?></td>
    </tr>
    <?php endforeach; ?>
</table>