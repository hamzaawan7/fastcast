<?php

use app\components\DropDownHelper;
use app\components\StringsHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserProjects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-12">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="col-md-12" style="background-color: #fff; margin:20px 0; border-radius: 6px">
            <h2>
                <center><?= $model->isNewRecord ? 'Add a New Project Role' : 'Update a User Role' ?></center>
            </h2>
            <hr/>
            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'fieldConfig' => [
                    'template' => "{label}{input}{error}",
                    'labelOptions' => ['class' => 'control-label'],
                ]
            ]); ?>
            <div class="col-md-12">
                <?= $form->field($model, 'role')->dropDownList(DropDownHelper::getProjectRemainingRoles(base64_decode($_GET['pn'])), ['prompt' => '-- select --']) ?>
            </div>
            <?php if ($user->type == "Actor") { ?>
                <div class="col-md-12">
                    <?= $form->field($model, 'character_name')->textInput() ?>
                </div>
            <?php } ?>
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitButton('Add Role', ['class' => 'btn', 'style' => 'width: 100%;background-color:#134e6c !important; color: #fff']) ?>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-2"></div>
</div>
