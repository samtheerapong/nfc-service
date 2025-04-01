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
                    ['label' => Yii::t('app', 'Raw Sauce Logs'), 'url' => ['/rawsauce/raw-sauce-log/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-database'],
                    ['label' => Yii::t('app', 'Create Raw Sauce Logs'), 'url' => ['/rawsauce/raw-sauce-log/create'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-database'],
                    ['label' => Yii::t('app', 'operators'), 'url' => ['/rawsauce/operators/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-database'],
                    ['label' => Yii::t('app', 'raw-sauce-quality'), 'url' => ['/rawsauce/raw-sauce-quality/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-database'],
                    ['label' => Yii::t('app', 'raw-sauce-transfer'), 'url' => ['/rawsauce/raw-sauce-transfer/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-database'],
                    ['label' => Yii::t('app', 'std-sauce'), 'url' => ['/rawsauce/std-sauce/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-database'],
                    ['label' => Yii::t('app', 'color-ratio'), 'url' => ['/rawsauce/color-ratio/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-database'],
                    
                    ['label' => ' ', 'header' => true, 'options' => ['style' => 'color: yellow;']],
                    // ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-home', 'options' => ['style' => 'font-size: small;']],ฃ
                ]
            ]);
            ?>
        </nav>
    </div>
</aside>