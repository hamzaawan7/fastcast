<?php

namespace app\controllers;

use app\components\StringsHelper;
use Yii;
use app\models\Users;
use app\models\UsersSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'verify', 'unverify', 'feature', 'unfeature', 'delete', 'logout'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'verify', 'unverify', 'feature', 'unfeature', 'delete', 'logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (StringsHelper::getYoutubeVimeoLink($model->demo_reel)) {
                $model->demo_reel = StringsHelper::getYoutubeVimeoLink($model->demo_reel);
                $model->save(false);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single Users model.
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
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionVerify($id)
    {
        $model = $this->findModel($id);
        $model->is_verified = 1;
        $model->save();

        return $this->redirect(['index']);
    }

    public function actionUnverify($id)
    {
        $model = $this->findModel($id);
        $model->is_verified = 0;
        $model->save();

        return $this->redirect(['index']);
    }

    public function actionFeature($id)
    {
        $model = $this->findModel($id);
        $model->is_featured = 1;
        $model->save();

        return $this->redirect(['index']);
    }

    public function actionUnfeature($id)
    {
        $model = $this->findModel($id);
        $model->is_featured = 0;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
