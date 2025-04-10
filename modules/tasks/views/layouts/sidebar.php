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
                    ['visible' => $users, 'label' => Yii::t('app', 'Home'), 'url' => ['/site/index'], 'iconStyle' => 'fa', 'icon' => 'fa fa-home text-success'],
                    ['label' => Yii::t('app', 'User'), 'header' => true, 'options' => ['style' => 'color: yellow;']],
                    ['label' => Yii::t('app', 'เพิ่มการแจ้งซ่อม'), 'url' => ['/tasks/ticket/create'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-triangle-exclamation'],
                    ['label' => Yii::t('app', 'รายการแจ้งซ่อม'), 'url' => ['/tasks/ticket/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-list'],

                    ['label' => Yii::t('app', 'Header'), 'header' => true, 'options' => ['style' => 'color: yellow;']],
                    ['label' => Yii::t('app', 'รายการรออนุมัติ'), 'url' => ['/tasks/ticket/index-super'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-hourglass-half'],
                    
                    ['label' => Yii::t('app', 'Engineer'), 'header' => true, 'options' => ['style' => 'color: yellow;']],
                    ['label' => Yii::t('app', 'รายการรอซ่อม'), 'url' => ['/tasks/ticket/index-process'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-spinner'],
                    ['label' => Yii::t('app', 'รายการอนุมัติ'), 'url' => ['/tasks/work-order/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-screwdriver-wrench'],
                    // ['label' => Yii::t('app', 'รายการอนุมัติซ่อม'), 'url' => ['/tasks/work-order/index-approval'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-sun'],
                    ['label' => Yii::t('app', 'รายการงานสิ้นสุด'), 'url' => ['/tasks/ticket/index-complete'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-thumbs-up'],

                    ['label' => Yii::t('app', 'Config'), 'header' => true, 'options' => ['style' => 'color: yellow;']],
                    ['label' => Yii::t('app', 'เครื่องจักร'), 'url' => ['/tasks/machine/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-square-pen'],
                    ['label' => Yii::t('app', 'อะไหล่'), 'url' => ['/tasks/parts/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-square-pen'],
                    ['label' => Yii::t('app', 'โครงสร้างเครื่องจักร'), 'url' => ['/tasks/machine-bom/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-square-pen'],
                    ['label' => Yii::t('app', 'ทีมงาน'), 'url' => ['/tasks/technician/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-square-pen'],
                    ['label' => Yii::t('app', 'กลุ่มทีมงาน'), 'url' => ['/tasks/teams/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-square-pen'],
                    ['label' => Yii::t('app', 'ทีมงาน'), 'url' => ['/tasks/teams/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-square-pen'],
                    ['label' => Yii::t('app', 'ทีมงาน'), 'url' => ['/tasks/teams/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-square-pen'],
                    ['label' => Yii::t('app', 'การอนุมัติ'), 'url' => ['/equipment/orders/approve-index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-square-check'],
                    ['label' => Yii::t('app', 'รายการเบิกทั้งหมด'), 'url' => ['/equipment/orders/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-rectangle-list'],
                    ['label' => Yii::t('app', 'สต๊อคอุปกรณ์'), 'url' => ['/equipment/items/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-cubes'],
                    ['label' => Yii::t('app', 'รายการสั่งซื้ออุปกรณ์'), 'url' => ['/equipment/order-item/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-file-invoice-dollar'],
                    ['label' => ' ', 'header' => true, 'options' => ['style' => 'color: yellow;']],
                    // ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-home', 'options' => ['style' => 'font-size: small;']],ฃ
                ]
            ]);
            ?>
        </nav>
    </div>
</aside>