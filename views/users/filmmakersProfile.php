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
use budyaga\cropper\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = $model->name . " - Profile";
?>

<div class="container-fluid">
    <?= HomeHeaderContentWidget::widget(['model' => $model]); ?>
    <div class="container">
        <!--- profileInfo start --->
        <div class="profileInfo bg_default col-md-12">
            <div class="row">
                <div class="profileName bg_profileName col-md-12 col-sm-12 col-xs-12">
                    <span><?= $model->name; ?></span>
                    <?php if ($model->is_verified) { ?>
                        <img src="images/verified.png" style="margin-top:10px;width: 20px; height: 20px"/>
                    <?php } ?>
                    <button type="button" class="remove-button-styling" style="color:#fff" data-toggle="modal"
                            data-target="#changeName">
                        (Change)
                    </button>
                </div>
                <!-- Profile-Image -->
                <div class="profileImg pR0 col-md-1 col-sm-12 col-xs-12">
                    <?php if (isset($model->profile_picture)) { ?>
                        <img src="<?= 'images/profile_pics/' . $model->profile_picture ?>" alt="image not found">
                    <?php } else { ?>
                        <img src="images/profile_Img.png" alt="image not found">
                    <?php } ?>
                </div>

                <!-- profileInfo_left start -->
                <div class="profileInfo_left col-md-5 col-sm-12 col-xs-12">
                    <?php if ($model->is_verified) { ?>
                        Verified <br>
                    <?php } ?>
                    <span><b>Filmmaker</b></span>
                    <br/>
                    <?php if (isset($model->location)) { ?>
                        <b>Location : </b><?= $model->location; ?>
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="remove-button-styling greenText" data-toggle="modal"
                                data-target="#addAddress">
                            (Change)
                        </button>
                    <?php } else { ?>
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="remove-button-styling greenText" data-toggle="modal"
                                data-target="#addAddress">
                            + Add a Location
                        </button>
                    <?php } ?>
                    <p style="margin-bottom: 1%"></p>
                    <?= !empty($model->is_union) ? ' <b>Union</b> ' : '<b>Non-Union</b>'; ?>
                    <!-- Trigger the modal with a button -->
                    <button type="button"  style="margin-bottom: 1%" class="remove-button-styling greenText" data-toggle="modal"
                            data-target="#addUnion">
                        (Change)
                    </button>
                    <!--<div class="profileButton">
                        <a href="#"><span>CONTACT</span></a>
                        <a href="#"><span>PRINT</span></a>
                        <a href="#"><span>SHARE</span></a>
                    </div>-->
                    <span class="clearfix"></span>
                    <span>
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="fa fa-camera remove-button-styling" style="font-size: x-large"
                                data-toggle="modal"
                                data-target="#addImage">
                        </button>
                    </span>
                </div><!-- profileInfo_left end -->

                <!-- profileDetail_right start -->
                <div class="profileInfo_right col-md-4 col-md-push-2 col-sm-12 col-sm-12">

                    <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Also does :</b></h5>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <?php
                        if (!empty($model->filmmakerSkills)) {
                            foreach ($model->filmmakerSkills as $skill) {
                                ?>
                                <p class="col-md-7 col-sm-2 col-xs-3" style="margin-bottom: 0"><?= $skill->skill ?>
                                </p>
                                <form method="post"
                                      style="margin-bottom: 5px"
                                      action="<?= Yii::$app->urlManager->createUrl(['filmmaker-skills/delete']) ?>">
                                    <input type="hidden" name="_csrf">
                                    <input name="skillid" type="hidden" value="<?= base64_encode($skill->id) ?>"/>
                                    <button type="submit" class="greenText remove-button-styling">x</button>
                                </form>
                                <?php
                            }
                        }
                        ?>
                        <p class="col-md-12 col-sm-12 col-xs-13 greenText">
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="remove-button-styling" data-toggle="modal"
                                    data-target="#addSkill">
                                + Add a Skill
                            </button>
                        </p>
                    </div>
                </div><!-- profileDetail_right end -->

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
                        <button type="button" class="remove-button-styling add-text greenText" data-toggle="modal"
                                data-target="#addDemoReel">
                            <?php if (isset($model->demo_reel)) { ?>
                                (Change)
                            <?php } else { ?>
                                + Add a Youtube or Vimeo Link
                            <?php } ?>
                        </button>
                    </h2>
                    <div class="embed-responsive embed-responsive-16by9 m-zero">
                        <?php if (isset($model->demo_reel)) { ?>
                            <iframe class="embed-responsive-item" src="<?= $model->demo_reel ?>"
                                    allowfullscreen=""></iframe>
                        <?php } ?>
                    </div>
                </div>


                <div class="website_contact_right p-zero col-md-4 col-sm-12 col-xs-12">
                    <!-- Website -->
                    <div class="website p-zero col-md-12 col-sm-5 col-xs-12">
                        <h2 class="bg_default col-md-12">
                            Website
                            <button type="button" class="remove-button-styling add-text greenText"
                                    data-toggle="modal" data-target="#addWebsiteLink">
                                <?php if (isset($model->website_link)) { ?>
                                    (Change)
                                <?php } else { ?>
                                    + Add a Link
                                <?php } ?>
                            </button>
                        </h2>
                        <span class="col-md-12">
                            <?php if (isset($model->website_link)) {
                                $link = $model->getWebLink($model->website_link)
                                ?>
                                <a href="<?= $model->website_link ?>" target="_blank">
                                    <?= $link ?>
                                </a>
                                <?php
                            } ?>
                        </span>
                    </div>
                    <!-- Contact -->
                    <div class="contact p-zero pull-right col-md-12 col-sm-6 col-xs-12">
                        <h2 class="bg_default">
                            Contact
                            <button type="button" class="remove-button-styling add-text greenText"
                                    data-toggle="modal" data-target="#changeNumber">(Change)
                            </button>
                        </h2>
                        <p>Contact Number: <span class="pull-right"><?= $model->contact_number ?></span></p>
                        <p>Email: <span class="pull-right"><?= $model->email ?></span></p>
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

        <?= UserProjectsDisplayWidget::widget(['model' => $model]); ?>

    </div><!-- container ends here -->
</div><!-- container-fluid ends here -->

<!-- Bootstrap Modals -->
<!-- Location Modal -->
<div id="addAddress" class="modal fade" role="dialog" style="margin-top:80px">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center>
                    <h1>FastCast</h1>
                    <p>Find an actor, without the drama</p>
                    <h4 class="modal-title">Add an Adress Here</h4>
                </center>
            </div>
            <?php $form = ActiveForm::begin([
                    'action' => Yii::$app->urlManager->createUrl(["users/update"]),
                    'fieldConfig' => [
                        'labelOptions' => ['class' => 'control-label', 'style' => 'color:#fff'],
                    ],
                ]
            ); ?>
            <div class="modal-body">
                <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton(!isset($model->location) ? 'Add' : 'Change', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- Union Modal -->
<div id="addUnion" class="modal fade" role="dialog" style="margin-top:80px">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center>
                    <h1>FastCast</h1>
                    <p>Find an actor, without the drama</p>
                    <h4 class="modal-title">Add an Address Here</h4>
                </center>
            </div>
            <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(["users/update"])]
            ); ?>
            <div class="modal-body">
                <?= $form->field($model, 'is_union')->dropDownList(['1' => 'Yes', '0' => 'No']) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('Change', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- Name Modal -->
<div id="changeName" class="modal fade" role="dialog" style="margin-top:80px">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center>
                    <h1>FastCast</h1>
                    <p>Find an actor, without the drama</p>
                    <h4 class="modal-title">Change Name</h4>
                </center>
            </div>
            <?php $form = ActiveForm::begin([
                    'action' => Yii::$app->urlManager->createUrl(["users/update"]),
                ]
            ); ?>
            <div class="modal-body">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('Change', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- Image Modal -->
<div id="addImage" class="modal fade" role="dialog" style="margin-top:80px">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center>
                    <h1>FastCast</h1>
                    <p>Find an actor, without the drama</p>
                    <h4 class="modal-title">Upload an Image</h4>
                </center>
            </div>
            <?php $form = ActiveForm::begin([
                'id' => 'form-profile',
                'action' => Yii::$app->urlManager->createUrl(["users/uimage"]),
            ]); ?>
            <?php echo $form->field($model, 'profile_picture')->label(false)->widget(Widget::className(), [
                'uploadUrl' => Url::toRoute('/users/uploadPhoto'),
            ]) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- Demo Reel Modal -->
<div id="addDemoReel" class="modal fade" role="dialog" style="margin-top:80px">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center>
                    <h1>FastCast</h1>
                    <p>Find an actor, without the drama</p>
                    <h4 class="modal-title">Add Youtube or Vimeo Demo Reel Link Here</h4>
                </center>
            </div>
            <?php $form = ActiveForm::begin([
                    'action' => Yii::$app->urlManager->createUrl(["users/uvideo"]),
                    'fieldConfig' => [
                        'labelOptions' => ['class' => 'control-label', 'style' => 'color:#fff'],
                    ],
                ]
            ); ?>
            <div class="modal-body">
                <?= $form->field($model, 'demo_reel')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton(!isset($model->demo_reel) ? 'Add' : 'Change', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- Skill Modal -->
<div id="addSkill" class="modal fade" role="dialog" style="margin-top:80px">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center>
                    <h1>FastCast</h1>
                    <p>Find an actor, without the drama</p>
                    <h4 class="modal-title">Select Skills to Add</h4>
                </center>
            </div>
            <?php $mskill = new FilmmakerSkills(); ?>
            <?php $form = ActiveForm::begin([
                    'action' => Yii::$app->urlManager->createUrl(["filmmaker-skills/add-skill"]),
                ]
            ); ?>
            <div class="modal-body">
                <div class="container-fluid" style="background-color: #fff">
                    <?= $form->field($mskill, 'skill')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- Number Modal -->
<div id="changeNumber" class="modal fade" role="dialog" style="margin-top:80px">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center>
                    <h1>FastCast</h1>
                    <p>Find an actor, without the drama</p>
                    <h4 class="modal-title">Change Number</h4>
                </center>
            </div>
            <?php $form = ActiveForm::begin([
                    'action' => Yii::$app->urlManager->createUrl(["users/update"]),
                ]
            ); ?>
            <div class="modal-body">
                <?= $form->field($model, 'contact_number')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('Change', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- Website Modal -->
<div id="addWebsiteLink" class="modal fade" role="dialog" style="margin-top:80px">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center>
                    <h1>FastCast</h1>
                    <p>Find an actor, without the drama</p>
                    <h4 class="modal-title">Add a Website Link Here</h4>
                </center>
            </div>
            <?php $form = ActiveForm::begin([
                    'action' => Yii::$app->urlManager->createUrl(["users/update"]),
                    'fieldConfig' => [
                        'labelOptions' => ['class' => 'control-label', 'style' => 'color:#fff'],
                    ],
                ]
            ); ?>
            <div class="modal-body">
                <?= $form->field($model, 'website_link')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton(!isset($model->website_link) ? 'Add' : 'Change', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>