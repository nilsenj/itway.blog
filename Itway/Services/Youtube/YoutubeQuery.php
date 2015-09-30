<?php
/**
 * Created by PhpStorm.
 * User: nilsenj
 * Date: 9/26/2015
 * Time: 12:46 PM
 */

namespace Itway\Services\Youtube;

use Itway\Services\Youtube\Facades\Youtube;


trait YoutubeQuery
{
    public function searchYoutubeRelated(array $tagList){


        try {
            $videos = [];
            foreach ($tagList as $key => $tag) {
                try {
                    $videos[$key] = $this->videoGenerator($tag)[0];
                } catch (\ErrorException $e) {
                    return false;
                }


            }
            $vids = [];
            if (count($videos)) {
                foreach ($videos as $key => $video) {
                    $vids[$key] = $video->id->videoId;
                }

                return $vids;
            }
            else return false;

        }catch (\ErrorException $e) {
            return false;
        }



    }


    private function videoGenerator($tag)
    {
//        dd(\App::getLocale());
        try {
            if (\App::getLocale() === "ru") {

                if(count($tag) > 0) {
                    $videos = Youtube::searchVideos($tag, 50, "RU");

                    $videos = $videos[rand(count($tag) >= 1 ? 1 : 0, count($tag) >= 49 ? 49 : count($videos))];
                }
                else return false;

            } else {
                if(count($tag) > 0) {
                    $videos = Youtube::searchVideos($tag, 50, "US");
                    $videos = $videos[rand(count($tag) >= 1 ? 1 : 0, count($tag) >= 49 ? 49 : count($videos))];

                }
                else return false;

            }


            return [$videos];

        }

        catch (\ErrorException $e) {
            return false;
        }
}

}