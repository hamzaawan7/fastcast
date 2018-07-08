<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property integer $posted_by_id
 * @property string $year
 * @property string $name_of_production
 * @property string $type
 * @property string $summary
 * @property string $company
 * @property string $venue
 * @property string $production_date_from
 * @property string $production_date_to
 * @property string $video_url
 * @property string $image
 * @property string $status
 * @property string $is_featured
 * @property string $is_union
 * @property string $is_paid
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
            [['posted_by_id', 'is_union', 'name_of_production', 'image', 'type', 'summary', 'status'], 'required'],
            [['summary'], 'string'],
            [['production_date_from', 'production_date_to'], 'string'],
            [['year'], 'string', 'min' => 4, 'max' => 4],
            [['name_of_production', 'year', 'type'], 'unique', 'targetAttribute' => ['name_of_production', 'year', 'type'], 'message' => 'The Project already exists.'],
            [['name_of_production', 'type', 'company', 'venue', 'image'], 'string', 'max' => 255],
            [['video_url'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 20],
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
            'name_of_production' => 'Project Name',
            'type' => 'Genre',
            'summary' => 'Project Summary',
            'company' => 'Company',
            'venue' => 'Location',
            'video_url' => 'Video Url (Youtube or Vimeo Only)',
            'image' => 'Image',
            'status' => 'Status',
            'production_date_from' => 'Production Dates',
            'is_paid' => 'This is a paid job',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProjects()
    {
        return $this->hasMany(UserProjects::className(), ['project_id' => 'id'])->andOnCondition('is_approved=1')->orderBy('role asc');
    }

    public function getAvailableRoles()
    {
        return $this->hasMany(ActiveProjectRoles::className(), ['project_id' => 'id']);
    }

    public function getPostedby()
    {
        return $this->hasOne(Users::className(), ['id' => 'posted_by_id']);
    }
}
