<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

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
            'gender' => 'required',
            'email' => 'required | email ',
            'age' => 'required |integer ',
            'content' => 'required | max:750',
        ];
    }

    public function attributes()
    {
        return [
            'gender' => '性別',
            'email' => 'メールアドレス',
            'age' => '年齢',
            'content' => 'お問い合わせ内容',
        ];
    }
}
