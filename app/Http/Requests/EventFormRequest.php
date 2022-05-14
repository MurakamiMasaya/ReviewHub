<?php

namespace App\Http\Requests;

use App\Rules\CustomUrlValidation;
use Illuminate\Foundation\Http\FormRequest;

class EventFormRequest extends FormRequest
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
            'contact_address' => ['required', 'numeric', 'digits_between:10,11'],
            'contact_email' => ['required', 'string', 'email:strict,spoof'],
            'segment' => ['required', 'between:1,2'],
            'area' => ['required_without:online'],
            'capacity' => ['required', 'numeric', 'between:1,100'],
            'title' => ['required', 'string', 'max:40'],
            'contents' => ['required', 'string', 'max:1000'],
            'image' => ['image', 'mimes:jpeg,png,jpg'],
            'url' => [new CustomUrlValidation],
        ];
    }
}
