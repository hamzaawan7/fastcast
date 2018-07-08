<?php
/**
 * Created by PhpStorm.
 * User: DELl
 * Date: 2/17/2017
 * Time: 12:35 AM
 */
?>

<form action="<?= Yii::$app->urlManager->createUrl(["site/project-search"]) ?>" method="post">
    <input type="hidden" name="_csrf">
    <div class="find_Person_Category col-md-12">
        <div class="findPerson dropdown col-md-12 col-xs-12" style="margin:20px 0">
            <select name="pgenre">
                <option <?php if ($genre == "All") { ?>selected="true" <?php }; ?> value="All">All</option>
                <option <?php if ($genre == "Ads/Commercials") { ?>selected="true" <?php }; ?> value="Ads/Commercials">Ads/Commercials</option>
                <option <?php if ($genre == "Action") { ?>selected="true" <?php }; ?> value="Action">Action</option>
                <option <?php if ($genre == "Adventure") { ?>selected="true" <?php }; ?> value="Adventure">Adventure</option>
                <option <?php if ($genre == "Biography") { ?>selected="true" <?php }; ?> value="Biography">Biography</option>
                <option <?php if ($genre == "Comedy") { ?>selected="true" <?php }; ?> value="Comedy">Comedy</option>
                <option <?php if ($genre == "Crime") { ?>selected="true" <?php }; ?> value="Crime">Crime</option>
                <option <?php if ($genre == "Drama") { ?>selected="true" <?php }; ?> value="Drama">Drama</option>
                <option <?php if ($genre == "Family") { ?>selected="true" <?php }; ?> value="Family">Family</option>
                <option <?php if ($genre == "Fantasy") { ?>selected="true" <?php }; ?> value="Fantasy">Fantasy</option>
                <option <?php if ($genre == "Film-Noir") { ?>selected="true" <?php }; ?> value="Drama">Film-Noir</option>
                <option <?php if ($genre == "History") { ?>selected="true" <?php }; ?> value="History">History</option>
                <option <?php if ($genre == "Horror") { ?>selected="true" <?php }; ?> value="Horror">Horror</option>
                <option <?php if ($genre == "Music") { ?>selected="true" <?php }; ?> value="Music">Music</option>
                <option <?php if ($genre == "Musical") { ?>selected="true" <?php }; ?> value="Musical">Musical</option>
                <option <?php if ($genre == "Mystery") { ?>selected="true" <?php }; ?> value="Mystery">Mystery</option>
                <option <?php if ($genre == "Romance") { ?>selected="true" <?php }; ?> value="Romance">Romance</option>
                <option <?php if ($genre == "Sci-Fi") { ?>selected="true" <?php }; ?> value="Sci-Fi">Sci-Fi</option>
                <option <?php if ($genre == "Sports") { ?>selected="true" <?php }; ?> value="Sports">Sports</option>
                <option <?php if ($genre == "Thriller") { ?>selected="true" <?php }; ?> value="Thriller">Thriller</option>
                <option <?php if ($genre == "War") { ?>selected="true" <?php }; ?> value="War">War</option>
                <option <?php if ($genre == "Western") { ?>selected="true" <?php }; ?> value="Western">Western</option>
            </select>
        </div>
            <span class="dropdown col-md-12 col-xs-9"  style="margin:5px 0">
              <select name="ptype">
                <option <?php if ($type == "All") { ?>selected="true" <?php }; ?> value="All">All</option>
                <option <?php if ($type == "Completed") { ?>selected="true" <?php }; ?> value="Completed">Completed</option>
                <option <?php if ($genre == "Active") { ?>selected="true" <?php }; ?> value="Active">Active</option>
                <option <?php if ($genre == "Featured") { ?>selected="true" <?php }; ?> value="Featured">Featured</option>
              </select>
            </span>
        <div class="col-md-1 col-xs-3" style="margin:10px 0">
            <button type="submit" class="glyphicon glyphicon-search fa-300px bg-primary navBg">
            </button>
        </div>
    </div>
</form>