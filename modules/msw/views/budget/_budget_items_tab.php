<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h3>รายการงบประมาณย่อย (Budget Items)</h3>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $budgetItemProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'category',
        'sub_category',
        'amount_allocated:currency',
        'note:ntext',
        // 'amount:currency',
        // 'description:ntext',
    ],
]); ?>

<hr>
<h4>เพิ่มรายการใหม่</h4>


<?php $form = ActiveForm::begin(['action' => ['add-item', 'budget_id' => $budgetId]]); ?>

<?= $form->field($budgetItemModel, 'category')->textInput(['maxlength' => true]) ?>
<?= $form->field($budgetItemModel, 'note')->textarea(['rows' => 2]) ?>
<?= $form->field($budgetItemModel, 'amount_allocated')->input('number', ['step' => '0.01']) ?>

<div class="form-group">
    <?= Html::submitButton('เพิ่ม', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>