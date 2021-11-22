<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please provide :attribute ',
            'email.required' => 'Please provide :attribute ',
            'phone.required' => 'Please provide :attribute ',
            'email.email' => 'Please provide valid :attribute',
            'email.unique' => 'Please provide :attribute already taken',
            'phone.unique' => 'Please provide :attribute already taken',
            'password.required' => 'Please fill up :attribute '
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'name / company name',
            'email' => 'email',
            'phone' => 'phone number',
            'password' => 'password'
        ];
    }
}
