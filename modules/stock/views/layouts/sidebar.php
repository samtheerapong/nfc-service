<?php


use yii\helpers\Url;

$identity = Yii::$app->user->identity;
$isGuest = Yii::$app->user->isGuest;
$employeeId = !$isGuest ? $identity->employee_id : null;
$users = !$isGuest && $employeeId;

?>

<aside class="main-sidebar sidebar-dark-light elevation-4">
    <a href="<?= Url::home() ?>" class="brand-link text-center">NFC</a>
    <div class="sidebar">
        <nav class="mt-2 nav-flat nav-compact">
            <?= \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => Yii::t('app', 'User'), 'header' => true, 'options' => ['style' => 'color: yellow;']],
                    ['label' => 'ขอเบิก', 'url' => ['/stock/requisition/index']],
                    ['label' => Yii::t('app', 'Approval'), 'header' => true, 'options' => ['style' => 'color: yellow;']],
                    ['label' => 'อนุมัติการเบิก', 'url' => ['/stock/requisition/approval']],
                    ['label' => Yii::t('app', 'Admininstrator'), 'header' => true, 'options' => ['style' => 'color: yellow;']],
                    ['label' => 'การสั่งซื้อ', 'url' => ['/stock/purchase-order/index']],
                    ['label' => 'สรุปความต้องการสั่งซื้อ', 'url' => ['/stock/purchase-order/report']],
                    ['label' => 'สรุป', 'url' => ['/stock/purchase-order/summary']],
                    ['label' => 'อุปกรณ์', 'url' => ['/stock/equipment/index']],
                    ['label' => 'จัดการสต็อก', 'url' => ['/stock/purchase-order/manage-stock']],
                ],
            ]);
            ?>
        </nav>
    </div>
</aside>