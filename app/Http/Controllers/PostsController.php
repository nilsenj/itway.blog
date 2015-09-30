<?php namespace itway\Http\Controllers;


use Conner\Tagging\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use itway\Http\Requests;
use itway\Post;
use Itway\Validation\Post\PostsUpdateFormRequest;
use Itway\Validation\Post\PostsFormRequest;
use itway\Commands\CreatePostCommand;
use Illuminate\Contracts\Cookie;
use \Illuminate\Http\Request;
use  Itway\Repositories\Posts\PostsRepository;
use itway\User;
use App;
use itway\Picture;
use Itway\Uploader\ImageUploader;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use nilsenj\Toastr\Facades\Toastr;
use Itway\Services\Youtube\Facades\Youtube;
use Itway\Services\Youtube\YoutubeQuery;
//use Request;

/**
 * Class PostsController
 * @package itway\Http\Controllers
 */
class PostsController extends Controller {

    use YoutubeQuery;
    /**
     * @var ImageUploader
     */
    protected $uploader;

    /**
     * @param ImageUploader $uploader
     * @param PostsRepository $repository
     */
    public function __construct(ImageUploader $uploader, PostsRepository $repository)
    {
        $this->middleware('auth', ['only' => ['create', 'edit', 'update', 'store']]);
        $this->uploader = $uploader;
        $this->repository = $repository;
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return redirect()->to(App::getLocale()."/blog")->with(\Flash::error('Post Not Found!!'));
    }

    /**
     * @param Request $request
     * @param Post $postData
     * @return \Illuminate\View\View
     */
	public function index( Request $request, Post $postData)
    {
        $posts = $this->repository->allOrSearch($request->get('q'));
        $countUserPosts = $this->repository->countUserPosts();

            return view('pages.blog', compact('posts','countUserPosts'));

    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tagCollection = Tag::where('count', '>=', ENV('SUPPOSED_TAGS', 5))->get();

        $tags =  $tagCollection->lists('name', 'id');

        $countUserPosts = $this->repository->countUserPosts();

        flash()->info(trans('messages.createLang'));

        return view('posts.create', compact('tags','countUserPosts'));
    }

    /**
     * @param PostsFormRequest $request
     * @return mixed
     */
    public function store(PostsFormRequest $request)
    {

        $post = $this->dispatch(
            new CreatePostCommand(
                $request->title,
                $request->preamble,
                $request->body,
                $request->tags_list,
                $request->published_at,
                $request->localed = Lang::locale()
            ));
        if (\Input::hasFile('image')) {
            // upload image
            $image = \Input::file('image');

            $this->uploader->upload($image, 'images/posts/')->save('images/posts');

            $picture = Picture::create(['path' => $this->uploader->getFilename()]);

            $post->picture()->attach($picture);

        }

        Toastr::success(trans('messages.yourPostCreated'), $title = $post->title, $options = []);

        return redirect()->to(App::getLocale().'/blog/post/'.$post->id);
    }


    /**
     * @param $slug
     * @param Post $postdata
     * @return \Illuminate\View\View|Response
     */
	public function show($slug, Post $postdata)
        
	{
        try {
            $post = $postdata->findBySlugOrId($slug);
            $post->view();
            $postUser = $post->user_id;
            $countUserPosts = $this->repository->countUserPosts();

            if($this->searchYoutubeRelated($post->tagNames())) {
                $videos = $this->searchYoutubeRelated($post->tagNames());
            }
            else $videos = false;
//            dd($this->youtube->searchVideos($post->tags()));

//            $bookmarked = User::find(Auth::id())->pins()->where('post_id', '=', $post->id)->first();

            if(Auth::user() && Auth::user()->id === $postUser) {
                $createdByUser = true;
                return view('posts.single', compact('post', 'createdByUser','countUserPosts', 'videos'));
            }
            else {
                $createdByUser = false;
                return view('posts.single', compact('post','createdByUser','countUserPosts', 'videos'));
            }
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }

	}
    public function userPosts(Request $request, Post $postData)

    {

            try {

                $posts = $this->repository->allOrSearchUsers($request->get('q'));

                $countUserPosts = $this->repository->countUserPosts();


                if($countUserPosts === 0)
                {
                    Toastr::warning(trans('messages.noPostsFound'), $title = trans('messages.noPostsFoundTitle'), $options = []);
                    return redirect()->back();
                }
                else {

                    return view('pages.blog', compact('posts', 'countUserPosts'));
                }

            } catch (ModelNotFoundException $e) {
                return $this->redirectNotFound();
            }

    }


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $slug
	 * @return Response
	 */
	public function edit($slug)

	{
        try {
            $post = Post::findBySlugOrId($slug);
            $countUserPosts = $this->repository->countUserPosts();


//            $categories = Category::all()->lists("slug", 'id');

            $tags = $post->tagNames();

            if ($post->picture()) {

                $picture = $post->picture()->get() ;

            }

            return view('posts.edit', compact('post', 'tags', 'picture','countUserPosts'));


        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }


	}

    /**
     * @param $slug
     * @param PostsUpdateFormRequest $request
     * @return Redirect
     */
	public function update( $slug, PostsUpdateFormRequest $request)
	{
        try {

            $post = Post::findBySlugOrId($slug);

            $data = $request->all();

            unset($data['image']);

            $data['user_id'] = \Auth::id();

            $data['slug'] = Str::slug($data['title']);

            if (\Input::hasFile('image')) {
                // upload image
                $image = \Input::file('image');

                if ($post->picture()) {

                    $picture = $post->picture()->get() ;

                    foreach($picture as $pic) {

                        Post::deleteImage($pic->path);

                    }
                    $post->picture()->detach();
                }

                $post->update($data);

                $post->untag();

                $post->tag($request->input('tags_list'));

                $this->uploader->upload($image, 'images/posts/')->save('images/posts');

                $picture = Picture::create(['path' => $this->uploader->getFilename()]);

                $post->picture()->attach($picture);

            }
            else{
                $post->update($data);

                $post->untag();

                $post->tag($request->input('tags_list'));

            }


            $updatedPost = $post->id;

            Toastr::success(trans('messages.yourPostUpdated'), $title = $post->title, $options = []);

            return redirect()->to(App::getLocale().'/blog/post/'.$updatedPost);

        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
	}

    /**
     * @param $id
     * @return mixed
     */
	public function destroy($id)
	{
        $post = Post::where('id', '=', $id);

            $post->delete();

        Toastr::success(Auth::user()->name, $title = 'Your Post deleted successfully! Have a nice day!', $options = []);

        return redirect()->to(App::getLocale().'/blog');
	}

    public function tags($slug) {

        $posts = Post::withAnyTag([$slug])->latest('published_at')->published()->paginate(8);

        $countUserPosts = $this->repository->countUserPosts();

        return view('pages.blog',compact('posts', 'countUserPosts'));
    }


}
