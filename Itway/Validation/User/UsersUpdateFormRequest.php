<?php

namespace Itway\Validation\User;

use itway\Http\Requests\Request;
use itway\User;
use Exception;
class UsersUpdateFormRequest extends Request
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
        $slug = $this->slug;
        $id = User::findBySlug($slug)->id;

        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,id,' . $id
        ];
        if ($this->has('password')) {
            $rules['password'] = 'required|min:6|max:20';
        }

              return $rules;

    }
}
