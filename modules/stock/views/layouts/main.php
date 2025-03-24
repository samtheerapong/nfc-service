<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use hail812\adminlte3\assets\{FontAwesomeAsset, AdminLteAsset, PluginAsset};

defined('YII_DEBUG') or define('YII_DEBUG', true);

defined('YII_ENV') or define('YII_ENV', 'dev');

AppAsset::register($this);
FontAwesomeAsset::register($this);
AdminLteAsset::register($this);
PluginAsset::register($this)->add('sweetalert2');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
$this->registerJsFile($publishedRes[1] . '/control_sidebar.js', ['depends' => AdminLteAsset::class]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Application For Northernfood complex">
    <meta name="author" content="Theerapong Khanta">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons-core.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]); ?>
<body class="hold-transition sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">
    <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
    <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>
    <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <?= $this->render('control-sidebar') ?>
    <?= $this->render('footer') ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
