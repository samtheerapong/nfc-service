<?php

use yii\helpers\Html; ?>
<div class="card">
    <div class="img-thumbnail text-center"><?= Html::a($model->getAvatar(), ['view', 'id' => $model->id]) ?></div>
    <div class="card-body text-center">
        <strong>
            <div class="card-text"><?= Html::encode($model->thainame) ?></div>
        </strong>
        <div class="card-text"><?= Html::encode($model->roles ? $model->roles->name : 'ไม่ระบุ') ?></div>
        <div class="card-text"><?= $model->active === 'yes' ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' ?></div>
    </div>
</div>