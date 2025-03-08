<?php

namespace app\modules\ticket\controllers;

use app\components\HandleUploads;
use app\modules\ticket\models\ticket;
use app\modules\ticket\models\Autonumber;
use app\modules\ticket\models\search\TicketSearch;
use app\modules\ticket\models\TicketList;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use app\models\Uploads;
use Exception;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new TicketSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexD()
    {
        $searchModel = new TicketSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // Create
    public function actionCreate()
    {
        $model = new Ticket();

        $model->status_id = 1;
        $model->ticket_date = date("Y-m-d");

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->ticket_code = Autonumber::generate('TK-' . (date('y') + 43) . date('m') . '-????'); // Auto Number
                // $model->thainame =  $model->users->thai_name;
                $model->getUploads();

                if ($model->save()) {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Success'));
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed');
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

 

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        list($initialPreview, $initialPreviewConfig) = HandleUploads::getInitialPreview($model->ticket_code, Ticket::UPLOAD_FOLDER);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $model->getUploads();

            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig
        ]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
 
    protected function findModel($id)
    {
        if (($model = Ticket::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    public function removeUploadDir($ref)
    {
        $basePath = HandleUploads::getUploadPath(Ticket::UPLOAD_FOLDER);
        $uploadDir = $basePath . $ref;
        if (is_dir($uploadDir)) {
            $files = array_diff(scandir($uploadDir), array('.', '..'));
            foreach ($files as $file) {
                (is_dir("$uploadDir/$file")) ? $this->removeUploadDir("$ref/$file") : unlink("$uploadDir/$file");
            }
            return rmdir($uploadDir);
        }

        return false;
    }


    //  ดาวน์โหลดไฟล์
    public function actionDownload($id)
    {
        $file = Uploads::findOne($id);

        if ($file !== null) {
            $filePath = HandleUploads::getUploadPath(Ticket::UPLOAD_FOLDER) . $file->ref . '/' . $file->real_filename;

            if (file_exists($filePath)) {
                return Yii::$app->response->sendFile($filePath, $file->file_name);
            } else {
                Yii::$app->session->setFlash('error', 'ไม่พบไฟล์ที่ต้องการดาวน์โหลด');
            }
        } else {
            Yii::$app->session->setFlash('error', 'ไม่พบข้อมูลไฟล์');
        }

        return $this->redirect(['view', 'id' => $file->ref]);
    }

    //  ลบไฟล์จากปุ่มในฟอร์ม
    public function actionDeletefile()
    {
        $model = Uploads::findOne(Yii::$app->request->post('key'));
        if ($model !== NULL) {
            $filename  = HandleUploads::getUploadPath(Ticket::UPLOAD_FOLDER) . $model->ref . '/' . $model->real_filename;
            $thumbnail = HandleUploads::getUploadPath(Ticket::UPLOAD_FOLDER) . $model->ref . '/thumb/' . $model->real_filename;
            if ($model->delete()) {
                @unlink($filename);
                @unlink($thumbnail);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        } else {
            echo json_encode(['success' => false]);
        }
    }




    public function actionAddItems()
    {
        $model = new Ticket();
        $modelsList = [new TicketList()];

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $model->ticket_code = AutoNumber::generate('TK-' . (date('y') + 43) . date('m') . '-????'); // Auto Number

                $modelsList = Model::createMultiple(TicketList::class);
                Model::loadMultiple($modelsList, Yii::$app->request->post());

                // ajax validation
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($modelsList),
                        ActiveForm::validate($model)
                    );
                }
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelsList) && $valid;


                if ($model->save()) {
                    if ($valid) {
                        $transaction = \Yii::$app->db->beginTransaction();
                        try {
                            if ($flag = $model->save(false)) {
                                foreach ($modelsList as $i => $modelList) {
                                    $modelList->ticket_code = $model->ticket_code;
                                    if (!($flag = $modelList->save(false))) {
                                        $transaction->rollBack();
                                        break;
                                    }
                                }
                            }
                            if ($flag) {
                                $transaction->commit();
                                return $this->redirect(['view', 'id' => $model->id]);
                            }
                        } catch (Exception $e) {
                            $transaction->rollBack();
                        }
                    }
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Success'));
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('_form_details.php', [
            'model' => $model,
            'modelsList' => (empty($modelsList)) ? [new TicketList] : $modelsList
        ]);
    }
}
