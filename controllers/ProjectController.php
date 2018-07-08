<?php

namespace app\controllers;

use app\components\StringsHelper;
use app\models\ActiveProjectRoles;
use app\models\Notifications;
use app\models\RoleApplications;
use app\models\UserProjects;
use app\models\Users;
use Yii;
use app\models\Project;
use app\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'uploadPhoto' => [
                'class' => 'budyaga\cropper\actions\UploadAction',
                'url' => 'http://www.fastcast.ca/images/projects',
                /*'url' => 'http://localhost/fastcast/images/projects',*/
                'path' => '@app/images/projects',
                'maxSize' => '99999999',
                /*'url' => 'http://eatwithalfred.com/chef/images/chef',*/
                /*'path' => '/var/www/html/chef/images/chef',*/
            ]
        ];
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNew()
    {
        $model = new Project();
        $upmodel = new UserProjects();
        $user = Users::findOne(['id' => Yii::$app->user->id]);
        if ($model->load(Yii::$app->request->post())) {
            $model->posted_by_id = $user->id;
            if ($model->validate()) {
                if (!empty($model->video_url)) {
                    $model->video_url = StringsHelper::getYoutubeVimeoLink($model->video_url);
                }
                if (isset($model->image)) {
                    $img = $model->image;
                    $i = strripos($img, '/');
                    $model->image = substr($img, $i + 1);
                } else {
                    $model->image = "noImage.png";
                }
                $available_roles = @$_POST['ActiveProjects'];
                if ($model->save()) {
                    $size = sizeof($available_roles['available_role']);
                    if (!empty($available_roles['available_role']) && $size > 0) {
                        for ($i = 0; $i < $size; $i++) {
                            $role = new ActiveProjectRoles();
                            $role->project_id = $model->id;
                            $role->available_role = $available_roles['available_role'][$i];
                            $role->age_from = $available_roles['age_from'][$i];
                            $role->age_to = $available_roles['age_to'][$i];
                            $role->gender = $available_roles['gender'][$i];
                            $role->role_description = $available_roles['role_description'][$i];
                            $role->save();
                        }
                    }
                    if ($upmodel->load(Yii::$app->request->post())) {
                        $upmodel->project_id = $model->id;
                        $upmodel->user_id = $user->id;
                        $upmodel->is_approved = 1;
                        if ($upmodel->save()) {
                            return $this->redirect(['view', 'pn' => base64_encode($model->id)]);
                        }
                    }
                }
            }
        }
        return $this->render('create', ['user' => $user,
            'model' => $model,
            'upmodel' => $upmodel,]);
    }

    public function actionChange($pn)
    {
        $number = base64_decode($pn);
        $model = $this->findModel($number);
        $user = Users::findOne(['id' => Yii::$app->user->id]);
        $old = $model->image;
        $old_url = $model->video_url;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!empty($model->video_url) && $model->video_url != $old_url) {
                $model->video_url = StringsHelper::getYoutubeVimeoLink($model->video_url);
            }
            if ($model->image != $old && !empty($model)) {
                $img = $model->image;
                $i = strripos($img, '/');
                $model->image = substr($img, $i + 1);
                if (!is_null($old) && !empty($old)) {
                    if (unlink('images/projects/' . $old)) {

                    }
                }
            } else {
                $model->image = $old;
            }
            $available_roles = @$_POST['ActiveProjects'];
            $existing_available_roles = @$_POST['UpdatedActiveProjects'];
            if ($model->save()) {
                $old_size = sizeof($existing_available_roles['available_role']);
                if ($old_size > 0) {
                    $old_roles = ActiveProjectRoles::find()->where(['project_id' => $model->id])->all();
                    $i = 0;
                    foreach ($old_roles as $old_role) {
                        $old_role->project_id = $model->id;
                        $old_role->available_role = $existing_available_roles['available_role'][$i];
                        $old_role->age_from = $existing_available_roles['age_from'][$i];
                        $old_role->age_to = $existing_available_roles['age_to'][$i];
                        $old_role->gender = $existing_available_roles['gender'][$i];
                        $old_role->role_description = $existing_available_roles['role_description'][$i];
                        $old_role->save();
                        $i++;
                    }
                }

                $size = sizeof($available_roles['available_role']);
                if (!empty($available_roles['available_role']) && $size > 0) {
                    for ($i = 0; $i < $size; $i++) {
                        $role = new ActiveProjectRoles();
                        $role->project_id = $model->id;
                        $role->available_role = $available_roles['available_role'][$i];
                        $role->age_from = $available_roles['age_from'][$i];
                        $role->age_to = $available_roles['age_to'][$i];
                        $role->age_to = $available_roles['age_to'][$i];
                        $role->role_description = $available_roles['role_description'][$i];
                        $role->save();
                    }
                }
                return $this->redirect(['view', 'pn' => base64_encode($number)]);
            }
        }
        return $this->render('update', [
            'user' => $user,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($pn)
    {
        $model = $this->findModel(base64_decode($pn));
        $application_model = new RoleApplications();
        if ($application_model->load(Yii::$app->request->post()) && $application_model->validate()) {
            if ($application_model->save()) {
                return $this->redirect(['project/view', 'pn' => $pn]);
            }
        }
        return $this->render('view', [
            'model' => $model,
            'user' => Users::findOne(['id' => Yii::$app->user->id]),
            'application_model' => $application_model,
        ]);
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($pn)
    {
        $id = base64_decode($pn);
        $this->findModel($id)->delete();

        return $this->redirect(['site/index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
