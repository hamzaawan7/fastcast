<?php

/* @var $this yii\web\View */

$this->title = 'Welcome to FastCast';
?>

<div class="welcome_bgWrapper">

    <div class="welcome_wrapper">
        <div class="container">
            <!-- main_container starts here -->


            <!-- header_wrapper starts here -->
            <div class="welcome_header_top">

                <div class="row">


                    <!--	<div class="col-md-md col-sm-12">&nbsp;</div>	-->
                    <!-- header_middleSec starts here -->
                    <div class="col-md-4 col-md-offset-4 col-sm-12 pR0">
                        <div class="brand_logo animated slideInDown">
                            <a href="<?php echo Yii::$app->urlManager->createUrl(array('site/home')) ?>">
                                <h1>FastCast</h1>
                                <p>Find an actor, without the drama</p>
                            </a>
                        </div>
                    </div><!-- brand_logo ends here -->

                    <div class="col-md-4 col-sm-12">
                        <div class="header_search">
                            <span>
                                <a href="<?php echo Yii::$app->urlManager->createUrl(array('site/login')) ?>">
                                    Login
                                </a>
                            </span>
                            <a href="<?php echo Yii::$app->urlManager->createUrl(array('site/signup')) ?>">
                                <button type="button" id="singUp_button" value="singUp">SIGN UP
                                </button>
                            </a>
                        </div>
                    </div>
                    <!--==== header_search ends here ====-->

                </div>
            </div>

            <!--==== header_wrapper ends here ===-->


            <!--============== body starts here ==============-->


            <!--- bodyContainer starts here --->
            <div class="bodyWrapper">
                <div class="row">

                    <div class="col-md-6 col-sm-12">
                        <div class="body_leftSec animated slideInLeft">
                            <h1>Post a casting</h1>
                            <p>with full detail</p>
                            <a href="<?= Yii::$app->urlManager->createUrl(array('users/register', 'type' => 'Filmmaker')) ?>">
                                <button type="button" value="postCasting">
                                    Post Casting
                                </button>
                            </a>
                        </div>

                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="body_rightSec animated slideInRight">
                            <h1>Contact actors</h1>
                            <p>fast and easy</p>
                            <a href="<?= Yii::$app->urlManager->createUrl(array('site/actors')) ?>">
                                <button type="button" value="findActor">
                                    Find an actor
                                </button>
                            </a>
                        </div>
                    </div>


                </div>
                <!-- bodyWrapper ends here -->
            </div>
            <!-- bodyContainer ends here -->

        </div><!-- welcome_wrapper ends here -->
    </div>
</div><!-- welcome_bgWrapper ends here -->