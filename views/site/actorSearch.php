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
use app\components\SimpleSearchWidget;
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


    <?= NavbarWidget::widget(['model' => !empty($user) ? $user : '' , 'highlight' => 'actors']); ?>

</div><!--- header ends here --->


<!--- mainBody_container starts here --->
<div class="container-fluid p-zero">
    <!--- main_wrapper starts here --->
    <div class="container p-zero">
        <!--- find_Person_Category starts here --->
        <div class="row">
            <?= SimpleSearchWidget::widget(['query' => (!is_null($query)) ? $query : '']); ?>
        </div>
        <!--- find_Person_Category ends here --->

        <div class="row p-zero">
            <div class="featuredActor col-md-12">
                <div class="col-md-12 p-zero">
                    <h4>Actors</h4>
                </div>
                <?php if (!empty($actors) && $query) { ?>
                <?php $count = 0; ?>
                <?php foreach ($actors as $actor) {
                    if ($count % 6 == 0) {
                        echo '<div class="itemActor_detail col-md-12 p-zero">';
                    }
                    ?>
                    <center>
                        <div class="col-md-2 col-xs-12">
                            <a href="<?= Yii::$app->urlManager->createUrl(['users/view-profile', 'email' => $actor->email]) ?>">
                                <?php if (!empty($actor->profile_picture)) { ?>
                                    <img src="<?php echo 'images/profile_pics/' . $actor->profile_picture ?>"
                                         class="img-responsive" alt="Image"/>
                                <?php } else { ?>
                                    <img src="<?= 'images/profile_Img.png' ?>" class="img-responsive" alt="Image"/>
                                <?php } ?>
                                <h5><?= $actor->name ?></h5>
                            </a>
                            <p>
                                <a href="<?= Yii::$app->urlManager->createUrl(['users/view-profile', 'email' => $actor->email]) ?>"><span> View Profile </span></a>
                            </p>
                            <?= isset($actor->demo_reel) ? '<a href=' . $actor->demo_reel . '><span> Demo Reel </span></a>' : '<br/>' ?>
                        </div>
                    </center>
                    <?php
                    if ($count % 6 == 5) {
                        echo '</div>';
                    }
                    $count++;
                    ?>
                <?php } ?>
            </div>
            <?php } else { ?>
                <h5 style="font-weight: 600;padding :50px 30px">Sorry, none of the Actor Name matches "<?= $query ?>
                    "</h5>
            <?php } ?>
        </div>

    </div><!-- end container -->
</div><!--- ends main_container here --->