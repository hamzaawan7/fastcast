<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = 'FastCast - Become an Actor';
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
                                <hr style="width: 50%"/>
                            </div>
                            <span class="clearfix"></span>
                            <h4 style="color:#fff">Fill the following fields to Become a Member</h4>
                        </center>
                        <div class="users-create">
                            <?= $this->render('_form', [
                                'model' => $model,
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>