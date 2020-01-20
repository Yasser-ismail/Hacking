<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AdminUsersUpdateRequest extends Request
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
            'email'=>'required|email',
            'role_id'=>'required|integer',
            'is_active'=>'required|boolean',
            'password'=>'min:8',
            'password_confirm'=>'same:password',
            'photo_id'=>'image',
        ];
    }

    public function messages(){
        return ['photo_id.image'=> 'Image Only!'];
    }
}
