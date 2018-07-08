<?php

namespace app\controllers;

use app\models\FilmmakerSkills;
use Yii;
use yii\web\Controller;

class FilmmakerSkillsController extends Controller
{
    public function actionAddSkill()
    {
        $model = new FilmmakerSkills();
        if ($model->load(Yii::$app->request->post())) {
            $model->filmmaker_id = Yii::$app->user->id;
            $model->save();
        }
        return $this->redirect(['users/profile']);
    }


    public function actionDelete()
    {
        $skill = $_POST['skillid'];
        $id = base64_decode($skill);
        FilmmakerSkills::deleteAll(['id' => $id]);
        return $this->redirect(['users/profile']);
    }
}
