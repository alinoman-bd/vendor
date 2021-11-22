<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthValidation extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Please provide :attribute ',
            'email.email' => 'Please provide valid :attribute',
            'password.required' => 'Please fill up :attribute '
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'email',
            'password' => 'password'
        ];
    }
}