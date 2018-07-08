<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 12/23/2016
 * Time: 4:20 AM
 */
?>
<!--- otherProject start --->
<div class="row">
    <div class="otherProject col-lg-12">
        <h2 class="bg_default">
            Projects
            <?php if ($model->id == Yii::$app->user->id) { ?>
                <a class="greenText" style="font-size: 13px"
                   href="<?= Yii::$app->urlManager->createUrl(["project/new"]) ?>">
                    (+ Add)
                </a>
            <?php } ?>
        </h2>
        <div class="table-responsive">
            <table class="table col-lg-12">
                <thead>
                <tr>
                    <th class="col-md-3 col-xs-3">Name of Production</th>
                    <th class="col-md-3 col-xs-3">Role / Type</th>
                    <th class="col-md-3 col-xs-3">Company</th>
                    <th class="col-md-2 col-xs-2">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $count = 0;
                foreach ($model->userProjects as $userProject) { ?>
                    <tr>
                        <td class="greenText">
                            <a href="<?= Yii::$app->urlManager->createUrl(['project/view', 'pn' => base64_encode($userProject->project->id)]) ?>"><?= $userProject->project->name_of_production ?></a>
                        </td>
                        <td class="greenText">
                            <a href="<?= Yii::$app->urlManager->createUrl(['users/view-profile', 'email' => $model->email]) ?>"><?= $userProject->role ?></a>
                            <p><?= $userProject->project->type ?></p>
                        </td>
                        <td>
                            <?= $userProject->project->company ?>
                        </td>
                        <td>
                            <?= $userProject->project->status ?>
                        </td>
                    </tr>
                    <?php
                    $count++;
                    if ($count > 4) {
                        break;
                    }
                } ?>
                <?php if (!empty($model->userProjects)) { ?>
                    <tr>
                        <td colspan="12" style="text-align:center;">
                        <span class="greenText">
                            <a href="<?= Yii::$app->urlManager->createUrl(['site/user-projects', 'email' => $model->email]) ?>">
                                see more
                            </a>
                        </span>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </div><!--- otherProject start --->
</div><!-- row end -->