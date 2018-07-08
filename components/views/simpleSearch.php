<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 2/17/2017
 * Time: 12:35 AM
 */
?>

<form action="<?= Yii::$app->urlManager->createUrl(["site/search"])?>" method="post">
    <input type="hidden" name="_csrf">
    <div class="find_Person_Category col-md-12">
        <div class="findPerson col-md-8 col-xs-12">
            <input name="name" value="<?= $query ?>" placeholder="Find a person or project!"/>
        </div>
                    <span class="dropdown col-md-3 col-xs-9">
                      <select name="type">
                        <option value="1">Actors</option>
                        <option value="2">Filmmakers</option>
                        <option value="3">Projects</option>
                      </select>
                    </span>
        <div class="col-md-1 col-xs-3">
            <button type="submit" class="glyphicon glyphicon-search fa-300px bg-primary navBg"></button>
        </div>
    </div>
</form>