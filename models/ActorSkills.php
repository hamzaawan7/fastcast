<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actor_skills".
 *
 * @property integer $id
 * @property integer $actor_id
 * @property string $skill
 * @property string $experience
 *
 * @property Users $actor
 */
class ActorSkills extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actor_skills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actor_id', 'skill', 'experience'], 'required'],
            [['actor_id'], 'integer'],
            [['skill', 'experience'], 'string', 'max' => 50],
            [['actor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['actor_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'actor_id' => 'Actor ID',
            'skill' => 'Skill',
            'experience' => 'Experience',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActor()
    {
        return $this->hasOne(Users::className(), ['id' => 'actor_id']);
    }
}
