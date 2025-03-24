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
                    ['label' => Yii::t('app', 'แจ้งงาน'), 'url' => ['/tasks/ticket/create'], 'iconStyle' => 'fa', 'icon' => 'fa-solid fa-wrench'],
                    ['label' => Yii::t('app', 'รายการแจ้งของแผนก'), 'url' => ['/tasks/ticket/index'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-rectangle-list'],
                    ['label' => Yii::t('app', 'รายการรออนุมัติ'), 'url' => ['/tasks/ticket/approve-dep'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-rectangle-list'],
                    ['label' => Yii::t('app', 'รายการซ่อม'), 'url' => ['/tasks/ticket/in-progress'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-rectangle-list'],
                    ['label' => Yii::t('app', 'รายการเสร็จ'), 'url' => ['/tasks/ticket/successfully'], 'iconStyle' => 'fa', 'icon' => 'fa-regular fa-rectangle-list'],
                    [
                        // 'visible' => $notUser,
                        'label' => Yii::t('app', 'Engineer'),
                        'iconStyle' => 'bx',
                        'icon' => 'bx bxs-flask text-warning',
                        'items' => [
                            // ITMS
                            [
                                'label' => Yii::t('app', 'Tasks'),
                                'iconStyle' => 'fa',
                                'icon' => 'fa-solid fa-circle-chevron-down',
                                'items' => [
                                    ['label' => Yii::t('app', 'Technician'), 'url' => ['/tasks/technician/index'], 'iconStyle' => 'bx', 'icon' => 'bx bxs-home text-success'],
                                    ['label' => Yii::t('app', 'Team'), 'url' => ['/tasks/teams/index'], 'iconStyle' => 'bx', 'icon' => 'bx bxs-home text-success'],
                                    ['label' => Yii::t('app', 'Role'), 'url' => ['/tasks/team-roles/index'], 'iconStyle' => 'bx', 'icon' => 'bx bxs-home text-success'],
                                    ['label' => Yii::t('app', 'User'), 'header' => true, 'options' => ['style' => 'color: yellow;']],
                                   
                                ],
                            ],
                        ],
                    ],
                    [
                        // 'visible' => $notUser,
                        'label' => Yii::t('app', 'IT'),
                        'iconStyle' => 'bx',
                        'icon' => 'bx bxs-flask text-warning',
                        'items' => [
                            // ITMS
                            [
                                'label' => Yii::t('app', 'Task Recorder'),
                                'iconStyle' => 'fa',
                                'icon' => 'fa-solid fa-o text-warning',
                                'items' => [
                                    ['label' => Yii::t('app', 'Task Lists'), 'url' => ['/itms/tasks/index'], 'iconStyle' => 'fa', 'icon' => 'fa fa-list text-success'],
                                    ['label' => Yii::t('app', 'Task Card'), 'url' => ['/itms/tasks/list-view'], 'iconStyle' => 'fa', 'icon' => 'fa fa-edit text-success'],
                                    ['label' => Yii::t('app', 'New Task'), 'url' => ['/itms/tasks/create'], 'iconStyle' => 'fa', 'icon' => 'fa fa-edit text-success'],
                                  
                                ],
                            ],
                        ],
                    ],
                ],

            ]); ?>

        </nav>
    </div>
</aside>