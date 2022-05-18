<?php

namespace App\Http\Requests;

use App\Rules\CustomUrlValidation;
use Illuminate\Foundation\Http\FormRequest;

class ArticleFormRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:40'],
            'contents' => ['required', 'string', 'max:1000'],
            'url' => [new CustomUrlValidation],
        ];
    }
}
