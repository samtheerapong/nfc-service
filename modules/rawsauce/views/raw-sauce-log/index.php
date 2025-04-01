<?php

use app\modules\rawsauce\models\RawSauceLog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\modules\rawsauce\models\search\RawSauceLogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Raw Sauce Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raw-sauce-log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Raw Sauce Log'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?php foreach ($dataProvider->models as $model): ?>
        <div class="col-lg-3 col-md-4 mb-3">
            <?php $color = $model->status->color ?? '#ccc'; ?>
            <div class="card shadow-sm border-left-<?= $color ?>" style="border-left: 5px solid <?= $color ?>; height: 100%;">
                <div class="card-body" style="background-color: <?= $color ?>20;">
                    <div class="card-footer text-center">
                        <ul class="list-unstyled text-left">
                            <?php
                            $items = array_filter([
                                $model->tank_id ? '<i class="fa-solid fa-o"></i> <strong>หมายเลขถัง:</strong> ' . $model->tank_id : '',
                                $model->batch ? '<i class="fa-solid fa-o"></i> <strong>แบทซ์:</strong> ' . $model->batch : '',
                                $model->current_value ? '<i class="fa-solid fa-o"></i> <strong>ปริมาตร:</strong> ' . $model->current_value : '',
                                $model->sauce_type_id ? '<i class="fa-solid fa-o"></i> <strong>ประเภทน้ำ:</strong> ' . $model->sauce_type_id : '',
                                $model->incoming_value ? '<i class="fa-solid fa-o"></i> <strong>ปริมาตรขาเข้า:</strong> ' . $model->incoming_value : '',
                                $model->outgoing_value ? '<i class="fa-solid fa-o"></i> <strong>ปริมาตรขาออก:</strong> ' . $model->outgoing_value : '',
                                $model->incoming_date ? '<i class="fa-solid fa-o"></i> <strong>วันที่ขาเข้า:</strong> ' . Yii::$app->thaiFormatter->asDate($model->incoming_date, 'long') : '',
                                $model->outgoing_date ? '<i class="fa-solid fa-o"></i> <strong>วันที่ขาออก:</strong> ' . Yii::$app->thaiFormatter->asDate($model->outgoing_date, 'long') : '',
                                $model->record_by ? '<i class="fa-solid fa-o"></i> <strong>ผู้บันทึก:</strong> ' . $model->record_by : '',
                                $model->updated_date ? '<i class="fa-solid fa-o"></i> <strong>วันที่บันทึกล่าสุด:</strong> ' . Yii::$app->thaiFormatter->asDate($model->updated_date, 'long') : '',
                                $model->ref_code ? '<i class="fa-solid fa-o"></i> รหัส: ' . $model->ref_code . '</i>' : '',
                                $model->remask ? '<div class="text-danger"><i> หมายเหตุ: ' . $model->remask . '</i></div>' : ''
                            ]);
                            echo implode("\n", array_map(fn($item) => "<li>$item</li>", $items));
                            ?>
                        </ul>

                        <div class="btn-group btn-group-sm">
                            <?= Html::a('<i class="fas fa-list"></i>', ['view', 'id' => $model->id], ['class' => 'btn btn-secondary',  'title' => 'รายละเอียด',]) ?>
                           
                            </p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    <?php endforeach; ?>


</div>