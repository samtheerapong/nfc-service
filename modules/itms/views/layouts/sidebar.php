<?php
use hoaaah\sbadmin2\widgets\Menu;

echo Menu::widget([
    'options' => [
        'ulClass' => "navbar-nav bg-gradient-dark sidebar sidebar-dark accordion",
        'ulId' => "accordionSidebar"
    ], //  optional
    'brand' => [
        'url' => ['/'],
        'content' => <<<HTML
            <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>        
HTML
    ],
    'items' => [
        // [
        //     'label' => 'Menu 1',
        //     'url' => ['/menu1'], //  Array format of Url to, will be not used if have an items
        //     'icon' => 'fas fa-fw fa-tachometer-alt', // optional, default to "fa fa-circle-o
        //     'visible' => true, // optional, default to true
        //     // 'options' => [
        //     //     'liClass' => 'nav-item',
        //     // ] // optional
        // ],
        // [
        //     'type' => 'divider', // divider or sidebar, if not set then link menu
        //     // 'label' => '', // if sidebar we will set this, if divider then no

        // ],
        [
            'label' => 'Tasks',
            'icon' => 'fas fa-home', // optional, default to "fa fa-circle-o
            'visible' => true, // optional, default to true
            'subMenuTitle' => 'User Task', // optional only when have submenutitle, if not exist will not have subMenuTitle
            'items' => [
                [
                    'label' => 'Task Lists',
                    'url' => ['/itms/tasks/index'], //  Array format of Url to, will be not used if have an items
                    'icon' => 'fa fa-list', // optional, default to "fa fa-circle-o
                ],
                [
                    'label' => 'New Task',
                    'url' => ['/itms/tasks/create'], //  Array format of Url to, will be not used if have an items
                    'icon' => 'fa fa-edit', // optional, default to "fa fa-circle-o
                ],
            ]
        ],
        
        [
            'label' => 'Menu 3',
            'visible' => true, // optional, default to true
            // 'subMenuTitle' => 'Menu 3 Item', // optional only when have submenutitle, if not exist will not have subMenuTitle
            'items' => [
                [
                    'label' => 'Menu 3 Sub 1',
                    'url' => ['/menu21'], //  Array format of Url to, will be not used if have an items
                ],
                [
                    'label' => 'Menu 3 Sub 2',
                    'url' => ['/menu22'], //  Array format of Url to, will be not used if have an items
                ],
            ]
        ],
    ]
]);