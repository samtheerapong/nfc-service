<?php
 
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="text-center">
    <h3>
        <?= Html::encode($name) ?>
    </h3>
    <h1>
        <p class="text-danger"><?= nl2br(Html::encode($message)) ?></p>
    </h1>
    <?= Html::img(Url::base(true) . '/web/img/error.png', [
        'class' => 'img-thumbnail',
        'style' => 'height: 200px; display: block; margin: 0 auto;'
    ]) ?>
    <br>
    <p><a class="btn btn-primary" href="javascript:history.back()" role="button"><?= Yii::t('app', 'Go Back') ?></a></p>
</div>
