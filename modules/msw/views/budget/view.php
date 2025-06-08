<?php

use yii\bootstrap5\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\msw\models\Budget $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Budgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="budget-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php //if ($model->status === 'pending' && Yii::$app->user->can('approveBudget')): ?>
        <?php if ($model->status === 'pending'): ?>
            <?= \yii\helpers\Html::a('อนุมัติ', ['approve', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => ['confirm' => 'คุณแน่ใจหรือไม่ว่าต้องการอนุมัติ?', 'method' => 'post']
            ]) ?>
            <?= \yii\helpers\Html::a('ปฏิเสธ', ['reject', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => ['confirm' => 'ยืนยันการปฏิเสธ?', 'method' => 'post']
            ]) ?>

    </p>

<?php endif; ?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        // 'id',
        'fiscal_year',
        'project_name',
        'description:ntext',
        'total_amount',
        'created_by',
        'created_at',
        'updated_at',
        'status',
    ],
]) ?>

<hr>


<?= Tabs::widget([
    'items' => [
        [
            'label' => 'รายการงบประมาณย่อย',
            'content' => $this->render('_budget_items_tab', [
                'budgetItemProvider' => $budgetItemProvider,
                'budgetItemModel' => $budgetItemModel,
                'budgetId' => $model->id,
            ]),
            'active' => true,
        ],
        // คุณสามารถเพิ่ม Tab อื่นได้ เช่น: 'เอกสารแนบ', 'การอนุมัติ'
    ],
]); ?>

</div>