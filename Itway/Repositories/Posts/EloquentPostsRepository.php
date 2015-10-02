<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 7/20/2015
 * Time: 1:56 AM
 */

namespace Itway\Repositories\Posts;


use itway\Post;
use Auth;
use Illuminate\Contracts\Bus\Dispatcher;
use itway\Commands\CreatePostCommand;
use Itway\Validation\Post\PostsFormRequest;
use Lang;
use itway\Picture;
use Itway\Uploader\ImageUploader;


 class EloquentPostsRepository implements PostsRepository
{
     /**
      * constructor takes Dispatcher and ImageUploader instances
      *
      * @param Dispatcher $dispatcher
      * @param ImageUploader $uploader
      */
     public function __construct(Dispatcher $dispatcher, ImageUploader $uploader){
         $this->dispatcher = $dispatcher;
         $this->uploader = $uploader;
     }

     /**
      * returns simple number for pagination
      *
      * @return int
      */
    public function perPage()
    {
        return 10;
    }

     /**
      * get the model instance
      *
      * @return mixed
      */
    public function getModel()
    {
        $model = Post::class;

        return new $model;
    }

     /**
      * get all posts or search
      *
      * @param null $searchQuery
      * @return mixed
      */
    public function allOrSearch($searchQuery = null)
{
    if (is_null($searchQuery)) {
        return $this->getAll();
    }
    return $this->search($searchQuery);
    }

     /**
      * get all posts that belong to user or search
      *
      * @param null $searchQuery
      * @return mixed
      */
    public function allOrSearchUsers($searchQuery = null)
    {
        if (is_null($searchQuery)) {
            return $this->getAllUsers();
        }
        return $this->search($searchQuery);
    }

     /**
      * getALl posts
      *
      * @return mixed
      */
    public function getAll()
    {
        return $this->getModel()->latest('published_at')->published()->localed()->paginate($this->perPage());
    }

     /**
      * return all user's posts as collection
      *
      * @return mixed
      */
    public function getAllUsers()
    {
        return $this->getModel()->latest('published_at')->published()->localed()->users()->paginate($this->perPage());
    }

     /**
      * simple search posts implemented in admin section
      *
      * @param mixed $searchQuery
      * @return mixed
      */
    public function search($searchQuery)
    {
        $search = "%{$searchQuery}%";

        return $this->getModel()->where('title', 'like', $search)
            ->orWhere('body', 'like', $search)
            ->orWhere('id', '=', $searchQuery)
            ->paginate($this->perPage())
            ;
    }

     /**
      * find the post by id
      *
      * @param int $id
      * @return mixed
      */
    public function findById($id)
    {
        return $this->getModel()->find($id);
    }

     /**
      * find the post by something
      *
      * @param string $key
      * @param string $value
      * @param string $operator
      * @return mixed
      */
    public function findBy($key, $value, $operator = '=')
    {
        return $this->getModel()->where($key, $operator, $value)->paginate($this->perPage());
    }

     /**
      *  delete the post
      *
      * @param int $id
      * @return bool
      * @throws \Exception
      */
    public function delete($id)
    {
        $post = $this->findById($id);
        if (!is_null($post)) {
            $post->delete();
            return true;
        }
        return false;
    }

     /**
      * simple creation not implemented anywhere
      * but should exist here because of the main repository interface
      *
      * @param array $data
      * @return mixed
      */
    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }

     /**
      * create the post
      * and dispatch the command
      *
      * @param PostsFormRequest $request
      * @param $image
      * @return mixed
      */
     public function createPost(PostsFormRequest $request, $image){

         $post = $this->dispatcher->dispatch(
             new CreatePostCommand(
                 $request->title,
                 $request->preamble,
                 $request->body,
                 $request->tags_list,
                 $request->published_at,
                 $request->localed = Lang::locale()
             ));

         $this->bindImage($image, $post);

         return $post;
     }

     /**
      * bind an image to the post
      *
      * @param $image
      * @param $post
      */
     protected function bindImage($image, $post){

             $this->uploader->upload($image, config('image.postsDESTINATION'))->save(config('image.postsDESTINATION'));

             $picture = Picture::create(['path' => $this->uploader->getFilename()]);

             $post->picture()->attach($picture);
     }

     /**
      * return the number of user's posts
      *
      * @return mixed
      */
    public function countUserPosts(){

        return $this->getModel()->where('user_id', '=', Auth::id())->count();
    }

     /**
      * return the number of today's posts
      *
      * @return mixed
      */
     public function todayPosts(){
         return $this->getModel()->latest('published_at')->published()->today()->count();
     }

}