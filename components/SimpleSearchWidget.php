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

class SimpleSearchWidget extends Widget
{
    public $query;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render("simpleSearch", ['query' => $this->query]);
    }
}