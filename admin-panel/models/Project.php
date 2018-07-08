<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property string $year
 * @property string $name_of_production
 * @property string $type
 * @property string $summary
 * @property string $company
 * @property string $venue
 * @property string $video_url
 * @property string $image
 * @property string $status
 * @property integer $is_featured
 *
 * @property UserProjects[] $userProjects
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_of_production', 'type', 'summary', 'image', 'status'], 'required'],
            [['summary'], 'string'],
            [['is_featured'], 'integer'],
            [['year'], 'string', 'max' => 4],
            [['name_of_production', 'type', 'company', 'venue', 'image'], 'string', 'max' => 255],
            [['video_url'], 'string', 'max' => 2083],
            [['status'], 'string', 'max' => 20],
            [['year', 'name_of_production', 'type'], 'unique', 'targetAttribute' => ['year', 'name_of_production', 'type'], 'message' => 'The combination of Year, Name Of Production and Type has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'Year',
            'name_of_production' => 'Name Of Production',
            'type' => 'Type',
            'summary' => 'Summary',
            'company' => 'Company',
            'venue' => 'Venue',
            'video_url' => 'Video Url',
            'image' => 'Image',
            'status' => 'Status',
            'is_featured' => 'Is Featured',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProjects()
    {
        return $this->hasMany(UserProjects::className(), ['project_id' => 'id']);
    }
}
