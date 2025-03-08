<?php

use app\components\HandleUploads;
use app\components\StaticHelper;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tasks-view">
    <div style="display: flex; justify-content: space-between;">
        <p>
            <?= Html::a('<i class="fas fa-home"></i> ' . Yii::t('app', 'Home'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fa-solid fa-wrench"></i> ' . Yii::t('app', 'Actions'), ['task-action', 'id' => $model->id], [
                'title' => Yii::t('app', 'Action'),
                'class' => 'btn btn-success',
                // 'style' => 'border-color: #666666;'
            ]) ?>
        </p>

        <p style="text-align: right;" class="btn-group btn-group-xs" role="group">


            <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $model->id], [
                'title' => Yii::t('app', 'Update'),
                'class' => 'btn btn-outline-warning',
                'style' => 'border-color: #666666;'
            ]) ?>

            <?= Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $model->id], [
                'title' => Yii::t('app', 'Delete'),
                'class' => 'btn btn-outline-danger',
                'style' => 'border-color: #666666',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>

    <div class="card">
        <div class="card-header text-white bg-secondary">
            <?= $this->title  ?>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-lg-8">
                    <?= DetailView::widget([
                        'model' => $model,
                        'template' => '<tr><th class="text-right" style="width: 1px; white-space: nowrap">{label} : </th><td> {value}</td></tr>',
                        'attributes' => [
                            // 'id',
                            [
                                'attribute' => 'status_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $color = $model->taskStatus->color;
                                    $name = $model->taskStatus->name;
                                    return '<span class="badge" style="background-color:' . $color . '">' . $name . '</span>';
                                },
                            ],
                            'ref_code',
                            'title',
                            [
                                'attribute' => 'description',
                                'format' => 'ntext',
                                'value' => function ($model) {
                                    $msg = $model->description ?: '';
                                    return $msg;
                                },
                            ],
                            [
                                'attribute' => 'task_date',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $msg = Yii::$app->thaiFormatter->asDate($model->task_date, 'long');
                                    return  $msg;
                                },
                            ],
                            [
                                'attribute' => 'type_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $color = $model->taskTypes->color;
                                    $name = $model->taskTypes->name;
                                    return '<span class="badge" style="background-color:' . $color . '">' . $name . '</span>';
                                },
                            ],
                            [
                                'attribute' => 'department_id',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $color = $model->taskDepartments->color;
                                    $name = $model->taskDepartments->name;
                                    return '<span class="badge" style="background-color:' . $color . '">' . $name . '</span>';
                                },
                            ],
                            'user_request',
                            [
                                'attribute' => 'remask',
                                'format' => 'html',
                                'value' => function ($model) {
                                    $msg = $model->remask ?: '';
                                    return $msg;
                                },
                            ],

                        ],
                    ]) ?>

                </div>
                <div class="col-md-4 img-thumbnail text-center">
                    <h3>image</h3>
                </div>

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header text-white bg-success">
            <?= Yii::t('app', 'Task Actions') ?>
        </div>
        <div class="card-body">
            <?php if ($taskAction): ?>
                <div class="row">
                    <div class="col-lg-8">
                        <?= DetailView::widget([
                            'model' => $taskAction,
                            'template' => '<tr><th class="text-right" style="width: 1px; white-space: nowrap">{label} : </th><td> {value}</td></tr>',
                            'attributes' => [
                                'action_code',
                                'start_date',
                                'end_date', 
                                [
                                    'attribute' => 'process_fixed',
                                    'format' => 'ntext',
                                    'value' => function ($model) {
                                        $msg = $model->process_fixed ?: '';
                                        return $msg;
                                    },
                                ],
                                [
                                    'attribute' => 'operator',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        $msg = $model->operator ?: '';
                                        return $msg;
                                    },
                                ],
                                [
                                    'attribute' => 'item',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        $msg = $model->item ?: '';
                                        return $msg;
                                    },
                                ],
                                [
                                    'attribute' => 'cost',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        $msg = $model->cost ? : 'ไม่มี';
                                        return $msg;
                                    },
                                ],
                                [
                                    'attribute' => 'comment',
                                    'format' => 'ntext',
                                    'value' => function ($model) {
                                        $msg = $model->comment ?: '';
                                        return $msg;
                                    },
                                ],
                            ],
                        ]) ?>
                    </div>
                    <div class="col-md-4 img-thumbnail text-center">
                        <h3>image</h3>
                    </div>
                </div>
            <?php else: ?>
                <p><?= Yii::t('app', 'No Task Actions available.') ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>