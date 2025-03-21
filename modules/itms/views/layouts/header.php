<?php

use yii\bootstrap5\Nav;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <?= Html::a('Home', ['/itms/tasks/index'], ['class' => 'nav-link']) ?>
    <?php //echo Html::a('Dashboard', ['/site/dashboard'], ['class' => 'nav-link']) 
    ?>
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-dark">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 12, 2019</div>
                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="fas fa-donate text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 7, 2019</div>
                        $290.29 has been deposited into your account!
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 2, 2019</div>
                        Spending Alert: We've noticed unusually high spending for your account.
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="<?= Url::current(['language' => Yii::$app->language == 'th-TH' ? 'en-US' : 'th-TH']) ?>">
                <!-- <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> -->
                <?= Yii::$app->language == 'th-TH' ? 'TH' : 'EN' ?>
            </a>
        </li>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <?php if (!Yii::$app->user->isGuest): ?>
                <?php
                $nameToDisplay = Yii::$app->user->identity->username ?: Yii::$app->user->identity->username;
                $profileUrl = (Yii::$app->user->isGuest || !Yii::$app->user->identity || !isset(Yii::$app->user->identity->employee_id))
                    ? ['/user/view', 'id' => Yii::$app->user->identity->id]
                    : ['/hrm/employees/user-view', 'id' => Yii::$app->user->identity->employee_id];
                ?>
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $nameToDisplay ?></span>
                    <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= Url::to($profileUrl) ?>">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        <?= Yii::t('app', 'Profile') ?>
                    </a>
                    <a class="dropdown-item" href="<?= Url::to(['/user-manage/change-password']) ?>">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        <?= Yii::t('app', 'Change Password') ?>
                    </a>

                    <div class="dropdown-divider"></div>
                    <?= Html::a(
                        '<i class="fa-solid fa-right-from-bracket fa-sm fa-fw mr-2 text-gray-400"></i> ' . Yii::t('app', 'Logout'),
                        ['/site/logout'],
                        ['data-method' => 'post', 'class' => 'dropdown-item']
                    ) ?>
                </div>
            <?php else: ?>

                <?= Html::a(Yii::t('app', 'Login'), ['/site/login'], ['class' => 'nav-link']) ?>
            <?php endif; ?>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->