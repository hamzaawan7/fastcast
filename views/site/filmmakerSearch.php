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


    <?= NavbarWidget::widget(['model' => !empty($user) ? $user : '' , 'highlight' => 'filmmakers']); ?>

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
                    <h4>Filmmakers</h4>
                </div>
                <?php if (!empty($filmmakers) && $query) { ?>
                <?php $count = 0; ?>
                <?php foreach ($filmmakers as $filmmaker) {
                    if ($count % 6 == 0) {
                        echo '<div class="itemActor_detail col-md-12 p-zero">';
                    }
                    ?>
                    <center>
                        <div class="col-md-2 col-xs-12">
                            <a href="<?= Yii::$app->urlManager->createUrl(['users/view-profile', 'email' => $filmmaker->email]) ?>">
                                <?php if (!empty($filmmaker->profile_picture)) { ?>
                                    <img src="<?php echo 'images/profile_pics/' . $filmmaker->profile_picture ?>"
                                         class="img-responsive" alt="Image"/>
                                <?php } else { ?>
                                    <img src="<?= 'images/profile_Img.png' ?>" class="img-responsive" alt="Image"/>
                                <?php } ?>
                                <h5><?= $filmmaker->name ?></h5>
                            </a>
                            <?= isset($filmmaker->gender) ? '<p><b>Gender : </b>' . $filmmaker->gender . '</p>' : '<br/>' ?>
                            <?= isset($filmmaker->website_link) ? '<a href=' . $filmmaker->website_link . ' target="_blank"><span> Website Link </span></a><br/>' : '<br/>' ?>
                            <?= isset($filmmaker->demo_reel) ? '<a href=' . $filmmaker->demo_reel . ' target="_blank"><span> Demo Reel </span></a>' : '<br/>' ?>
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
                <h5 style="font-weight: 600;padding :50px  30px">Sorry, none of the Filmmaker Name matches "<?= $query ?>
                    "</h5>
            <?php } ?>
        </div>

    </div><!-- end container -->
</div><!--- ends main_container here --->