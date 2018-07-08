<?php
/**
 * Created by PhpStorm.
 * User: umairawan
 * Date: 31/12/16
 * Time: 3:54 PM
 */
// ---

namespace app\components;

use app\models\Project;
use app\models\UserProjects;
use app\models\Users;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class DropDownHelper
{
    static public function getProjectRemainingRoles($id = 0)
    {
        $array = [
            'Director' => 'Director',
            'Co-Director' => 'Co-Director',
            'Producer' => 'Producer',
            'DOP' => 'DOP',
            'Sound' => 'Sound',
            'Make-up' => 'Make-up',
            'Gripping' => 'Gripping',
            'Location' => 'Location',
            'Actor' => 'Actor',
        ];

        return $array;
    }

    static public function getGenreTypes()
    {
        return [
            'Ads/Commercials' => 'Ads/Commercials',
            'Action' => 'Action',
            'Adventure' => 'Adventure',
            'Biography' => 'Biography',
            'Comedy' => 'Comedy',
            'Crime' => 'Crime',
            'Drama' => 'Drama',
            'Family' => 'Family',
            'Fantasy' => 'Fantasy',
            'Film-Noir' => 'Film-Noir',
            'History' => 'History',
            'Horror' => 'Horror',
            'Music' => 'Music',
            'Musical' => 'Musical',
            'Mystery' => 'Mystery',
            'Romance' => 'Romance',
            'Sci-Fi' => 'Sci-Fi',
            'Sports' => 'Sports',
            'Thriller' => 'Thriller',
            'War' => 'War',
            'Western' => 'Western',
        ];
    }

    static public function getProjectStatus($user)
    {
        if($user->type == "Filmmaker" && $user->email_verified){
            $array = [
                'Active' => 'Active',
                'Completed' => 'Completed',
            ];
        }else{
            $array = [
                'Completed' => 'Completed',
            ];
        }
        return $array;
    }

    static public function getUsers()
    {
        return ArrayHelper::map(Users::find()->all(), 'id', 'name');
    }
}