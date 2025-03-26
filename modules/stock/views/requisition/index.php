<?php

use app\components\StaticHelper;
use yii\widgets\ListView;
?>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'pager' => StaticHelper::getGridPagerConfig(),
    'itemOptions'  => ['class' => "col-sm-4 col-md-3 col-lg-2 item-hover"],
    'layout' => '<div class="list-view d-flex flex-wrap">{items}</div><div class="text-center">{pager}</div>',
    'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('_list-view', [
            'model' => $model,
            'index' => $index,
        ]);
    },
]); ?>