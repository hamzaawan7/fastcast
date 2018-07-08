<?php

namespace app\controllers;

use app\models\Notifications;
use app\models\Project;
use app\models\RoleApplications;
use app\models\Users;
use Codeception\Lib\Notification;
use Yii;
use app\models\UserProjects;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserProjectsController implements the CRUD actions for UserProjects model.
 */
class RoleApplicationsController extends Controller
{
    /*public function actionApprove($role, $pn)
    {
        $number = base64_decode($role);
        $application = RoleApplications::findOne($number);
        $user_project = new UserProjects();
        $user_project->user_id = $application->request_from_id;
        $user_project->project_id = $application->project_id;
        $user_project->role = $application->available_role;
        $user_project->is_approved = 1;
        if($user_project->save()){
            $application->delete();
            return $this->redirect(['project/view', 'pn' => $pn]);
        }
    }*/

    public function actionReject($role, $pn)
    {
        $number = base64_decode($role);
        $application = RoleApplications::findOne($number);
        $application->delete();
        return $this->redirect(['project/view', 'pn' => $pn]);
    }
}
