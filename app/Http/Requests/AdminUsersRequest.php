<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminUsersRequest extends Request
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
            'name'=>'required|max:50',
            'email'=>'required|email|unique:users',
            'role_id'=>'required|integer',
            'is_active'=>'required|boolean',
            'password'=>'required|min:8',
            'password_confirm'=>'required|same:password',
            'photo_id'=>'image',
        ];


    }

    public function messages(){
       return ['photo_id.image'=> 'Image Only!'];
    }
}
