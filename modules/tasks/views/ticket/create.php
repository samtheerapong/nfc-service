<?php

use yii\helpers\Html;
 
$this->title = Yii::t('app', 'เพิ่มการแจ้งซ่อม');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-create">
    <p><?= Html::a('<i class="fa-solid fa-home"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary btn-sm btn-w100']) ?></p>
    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview' => [],
        'initialPreviewConfig' => []
    ]) ?>

</div>