<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConfirmRequest extends FormRequest
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
            'gender' =>  'required',
            'age' => 'required |integer ',
            'email' => 'required | email ',
            'content' => 'required | max:700',
        ];
    }

    public function attributes()
    {
        return [
            'gender' => '性別',
            'age' => '年齢',
            'email' => 'メールアドレス',
            'content' => 'お問い合わせ内容',
        ];
    }
}
