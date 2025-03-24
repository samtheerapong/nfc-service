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
                    ['label' => 'อุปกรณ์', 'url' => ['/stock/equipment/index']],
                    ['label' => 'การขอเบิก', 'url' => ['/stock/requisition/index']],
                    ['label' => 'การสั่งซื้อ', 'url' => ['/stock/purchase-order/index']],
                    ['label' => 'สรุป', 'url' => ['/stock/purchase-order/summary']],
                ],
            ]);
            ?>
        </nav>
    </div>
</aside>