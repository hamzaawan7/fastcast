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
 * @property string $auth_key
 * @property string $is_verified
 * @property string $is_featured
 * @property string $is_union
 * @property string $email_verified
 * @property string $email_token
 *
 * @property ActorAttributes[] $actorAttributes
 * @property UserProjects[] $userProjects
 * @property ActorSkills[] $actorSkills
 * @property FilmmakerSkills[] $skills
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
            [['type', 'name', 'email', 'password', 'gender', 'is_union'], 'required'],
            [['resume'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
            [['about_me'], 'string'],
            [['type', 'gender'], 'string', 'max' => 10],
            [['resume', 'profile_picture', 'website_link', 'auth_key'], 'string', 'max' => 255],
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
            'auth_key' => 'Auth Key',
            'is_union' => 'Belong to a Union',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActorAttributes()
    {
        return $this->hasOne(ActorAttributes::className(), ['actor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProjects()
    {
        return $this->hasMany(UserProjects::className(), ['user_id' => 'id'])->andOnCondition('is_approved=1');
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
    public function getSentNoifications()
    {
        return $this->hasMany(ActorSkills::className(), ['message_from_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceivedNoifications()
    {
        return $this->hasMany(ActorSkills::className(), ['message_to_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilmmakerSkills()
    {
        return $this->hasMany(FilmmakerSkills::className(), ['filmmaker_id' => 'id'])->orderBy('id');
    }


    public static function findByUserName($email)
    {
        return self::findOne(['email' => $email]);
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    function getWebLink($url)
    {
        $parsed_url = parse_url($url);
        $host = isset($parsed_url['host']) ? $parsed_url['host'] : '';
        return "$host";
    }

    public function uploadResume($name)
    {
        $myBasePath = \Yii::$app->basePath;
        $path = $myBasePath . "/resume/";
        $url = $path . $name;
        return $this->resume->saveAs($url);
    }

    public function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
        return Users::findOne(['id' => $id]);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
        throw new NotSupportedException();
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
        return $this->authKey === $authKey;
    }
}
