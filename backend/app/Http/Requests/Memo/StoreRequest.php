<?php

namespace App\Http\Requests\Memo;

use Illuminate\Foundation\Http\FormRequest;
use Psy\CodeCleaner\IssetPass;

class StoreRequest extends FormRequest
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
            'body' => 'required | string | max:255',
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
