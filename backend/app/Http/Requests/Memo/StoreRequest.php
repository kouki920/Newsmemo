<?php

namespace App\Http\Requests\Memo;

use Illuminate\Foundation\Http\FormRequest;

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
            'body' => 'required | string | max:255',
        ];
    }

    /**
     * 保存対象となるarticleデータのidをarticle_id指定で取得
     */
    public function getArticleId($request): int
    {
        if (isset($request->article_id)) {
            return $request->article_id;
        }
    }
}
