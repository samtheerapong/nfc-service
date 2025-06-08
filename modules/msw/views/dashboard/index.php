<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>

<h1>ภาพรวมงบประมาณ</h1>

<div class="card bg-light p-3 mb-4">
    <h4>งบประมาณทั้งหมด: <?= number_format($totalBudget, 2) ?> บาท</h4>
</div>

<div class="row">
    <?php foreach ($fiscalYears as $year): ?>
        <div class="col-md-4">
            <div class="card border p-3 mb-3">
                <h5>ปี <?= $year['fiscal_year'] ?></h5>
                <p>รวมงบประมาณ: <strong><?= number_format($year['total'], 2) ?> บาท</strong></p>
                <?= Html::a('ดูรายละเอียด', ['budget/index', 'BudgetSearch[fiscal_year]' => $year['fiscal_year']], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
