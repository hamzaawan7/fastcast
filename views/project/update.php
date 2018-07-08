<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 11/29/2016
 * Time: 5:44 PM
 */
/* @var $user app\models\Users */
/* @var $upmodel app\models\UserProjects */

use app\components\HomeHeaderContentWidget;
use app\components\NavbarWidget;
use app\models\Notifications;

$this->title = 'FastCast - Find an Actor, without the Drama';
?>
<!--- headerTop starts here --->
<div class="container-fluid">
    <?= HomeHeaderContentWidget::widget(['model' => $user]);?>
    <!--- logo starts here --->
    <div class="row p-zero">
        <div class="logoTop col-md-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['']) ?>">
                <span><img src="images/logoTop.png" alt="image not found"></span>
            </a>
        </div>
    </div>
    <!--- logo ends here --->


    <?= NavbarWidget::widget(['model' => !empty($user) ? $user : '']); ?>

</div><!--- header ends here --->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2"></div>
            <div class="col-md-8 credential-box">
                <?= $this->render('_form', [
                    'model'=>$model,
                    'user' => $user,
                ]); ?>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>