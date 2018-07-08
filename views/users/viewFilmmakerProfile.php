<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 12/13/2016
 * Time: 5:40 PM
 */

use app\components\FilmmakerProjectsDisplayWidget;
use app\components\HomeHeaderContentWidget;
use app\components\UserProjectsDisplayWidget;
use app\models\FilmmakerSkills;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $user->name . " - Profile";
?>

<div class="container-fluid">
    <?= HomeHeaderContentWidget::widget(['model' => !empty($model) ? $model : '']); ?>
    <div class="container">
        <!--- profileInfo start --->
        <div class="profileInfo bg_default col-md-12">
            <div class="row">
                <div class="profileName bg_profileName col-md-12 col-sm-12 col-xs-12">
                    <span><?= $user->name; ?></span>
                    <?php if ($user->is_verified) { ?>
                        <img src="images/verified.png" style="margin-top:10px;width: 20px; height: 20px"/>
                    <?php } ?>
                </div>
                <!-- Profile-Image -->
                <div class="profileImg pR0 col-md-1 col-sm-12 col-xs-12">
                    <?php if (isset($user->profile_picture)) { ?>
                        <img src="<?= 'images/profile_pics/' . $user->profile_picture ?>" alt="image not found">
                    <?php } else { ?>
                        <img src="images/profile_Img.png" alt="image not found">
                    <?php } ?>
                </div>

                <!-- profileInfo_left start -->
                <div class="profileInfo_left col-md-5 col-sm-12 col-xs-12">
                    <?php if ($user->is_verified) { ?>
                        Verified <br>
                    <?php } ?>
                    <span><b>Filmmaker</b></span>
                    <br/>
                    <?= !empty($user->location) ? '<b>Location : </b>' . $user->location : ""; ?>
                    <p style="margin-bottom: 1%"></p>
                    <?= !empty($user->is_union) ? ' <b>Union</b> ' : '<b>Non-Union</b>'; ?>
                    <!--<div class="profileButton">
                        <a href="#"><span>CONTACT</span></a>
                        <a href="#"><span>PRINT</span></a>
                        <a href="#"><span>SHARE</span></a>
                    </div>-->
                    <span class="clearfix"></span>
                </div><!-- profileInfo_left end -->

                <?php if (!empty($user->filmmakerSkills)) { ?>
                    <!-- profileDetail_right start -->
                    <div class="profileInfo_right col-md-4 col-md-push-2 col-sm-12 col-sm-12">
                        <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Also does :</b></h5>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <?php foreach ($user->filmmakerSkills as $filmmakerSkill) { ?>
                                <p class="col-md-7 col-sm-2 col-xs-3"><?= $filmmakerSkill->skill ?></p>
                            <?php } ?>
                        </div>
                    </div><!-- profileDetail_right end -->
                <?php } ?>
            </div><!-- profileInfo row end -->
        </div>
        <!-- profileInfo end-->


        <!--- demoReel_website_contact start --->
        <div class="row">
            <div class="demoReel_website_contact col-lg-12">
                <!-- Demo-Reel -->
                <div class="demoReel_left p-zero col-md-8 col-sm-12 col-xs-12">
                    <h2 class="bg_default">
                        Demo reel/Highlighted project
                    </h2>
                    <?php if (isset($user->demo_reel)) { ?>
                        <div class="embed-responsive embed-responsive-16by9 m-zero">
                            <iframe class="embed-responsive-item" src="<?= $user->demo_reel ?>"
                                    allowfullscreen=""></iframe>
                        </div>
                    <?php } ?>
                </div>


                <div class="website_contact_right p-zero col-md-4 col-sm-12 col-xs-12">
                    <?php if (!empty($user->website_link)) {
                        $link = $user->getWebLink($user->website_link, "http://", "/")
                        ?>
                        <!-- Website -->
                        <div class="website p-zero col-md-12 col-sm-5 col-xs-12">
                            <h2 class="bg_default col-md-12">
                                Website
                            </h2>
                        <span class="col-md-12">
                            <a href="<?= $user->website_link ?>" target="_blank">
                                    <?= $link ?>
                                </a>
                        </span>
                        </div>
                        <?php
                    } ?>
                    <!-- Contact -->
                    <div class="contact p-zero pull-right col-md-12 col-sm-6 col-xs-12">
                        <h2 class="bg_default">
                            Contact
                        </h2>
                        <p>Contact Number: <span class="pull-right"><?= $user->contact_number ?></span></p>
                        <p>Email: <span class="pull-right"><?= $user->email ?></span></p>
                    </div>
                </div>
            </div><!--- demoReel_website_contact start --->
        </div><!-- row end -->

        <!--<div class="row">
            <div class="highlight bg_default">
                <div class="highlight_header">
                    <h2>highlight projects</h2>
                </div>
                <div class="highlight_Video">
                    <div class="embed-responsive embed-responsive-16by9 m-zero">
                        <iframe id="vid_frame" class="embed-responsive-item"
                                src="http://www.youtube.com/embed/ePbKGoIGAXY" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                <hr width="95%">
                <div class="highlight_thumbnail bg_default col-md-12 col-sm-12 col-xs-12">
                    <div class="vid-item"
                         onClick="document.getElementById('vid_frame').src='http://www.youtube.com/embed/W7qWa52k-nE'">
                        <div class="col-md-3 col-sm-6 col">
                            <img src="http://img.youtube.com/vi/W7qWa52k-nE/1.jpg" class="img-responsive center-block"
                                 alt="not found">
                        </div>
                    </div>
                    <div class="vid-item"
                         onClick="document.getElementById('vid_frame').src='http://www.youtube.com/embed/W7qWa52k-nE'">
                        <div class="col-md-3 col-sm-6 col">
                            <img src="http://img.youtube.com/vi/W7qWa52k-nE/2.jpg" class="img-responsive center-block"
                                 alt="not found">
                        </div>
                    </div>
                    <div class="vid-item"
                         onClick="document.getElementById('vid_frame').src='http://www.youtube.com/embed/W7qWa52k-nE'">
                        <div class="col-md-3 col-sm-6 col">
                            <img src="http://img.youtube.com/vi/W7qWa52k-nE/1.jpg" class="img-responsive center-block"
                                 alt="not found">
                        </div>
                    </div>
                    <div class="vid-item"
                         onClick="document.getElementById('vid_frame').src='http://www.youtube.com/embed/W7qWa52k-nE'">
                        <div class="col-md-3 col-sm-6 col">
                            <img src="http://img.youtube.com/vi/W7qWa52k-nE/2.jpg" class="img-responsive center-block"
                                 alt="not found">
                        </div>
                    </div>
                </div>
            </div>
        </div>-->

        <?php if (!empty($user->userProjects)) { ?>
            <?= UserProjectsDisplayWidget::widget(['model' => $user]); ?>
        <?php } ?>


    </div><!-- container ends here -->
</div><!-- container-fluid ends here -->