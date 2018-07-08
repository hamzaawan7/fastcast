<?php
/**
 * Created by PhpStorm.
 * User: umairawan
 * Date: 31/12/16
 * Time: 3:54 PM
 */
// ---

namespace app\components;

use app\models\RoleApplications;
use app\models\UserProjects;
use Yii;
use yii\helpers\Url;

class StringsHelper
{
    static public function getYoutubeVimeoLink($videoLink)
    {
        $embed = '';
        if (strpos($videoLink, 'youtube') !== false) {
            if (preg_match('/https:\/\/(?:www.)?(youtube).com\/watch\\?v=(.*?)/', $videoLink)) {
                $embed = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "http://www.youtube.com/embed/$1", $videoLink);
            }
        } else if (strpos($videoLink, 'vimeo') !== false) {
            if (preg_match('/https:\/\/vimeo.com\/(\\d+)/', $videoLink, $regs)) {
                $embed = 'http://player.vimeo.com/video/' . $regs[1];
            }
        } else {
            return false;
        }
        return $embed;
    }

    static public function getProjectUserRole($project_id, $user_id = 0)
    {
        if ($user_id == 0) {
            $user_id = Yii::$app->user->id;
        }
        $model = UserProjects::find()->where(['user_id' => $user_id])
            ->andWhere(['project_id' => $project_id])
            ->andWhere(['is_approved' => 1])
            ->one();
        if (!empty($model)) {
            return $model->role;
        }
        $model = UserProjects::find()->where(['user_id' => $user_id])
            ->andWhere(['project_id' => $project_id])
            ->andWhere(['is_approved' => 0])
            ->one();
        if (!empty($model)) {
            return 2;
        }
        return false;
    }

    static public function getAppliedRole($project_id, $role, $user_id = 0)
    {
        if ($user_id == 0) {
            $user_id = Yii::$app->user->id;
        }
        $model = RoleApplications::find()->where(['request_from_id' => $user_id])
            ->andWhere(['project_id' => $project_id])
            ->andWhere(['available_role' => $role])
            ->one();
        if (!empty($model)) {
            return $model->id;
        }
        return false;
    }

    static public function getDirector($project)
    {
        $model = UserProjects::find()->where(['role' => "Director"])
            ->andWhere(['project_id' => $project->id])
            ->andWhere(['is_approved' => 1])
            ->one();
        if (!empty($model)) {
            return $model->user->name;
        }
        return false;
    }
}