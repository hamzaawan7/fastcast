<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actor_attributes".
 *
 * @property integer $id
 * @property integer $actor_id
 * @property string $age_range
 * @property string $build
 * @property string $height
 * @property string $weight
 * @property string $ethnicity
 * @property string $hair_color
 * @property string $eye_color
 *
 * @property Users $actor
 */
class ActorAttributes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actor_attributes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['actor_id', 'age_range', 'build', 'height', 'weight', 'ethnicity', 'hair_color', 'eye_color'], 'required'],
            [['actor_id'], 'integer'],
            [['age_range', 'ethnicity'], 'string', 'max' => 50],
            [['build', 'weight', 'hair_color', 'eye_color'], 'string', 'max' => 20],
            [['height'], 'string', 'max' => 10],
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
            'age_range' => 'Acting Age',
            'build' => 'Build',
            'height' => 'Height',
            'weight' => 'Weight',
            'ethnicity' => 'Ethnicity',
            'hair_color' => 'Hair Color',
            'eye_color' => 'Eye Color',
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
