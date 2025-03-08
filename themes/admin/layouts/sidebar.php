<?php

use yii\helpers\Url;

?>

<aside class="main-sidebar sidebar-dark-light elevation-4">
    <a href="<?= Url::toRoute('') ?>" class="brand-link text-center">NFC</a>
    <div class="sidebar">
        <nav class="mt-2">
            <?= \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index'], 'iconStyle' => 'bx', 'icon' => 'bx bxs-home text-success'],
                    ['label' => Yii::t('app', 'Technician'), 'url' => ['/tasks/technician/index'], 'iconStyle' => 'bx', 'icon' => 'bx bxs-home text-success'],
                    ['label' => Yii::t('app', 'Team'), 'url' => ['/tasks/teams/index'], 'iconStyle' => 'bx', 'icon' => 'bx bxs-home text-success'],
                    ['label' => Yii::t('app', 'Role'), 'url' => ['/tasks/team-roles/index'], 'iconStyle' => 'bx', 'icon' => 'bx bxs-home text-success'],
                ],
            ]); ?>

        </nav>
    </div>
</aside>