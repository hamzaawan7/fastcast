<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
            'fieldConfig' => [
                'labelOptions' => ['class' => 'control-label', 'style' => 'color:#fff'],
            ],
        ]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->dropDownList(['' => '-- select --', 'Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other']) ?>

    <?= $form->field($model, 'contact_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_union')->dropDownList(['1' => 'Yes', '0' => 'No']) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn' : 'btn btn-primary', 'style' => 'width:100%;background-color:#3f4f5f;color:#fff']) ?>
    </div>
    <center>
        <p style="color:#fff">Already a Member of FastCast Community?
            <a href="<?php echo Yii::$app->urlManager->createUrl(array('site/login')) ?>"
               style="color:#3f4f5f">Login</a>
        </p>
    </center>
    <?php ActiveForm::end(); ?>

</div>
