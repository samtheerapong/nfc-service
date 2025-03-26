<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $summary array */
/* @var $chartData array */

$this->title = 'สรุปความต้องการสั่งซื้อ';
$this->params['breadcrumbs'][] = ['label' => 'การสั่งซื้อ', 'url' => ['/stock/purchase-order/index']];
$this->params['breadcrumbs'][] = $this->title;

// เพิ่ม Chart.js
$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js', ['position' => \yii\web\View::POS_HEAD]);
?>

<div class="purchase-order-summary">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <!-- กราฟ -->
    <div class="chart-container" style="margin-bottom: 30px;">
        <canvas id="summaryChart" height="100"></canvas>
    </div>

    <?php if (empty($summary)): ?>
        <div class="alert alert-info">
            ไม่มีรายการที่ต้องสั่งซื้อในขณะนี้
        </div>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>อุปกรณ์</th>
                    <th>จำนวนที่ขอ</th>
                    <th>สต็อกปัจจุบัน</th>
                    <th>รอรับ</th>
                    <th>ระดับสต็อกต่ำ</th>
                    <th>ต้องสั่งเพิ่ม</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($summary as $item): ?>
                    <tr>
                        <td><?= Html::encode($item['equipment_name']) ?></td>
                        <td><?= Html::encode($item['total_requested']) ?></td>
                        <td><?= Html::encode($item['current_stock']) ?></td>
                        <td><?= Html::encode($item['pending_order']) ?></td>
                        <td><?= Html::encode($item['low_stock_level']) ?></td>
                        <td>
                            <span class="<?= $item['needed'] > 0 ? 'text-danger' : '' ?>">
                                <?= Html::encode($item['needed']) ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($item['needed'] > 0): ?>
                                <?= Html::a("สั่งซื้อ ({$item['needed']})", 
                                    ['create-from-summary', 
                                        'equipment_id' => $item['equipment_id'], 
                                        'quantity' => $item['needed']
                                    ], 
                                    [
                                        'class' => 'btn btn-sm btn-primary',
                                        'data' => [
                                            'confirm' => "ยืนยันการสร้างรายการสั่งซื้อ {$item['equipment_name']} จำนวน {$item['needed']}?",
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                            <?php else: ?>
                                <span class="text-success">เพียงพอ</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::a('กลับไปหน้ารายการสั่งซื้อ', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>
</div>

<?php
// สคริปต์สำหรับสร้างกราฟ
$chartDataJson = json_encode($chartData);
$this->registerJs("
    const ctx = document.getElementById('summaryChart').getContext('2d');
    const summaryChart = new Chart(ctx, {
        type: 'bar',
        data: $chartDataJson,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'จำนวน'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'อุปกรณ์'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'สรุปความต้องการสั่งซื้อ'
                }
            }
        }
    });
");

$this->registerCss('
    .purchase-order-summary {
        margin: 20px;
    }
    .chart-container {
        position: relative;
        margin: auto;
        width: 100%;
    }
    .table {
        margin-top: 20px;
    }
    .text-danger {
        font-weight: bold;
    }
    .text-success {
        font-style: italic;
    }
');
?>