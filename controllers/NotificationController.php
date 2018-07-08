<?php

namespace app\controllers;

use app\models\ActiveProjectRoles;
use app\models\Notifications;
use app\models\UserProjects;
use Yii;
use app\models\ActorAttributes;
use app\models\ActorAttributesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActorAttributesController implements the CRUD actions for ActorAttributes model.
 */
class NotificationController extends Controller
{
    public function actionApprove($n)
    {
        $id = base64_decode($n);
        $notification = $this->findById($id);
        $project = UserProjects::find()->where(['id' => $notification->project_id])->one();
        $project->is_approved = 1;
        if ($project->save()) {
            $notes = Notifications::find()->where(['message_from_id' => $notification->message_from_id])
                ->andWhere(['project_id' => $project->id])
                ->andWhere(['notification' => $notification->notification])
                ->all();
            foreach ($notes as $note) {
                $note->delete();
            }
            $available_role = ActiveProjectRoles::deleteAll(['project_id' => $project->project_id, 'available_role' => $project->role]);
        }
        return $this->redirect(['site/requests']);
    }

    public function actionReject($n)
    {
        $id = base64_decode($n);
        $notification = $this->findById($id);
        $project = UserProjects::find()->where(['id' => $notification->project_id])->one();
        $notes = Notifications::find()->where(['message_from_id' => $notification->message_from_id])
            ->andWhere(['project_id' => $project->id])
            ->andWhere(['notification' => $notification->notification])
            ->all();
        foreach ($notes as $note) {
            $note->delete();
        }
        $project->delete();

        return $this->redirect(['site/requests']);
    }

    protected function findById($id)
    {
        return Notifications::find()->where(['id' => $id])->one();
    }
}
