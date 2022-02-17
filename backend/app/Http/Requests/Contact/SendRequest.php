<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class SendRequest extends FormRequest
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
            'user_id' => 'required | integer',
            'gender' =>  'required',
            'age' => 'required |integer | max:90',
            'email' => 'required | email | string | max:255',
            'content' => 'required | max:700',
        ];
    }

    /**
     * バリデーションする前に実行させる
     * userのidをmergeする
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->id()
        ]);
    }
}
