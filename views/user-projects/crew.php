<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 11/29/2016
 * Time: 5:44 PM
 */
/* @var $user app\models\Users */
/* @var $user app\models\UserProjects */

use app\components\HomeHeaderContentWidget;
use app\models\Notifications;

$this->title = 'FastCast - Find an Actor, without the Drama';
?>
<!--- headerTop starts here --->
<div class="container-fluid">
    <?= HomeHeaderContentWidget::widget(['model' => $user]); ?>
    <!--- logo starts here --->
    <div class="row p-zero">
        <div class="logoTop col-md-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['']) ?>">
                <span><img src="images/logoTop.png" alt="image not found"></span>
            </a>
        </div>
    </div>
    <!--- logo ends here --->


    <!--- navbar starts here --->
    <nav class="navbar extraP navBg col-md-12">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse"
                    data-target="#navbar1" aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar1" class="navbar-collapse collapse">
            <ul class="nav navbar-nav p-zero">
                <li class="active"><a href="<?= Yii::$app->urlManager->createUrl(['']) ?>">Home</a></li>
                <li><a href="<?= Yii::$app->urlManager->createUrl(['site/actors']) ?>">Actors</a></li>
                <li><a href="<?= Yii::$app->urlManager->createUrl(['site/filmmakers']) ?>">Filmmakers/crews</a></li>
                <li><a href="<?= Yii::$app->urlManager->createUrl(['site/projects']) ?>">Browse Projects</a></li>
                <li><a href="<?= Yii::$app->urlManager->createUrl(['site/notifications']) ?>">Requests <span style="color:yellow">(<?= count(Notifications::find()->where(['message_to_id'=>$user->id])->all())?>)</span></a></li>
                <!--<li><a href="https://mail.google.com/mail/?view=cm&fs=1&to=saladinian@gmail.com" target="_blank">Contact</a></li>-->
            </ul>
        </div><!--/.nav-collapse -->

        <form class="navbar-form navbar-right p-zero col-md-3 col-sm-3 col-xs-3">
            <button type="submit" class="btn btn-primary">POST CASTING</button>
        </form>

    </nav>
    <!--- navbar ends here --->

</div><!--- header ends here --->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2"></div>
            <div class="col-md-8 credential-box">
                <?= $this->render('_form1', [
                    'model' => $model,
                    'user' => $user,
                    'project' => $project,
                ]); ?>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>