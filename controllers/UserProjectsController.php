<?php

namespace app\controllers;

use app\models\Notifications;
use app\models\Project;
use app\models\Users;
use Codeception\Lib\Notification;
use Yii;
use app\models\UserProjects;
use app\models\UserProjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserProjectsController implements the CRUD actions for UserProjects model.
 */
class UserProjectsController extends Controller
{
    /**
     * Creates a new UserProjects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionBecomePart($pn)
    {
        $number = base64_decode($pn);
        $project = Project::find()->where(['id' => $number])->one();
        $model = new UserProjects();
        $user = Users::find()->where(['id' => Yii::$app->user->id])->one();
        if ($model->load(Yii::$app->request->post())) {
            $model->project_id = $number;
            $model->user_id = $user->id;
            if ($model->save()) {
                foreach ($project->userProjects as $userProject) {
                    if ($userProject->role != $model->role) {
                        $notification = new Notifications();
                        $notification->message_from_id = $model->user_id;
                        $notification->message_to_id = $userProject->user_id;
                        $notification->project_id = $model->id;
                        $notification->notification = $model->user->name . " requested to participate in " . $project->name_of_production . " as " . $model->role;
                        $notification->save();
                    }
                }
                return $this->redirect(['project/view', 'pn' => $pn]);
            }
        }
        return $this->render('create', [
            'user' => Users::findOne(['id' => Yii::$app->user->id]),
            'model' => $model,
            'project' => $project,
        ]);
    }

    /**
     * Creates a new UserProjects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddCrew($pn)
    {
        $number = base64_decode($pn);
        $project = Project::find()->where(['id' => $number])->one();
        $model = new UserProjects();
        $user = Users::find()->where(['id' => Yii::$app->user->id])->one();
        if ($model->load(Yii::$app->request->post())) {
            $model->project_id = $number;
            if ($model->user_id == $user->id) {
                $model->user_id = $user->id;
            }
            if ($model->save()) {
                foreach ($project->userProjects as $userProject) {
                    if ($userProject->role != $model->role) {
                        $notification = new Notifications();
                        $notification->message_from_id = $model->user_id;
                        $notification->message_to_id = $userProject->user_id;
                        $notification->project_id = $model->id;
                        $notification->notification = $model->user->name . " requested to participate in " . $project->name_of_production . " as " . $model->role;
                        $notification->save();
                    }
                }
                return $this->redirect(['project/view', 'pn' => $pn]);
            }
        }
        return $this->render('crew', [
            'user' => Users::findOne(['id' => Yii::$app->user->id]),
            'model' => $model,
            'project' => $project,
        ]);
    }

    /**
     * Deletes an existing UserProjects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionRemovePart($pn)
    {
        $number = base64_decode($pn);
        $user_parts = UserProjects::find()->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['project_id' => $number])->all();
        foreach ($user_parts as $model) {
            $notifications = Notifications::find()->where(['message_from_id' => Yii::$app->user->id])
                ->andWhere(['project_id' => $model->id])->all();
            if (!empty($notification)) {
                foreach ($notifications as $notification){
                    $notification->delete();
                }
            }
            $model->delete();
        }
        return $this->redirect(['project/view', 'pn' => $pn]);
    }

    /**
     * Finds the UserProjects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserProjects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserProjects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
