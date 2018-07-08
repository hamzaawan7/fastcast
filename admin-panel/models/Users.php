<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $type
 * @property string $profile_picture
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $gender
 * @property string $location
 * @property string $demo_reel
 * @property string $contact_number
 * @property string $website_link
 * @property string $about_me
 * @property string $resume
 * @property string $auth_key
 * @property integer $is_verified
 * @property integer $is_featured
 *
 * @property ActorAttributes[] $actorAttributes
 * @property ActorSkills[] $actorSkills
 * @property FilmmakerSkills[] $filmmakerSkills
 * @property Notifications[] $notifications
 * @property Notifications[] $notifications0
 * @property UserProjects[] $userProjects
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'name', 'email', 'password', 'gender'], 'required'],
            [['about_me'], 'string'],
            [['is_verified', 'is_featured'], 'integer'],
            [['type', 'gender'], 'string', 'max' => 10],
            [['profile_picture', 'website_link', 'resume', 'auth_key'], 'string', 'max' => 255],
            [['name', 'email', 'password'], 'string', 'max' => 50],
            [['location', 'demo_reel'], 'string', 'max' => 2083],
            [['contact_number'], 'string', 'max' => 20],
            [['email'], 'unique'],
            [['auth_key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'profile_picture' => 'Profile Picture',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'gender' => 'Gender',
            'location' => 'Location',
            'demo_reel' => 'Demo Reel',
            'contact_number' => 'Contact Number',
            'website_link' => 'Website Link',
            'about_me' => 'About Me',
            'resume' => 'Resume',
            'auth_key' => 'Auth Key',
            'is_verified' => 'Is Verified',
            'is_featured' => 'Is Featured',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActorAttributes()
    {
        return $this->hasMany(ActorAttributes::className(), ['actor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActorSkills()
    {
        return $this->hasMany(ActorSkills::className(), ['actor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilmmakerSkills()
    {
        return $this->hasMany(FilmmakerSkills::className(), ['filmmaker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notifications::className(), ['message_from_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications0()
    {
        return $this->hasMany(Notifications::className(), ['message_to_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProjects()
    {
        return $this->hasMany(UserProjects::className(), ['user_id' => 'id']);
    }
}
