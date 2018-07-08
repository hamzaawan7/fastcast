<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 12/23/2016
 * Time: 4:20 AM
 */
?>
<div class="row p-zero">
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
                <?= isset($actor->demo_reel) ? '<a href=' . $actor->demo_reel . ' target="_blank"><span> Demo Reel </span></a>' : '<br/>' ?>
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