<?php

use app\modules\itms\models\Profile;
use yii\helpers\Html;
use yii\widgets\ListView;


$this->title = Yii::t('app', 'Profiles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">
    <p>
        <?= Html::a('<i class="fa-solid fa-home"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary btn-sm btn-w100']) ?>
        <?= Html::a('<i class="fa-solid fa-triangle-exclamation"></i> ' . Yii::t('app', 'เพิ่มการแจ้งซ่อม'), ['create'], ['class' => 'btn btn-danger btn-sm btn-w100']) ?></p>
    <div class="card">
        <div class="card-header text-white bg-info">
            <?= $this->title  ?>
        </div>
        <div class="card-body">
            <div class="row">

                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'options' => ['class' => 'row'],
                    'itemOptions' => ['class' => 'col-lg-3 col-md-4 mb-3'],
                    'itemView' => '_list',
                ]) ?>

            </div>
        </div>
    </div>
</div>