<?php
namespace app\modules\stock\controllers;;

use Yii;
use app\modules\stock\models\Equipment;
use yii\web\Controller;

class EquipmentController extends Controller
{
    public function actionIndex()
    {
        $equipments = Equipment::find()->all();
        $lowStockItems = Equipment::find()->where(['<=', 'stock', 'low_stock_level'])->all();
        
        if ($lowStockItems) {
            $message = 'แจ้งเตือน: อุปกรณ์ต่อไปนี้มีสต็อกต่ำ - ';
            $message .= implode(', ', array_map(function($item) { return $item->name; }, $lowStockItems));
            Yii::$app->session->setFlash('warning', $message);
        }

        return $this->render('index', [
            'equipments' => $equipments,
        ]);
    }
    
    public function actionCreate()
    {
        $model = new Equipment();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'เพิ่มอุปกรณ์สำเร็จ');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'เกิดข้อผิดพลาดในการเพิ่มอุปกรณ์');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Equipment::findOne($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }
}