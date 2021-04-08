<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
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
            'country' => 'required | string',
            'category' => 'string | nullable'
        ];
    }
    public function attributes()
    {
        return [
            'country' => '国名',
            'category' => 'カテゴリー',
        ];
    }
}
