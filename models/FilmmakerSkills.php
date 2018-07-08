<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "filmmaker_skills".
 *
 * @property integer $id
 * @property integer $filmmaker_id
 * @property string $skill
 *
 * @property Users $filmmaker
 */
class FilmmakerSkills extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filmmaker_skills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filmmaker_id', 'skill'], 'required'],
            [['filmmaker_id'], 'integer'],
            [['skill'], 'string', 'max' => 20],
            [['filmmaker_id', 'skill'], 'unique', 'targetAttribute' => ['filmmaker_id', 'skill'], 'message' => 'The Skill has already been taken.'],
            [['filmmaker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['filmmaker_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filmmaker_id' => 'Filmmaker ID',
            'skill' => 'Skill',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilmmaker()
    {
        return $this->hasOne(Users::className(), ['id' => 'filmmaker_id']);
    }
}
