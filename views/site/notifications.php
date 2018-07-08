<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 11/29/2016
 * Time: 5:44 PM
 */
use app\components\ActorDisplayWidget;
use app\components\HomeHeaderContentWidget;
use app\components\NavbarWidget;
use app\components\SimpleSearchWidget;
use app\components\StringsHelper;
use app\models\Notifications;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'FastCast - Find an Actor, without the Drama';
?>
<!--- headerTop starts here --->
<div class="container-fluid">
    <?= HomeHeaderContentWidget::widget(['model' => !empty($user) ? $user : '']); ?>
    <!--- logo starts here --->
    <div class="row p-zero">
        <div class="logoTop col-md-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['']) ?>">
                <span><img src="images/logoTop.png" alt="image not found"></span>
            </a>
        </div>
    </div>
    <!--- logo ends here --->


    <?= NavbarWidget::widget(['model' => !empty($user) ? $user : '' , 'highlight' => 'requests']); ?>

</div><!--- header ends here --->


<!--- mainBody_container starts here --->
<div class="container-fluid p-zero">
    <!--- main_wrapper starts here --->
    <div class="container p-zero">
        <!--- find_Person_Category starts here --->
        <div class="row">
            <?= SimpleSearchWidget::widget(); ?>
        </div>
        <!--- find_Person_Category ends here --->

        <div class="row p-zero">
            <div class="featuredActor col-md-12 pull-left">
                <div class="col-md-12 p-zero">
                    <h4>Role Requests</h4>
                </div>
                <div class="row">
                    <?php $count = 0; ?>
                    <?php
                    if (!empty($notifications)) {
                        foreach ($notifications as $notification) {
                            if ($count % 6 == 0) {
                                echo '<div class="itemActor_detail col-md-12 p-zero">';
                            }
                            ?>
                            <center>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <a href="<?= Yii::$app->urlManager->createUrl(['project/view', 'pn' => base64_encode($notification->project_id)]) ?>">
                                                <img
                                                    src="<?= 'images/projects/' . $notification->project->project->image ?>"
                                                    class="img-responsive" alt="Image"/>
                                            </a>
                                            <a href="<?= Yii::$app->urlManager->createUrl(['project/view', 'pn' => base64_encode($notification->project_id)]) ?>">
                                                <h5><?= $notification->project->project->name_of_production ?></h5>
                                            </a>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px">
                                            <p style="margin-bottom: 10px"><?= $notification->notification ?></p>
                                        <span style="margin:4% 1% !important; clear: both">
                                            <a href="<?= Yii::$app->urlManager->createUrl(['notification/approve', 'n' => base64_encode($notification->id)]) ?>"
                                               style="padding: 2px; border: 1px solid #000; border-radius: 5px; color: #000">Approve</a>
                                        </span>
                                        <span  style="margin:4% 1% !important; clear: both">
                                            <a href="<?= Yii::$app->urlManager->createUrl(['notification/reject', 'n' => base64_encode($notification->id)]) ?>"
                                               style="padding: 2px; border: 1px solid #000; border-radius: 5px; color: #000">Reject</i></a>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </center>
                            <?php
                            if ($count % 6 == 5) {
                                echo '</div>';
                            }
                            $count++;
                            ?>
                        <?php } ?>
                    <?php } else { ?>
                        <h5 style="font-weight: 600;padding :50px 30px">You have no new request.</h5>
                    <?php } ?>
                </div>
            </div>
        </div><!--- row --->

    </div><!-- end container -->
</div><!--- ends main_container here --->