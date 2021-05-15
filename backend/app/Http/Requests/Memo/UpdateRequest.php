<?php

namespace App\Http\Requests\Memo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'memo' => 'string | max:200',
        ];
    }

    public function attributes()
    {
        return [
            'memo' => '非公開メモ',
        ];
    }

    /**
     * 更新対象となるarticleのidを代入
     */
    public function articleId($request)
    {
        if (isset($request->article_id)) {
            $article = $request->article_id;
            return $article;
        }
    }
}
