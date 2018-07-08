<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="description" content="FastCast - Find an Actor, Without the Drama">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="icon" href="images/fav.ico" type="image/x-icon">
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapper">
    <?= $content ?>
    <div class="push"></div>
</div>
<?php if (Yii::$app->controller->action->id != "login") { ?>
    <?php if (Yii::$app->controller->action->id != "signup") { ?>
        <?php if (Yii::$app->controller->action->id != "register") { ?>
            <?php if (Yii::$app->controller->action->id != "index") { ?>
                <?php if (Yii::$app->controller->action->id != "error") { ?>
                    <div class="terms-contact">
                    <div class="row footer-bg">
                        <div class="col-md-12">
                            <div class="contact-gmail">
                                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=fastcast.ca@gmail.com" target="_blank">Having trouble using the site? Email us!</a>
                            </div>
                            <div class="terms">
                                <a href="<?= Yii::$app->urlManager->createUrl(['site/terms-and-conditions'])?>" target="_blank">Terms and conditions</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <footer class="footer">
                        <div class="row footer-bg">
                            <div class="col-md-12">
                                <div class="copyright">
                                    Copyright &copy Fascast 2017. All rights reserved.
                                </div>
                                <div class="powered">
                                    Powered by SPG Media
                                </div>
                            </div>
                        </div>
                    </footer>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
<?php } ?>
<?php $this->endBody() ?>
</body>
<script>
    $(document).ready(function(){
        var type = $("#project_type").val();
        if (type == 'Active') {
            $("#role_request").removeClass("hidden");
            $("#project_year").addClass("hidden");
        } else {
            $("#role_request").addClass("hidden");
            $("#project_year").removeClass("hidden");
        }

        $(window).resize(function(){
            var footerHeight = $('.footer').outerHeight();
            var stickFooterPush = $('.push').height(footerHeight);

            $('.wrapper').css({'marginBottom':'-' + footerHeight + 'px'});
        });

        $(window).resize();

        $("#project_type").change(function (e) {
            var type = $(this).val();
            if (type == 'Active') {
                $("#role_request").removeClass("hidden");
                $("#project_year").addClass("hidden");
            } else {
                $("#role_request").addClass("hidden");
                $("#project_year").removeClass("hidden");
            }
        });

        $("#role_type").change(function (e) {
            var type = $(this).val();
            if (type == 'Actor') {
                $("#char_name").removeClass("hidden");
            } else {
                $("#char_name").addClass("hidden");
            }
        });
        $("#add_role").click(function () {
            var id = "available_role";
            $("#available_role").clone().attr('id', id += 1)
                .find("input:text").val("").end()
                .find("textarea").val("").end()
                .appendTo("#roles");
        });

        $("#add_skill").click(function () {
            var id = "skills";
            $("#skill").clone().attr('id', id += 1)
                .find("input:text").val("").end()
                .appendTo("#skills");
        });

    });
</script>
</html>
<?php $this->endPage() ?>
