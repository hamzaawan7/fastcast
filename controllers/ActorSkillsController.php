<?php

namespace app\controllers;

use Yii;
use app\models\ActorSkills;
use app\models\ActorSkillsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActorSkillsController implements the CRUD actions for ActorSkills model.
 */
class ActorSkillsController extends Controller
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
                    'create' => ['POST'],
                    'update' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Creates a new ActorSkills model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->request->post()) {
            $actor_skills = @$_POST['ModelSkills'];
            $existing_actor_skills = @$_POST['UpdateModelSkills'];
            $old_size = sizeof($existing_actor_skills['skill']);
            if ($old_size > 0) {
                $old_skills = ActorSkills::find()->where(['actor_id' => Yii::$app->user->id])->all();
                $i = 0;
                foreach ($old_skills as $old_skill) {
                    $old_skill->actor_id = Yii::$app->user->id;
                    $old_skill->skill = $existing_actor_skills['skill'][$i];
                    $old_skill->experience = $existing_actor_skills['experience'][$i];
                    $old_skill->save();
                    $i++;
                }
            }
            $size = sizeof($actor_skills['skill']);
            if (!empty($actor_skills['skill']) && $size > 0) {
                for ($i = 0; $i < $size; $i++) {
                    $skill = new ActorSkills();
                    $skill->actor_id = Yii::$app->user->id;
                    $skill->skill = $actor_skills['skill'][$i];
                    $skill->experience = $actor_skills['experience'][$i];
                    $skill->save();
                }
            }
            return $this->redirect(['users/profile']);
        }
    }

    /**
     * Updates an existing ActorSkills model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = ActorSkills::findOne(['actor_id' => Yii::$app->user->id]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['users/profile']);
        }
    }

    /**
     * Deletes an existing ActorSkills model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($skill)
    {
        $id = base64_decode($skill);
        $model = ActorSkills::findOne(['id' => $id]);
        $model->delete();
        return $this->redirect(['users/profile']);
    }

    /**
     * Finds the ActorSkills model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActorSkills the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActorSkills::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
