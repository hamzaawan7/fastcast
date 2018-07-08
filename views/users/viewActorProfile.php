<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 12/13/2016
 * Time: 5:40 PM
 */

use app\components\ActorProjectsDisplayWidget;
use app\components\HomeHeaderContentWidget;
use app\components\UserProjectsDisplayWidget;
use app\models\FilmmakerSkills;
use yii\helpers\Html;
use yii\web\View;
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
                    <span><?= !empty($user->name) ? $user->name : ""; ?></span>
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
                        <span>Verified</span>
                        <br/>
                    <?php } ?>
                    <span><?= !empty($user->gender) ? '<b>' . $user->gender . ',</b>' : "" ?> Actor</span>
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

                <?php if (!empty($user->actorAttributes)) { ?>
                    <!-- profileDetail_right start -->
                    <div class="profileInfo_right col-md-4 col-md-push-2 col-sm-12 col-sm-12">
                        <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Ethnicity :</b></h5>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                        <span class="col-md-12 col-sm-12 col-xs-13">
                            <?= !empty($user->actorAttributes->ethnicity) ? $user->actorAttributes->ethnicity : "" ?>
                        </span>
                        </div>
                        <br/>
                        <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Acting Age :</b></h5>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                        <span class="col-md-12 col-sm-12 col-xs-13">
                            <?= !empty($user->actorAttributes->age_range) ? $user->actorAttributes->age_range : "" ?>
                        </span>
                        </div>
                        <br/>
                        <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Height :</b></h5>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                        <span class="col-md-12 col-sm-12 col-xs-13">
                            <?= !empty($user->actorAttributes->height) ? $user->actorAttributes->height : "" ?>
                        </span>
                        </div>
                        <br/>
                        <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Weight :</b></h5>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                        <span class="col-md-12 col-sm-12 col-xs-13">
                            <?= !empty($user->actorAttributes->weight) ? $user->actorAttributes->weight : "" ?>
                        </span>
                        </div>
                        <br/>
                        <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Hair Color :</b></h5>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                        <span class="col-md-12 col-sm-12 col-xs-13">
                            <?= !empty($user->actorAttributes->hair_color) ? $user->actorAttributes->hair_color : "" ?>
                        </span>
                        </div>
                        <br/>
                        <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Eye Color :</b></h5>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                        <span class="col-md-12 col-sm-12 col-xs-13">
                            <?= !empty($user->actorAttributes->eye_color) ? $user->actorAttributes->eye_color : "" ?>
                        </span>
                        </div>
                        <br/>
                        <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Build :</b></h5>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                        <span class="col-md-12 col-sm-12 col-xs-13">
                            <?= !empty($user->actorAttributes->build) ? $user->actorAttributes->build : "" ?>
                        </span>
                        </div>
                    </div><!-- profileDetail_right end -->
                <?php } ?>
            </div><!-- profileInfo row end -->
        </div>
        <!-- profileInfo end-->


        <!--- demoReel_aboutme_contact start --->
        <div class="row">
            <div class="demoReel_website_contact col-lg-12">
                <?php if (!empty($user->demo_reel)) { ?>
                    <div class="demoReel_left p-zero col-md-8 col-sm-12 col-xs-12">
                        <h2 class="bg_default">
                            Actor reel
                        </h2>
                        <div class="embed-responsive embed-responsive-16by9 m-zero">
                            <iframe class="embed-responsive-item" src="<?= $user->demo_reel ?>"
                                    allowfullscreen=""></iframe>
                        </div>
                    </div>
                <?php } ?>


                <div class="website_contact_right p-zero col-md-4 col-sm-12 col-xs-12">
                    <!-- Contact -->
                    <div class="contact p-zero pull-right col-md-12 col-sm-6 col-xs-12">
                        <h2 class="bg_default">
                            Contact
                        </h2>
                        <p>Contact Number: <span class="pull-right"><?= $user->contact_number ?></span></p>
                        <p>Email: <span class="pull-right"><?= $user->email ?></span></p>
                    </div>
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
                    <?php if (!empty($user->resume)) { ?>
                        <!-- Resume -->
                        <div class="contact p-zero pull-right col-md-12 col-sm-6 col-xs-12" align="center"
                             style="margin:10% 0">
                            <a href="resume/<?= $user->resume ?>" target="_blank" class="resumeButton"
                               style="color: #fff">
                                View Resume
                            </a>
                        </div>
                    <?php } ?>
                </div>

                <!-- Actor-Reel -->
                <div class="demoReel_left p-zero col-md-8 col-sm-12 col-xs-12"
                     style="margin-bottom: 50px;<?= !empty($user->demo_reel) ? 'margin-top:9px' : '' ?>">
                    <h2 class="bg_default">
                        About Me
                    </h2>
                    <?php if (!empty($user->about_me)) { ?>
                        <span><?= $user->about_me ?></span>
                    <?php } else { ?>
                        <span><b>N/A</b></span>
                    <?php } ?>
                </div>

                <?php if (!empty($user->actorSkills)) { ?>
                    <!-- Skills-->
                    <div class="demoReel_left p-zero col-md-8 col-sm-12 col-xs-12">
                        <div class="">
                            <table class="table col-md-6">
                                <thead>
                                <tr>
                                    <th class="col-md-3" align="center">Skills</th>
                                    <th class="col-md-3" align="center">Experience</th>
                                </tr>
                                </thead>
                                <tbody align="center">
                                <?php foreach ($user->actorSkills as $skill) { ?>
                                    <tr>
                                        <td class="col-md-3" align="left" style="border: none">
                                            <?= $skill->skill ?>
                                        </td>
                                        <td class="col-md-3" align="left" style="border: none">
                                            <?= $skill->experience ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>

                <?php if (!empty($user->userProjects)) {
                    echo UserProjectsDisplayWidget::widget(['model' => $user]);
                } ?>
            </div><!--- demoReel_aboutme_contact start --->
        </div><!-- row end -->
    </div><!-- container ends here -->
</div><!-- container-fluid ends here -->