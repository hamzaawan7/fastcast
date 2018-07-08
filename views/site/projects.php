<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 11/29/2016
 * Time: 5:44 PM
 */
use app\components\ActorDisplayWidget;
use app\components\HomeHeaderContentWidget;
use app\components\NavbarWidget;
use app\components\ProjectSearchWidget;
use app\components\SimpleSearchWidget;
use app\components\StringsHelper;
use app\models\Notifications;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'FastCast - Find an Actor, without the Drama';
?>
<!--- headerTop starts here --->
<div class="container-fluid">
    <?= HomeHeaderContentWidget::widget(['model' => !empty($user) ? $user : '']); ?>
    <!--- logo starts here --->
    <div class="row p-zero">
        <div class="logoTop col-md-12">
            <a href="<?= Yii::$app->urlManager->createUrl(['']) ?>">
                <span><img src="images/logoTop.png" alt="image not found"></span>
            </a>
        </div>
    </div>
    <!--- logo ends here --->


    <?= NavbarWidget::widget(['model' => !empty($user) ? $user : '' , 'highlight' => 'projects']); ?>

</div><!--- header ends here --->


<!--- mainBody_container starts here --->
<div class="container-fluid p-zero">
    <!--- main_wrapper starts here --->
    <div class="container p-zero">
        <!--- find_Person_Category starts here --->
        <div class="row">
            <?= SimpleSearchWidget::widget(); ?>
        </div>
        <!--- find_Person_Category ends here --->

        <div class="row p-zero">
            <div class="featuredActor col-md-12 pull-left">
                <div class="col-md-12 p-zero">
                    <h4>Projects</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <?= ProjectSearchWidget::widget(); ?>
                        </div>
                        <div class="col-md-10">
                            <?php $count = 0; ?>
                            <?php foreach ($projects as $project) {
                            if ($count % 4 == 0) {
                            ?>
                            <div class="itemProject_detail col-md-12" style="margin: 20px 0"><?php
                                }
                                ?>
                                <center>
                                    <div class="col-md-3 col-xs-12">
                                        <a href="<?= Yii::$app->urlManager->createUrl(['project/view', 'pn' => base64_encode($project->id)]) ?>">
                                            <img src="<?= 'images/projects/' . $project->image ?>"
                                                 class="img-responsive" alt="Image"/>
                                            <h5><?= $project->name_of_production ?></h5>
                                        </a>
                                        <?= !empty($project->type) ? '<b>' . $project->type . '</b><br/>' : '' ?>
                                        <?= !empty($project->year) ? '<b>Year : </b>' . $project->year : '' ?>
                                    </div>
                                </center>
                                <?php
                                if ($count % 4 == 3) {
                                    echo '</div>';
                                }
                                $count++;
                                ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--- row --->
        </div><!-- end container -->
    </div><!--- ends main_container here --->