<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
\hail812\adminlte3\assets\PluginAsset::register($this)->add('sweetalert2');

$isGuest = Yii::$app->user->isGuest;

// DynamicFormAsset::register($this);

// $bundle = \hail812\adminlte3\assets\PluginAsset::register($this);
// $bundle->css[] = 'sweetalert2-theme-bootstrap-4/bootstrap-4.min.css';
// $bundle->js[] = 'sweetalert2/sweetalert2.min.js';


// $this->registerCssFile('https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@500&family=Kanit&family=Sriracha&family=Sarabun:wght@500&display=swap');
$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
$this->registerJsFile($publishedRes[1] . '/control_sidebar.js', ['depends' => '\hail812\adminlte3\assets\AdminLteAsset']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Application For Northernfood complex">
    <meta name="author" content="Theerapong Khanta">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons-core.min.css" integrity="sha512-OmevVDECSDeo7M4G+Nvh0+VLVGS2XnEOkXWJcJ0TRom3GpGgc/ryQIgpRZw20mb5eR2U0sqsm33MaR8yD1zdsQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>

</head>

<?php \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]); ?>

<body class="hold-transition sidebar-mini">
    <?php $this->beginBody() ?>

    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>

        <!-- Content Wrapper. Contains page content -->
        <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <?= $this->render('control-sidebar') ?>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php echo $this->render('footer') ?>

    </div>

    <?php $this->endBody() ?>




</body>

</html>
<?php $this->endPage() ?>