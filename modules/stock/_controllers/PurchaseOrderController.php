<?php

namespace app\modules\stock\controllers;

use Yii;
use app\modules\stock\models\PurchaseOrder;
use app\modules\stock\models\Equipment;
use app\modules\stock\models\Requisition;
use app\modules\stock\models\RequisitionStatus;
use app\modules\stock\models\StockHistory;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class PurchaseOrderController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PurchaseOrder::find()->with('equipment'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSummary()
    {
        try {
            // ดึง ID ของสถานะ approved
            $approvedStatusId = RequisitionStatus::findOne(['code' => 'approved'])->id;

            $query = (new Query())
                ->select([
                    'e.id as equipment_id',
                    'e.name as equipment_name',
                    'SUM(r.quantity) as total_requested',
                    'e.stock as current_stock',
                    'e.low_stock_level',
                    'IFNULL(po.pending_quantity, 0) as pending_order',
                    'GREATEST(0, SUM(r.quantity) + e.low_stock_level - e.stock - IFNULL(po.pending_quantity, 0)) as needed'
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
                ->where(['r.status_id' => $approvedStatusId]) // เปลี่ยนจาก r.status เป็น r.status_id
                ->groupBy(['e.id', 'e.name', 'e.stock', 'e.low_stock_level', 'po.pending_quantity'])
                ->having('total_requested > 0');

            $allData = $query->all(Yii::$app->dbstock);

            // สร้าง DataProvider
            $dataProvider = new ArrayDataProvider([
                'allModels' => $allData,
                'pagination' => [
                    'pageSize' => 20, // จำกัด 20 รายการต่อหน้า
                ],
                'sort' => [
                    'attributes' => [
                        'equipment_name',
                        'total_requested',
                        'current_stock',
                        'pending_order',
                        'low_stock_level',
                        'needed',
                    ],
                ],
            ]);

            return $this->render('summary', [
                'dataProvider' => $dataProvider,
            ]);
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
            return $this->redirect(['index']);
        }
    }

    public function actionReport()
    {
        try {
            // ดึง ID ของสถานะ approved
            $approvedStatusId = RequisitionStatus::findOne(['id' => 2])->id;

            $query = (new Query())
                ->select([
                    'e.id as equipment_id',
                    'e.name as equipment_name',
                    'SUM(r.quantity) as total_requested',
                    'e.stock as current_stock',
                    'e.low_stock_level',
                    'IFNULL(po.pending_quantity, 0) as pending_order',
                    'GREATEST(0, SUM(r.quantity) + e.low_stock_level - e.stock - IFNULL(po.pending_quantity, 0)) as needed'
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
                ->where(['r.status_id' => $approvedStatusId]) // เปลี่ยนจาก r.status เป็น r.status_id
                ->groupBy(['e.id', 'e.name', 'e.stock', 'e.low_stock_level', 'po.pending_quantity'])
                ->having('total_requested > 0');

            $allData = $query->all(Yii::$app->dbstock);

            // สร้าง DataProvider
            $dataProvider = new ArrayDataProvider([
                'allModels' => $allData,
                'pagination' => [
                    'pageSize' => 20,
                ],
                'sort' => [
                    'attributes' => [
                        'equipment_name',
                        'total_requested',
                        'current_stock',
                        'pending_order',
                        'low_stock_level',
                        'needed',
                    ],
                ],
            ]);

            // เตรียมข้อมูลสำหรับกราฟ
            $chartData = [
                'labels' => array_column($allData, 'equipment_name'),
                'datasets' => [
                    [
                        'label' => 'จำนวนที่ขอ',
                        'data' => array_column($allData, 'total_requested'),
                        'backgroundColor' => 'rgba(255, 99, 132, 0.5)',
                        'borderColor' => 'rgba(255, 99, 132, 1)',
                        'borderWidth' => 1,
                    ],
                    [
                        'label' => 'สต็อกปัจจุบัน',
                        'data' => array_column($allData, 'current_stock'),
                        'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                        'borderColor' => 'rgba(54, 162, 235, 1)',
                        'borderWidth' => 1,
                    ],
                    [
                        'label' => 'ต้องสั่งเพิ่ม',
                        'data' => array_column($allData, 'needed'),
                        'backgroundColor' => 'rgba(255, 206, 86, 0.5)',
                        'borderColor' => 'rgba(255, 206, 86, 1)',
                        'borderWidth' => 1,
                    ],
                    [
                        'label' => 'รอรับ',
                        'data' => array_column($allData, 'pending_order'),
                        'backgroundColor' => 'rgba(75, 192, 192, 0.5)',
                        'borderColor' => 'rgba(75, 192, 192, 1)',
                        'borderWidth' => 1,
                    ],
                ],
            ];

            return $this->render('report', [
                'dataProvider' => $dataProvider,
                'chartData' => $chartData,
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

    public function actionManageStock()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Equipment::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => ['name' => SORT_ASC],
            ],
        ]);

        return $this->render('manage-stock', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdateStock($id)
    {
        $model = Equipment::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('ไม่พบอุปกรณ์ที่ระบุ');
        }

        // เก็บค่าเก่าไว้ก่อน
        $oldStock = $model->stock;

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->dbstock->beginTransaction();
            try {
                $newStock = $model->stock;
                $quantityChange = $newStock - $oldStock;

                // บันทึกการเปลี่ยนแปลงใน Equipment
                if ($model->save()) {
                    // บันทึกประวัติถ้ามีการเปลี่ยนแปลง
                    if ($quantityChange != 0) {
                        $history = new StockHistory();
                        $history->equipment_id = $model->id;
                        $history->quantity_change = $quantityChange;
                        $history->reason = Yii::$app->request->post('reason', 'ปรับปรุงสต็อกโดย admin');
                        $history->updated_by = Yii::$app->user->identity->username ?? 'Admin';

                        if (!$history->save()) {
                            throw new \Exception('ไม่สามารถบันทึกประวัติการเปลี่ยนแปลงได้: ' . implode(', ', $history->getFirstErrors()));
                        }
                    }

                    $transaction->commit();
                    Yii::$app->session->setFlash('success', "ปรับปรุงสต็อก '{$model->name}' จาก $oldStock เป็น $newStock เรียบร้อย");
                    return $this->redirect(['manage-stock']);
                } else {
                    throw new \Exception('ไม่สามารถบันทึกการเปลี่ยนแปลงสต็อกได้: ' . implode(', ', $model->getFirstErrors()));
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
            }
        }

        return $this->render('update-stock', [
            'model' => $model,
        ]);
    }

    public function actionStockHistory($equipment_id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => StockHistory::find()->where(['equipment_id' => $equipment_id]),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => ['updated_at' => SORT_DESC],
            ],
        ]);

        $equipment = Equipment::findOne($equipment_id);
        if (!$equipment) {
            throw new NotFoundHttpException('ไม่พบอุปกรณ์ที่ระบุ');
        }

        return $this->render('stock-history', [
            'dataProvider' => $dataProvider,
            'equipment' => $equipment,
        ]);
    }
}
