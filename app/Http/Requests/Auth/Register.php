<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'email:strict,dns|bail|required|unique:users|min:1|max:100',
            'password' => 'bail|required|string|min:1|max:100|confirmed',
            'username' => 'string|bail|required|string|min:1|max:100',
        ];
    }
}
