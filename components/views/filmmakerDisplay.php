<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 12/23/2016
 * Time: 4:20 AM
 */
?>
<div class="row p-zero">
    <div class="itemActor_detail col-md-12 p-zero">
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
</div>