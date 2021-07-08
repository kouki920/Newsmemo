<?php

namespace App\Http\Requests\Collection;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'collections' => 'json|regex:/^(?!.*\/).*$/u',
        ];
    }

    public function attributes()
    {
        return [
            'collections' => 'コレクション',
        ];
    }

    /**
     * JSON形式の文字列のままだとPHPで取り扱うことはできないので、json_decode関数で連想配列に変換
     */
    public function passedValidation()
    {
        $this->collections = collect(json_decode($this->collections))
            ->slice(0, 1)
            ->map(function ($requestCollection) {
                return $requestCollection->text;
            });
    }
}
