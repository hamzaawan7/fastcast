<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "active_project_roles".
 *
 * @property integer $id
 * @property integer $project_id
 * @property string $available_role
 * @property integer $age_from
 * @property integer $age_to
 * @property string $gender
 * @property string $role_description
 *
 * @property Project $project
 */
class ActiveProjectRoles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'active_project_roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'available_role', 'age_from', 'age_to', 'role_description'], 'required'],
            [['project_id', 'age_from', 'age_to'], 'integer'],
            [['role_description'], 'string'],
            [['available_role'], 'string', 'max' => 20],
            [['gender'], 'string', 'max' => 10],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'available_role' => 'Available Role',
            'age_from' => 'Age From',
            'age_to' => 'Age To',
            'gender' => 'Gender',
            'role_description' => 'Role Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
