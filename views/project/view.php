<?php

use app\components\HomeHeaderContentWidget;
use app\components\StringsHelper;
use app\models\UserProjects;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $user app\models\Users */

$this->title = $model->name_of_production . " - FastCast";
?>

<div class="container-fluid">
    <?= HomeHeaderContentWidget::widget(['model' => !empty($user) ? $user : '']); ?>
    <div class="container">
        <div class="side-padding">
            <div class="col-md-12" style="margin-bottom: 20px">
                <div class="row">
                    <!--- navbar starts here --->
                    <nav class="navbar navBg">
                        <div class="col-md-8">
                            <div class="project-title">
                                <p>
                                    <?= $model->name_of_production ?>
                                    <span
                                        style="font-size:12px"><?= ($model->status == "Active") ? '[ACTIVE]' : '' ?></span>
                                    <?php if (!empty($user)) { ?>
                                        <?php if ($model->posted_by_id == $user->id) { ?>
                                            <a href="<?= Yii::$app->urlManager->createUrl(['project/change', 'pn' => base64_encode($model->id)]) ?>">
                                                <span style="color: #fff !important; font-size: 14px">(Edit)</span>
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                </p>
                            </div><!--/.nav-collapse -->
                        </div>
                        <?php if (!empty($user)) { ?>
                            <div class="col-md-4">
                                <div class="navbar-right">
                                    <?php if ($model->posted_by_id == $user->id) { ?>
                                        <a href="<?= Yii::$app->urlManager->createUrl(['project/delete', 'pn' => base64_encode($model->id)]) ?>">
                                            <button style="margin-top: 6px;margin-right: 6px;" class="btn btn-project">
                                                Remove Project
                                            </button>
                                        </a>
                                    <?php } else if (StringsHelper::getProjectUserRole($model->id) && StringsHelper::getProjectUserRole($model->id) != 2) { ?>
                                        <a href="<?= Yii::$app->urlManager->createUrl(['user-projects/remove-part', 'pn' => base64_encode($model->id)]) ?>">
                                            <button style="margin-top: 6px;margin-right: 6px;" class="btn btn-project">
                                                Remove Particpation
                                            </button>
                                        </a>
                                    <?php } else if (StringsHelper::getProjectUserRole($model->id) == 2) { ?>
                                        <a href="<?= Yii::$app->urlManager->createUrl(['user-projects/remove-part', 'pn' => base64_encode($model->id)]) ?>">
                                            <button style="margin-top: 6px;margin-right: 6px;" class="btn btn-project">
                                                Remove Request
                                            </button>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?= Yii::$app->urlManager->createUrl(['user-projects/become-part', 'pn' => base64_encode($model->id)]) ?>">
                                            <button style="margin-top: 6px;margin-right: 6px;" class="btn btn-project">
                                                I took Part in this Project
                                            </button>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </nav>
                    <!--- navbar ends here --->
                </div>
            </div>
            <!--- highlight start --->
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 3%;">
                    <div class="row">
                        <div class="col-md-9">
                            <?php if (!empty($model->video_url)) { ?>
                                <!-- highlight_Video -->
                                <div class="highlight_Video">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item"
                                                src="<?= $model->video_url ?>" frameborder="0"
                                                allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-3">
                                    <img style="width:188px;max-height:122px" src="images/projects/<?= $model->image ?>"
                                         alt="Image"/>
                                </div>
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-8">
                                    <div class="project-summary-title" style="margin-top: 0 !important;">
                                        <p>Project Summary</p>
                                    </div>
                                    <div class="project-summary">
                                        <?= !empty($model->summary) ? $model->summary : '' ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-3">
                            <p class="crew-info">Crew Information</p>
                            <div class="table-responsive">
                                <table class="crew-table">
                                    <tbody>
                                    <?php foreach ($model->userProjects as $userProject) { ?>
                                        <tr>
                                            <?php if (!empty($userProject->user_id)) { ?>
                                                <td class="left-crew-data">
                                                    <a href="<?= Yii::$app->urlManager->createUrl(['users/view-profile', 'email' => $userProject->user->email]) ?>">
                                                        <?= $userProject->user->name ?>
                                                    </a>
                                                </td>
                                            <?php } else { ?>
                                                <td class="left-crew-data">
                                                    <a href="<?= Yii::$app->urlManager->createUrl(['users/view-profile', 'email' => $userProject->user->email]) ?>">
                                                        <?= $userProject->person_name ?>
                                                    </a>
                                                </td>
                                            <?php } ?>
                                            <td class="right-crew-data"><?= $userProject->role ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <hr style="margin:12% 10px; border: 1px solid #323232 !important;"/>

                            <?php if ($model->status == "Active") { ?>
                                <center><b>Posted By : </b><?= $model->postedby->name ?></center>
                            <?php } ?>
                            <?php if (!empty($model->company)) { ?>
                                <center><b>Company : </b><?= $model->company ?></center>
                            <?php } ?>
                            <center><b>Genre : </b><?= $model->type ?></center>
                            <?php if ($model->status == "Active") { ?>
                                <center><b>Paid : </b><?= ($model->is_paid) ? "Yes" : "No" ?></center>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php if (!empty($model->video_url)) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="project-summary-title">
                                <p>Project Summary</p>
                            </div>
                            <div class="project-summary">
                                <?= !empty($model->summary) ? $model->summary : '' ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php if (!empty($model->availableRoles)) { ?>
                <div class="row">
                    <div class="col-md-9">
                        <div class="project-summary-title">
                            <p>Available Roles</p>
                        </div>
                        <?php $count = 1;
                        foreach ($model->availableRoles as $role) { ?>
                            <div class="role-summary">
                                <span class="role-head"><?= $role->available_role ?></span><br/>
                                <span class="role-attributes"><b>Gender : </b><?= $role->gender ?></span><br/>
                                    <span class="role-attributes"><b>Playing Age : </b><?= $role->age_from ?>
                                        - <?= $role->age_to ?></span>
                                <div class="role-detail">
                                    <?= $role->role_description ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php if (!empty($user)) { ?>
                                            <?php if ($model->posted_by_id != $user->id && $user->type != "Filmmaker") { ?>
                                                <div class="col-md-8">
                                                    <hr style="margin:5% 0; border: 1px solid #323232 !important;"/>
                                                </div>
                                                <div class="col-md-4" style="margin-top: 18px">
                                                    <center>
                                                        <?php if (StringsHelper::getAppliedRole($model->id, $role->available_role)) { ?>
                                                            <a class="apply-role"
                                                               href="<?= Yii::$app->urlManager->createUrl([
                                                                   'role-applications/reject',
                                                                   'role' => base64_encode(StringsHelper::getAppliedRole($model->id, $role->available_role)),
                                                                   'pn' => base64_encode($model->id),
                                                               ]) ?>">
                                                                Cancel Application
                                                            </a>
                                                        <?php } else if (!StringsHelper::getAppliedRole($model->id, $role->available_role)) { ?>
                                                            <button class="apply-role" data-toggle="modal"
                                                                    data-target="#applyRole<?= $count ?>">
                                                                Apply for Role
                                                            </button>
                                                        <?php } ?>
                                                    </center>
                                                </div>
                                            <?php } else { ?>
                                                <hr style="margin:5% 10%; border: 1px solid #323232 !important;"/>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <hr style="margin:5% 10%; border: 1px solid #323232 !important;"/>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Union Modal -->
                            <div id="applyRole<?= $count ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <center>
                                                <h1>FastCast</h1>
                                                <p>Find an actor, without the drama</p>
                                                <h4 class="modal-title">Apply for Role (<?= $role->available_role ?>
                                                    )</h4>
                                            </center>
                                        </div>
                                        <?php $form = ActiveForm::begin(); ?>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <center>
                                                        <?php if (isset($user->profile_picture)) { ?>
                                                            <img style="margin-left: 70px"
                                                                 src="<?= 'images/profile_pics/' . $user->profile_picture ?>"
                                                                 alt="image not found">
                                                        <?php } else { ?>
                                                            <img style="margin-left: 70px" src="images/profile_Img.png"
                                                                 alt="image not found">
                                                        <?php } ?>
                                                    </center>
                                                </div>
                                                <?php if (!empty($user->actorAttributes)) { ?>
                                                    <div class="col-md-7" style="margin-top: 10px;">
                                                        <!-- profileDetail_right start -->
                                                        <div class="profileInfo_right col-md-12 col-sm-12 col-sm-12">
                                                            <h5 class="m-zero col-md-5 col-sm-12 col-xs-12"><b>Ethnicity
                                                                    :</b>
                                                            </h5>
                                                            <div class="col-md-7 col-sm-12 col-xs-12">
                                                                <span
                                                                    class="col-md-12 col-sm-12 col-xs-13"><?= $user->actorAttributes->ethnicity ?></span>
                                                            </div>
                                                            <br/>
                                                            <h5 class="m-zero col-md-5 col-sm-12 col-xs-12">
                                                                <b>Acting Age :</b>
                                                            </h5>
                                                            <div class="col-md-7 col-sm-12 col-xs-12">
                                                        <span
                                                            class="col-md-12 col-sm-12 col-xs-13"><?= $user->actorAttributes->age_range ?></span>
                                                            </div>
                                                            <br/>
                                                            <h5 class="m-zero col-md-5 col-sm-12 col-xs-12"><b>Height
                                                                    :</b></h5>
                                                            <div class="col-md-7 col-sm-12 col-xs-12">
                                                        <span
                                                            class="col-md-12 col-sm-12 col-xs-13"><?= $user->actorAttributes->height ?></span>
                                                            </div>
                                                            <br/>
                                                            <h5 class="m-zero col-md-5 col-sm-12 col-xs-12"><b>Weight
                                                                    :</b></h5>
                                                            <div class="col-md-7 col-sm-12 col-xs-12">
                                                        <span
                                                            class="col-md-12 col-sm-12 col-xs-13"><?= $user->actorAttributes->weight ?></span>
                                                            </div>
                                                            <br/>
                                                            <h5 class="m-zero col-md-5 col-sm-12 col-xs-12"><b>Hair
                                                                    Color :</b>
                                                            </h5>
                                                            <div class="col-md-7 col-sm-12 col-xs-12">
                                                        <span
                                                            class="col-md-12 col-sm-12 col-xs-13"><?= $user->actorAttributes->hair_color ?></span>
                                                            </div>
                                                            <br/>
                                                            <h5 class="m-zero col-md-5 col-sm-12 col-xs-12"><b>Eye Color
                                                                    :</b>
                                                            </h5>
                                                            <div class="col-md-7 col-sm-12 col-xs-12">
                                                        <span
                                                            class="col-md-12 col-sm-12 col-xs-13"><?= $user->actorAttributes->eye_color ?></span>
                                                            </div>
                                                            <br/>
                                                            <h5 class="m-zero col-md-5 col-sm-12 col-xs-12"><b>Build
                                                                    :</b></h5>
                                                            <div class="col-md-7 col-sm-12 col-xs-12">
                                                        <span
                                                            class="col-md-12 col-sm-12 col-xs-13"><?= $user->actorAttributes->build ?></span>
                                                            </div>
                                                        </div><!-- profileDetail_right end -->
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <?= $form->field($application_model, 'request_from_id')->hiddenInput(['value' => $user->id])->label(false) ?>
                                            <?= $form->field($application_model, 'request_to_id')->hiddenInput(['value' => $model->posted_by_id])->label(false) ?>
                                            <?= $form->field($application_model, 'project_id')->hiddenInput(['value' => $model->id])->label(false) ?>
                                            <?= $form->field($application_model, 'available_role')->hiddenInput(['value' => $role->available_role])->label(false) ?>
                                            <?= $form->field($application_model, 'message')->textarea([
                                                'value' => 'Hello,' . "\n\n" . 'I believe I would be a good match for your project and the available role' . "\n\n" . 'Thank You',
                                                'style' => '',
                                                'rows' => '6'
                                            ]) ?>
                                        </div>
                                        <div class="modal-footer">
                                            <?= Html::submitButton('Apply', ['class' => 'btn btn-success']) ?>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php $count++;
                        } ?>
                    </div>
                    <div class="col-md-3">
                        <center style="margin-top: 10px">
                            <b>Production date</b><br/>
                            <?= date("M d, Y", strtotime($model->production_date_from)); ?>
                        </center>
                        <center style="margin: 10px 0">
                            <b>Location</b><br/>
                            <?= $model->venue ?>
                        </center>
                    </div>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-md-12">
                    <a class="btn-other-projects" href="<?= Yii::$app->urlManager->createUrl(["site/projects"]) ?>"
                       style="color: #fff">
                        Other Projects
                    </a>
                </div>
            </div>
        </div>
    </div><!-- container ends here -->
</div><!-- container-fluid ends here -->