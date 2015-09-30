<?php

namespace itway\Http\Controllers;

//use Illuminate\Http\Request;
use itway\Http\Requests;
use itway\Http\Controllers\Controller;
use Itway\Repositories\Users\UserRepository;
use Itway\Repositories\Posts\PostsRepository;
use \Illuminate\Http\Request;

class AdminPostsController extends Controller
{


    public function __construct(UserRepository $userRepository, PostsRepository $postRepository)
    {
        $this->userRepository = $userRepository;
        $this->postRepository = $postRepository;

    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $posts = $this->postRepository->allOrSearch($request->get('q'));

        $countUserPosts = $this->postRepository->countUserPosts();

        return view('admin.posts.posts',compact('posts','countUserPosts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
