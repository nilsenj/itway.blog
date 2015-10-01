<?php namespace itway\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Input;
use itway\Http\Requests;
use itway\Http\Requests\UserPhotoRequest;
use itway\Http\Requests\UserUpdateRequest as UserUpdateRequest;
use itway\Picture;
use Itway\Uploader\ImageUploader;
use itway\User;
use Toastr;

class UserController extends Controller {


    public function __construct(ImageUploader $uploader){
        $this->uploader = $uploader;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('user.user-profile');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        try{
		$user = User::findBySlugOrId($id);

            if ($user->picture()) {

                $picture = $user->picture()->get() ;

            }
            $notFromProfile = false;
		return view('user.user-profile', compact('user', 'picture', 'notFromProfile'));

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();
        }
	}
	public function settings($id)
	{
        try{
		$user = User::find($id);
            $tags = $user->tagNames();

//            if ($user->picture()) {
//
//                $user = $user->picture()->get() ;
//
//            }
		return view('user.user-settings', compact('user','tags'));

        } catch (ModelNotFoundException $e) {

            return $this->redirectNotFound();
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

    /**
     * @param $id
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
	public function update($id, UserUpdateRequest $request)
	{
     try{
		$user = User::findBySlugOrId($id);

         $taglist = $request->input('tags_list');
//
//         if(! empty($user->tagNames())){
//
//             $user->untag();
//         }

         if(! empty($taglist)){

             $user->retag($taglist);
         }

//		dd($request->all());
		$user->update($request->all());
		return redirect()->back();
    } catch (ModelNotFoundException $e) {
        return $this->redirectNotFound();
        }

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    public function userPhoto(UserPhotoRequest $request) {

        $user = User::find($request->user()->id);

        if (\Input::hasFile('photo')) {
            // upload image
            $image = \Input::file('photo');

            $imagesPath = 'images/users';

            $this->uploader->upload($image, $imagesPath)->save($imagesPath);

            if ($user->picture()) {

                $picture = $user->picture()->get() ;

                foreach($picture as $pic) {
                    User::deleteImage($pic->path);
                }
                $user->picture()->detach();
            }

            $picture = Picture::create(['path' => $this->uploader->getFilename()]);

            $user->picture()->attach($picture);

        }
        Toastr::info(trans('messages.yourPhotoUpdated'), $title = $user->name, $options = []);

        return redirect()->back();

    }

    public function tags($slug) {

        $users = User::withAnyTag([$slug])->paginate(8);

        return view('pages.users',compact('users'));
    }
}
