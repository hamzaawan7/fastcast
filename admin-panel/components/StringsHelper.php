<?php
/**
 * Created by PhpStorm.
 * User: umairawan
 * Date: 31/12/16
 * Time: 3:54 PM
 */
// ---

namespace app\components;

use app\models\UserProjects;
use Yii;
use yii\helpers\Url;

class StringsHelper
{
    static public function getYoutubeVimeoLink($videoLink)
    {
        $embed = '';
        if (strpos($videoLink, 'youtube') !== false) {
            if (preg_match('/https:\/\/(?:www.)?(youtube).com\/watch\\?v=(.*?)/', $videoLink)) {
                $embed = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "http://www.youtube.com/embed/$1", $videoLink);
            }
        } else if (strpos($videoLink, 'vimeo') !== false) {
            if (preg_match('/https:\/\/vimeo.com\/(\\d+)/', $videoLink, $regs)) {
                $embed = 'http://player.vimeo.com/video/' . $regs[1];
            }
        } else {
            return false;
        }
        return $embed;
    }
}