<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 11/29/2016
 * Time: 5:44 PM
 */
use app\components\HomeHeaderContentWidget;
use app\components\NavbarWidget;
use app\components\SimpleSearchWidget;
use app\components\StringsHelper;
use app\models\Notifications;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'FastCast - Find an Actor, without the Drama';
?>

<div class="container-fluid">
    <?= HomeHeaderContentWidget::widget(['model' => !empty($user) ? $user : '']); ?>
    <div class="row p-zero">
        <div class="logoTop col-md-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['site/home']) ?>">
                <span><img src="images/logoTop.png" alt="image not found"></span>
            </a>
        </div>
    </div>

    <?= NavbarWidget::widget(['model' => !empty($user) ? $user : '' , 'highlight' => 'home']); ?>

</div>

<div class="container-fluid p-zero">
    <div class="container p-zero">
        <div class="row">
            <?= SimpleSearchWidget::widget(); ?>
        </div>

        <?php if (!empty($featured_projects)) { ?>
            <div class="row">
                <div class="festuredProject col-md-12 p-zero">
                    <div class="col-md-12">
                        <h4>Featured Projects</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <div id="myCarousel" data-ride="carousel" class="carousel slide">
                                <div class="carousel-inner">
                                    <?php $count = 0; ?>
                                    <?php foreach ($featured_projects as $project) {
                                        if ($count % 4 == 0 && $count > 3) {
                                            echo '<div class="item itemProject_detail">';
                                        } else if ($count % 4 == 0) {
                                            echo '<div class="item itemProject_detail active">';
                                        }
                                        ?>
                                        <div class="col-md-3 col-xs-12">
                                            <center>
                                                <a href="<?= Yii::$app->urlManager->createUrl(["project/view", 'pn' => base64_encode($project->id)]) ?>">
                                                    <img src="images/projects/<?= $project->image ?>"
                                                         class="img-responsive"
                                                         alt="Image"/>
                                                    <p><?= $project->name_of_production ?></p>
                                                </a>
                                            </center>
                                        </div>
                                        <?php
                                        if ($count % 4 == 3) {
                                            echo '</div>';
                                        }
                                        $count++;
                                        ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <a class="left carousel-control" role="button" href="#myCarousel" data-slide="prev">
                                <img src="images/slideLeft.png" alt="image not found">
                            </a>
                            <a class="right carousel-control" role="button" href="#myCarousel" data-slide="next">
                                <img src="images/slideRight.png" alt="image not found">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="row p-zero" style="margin: auto 0;">
            <?php if (!empty($featured_actors)) { ?>
                <div class="featuredActor col-md-7 pull-left">
                    <div class="col-md-12 p-zero">
                        <h4>Featured Actors</h4>
                    </div>
                    <div class="row p-zero">
                        <div class="itemActor_detail col-md-12 p-zero" style="margin-bottom:40px;">
                            <?php foreach ($featured_actors as $actor) { ?>
                                <center>
                                    <div class="col-md-3 col-xs-8">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['users/view-profile', 'email' => $actor->email]) ?>">
                                            <?php if (!empty($actor->profile_picture)) { ?>
                                                <img
                                                    src="<?php echo 'images/profile_pics/' . $actor->profile_picture ?>"
                                                    class="img-responsive" alt="Image"/>
                                            <?php } else { ?>
                                                <img src="<?= 'images/profile_Img.png' ?>" class="img-responsive"
                                                     alt="Image"/>
                                            <?php } ?>
                                            <h5><?= $actor->name ?></h5>
                                        </a>
                                        <p>
                                            <a href="<?= Yii::$app->urlManager->createUrl(['users/view-profile', 'email' => $actor->email]) ?>"><span> View Profile </span></a>
                                        </p>
                                        <?= isset($actor->demo_reel) ? '<a href=' . $actor->demo_reel . ' target="_blank"><span> Demo Reel </span></a>' : '<br/>' ?>
                                    </div>
                                </center>
                            <?php } ?>
                        </div>
                        <hr/>
                        <div class="activeProject_bottom row">
                            <a href="<?= Yii::$app->urlManager->createUrl(['site/actors']) ?>"><span class="col-md-12">See all actors</span></a>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($active_projects)) { ?>
                <div class="activeProject col-md-4 pull-right">
                    <div class="col-md-12 p-zero">
                        <h4>Active Projects</h4>
                    </div>
                    <div
                        style="width: 100%; float: left; clear:both; height: 425px; overflow-y: auto; overflow-x: hidden">
                        <?php foreach ($active_projects as $active_project) { ?>
                            <div class="row">
                                <div class="activeProject_detail col-md-12 p-zero">
                                    <div class="activeProject_detailLeft col-md-6 pull-left col-xs-12">
                                        <a href="<?= Yii::$app->urlManager->createUrl(["project/view", 'pn' => base64_encode($active_project->id)]) ?>">
                                            <h5><?= $active_project->name_of_production ?></h5>
                                        </a>
                                        <span><?= substr($active_project->summary, 0, 150) ?>..</span>
                                        <?= (StringsHelper::getDirector($active_project)) ? '<p><b>Directed By : </b>' . StringsHelper::getDirector($active_project) . '</p>' : '' ?>
                                    </div>
                                    <div class="activeProject_detailRight col-md-6 pull-left col-xs-12">
                                        <a href="<?= Yii::$app->urlManager->createUrl(["project/view", 'pn' => base64_encode($active_project->id)]) ?>"><img
                                                src="images/projects/<?= $active_project->image ?>"
                                                class="img-responsive"
                                                alt="Image"/></a>
                                    </div>
                                </div>
                            </div><!--/row1-->
                            <hr/>
                        <?php } ?>
                    </div>
                    <div class="activeProject_bottom row">
                        <a href="<?= Yii::$app->urlManager->createUrl(['site/projects']) ?>"><span class="col-md-12">See all projects</span></a>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($featured_filmmakers)) { ?>
                <div class="featuredActor col-md-7 pull-left">
                    <div class="col-md-12 p-zero">
                        <h4>Featured Filmmakers</h4>
                    </div>
                    <div class="row p-zero">
                        <div class="itemActor_detail col-md-12 p-zero" style="margin-bottom:40px;">
                            <?php foreach ($featured_filmmakers as $filmmaker) { ?>
                                <center>
                                    <div class="col-md-3 col-xs-8">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['users/view-profile', 'email' => $filmmaker->email]) ?>">
                                            <?php if (!empty($filmmaker->profile_picture)) { ?>
                                                <img
                                                    src="<?php echo 'images/profile_pics/' . $filmmaker->profile_picture ?>"
                                                    class="img-responsive" alt="Image"/>
                                            <?php } else { ?>
                                                <img src="<?= 'images/profile_Img.png' ?>" class="img-responsive"
                                                     alt="Image"/>
                                            <?php } ?>
                                            <h5><?= $filmmaker->name ?></h5>
                                        </a>
                                        <p>
                                            <a href="<?= Yii::$app->urlManager->createUrl(['users/view-profile', 'email' => $filmmaker->email]) ?>"><span> View Profile </span></a>
                                        </p>
                                        <?= isset($filmmaker->demo_reel) ? '<a href=' . $filmmaker->demo_reel . ' target="_blank"><span> Demo Reel </span></a>' : '<br/>' ?>
                                    </div>
                                </center>
                            <?php } ?>
                        </div>
                        <hr/>
                        <div class="activeProject_bottom row">
                            <a href="<?= Yii::$app->urlManager->createUrl(['site/filmmakers']) ?>"><span
                                    class="col-md-12">See all filmmakers</span></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>