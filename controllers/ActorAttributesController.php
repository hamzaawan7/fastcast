<?php

namespace app\controllers;

use Yii;
use app\models\ActorAttributes;
use app\models\ActorAttributesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActorAttributesController implements the CRUD actions for ActorAttributes model.
 */
class ActorAttributesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'create' => ['POST'],
                    'update' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ActorAttributes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActorAttributesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActorAttributes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ActorAttributes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActorAttributes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['users/profile']);
        }
    }

    /**
     * Updates an existing ActorAttributes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = ActorAttributes::findOne(['actor_id'=>Yii::$app->user->id]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['users/profile']);
        }
    }

    /**
     * Deletes an existing ActorAttributes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ActorAttributes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActorAttributes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActorAttributes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
