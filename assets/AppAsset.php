<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'https://fonts.googleapis.com/css?family=Lato:100,300,400',
        'css/font-awesome.min.css',
        'css/animate.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/custom.js',
        'js/retina.min.js',
        'js/respond.min.js',
        'js/sidenav.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public function init()
    {
        parent::init();
        if (Yii::$app->controller->action->id == "login") {
            $this->css [] = 'css/login.css';
        } else if (Yii::$app->controller->id == "site" && Yii::$app->controller->action->id == "signup") {
            $this->css [] = 'css/welcome.css';
        } else if (Yii::$app->controller->id == "users" && Yii::$app->controller->action->id == "register") {
            $this->css [] = 'css/login.css';
        } else if (Yii::$app->controller->id == "users") {
            $this->css [] = 'css/user_profile.css';
            $this->css [] = 'css/header-content.css';
            $this->css [] = 'css/custom.css';
        } else if (Yii::$app->controller->id == "project" && Yii::$app->controller->action->id == "view") {
            $this->css [] = 'css/header-content.css';
            $this->css [] = 'css/project-view.css';
            $this->css [] = 'css/custom.css';
        } else if (Yii::$app->controller->id == "user-projects") {
            $this->css [] = 'css/header-content.css';
            $this->css [] = 'css/home.css';
            $this->css [] = 'css/custom.css';
        } else if (Yii::$app->controller->action->id == "error") {
            $this->css [] = 'css/site.css';
        } else if (Yii::$app->controller->action->id == "index") {
            $this->css [] = 'css/welcome.css';
        } else {
            $this->css [] = 'css/home.css';
            $this->css [] = 'css/custom.css';
        }

    }
}
