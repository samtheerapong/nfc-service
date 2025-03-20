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
                    ['visible' => $users, 'label' => Yii::t('app', 'Home'), 'url' => ['/site/index'], 'iconStyle' => 'bx', 'icon' => 'bx bxs-home text-success'],
                    ['label' => Yii::t('app', 'User'), 'header' => true, 'options' => ['style' => 'color: yellow;']],
                    ['label' => Yii::t('app', 'แจ้งงาน'), 'url' => ['/tasks/ticket/create'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-wrench'],
                    ['label' => Yii::t('app', 'รายการแจ้งของแผนก'), 'url' => ['/tasks/ticket/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-rectangle-list'],
                    ['label' => Yii::t('app', 'รายการรออนุมัติ'), 'url' => ['/tasks/ticket/approve-dep'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-rectangle-list'],
                    ['label' => Yii::t('app', 'รายการซ่อม'), 'url' => ['/tasks/ticket/in-progress'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-rectangle-list'],
                    ['label' => Yii::t('app', 'รายการเสร็จ'), 'url' => ['/tasks/ticket/successfully'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-rectangle-list'],

                    ['label' => Yii::t('app', 'Administrator'), 'header' => true, 'options' => ['style' => 'color: yellow;']],
                    ['label' => Yii::t('app', 'การอนุมัติ'), 'url' => ['/equipment/orders/approve-index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-square-check'],
                    ['label' => Yii::t('app', 'รายการเบิกทั้งหมด'), 'url' => ['/equipment/orders/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-rectangle-list'],
                    ['label' => Yii::t('app', 'สต๊อคอุปกรณ์'), 'url' => ['/equipment/items/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-cubes'],
                    ['label' => Yii::t('app', 'รายการสั่งซื้ออุปกรณ์'), 'url' => ['/equipment/order-item/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-file-invoice-dollar'],
                    ['label' => ' ', 'header' => true, 'options' => ['style' => 'color: yellow;']],
                    // ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-home', 'options' => ['style' => 'font-size: small;']],ฃ
                ]
            ]); ?>
        </nav>
    </div>
</aside>