<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_projects".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $project_id
 * @property string $role
 * @property string $character_name
 * @property integer $is_approved
 *
 * @property Project $project
 * @property Users $user
 */
class UserProjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'role'], 'required'],
            [['user_id', 'project_id', 'is_approved'], 'integer'],
            [['role'], 'string', 'max' => 255],
            [['character_name'], 'string', 'max' => 30],
            [['user_id', 'project_id', 'role'], 'unique', 'targetAttribute' => ['user_id', 'project_id', 'role'], 'message' => 'The Role has already been taken.'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'project_id' => 'Project',
            'role' => 'Your Role',
            'character_name' => 'Character Name',
            'is_approved' => 'Is Approved',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
