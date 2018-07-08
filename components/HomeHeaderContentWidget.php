<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 12/23/2016
 * Time: 4:20 AM
 */

namespace app\components;

//use yii\base\Widget;
use yii\base\Widget;
use yii\helpers\Html;

class HomeHeaderContentWidget extends Widget
{
    public $model;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render("homeHeaderContent", [
            'model'=> !empty($this->model) ? $this->model : ''
        ]);
    }
}