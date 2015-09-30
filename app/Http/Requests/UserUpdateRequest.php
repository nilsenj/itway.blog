<?php

namespace itway\Http\Requests;

use itway\Http\Requests\Request;
use Auth;
class UserUpdateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        dd($this->id);
        if(Auth::user()->id == $this->id)
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'min:3|max:32',
            'email' => 'email|min:3|max:32',
            'bio' => 'min:3|max:450',
            'password' => 'string|min:8|max:32',
            'location' => 'string|min:3|max:64',
            'Google' => 'email',
            'Facebook' => 'url',
            'Github' => 'url',
            'Twitter' => 'string|min:3|max:250',
        ];
    }
}
