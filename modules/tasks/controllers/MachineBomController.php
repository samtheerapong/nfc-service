<?php

namespace app\modules\tasks\controllers;

use app\modules\tasks\models\Machine;
use app\modules\tasks\models\MachineBom;
use app\modules\tasks\models\search\MachineBomSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MachineBomController implements the CRUD actions for MachineBom model.
 */
class MachineBomController extends Controller
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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all MachineBom models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MachineBomSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexBom($machineId)
    {
        $machine = Machine::findOne($machineId);
        $bomItems = MachineBom::find()
            ->with(['parentPart', 'childPart'])
            ->where(['machine_id' => $machineId])
            ->orderBy('level')
            ->all();

        return $this->render('index-bom', [
            'machine' => $machine,
            'bomItems' => $bomItems,
        ]);
    }

    public function getBomTree($machineId, $parentId = null)
    {
        $query = MachineBom::find()
            ->with(['childPart'])
            ->where(['machine_id' => $machineId]);
        
        if ($parentId === null) {
            $query->andWhere(['parent_part_id' => null]);
        } else {
            $query->andWhere(['parent_part_id' => $parentId]);
        }

        $items = $query->all();
        $tree = [];

        foreach ($items as $item) {
            $tree[] = [
                'item' => $item,
                'children' => $this->getBomTree($machineId, $item->child_part_id)
            ];
        }

        return $tree;
    }

    /**
     * Displays a single MachineBom model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MachineBom model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MachineBom();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MachineBom model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MachineBom model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MachineBom model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MachineBom the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MachineBom::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
