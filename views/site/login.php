<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'FastCast - Login';
$this->registerCssFile('css/login.css');
?>
<div class="container-fluid">
    <div class="row p-zero">
        <div class="col-md-12 p-zero">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="credential-box">
                    <div class="container-fluid">
                        <center>
                            <div style="color:#fff">
                                <a style="color: #fff; text-decoration: none" href="<?php echo Yii::$app->urlManager->createUrl(array(''))?>"><h1>FastCast</h1></a>
                                <p>Find an actor, without the drama</p>
                            </div>
                            <hr/>
                            <h4 style="color:#fff">Please provide credentials to Login</h4>
                        </center>
                        <div class="container-fluid">
                            <?php $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'layout' => 'horizontal',
                                'fieldConfig' => [
                                    'template' => "{label}{input}{error}",
                                    'labelOptions' => ['class' => 'control-label', 'style' => 'color:#fff'],
                                ],
                            ]); ?>

                            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                            <?= $form->field($model, 'password')->passwordInput() ?>

                            <?= $form->field($model, 'rememberMe')->checkbox([
                                'template' => "<div class=\"\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                            ]) ?>

                            <div class="form-group">
                                <?= Html::submitButton('Login', ['class' => 'btn', 'style' => 'width:100%;background-color:#3f4f5f;color:#fff', 'name' => 'login-button']) ?>
                            </div>
                            <center>
                                <p style="color:#fff">Not a Member of FastCast Community?
                                    <a href="<?php echo Yii::$app->urlManager->createUrl(array('site/signup')) ?>"
                                       style="color:#3f4f5f">SignUp</a>
                                </p>
                            </center>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>
