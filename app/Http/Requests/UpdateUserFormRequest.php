<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'birthday' => ['required'],
            'gender' => ['required', 'numeric'],
            'username' => ['required', 'string', 'max:10'],
            'phone' => ['required','numeric','digits_between:10,11'],
            'password' => ['required', 'confirmed', Password::defaults()]
        ];
    }
}
