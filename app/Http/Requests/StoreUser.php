<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'phone' => 'required|phone_number|max:15',
            'email' => 'unique:users,email,'.$this->id.'|required|max:50|email',
			'password' => 'nullable|string|min:6|confirmed',
            'profile_image' => 'nullable',
        ];
    }
}
