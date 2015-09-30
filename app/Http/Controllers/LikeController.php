<?php

namespace itway\Http\Controllers;

use Auth;
use itway\Http\Requests;
use nilsenj\Toastr\Facades\Toastr;


class LikeController extends Controller
{
    use \Illuminate\Console\AppNamespaceDetectorTrait;

    /**
     * like-Action to call with class_name and object_id
     *
     * @return null
     */
    public function likeORdis($class_name, $object_id)
    {

        if (Auth::user()) {
            $class_name = "\\" . self::getAppNamespace() . ucfirst($class_name);

            $object = $class_name::find($object_id);

            if ($object->liked(Auth::user())) {


                    if ($object->dislike(\Auth::user()))

                        $type = "disliked";

                    else {

                        $type = "error";
                    }

                    return \Response::json([$type, $object->getLikeCount()]);
                }

             else {
                if ($object->like(\Auth::user()))

                    $type = "liked";

                else {
                    $type = "error";
                }

                return \Response::json([$type, $object->getLikeCount(), trans("messages.liked")]);

            }
        }
        else {

                Toastr::warning("please login or register to LIKE or DISLIKE!", $title = "login required", $options = []);
                return \Response::json("error");

            }

            }

}
