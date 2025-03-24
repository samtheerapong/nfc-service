<?php

namespace app\modules\stock\controllers;

use Yii;
use app\modules\stock\models\PurchaseOrder;
use app\modules\stock\models\Equipment;
use app\modules\stock\models\Requisition;
use yii\web\Controller;
use yii\db\Query;

class PurchaseOrderController extends Controller
{
    public function actionIndex()
    {
        $purchaseOrders = PurchaseOrder::find()->with('equipment')->all();
        return $this->render('index', [
            'purchaseOrders' => $purchaseOrders,
        ]);
    }

    public function actionSummary()
    {
        try {
            $query = (new Query())
                ->select([
                    'e.id as equipment_id',
                    'e.name as equipment_name',
                    'SUM(r.quantity) as total_requested',
                    'e.stock as current_stock',
                    'e.low_stock_level',
                    'IFNULL(po.pending_quantity, 0) as pending_order'
                ])
                ->from('requisition r')
                ->leftJoin('equipment e', 'e.id = r.equipment_id')
                ->leftJoin(
                    ['po' => '(SELECT equipment_id, SUM(quantity) as pending_quantity 
                                   FROM purchase_order 
                                   WHERE status IN ("pending", "ordered") 
                                   GROUP BY equipment_id)'],
                    'po.equipment_id = e.id'
                )
                ->where(['r.status' => 'approved'])
                ->groupBy(['e.id', 'e.name', 'e.stock', 'e.low_stock_level', 'po.pending_quantity'])
                ->having('total_requested > 0');

            $summary = $query->all(Yii::$app->dbstock);

            foreach ($summary as &$item) {
                $item['needed'] = max(
                    0,
                    $item['total_requested'] + $item['low_stock_level'] - $item['current_stock'] - $item['pending_order']
                );
            }
            unset($item);

            return $this->render('summary', [
                'summary' => $summary,
            ]);
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
            return $this->redirect(['index']);
        }
    }

    public function actionCreateFromSummary($equipment_id, $quantity)
    {
        $model = new PurchaseOrder();
        $model->equipment_id = $equipment_id;
        $model->quantity = $quantity;
        $model->status = 'pending';

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'สร้างรายการสั่งซื้อเรียบร้อย');
        } else {
            Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาดในการสร้าง');
        }

        return $this->redirect(['summary']);
    }

    public function actionMarkOrdered($id)
    {
        $model = PurchaseOrder::findOne($id);
        if ($model && $model->status == 'pending') {
            $model->status = 'ordered';
            $model->ordered_at = date('Y-m-d H:i:s');
            $model->save();
            Yii::$app->session->setFlash('success', 'เปลี่ยนสถานะเป็นสั่งซื้อแล้ว');
        }
        return $this->redirect(['index']);
    }

    public function actionMarkReceived($id)
    {
        $model = PurchaseOrder::findOne($id);
        if ($model && $model->status == 'ordered') {
            $model->status = 'received';
            $model->received_at = date('Y-m-d H:i:s');

            // เพิ่มสต็อกเมื่อรับของ
            $equipment = Equipment::findOne($model->equipment_id);
            $equipment->stock += $model->quantity;
            $equipment->save();

            $model->save();
            Yii::$app->session->setFlash('success', 'รับสินค้าเรียบร้อย สต็อกถูกอัพเดท');
        }
        return $this->redirect(['index']);
    }
}
