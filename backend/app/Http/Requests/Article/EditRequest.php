<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'required | max:255',
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
            'news' => 'required | string | max:255',
            'url' => 'required | string | max:255',
        ];
    }

    public function attributes()
    {
        return [
            'body' => '本文',
            'tags' => 'タグ',
            'news' => 'ニュース',
            'url' => 'ニュースURL',
        ];
    }
}
