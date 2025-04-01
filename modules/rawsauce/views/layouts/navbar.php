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
            <a href="<?= Url::home() ?>" class="nav-link"><?= Yii::t('app', 'Home'); ?></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <?php if (Yii::$app->user->isGuest): ?>
            <li class="nav-item"><?= Html::a(Yii::t('app', 'Login'), ['/site/login'], ['class' => 'nav-link']) ?></li>
        <?php else: 
            $identity = Yii::$app->user->identity;
            $nameToDisplay = $identity->thai_name ?: $identity->username;
            $profileUrl = isset($identity->employee_id) ? ['/hrm/employees/user-view', 'id' => $identity->employee_id] : ['/user/view', 'id' => $identity->id];

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav ml-auto'],
                'items' => [
                    [
                        'label' => Yii::$app->language === 'th-TH' ? 'TH' : 'EN',
                        'url' => Url::current(['language' => Yii::$app->language === 'th-TH' ? 'en-US' : 'th-TH']),
                        'linkOptions' => ['class' => 'active'],
                    ],
                    [
                        'label' => "( $nameToDisplay )",
                        'items' => [
                            ['label' => Yii::t('app', 'Profile'), 'url' => $profileUrl],
                            ['label' => Yii::t('app', 'Logout'), 'url' => ['/site/logout'], 'linkOptions' => ['class' => 'logout-link', 'data-method' => 'post']],
                        ],
                    ],
                ],
            ]);
        endif; ?>
    </ul>
</nav>
