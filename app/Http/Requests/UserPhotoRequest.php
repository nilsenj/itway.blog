<?php

namespace itway\Http\Requests;

use itway\Http\Requests\Request;

class UserPhotoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'photo' => 'image_size:>=150,>=150|mimes:jpeg,jpg,png,bmp,gif,svg'
        ];
    }
}
