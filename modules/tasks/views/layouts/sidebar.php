<?php

use app\modules\hrm\models\LeaveRequests;
use yii\helpers\Url;

$identity = Yii::$app->user->identity;
$isGuest = Yii::$app->user->isGuest;
$employeeId = !$isGuest ? $identity->employee_id : null;
$department = !$isGuest && isset($identity->employees->department) ? $identity->employees->department : null;
$users = !$isGuest && $employeeId;
$approves = !$isGuest && $department && $identity->employees->department_id === $department->id;
$managers = !$isGuest && in_array($identity->rule_id, [2, 3]);
$saler = !$isGuest && in_array($identity->rule_id, [2, 3, 15]);
$warehouse = !$isGuest && in_array($identity->department_id, [2]);
$notUser = !$isGuest && !in_array($identity->role_id, [1]); // ระดับหัวหน้าขึ้นไป
$admins = !$isGuest && in_array($identity->rule_id, [2, 12]); // แผนก HR
?>

<aside class="main-sidebar sidebar-dark-light elevation-4">
    <a href="<?= Url::home() ?>" class="brand-link text-center">NFC</a>
    <div class="sidebar">
        <nav class="mt-2 nav-flat nav-compact">
            <?= \hail812\adminlte\widgets\Menu::widget([
                
                'items' => [
                    ['visible' => $users, 'label' => Yii::t('app', 'Home'), 'url' => ['/site/index'], 'iconStyle' => 'bx', 'icon' => 'bx bxs-home text-success'],
                    ['label' => Yii::t('app', 'User'), 'header' => true, 'options' => ['style' => 'color: yellow;']],
                    ['label' => Yii::t('app', 'ขอเบิกอุปกรณ์'), 'url' => ['/equipment/orders/add-order'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-cart-arrow-down'],
                    ['label' => Yii::t('app', 'รายการเบิกของแผนก'), 'url' => ['/equipment/orders/user-index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-rectangle-list'],

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