<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 2/24/2017
 * Time: 12:18 AM
 */
use app\models\Notifications;
use app\models\RoleApplications;

?>

<!--- navbar starts here --->
<nav class="navbar extraP navBg col-md-12">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed pull-left" data-toggle="collapse"
                data-target="#navbar1" aria-expanded="false">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div id="navbar1" class="navbar-collapse collapse">
        <ul class="nav navbar-nav p-zero">
            <li <?= (!empty($highlight) && $highlight == 'home') ? 'class="active"' : '' ?>>
                <a href="<?= Yii::$app->urlManager->createUrl(['site/home']) ?>">Home</a>
            </li>
            <li <?= (!empty($highlight) && $highlight == 'actors') ? 'class="active"' : '' ?>>
                <a href="<?= Yii::$app->urlManager->createUrl(['site/actors']) ?>">Actors</a>
            </li>
            <li <?= (!empty($highlight) && $highlight == 'filmmakers') ? 'class="active"' : '' ?>>
                <a href="<?= Yii::$app->urlManager->createUrl(['site/filmmakers']) ?>">Filmmakers/crews</a>
            </li>
            <li <?= (!empty($highlight) && $highlight == 'projects') ? 'class="active"' : '' ?>>
                <a href="<?= Yii::$app->urlManager->createUrl(['site/projects']) ?>">Browse Projects</a>
            </li>
            <?php if (!empty($model)) { ?>
                <?php if ($model->type == "Filmmaker") { ?>
                    <li class="dropdown <?= (!empty($highlight) && ($highlight == 'requests' || $highlight == 'roles')) ? 'active' : '' ?>">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Requests</a>
                        <ul class="dropdown-menu">
                            <li <?= (!empty($highlight) && $highlight == 'requests') ? 'class="active"' : '' ?>>
                                <a href="<?= Yii::$app->urlManager->createUrl(['site/requests']) ?>">
                                    Partitcipation Requests
                                <span style="color:red">
                                    (<?= count(Notifications::find()->where(['message_to_id' => $model->id])->all()) ?>)
                                </span>
                                </a>
                            </li>
                            <?php if ($model->type == "Filmmaker" && $model->email_verified) { ?>
                                <li <?= (!empty($highlight) && $highlight == 'roles') ? 'class="active"' : '' ?>>
                                    <a href="<?= Yii::$app->urlManager->createUrl(['site/role-requests']) ?>">
                                        Roles Applications
                                    <span style="color:red">
                                        (<?= count(RoleApplications::find()->where(['request_to_id' => $model->id])->all()) ?>
                                        )
                                    </span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li <?= (!empty($highlight) && $highlight == 'requests') ? 'class="active"' : '' ?>>
                        <a href="<?= Yii::$app->urlManager->createUrl(['site/requests']) ?>">
                            Partitcipation Requests
                        <span <?= (!empty($highlight) && $highlight == 'requests') ? 'style="color:red"' : 'style="color:yellow"' ?>>
                            (<?= count(Notifications::find()->where(['message_to_id' => $model->id])->all()) ?>)
                        </span>
                        </a>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div><!--/.nav-collapse -->

    <?php if (!empty($model)) { ?>
        <?php if ($model->type == "Filmmaker" && $model->email_verified) { ?>
            <a href="<?= Yii::$app->urlManager->createUrl(['project/new']) ?>"
               class="navbar-form navbar-right p-zero col-md-3 col-sm-3 col-xs-3">
                <button type="button" class="btn btn-primary">POST CASTING</button>
            </a>
        <?php } ?>
    <?php } else { ?>
        <a href="<?= Yii::$app->urlManager->createUrl(['site/signup']) ?>"
           class="navbar-form navbar-right p-zero col-md-3 col-sm-3 col-xs-3">
            <button type="button" class="btn btn-primary">POST CASTING</button>
        </a>
    <?php } ?>

</nav>
<!--- navbar ends here --->
