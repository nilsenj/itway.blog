<?php

namespace itway\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use itway\Http\Requests;
use itway\Http\Controllers\Controller;
use itway\Post;

class SearchController extends Controller
{
    /**
     * @param Post $post
     */
    public function __construct(Post $post){
        $this->post = $post;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function executeSearch(Request $request) {

        if($request->ajax() && $request->get('keywords') !== "") {

            $keywords = $request->get('keywords');

            $search = $this->post->latest('published_at')->published()->search($keywords)->with('user')->with('tagged')->get();

            return view('pages.search-response', compact('search'));
        }
        else if($request->get('keywords') === ""){
                return response()->json(['noting chosen']);
        }
        return response("error", 404);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function getAllExistingTags(Request $request){

        if($request->ajax()) {
            $tags = $this->post->existingTags();
            return view('pages.all-tags', compact('tags'));
        }
        else {
            return response("error", 404);
        }
    }
}
