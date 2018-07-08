<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property integer $id
 * @property integer $message_from_id
 * @property integer $message_to_id
 * @property integer $project_id
 * @property string $notification
 * @property string $created_at
 *
 * @property Users $messageFrom
 * @property Users $messageTo
 * @property UserProjects $project
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message_from_id', 'message_to_id', 'project_id', 'notification'], 'required'],
            [['message_from_id', 'message_to_id', 'project_id'], 'integer'],
            [['created_at'], 'safe'],
            [['notification'], 'string', 'max' => 255],
            [['message_from_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['message_from_id' => 'id']],
            [['message_to_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['message_to_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserProjects::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message_from_id' => 'Message From ID',
            'message_to_id' => 'Message To ID',
            'project_id' => 'Project ID',
            'notification' => 'Notification',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessageFrom()
    {
        return $this->hasOne(Users::className(), ['id' => 'message_from_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessageTo()
    {
        return $this->hasOne(Users::className(), ['id' => 'message_to_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(UserProjects::className(), ['id' => 'project_id']);
    }
}
