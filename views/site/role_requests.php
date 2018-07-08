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


    <?= NavbarWidget::widget(['model' => !empty($user) ? $user : '', 'highlight' => 'roles']); ?>

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
                    <h4>Role Applications</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <?php if (!empty($requests)) { ?>
                                <div class="table-responsive">
                                    <table class="table ">
                                        <thead>
                                        <tr>
                                            <th class="col-md-2 col-xs-2"><center>Name</center></th>
                                            <th class="col-md-6 col-xs-3">Message</th>
                                            <th class="col-md-2 col-xs-3">Demo Reel</th>
                                            <th class="col-md-2 col-xs-3">Contact</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $count = 0;
                                        foreach ($requests as $request) { ?>
                                            <tr>
                                                <td>
                                                    <center>
                                                        <?php if (isset($request->requestFrom->profile_picture)) { ?>
                                                            <img
                                                                src="<?= 'images/profile_pics/' . $request->requestFrom->profile_picture ?>"
                                                                alt="image not found">
                                                        <?php } else { ?>
                                                            <img src="images/profile_Img.png" alt="image not found">
                                                        <?php } ?><br/>
                                                        <b><?= $request->requestFrom->name ?></b><br/>
                                                        <b>(<?= $request->available_role ?>)</b><br/>
                                                    </center>
                                                </td>
                                                <td>
                                                    <b><?= nl2br($request->message) ?></b>
                                                </td>
                                                <td>
                                                    <?php if (!empty($request->requestFrom->demo_reel)) { ?>
                                                        <a class="greenText" target="_blank"
                                                           href="<?= $request->requestFrom->demo_reel ?>">
                                                            View Reel
                                                        </a>
                                                    <?php } else { ?>
                                                        <b>N/A</b>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($request->requestFrom->contact_number)) { ?>
                                                        <b><?= $request->requestFrom->contact_number ?></b><br/>
                                                    <?php } ?>
                                                    <a class="greenText" target="_blank"
                                                       href="<?= Yii::$app->urlManager->createUrl(['users/view-profile', 'email' => $request->requestFrom->email]) ?>">View
                                                        Profile</a><br/>

                                                    <a href="<?= Yii::$app->urlManager->createUrl(['role-applications/reject', 'role' => base64_encode($request->id), 'pn' => base64_encode($request->project_id)]) ?>">Reject</a><br/>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            } else { ?>
                                <h5 style="font-weight: 600;padding :10px 0">You have no new application.</h5>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--- row --->

    </div><!-- end container -->
</div><!--- ends main_container here --->