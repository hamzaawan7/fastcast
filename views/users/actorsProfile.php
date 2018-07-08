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
use app\models\ActorSkills;
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
                        <span>Verified</span>
                    <?php } ?>
                    <br/>
                    <span><b><?= $model->gender ?>,</b> Actor</span>
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
                    <button type="button" style="margin-bottom: 1%" class="remove-button-styling greenText"
                            data-toggle="modal"
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
                    <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Ethnicity :</b></h5>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <span class="col-md-12 col-sm-12 col-xs-13"><?= $modelAttributes->ethnicity ?></span>
                    </div>
                    <br/>
                    <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Acting Age :</b></h5>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <span class="col-md-12 col-sm-12 col-xs-13"><?= $modelAttributes->age_range ?></span>
                    </div>
                    <br/>
                    <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Height :</b></h5>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <span class="col-md-12 col-sm-12 col-xs-13"><?= $modelAttributes->height ?></span>
                    </div>
                    <br/>
                    <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Weight :</b></h5>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <span class="col-md-12 col-sm-12 col-xs-13"><?= $modelAttributes->weight ?></span>
                    </div>
                    <br/>
                    <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Hair Color :</b></h5>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <span class="col-md-12 col-sm-12 col-xs-13"><?= $modelAttributes->hair_color ?></span>
                    </div>
                    <br/>
                    <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Eye Color :</b></h5>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <span class="col-md-12 col-sm-12 col-xs-13"><?= $modelAttributes->eye_color ?></span>
                    </div>
                    <br/>
                    <h5 class="m-zero col-md-3 col-sm-12 col-xs-12"><b>Build :</b></h5>
                    <div class="col-md-7 col-sm-12 col-xs-12">
                        <span class="col-md-12 col-sm-12 col-xs-13"><?= $modelAttributes->build ?></span>
                    </div>
                    <br/>
                    <p class="m-zero col-md-10 col-sm-12 col-xs-12 greenText">
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="remove-button-styling" data-toggle="modal"
                                data-target="#modifyAttributes">
                            (Change Attributes)
                        </button>
                    </p>
                </div><!-- profileDetail_right end -->

            </div><!-- profileInfo row end -->
        </div>
        <!-- profileInfo end-->


        <!--- demoReel_aboutme_contact start --->
        <div class="row">
            <div class="demoReel_website_contact col-lg-12">
                <!-- Actor-Reel -->
                <div class="demoReel_left p-zero col-md-8 col-sm-12 col-xs-12">
                    <h2 class="bg_default">
                        Actor reel
                        <button type="button" class="remove-button-styling add-text greenText" data-toggle="modal"
                                data-target="#addDemoReel">
                            <?php if (isset($model->demo_reel)) { ?>
                                (Change)
                            <?php } else { ?>
                                + Add a Youtube or Vimeo Link
                            <?php } ?>
                        </button>
                    </h2>
                    <?php if (isset($model->demo_reel)) { ?>
                        <div class="embed-responsive embed-responsive-16by9 m-zero">
                            <iframe class="embed-responsive-item" src="<?= $model->demo_reel ?>"
                                    allowfullscreen=""></iframe>
                        </div>
                    <?php } ?>
                </div>


                <div class="website_contact_right p-zero col-md-4 col-sm-12 col-xs-12">
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
                    <!-- Resume -->
                    <div class="contact p-zero pull-right col-md-12 col-sm-6 col-xs-12" align="center">
                        <button type="button" class="resumeButton" data-toggle="modal"
                                data-target="#addResume">
                            <?php if (isset($model->resume)) { ?>
                                Change Resume
                            <?php } else { ?>
                                Upload Resume
                            <?php } ?>
                        </button>
                    </div>
                </div>

                <!-- Actor-Reel -->
                <div class="demoReel_left p-zero col-md-8 col-sm-12 col-xs-12"
                     style="margin-bottom: 50px; margin-top:9px">
                    <h2 class="bg_default">
                        About Me
                        <button type="button" class="remove-button-styling add-text greenText" data-toggle="modal"
                                data-target="#addAbout">
                            <?php if (isset($model->about_me)) { ?>
                                (Change)
                            <?php } else { ?>
                                + Add Information
                            <?php } ?>
                        </button>
                    </h2>
                    <?php if (isset($model->about_me)) { ?>
                        <span><?= $model->about_me ?></span>
                    <?php } ?>
                </div>
                <!-- Skills-->
                <div class="demoReel_left p-zero col-md-8 col-sm-12 col-xs-12" style="margin-bottom: 50px">
                    <div class="">
                        <table class="table col-md-6">
                            <thead>
                            <tr>
                                <th class="col-md-3" align="center">Skills</th>
                                <th class="col-md-2" align="center">Experience</th>
                                <th class="col-md-2">
                                    <button type="button" style="font-size: 12px; float: right" class="remove-button-styling add-text greenText" data-toggle="modal" data-target="#modifySkills">
                                        (+ Modify Skills)
                                    </button>
                                </th>
                            </tr>
                            </thead>
                            <tbody align="center">
                            <?php foreach ($model->actorSkills as $skill) { ?>
                                <tr>
                                    <td class="col-md-3" align="left" style="border: none">
                                        <?= $skill->skill ?>
                                    </td>
                                    <td class="col-md-2" align="left" style="border: none">
                                        <?= $skill->experience ?>
                                    </td>
                                    <td class="col-md-2" align="center" style="border: none">
                                        <a href="<?= Yii::$app->urlManager->createUrl([
                                            'actor-skills/delete', 'skill' => base64_encode($skill->id)
                                        ]) ?>">
                                            <span style="color:red !important">x</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if (!empty($model->demo_reel)) {
                    echo UserProjectsDisplayWidget::widget(['model' => $model]);
                } ?>
            </div><!--- demoReel_aboutme_contact start --->
        </div><!-- row end -->
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
                    <h4 class="modal-title">Add an Address Here</h4>
                </center>
            </div>
            <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(["users/update"]),
                    'fieldConfig' => ['labelOptions' => ['class' => 'control-label', 'style' => 'color:#fff'],],]
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
            <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(["users/update"]),]
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
            <?php $form = ActiveForm::begin(['id' => 'form-profile',
                'action' => Yii::$app->urlManager->createUrl(["users/uimage"]),]); ?>
            <?php echo $form->field($model, 'profile_picture')->label(false)->widget(Widget::className(), ['uploadUrl' => Url::toRoute('/users/uploadPhoto'),]) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- Resume Modal -->
<div id="addResume" class="modal fade" role="dialog" style="margin-top:80px">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center>
                    <h1>FastCast</h1>
                    <p>Find an actor, without the drama</p>
                    <h4 class="modal-title">Upload a Resume</h4>
                </center>
            </div>
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                    'action' => Yii::$app->urlManager->createUrl(["users/uresume"]),
                    'fieldConfig' => ['labelOptions' => ['class' => 'control-label', 'style' => 'color:#fff'],],]
            ); ?>
            <div class="modal-body">
                <?= $form->field($model, 'resume')->fileInput() ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- Attributes Modal -->
<div id="modifyAttributes" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center>
                    <h1>FastCast</h1>
                    <p>Find an actor, without the drama</p>
                    <h4 class="modal-title">Fill in Respective Text Boxes to Modify Attributes</h4>
                </center>
            </div>
            <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl([($modelAttributes->isNewRecord) ? "actor-attributes/create" : "actor-attributes/update"]),]
            ); ?>
            <div class="modal-body">
                <?= $form->field($modelAttributes, 'actor_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
                <?= $form->field($modelAttributes, 'age_range')->textInput(['maxlength' => true]) ?>
                <?= $form->field($modelAttributes, 'build')->textInput(['maxlength' => true]) ?>
                <?= $form->field($modelAttributes, 'height')->textInput(['maxlength' => true]) ?>
                <?= $form->field($modelAttributes, 'weight')->textInput(['maxlength' => true]) ?>
                <?= $form->field($modelAttributes, 'ethnicity')->textInput(['maxlength' => true]) ?>
                <?= $form->field($modelAttributes, 'hair_color')->textInput(['maxlength' => true]) ?>
                <?= $form->field($modelAttributes, 'eye_color')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton(($modelAttributes->isNewRecord) ? 'Add' : 'Change', ['class' => 'btn btn-success']) ?>
            </div>
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
            <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(["users/uvideo"]),
                    'fieldConfig' => ['labelOptions' => ['class' => 'control-label', 'style' => 'color:#fff'],],]
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
<div id="modifySkills" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center>
                    <h1>FastCast</h1>
                    <p>Find an actor, without the drama</p>
                    <h4 class="modal-title">Fill in Respective Text Boxes to Add Skills</h4>
                </center>
            </div>
            <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(["actor-skills/create"]),]
            ); ?>
            <div class="modal-body">
                <?php if (!$model->isNewRecord) {
                    $actor_skills = ActorSkills::find()->where(['actor_id' => $model->id])->all();
                    foreach ($actor_skills as $skill) { ?>
                        <?= Html::hiddenInput('UpdateModelSkills[actor_id][]', $skill->actor_id, ['value' => Yii::$app->user->id]) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= Html::textInput('UpdateModelSkills[skill][]', $skill->skill, ['placeholder' => 'Dancing, Stunt, Singing, ETC', 'class' => 'form-control']) ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= Html::textInput('UpdateModelSkills[experience][]', $skill->experience, ['placeholder' => '2 years', 'class' => 'form-control']) ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
                <div id="skills">
                    <div id="skill">
                        <?= Html::hiddenInput('ModelSkills[actor_id][]', 'actor_id', ['value' => Yii::$app->user->id]) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= Html::textInput('ModelSkills[skill][]', '', ['placeholder' => 'Dancing, Stunt, Singing, ETC', 'class' => 'form-control']) ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= Html::textInput('ModelSkills[experience][]', '', ['placeholder' => '2 years', 'class' => 'form-control']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a id="add_skill" href="#" onclick="return false" class="greenText"
                           style="float: right">
                            + More
                        </a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('Modify', ['class' => 'btn btn-success']) ?>
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
            <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(["users/update"]),]
            ); ?>
            <div class="modal-body">
                <?= $form->field($model, 'contact_number')->textInput() ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('Change', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<!-- About Modal -->
<div id="addAbout" class="modal fade" role="dialog" style="margin-top:80px">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center>
                    <h1>FastCast</h1>
                    <p>Find an actor, without the drama</p>
                    <h4 class="modal-title">About Me</h4>
                </center>
            </div>
            <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(["users/update"]),
                    'fieldConfig' => ['labelOptions' => ['class' => 'control-label', 'style' => 'color:#fff'],],]
            ); ?>
            <div class="modal-body">
                <?= $form->field($model, 'about_me')->textarea(['rows' => 6]) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton(!empty($model->about_me) ? 'Add' : 'Change', ['class' => 'btn btn-success']) ?>
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