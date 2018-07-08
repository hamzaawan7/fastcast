<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "role_applications".
 *
 * @property integer $id
 * @property integer $request_from_id
 * @property integer $request_to_id
 * @property integer $project_id
 * @property string $available_role
 * @property string $message
 *
 * @property Users $requestFrom
 * @property Project $project
 * @property Users $requestTo
 */
class RoleApplications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role_applications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_from_id', 'request_to_id', 'project_id', 'available_role'], 'required'],
            [['request_from_id', 'request_to_id', 'project_id'], 'integer'],
            [['message'], 'string'],
            [['available_role'], 'string', 'max' => 50],
            [['request_from_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['request_from_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['request_to_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['request_to_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_from_id' => 'Request From ID',
            'request_to_id' => 'Request To ID',
            'project_id' => 'Project ID',
            'available_role' => 'Available Role',
            'message' => 'Message',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestFrom()
    {
        return $this->hasOne(Users::className(), ['id' => 'request_from_id']);
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
    public function getRequestTo()
    {
        return $this->hasOne(Users::className(), ['id' => 'request_to_id']);
    }
}
