<?php

use app\components\DropDownHelper;
use app\models\ActiveProjectRoles;
use budyaga\cropper\Widget;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-12">
    <div class="col-md-2"></div>
    <div class="col-md-8" style="background-color: #fff; margin:20px 0; border-radius: 6px">
        <div class="col-md-12">
            <h2>
                <center><?= $model->isNewRecord ? 'Add a new Project' : 'Update the Project' ?></center>
            </h2>
            <hr/>
            <?php $form = ActiveForm::begin([
                'id' => 'form-profile2',
                'options' => ['enctype' => 'multipart/form-data'],
                'fieldConfig' => [
                    'template' => "{label}{input}{error}",
                    'labelOptions' => ['class' => 'control-label'],
                ]
            ]); ?>

            <?= $form->field($model, 'image')->label(false)->widget(Widget::className(), [
                'uploadUrl' => Url::toRoute('/project/uploadPhoto'),
            ]) ?>

            <div class="col-md-12">
                <?= $form->field($model, 'name_of_production')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-8">
                <?= $form->field($model, 'type')->dropDownList(DropDownHelper::getGenreTypes()) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'status')->dropDownList(DropDownHelper::getProjectStatus($user), ['id' => 'project_type']) ?>
            </div>

            <div class="col-md-8">
                <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'venue')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-7">
                <?= $form->field($model, 'is_union')->radioList(['0' => 'Non-union', '1' => 'Union'], ['separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',])->label(false) ?>
            </div>
            <div class="col-md-5">
                <?= $form->field($model, 'is_paid')->radioList(['0' => 'Not Paid', '1' => 'Paid'], ['separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',])->label(false) ?>
            </div>

            <div class="col-md-12">
                <?= $form->field($model, 'summary')->textarea() ?>
            </div>

            <div id="role_request">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-5">
                            <?= $form->field($model, 'production_date_from')->widget(
                                DatePicker::className(), [
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ]); ?>
                        </div>
                        <div class="col-md-2" style="margin-top: 5%">
                            <center><b>to</b></center>
                        </div>
                        <div class="col-md-5" style="margin-top: 4%">
                            <?= $form->field($model, 'production_date_to')->widget(
                                DatePicker::className(), [
                                'clientOptions' => [
                                    'autoclose' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ])->label(false); ?>
                        </div>
                    </div>
                </div>
                <?php if (!$model->isNewRecord) {
                    $available_roles = ActiveProjectRoles::find()->where(['project_id' => $model->id])->all();
                    foreach ($available_roles as $role) { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Available Role</label>
                                        <?= Html::textInput('UpdatedActiveProjects[available_role][]', $role->available_role, ['id' => 'available_request_role', 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="col-md-12">
                                        <center><label>Age (Years)</label></center>
                                        <div class="col-md-5 pz">
                                            <div class="form-group">
                                                <?= Html::textInput('UpdatedActiveProjects[age_from][]', $role->age_from, ['id' => 'age_from', 'class' => 'form-control']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding: 3px">
                                            <center><b>-</b></center>
                                        </div>
                                        <div class="col-md-5 pz">
                                            <div class="form-group">
                                                <?= Html::textInput('UpdatedActiveProjects[age_to][]', $role->age_to, ['id' => 'age_to', 'class' => 'form-control']) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <?= Html::dropDownList('UpdatedActiveProjects[gender][]', $role->gender, ['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'], ['id' => 'available_request_role', 'class' => 'form-control', 'prompt'=>'--select--']) ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Role Description</label>
                                        <?= Html::textarea('UpdatedActiveProjects[role_description][]', $role->role_description, ['id' => 'role_description', 'class' => 'form-control']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
                <div id="roles">
                    <div class="row" id="available_role">
                        <div class="col-md-12">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label>Available Role</label>
                                    <?= Html::textInput('ActiveProjects[available_role][]', '', ['id' => 'available_request_role', 'class' => 'form-control']) ?>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="col-md-12">
                                    <center><label>Age (Years)</label></center>
                                    <div class="col-md-5 pz">
                                        <div class="form-group">
                                            <?= Html::textInput('ActiveProjects[age_from][]', '', ['id' => 'age_from', 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="padding: 3px">
                                        <center><b>-</b></center>
                                    </div>
                                    <div class="col-md-5 pz">
                                        <div class="form-group">
                                            <?= Html::textInput('ActiveProjects[age_to][]', '', ['id' => 'age_to', 'class' => 'form-control']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <?= Html::dropDownList('ActiveProjects[gender][]', '', ['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'], ['id' => 'available_request_role', 'class' => 'form-control', 'prompt'=>'--select--']) ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Role Description</label>
                                    <?= Html::textarea('ActiveProjects[role_description][]', '', ['id' => 'role_description', 'class' => 'form-control']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <a id="add_role" class="add-available-role">+Add another role</a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="project_year" class="hidden">
                <div class="col-md-12">
                    <?= $form->field($model, 'year')->textInput() ?>
                </div>
            </div>

            <?php if ($model->isNewRecord) { ?>
                <div class="col-md-12">
                    <?= $form->field($upmodel, 'role')->dropDownList(DropDownHelper::getProjectRemainingRoles(), ['id' => 'role_type', 'prompt' => '-- select --']) ?>
                </div>
                <div class="hidden" id="char_name">
                    <div class="col-md-12">
                        <?= $form->field($upmodel, 'character_name')->textInput() ?>
                    </div>
                </div>
            <?php } ?>

            <div class="col-md-12">
                <?= $form->field($model, 'video_url')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn', 'style' => 'width: 100%;background-color:#134e6c !important; color: #fff']) ?>
                </div>
            </div>

        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-2"></div>
</div>