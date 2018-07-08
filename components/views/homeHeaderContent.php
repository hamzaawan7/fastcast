<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="row headerTopbg">
    <!--- headerTop_leftSec starts here --->
    <div class="headerTop_leftSec clearfix pull-left col-lg-4 col-md-4 col-sm-3 col-xs-3">
        <a href="#"><i class="fa fa-twitter fa-2x"></i></a>
        <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
    </div>

    <!--- headerTop_rightSec starts here --->
    <div class="headerTop_rightSec pull-right col-lg-4 col-md-5 col-sm-6 col-xs-9">
        <?php if (!empty($model)) { ?>
            <a href="<?= Yii::$app->urlManager->createUrl(["site/index"]) ?>">
                <p class="bR0">Welcome ,</p>
            </a>
            <span>
            <b>
                <?php $i = strpos($model->name, " ");
                echo substr($model->name, 0, $i) ?>
            </b>
            </span>
            <a href="<?= Yii::$app->urlManager->createUrl(["users/profile"]) ?>">
            <span>
                My Clipboard
            </span>
            </a>
            <a href="<?= Yii::$app->urlManager->createUrl(["site/logout"]) ?>">
            <span style="border: none">
                Logout
            </span>
            </a>
        <?php } else { ?>
            <a href="<?= Yii::$app->urlManager->createUrl(["site/index"]) ?>">
                <p class="bR0">Welcome ,</p>
            </a>
            <span>
            <b>
                Guest
            </b>
            </span>
            <a href="<?= Yii::$app->urlManager->createUrl(["site/login"]) ?>">
                <span>Login</span>
            </a>
            <a href="<?= Yii::$app->urlManager->createUrl(["site/signup"]) ?>">
            <span style="border: none">Signup</span>
            </a>
        <?php } ?>
    </div>
</div>