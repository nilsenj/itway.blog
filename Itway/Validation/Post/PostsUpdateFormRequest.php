<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/27/2015
 * Time: 8:17 PM
 */

namespace Itway\Validation\Post;

use itway\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use itway\Post;
use Input;

class PostsUpdateFormRequest extends Request{

    protected $rules = [
        'title' => 'required|min:3|max:120',
        'preamble' => 'required|min:100|max:300',
//			'localed' => 'required',
//        'image' => 'image',
        'image' =>'image|image_size:>=450,>=250',
        'body' => 'required|min:300|max:500000',
        'tags_list' => 'required|array',
        'published_at' => 'required|date'

    ];


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()

    {
        $post = Post::find(Input::get('id'));

        if ( ! Auth::check() )
        {
            return redirect('home');
        }
        elseif( ! $post || $post->user != Auth::id) {

            return redirect()->back();
        }

        return true;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return $this->rules;

    }

}

  