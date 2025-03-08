<?php

use yii\bootstrap5\Nav;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= \yii\helpers\Url::home() ?>" class="nav-link"><?= Yii::t('app', 'Home'); ?></a>
        </li>
        
    </ul>
    <ul class="navbar-nav ml-auto">
        <?php
        if (Yii::$app->user->isGuest) {
            // echo Html::tag('li', Html::a(Yii::t('app', 'Register'), ['/site/signup'], ['class' => 'nav-link']));
            echo Html::tag('li', Html::a(Yii::t('app', 'Login'), ['/site/login'], ['class' => 'nav-link']));
        } else {
            // $nameToDisplay = Yii::$app->user->identity->thai_name ?: Yii::$app->user->identity->username;
            $nameToDisplay = Yii::$app->user->identity->username ?: Yii::$app->user->identity->username;
            $menuItems = [
                [
                    'label' => Yii::$app->language == 'th-TH' ? 'TH' : 'EN',
                    'url' => Url::current(['language' => Yii::$app->language == 'th-TH' ? 'en-US' : 'th-TH']),
                    'linkOptions' => ['class' => 'active'],
                ],
                 

                [
                    'label' => "( $nameToDisplay )",
                    'items' => [
                        [
                            'label' => Yii::t('app', 'Profile'),
                            'url' => (Yii::$app->user->isGuest || !Yii::$app->user->identity || !isset(Yii::$app->user->identity->employee_id))
                                ?  ['/user/view', 'id' => Yii::$app->user->identity->id]
                                : ['/hrm/employees/user-view', 'id' => Yii::$app->user->identity->employee_id],
                        ],

                        ['label' => Yii::t('app', 'Change Password'), 'url' => ['/user-manage/change-password'], 'linkOptions' => ['class' => 'logout-link']],
                        ['label' => Yii::t('app', 'Logout'), 'url' => ['/site/logout'], 'linkOptions' => ['class' => 'logout-link', 'data-method' => 'post']],
                    ],
                ],
            ];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav ml-auto'],
                'items' => $menuItems,
            ]);
        }
        ?>
        </li>

    </ul>

</nav>