<?php

namespace App\Http\Requests\Article;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class IndexRequest extends FormRequest
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
            'title' => 'required | max:25',
            'body' => 'required | max:300',
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'body' => '本文',
            'tags' => 'タグ',
        ];
    }

    /**
     * 検索フォームでの入力データをもとに表示するデータを絞り込む
     */
    public function filters()
    {
        $query = Article::with(['user', 'likes', 'tags'])->orderBy('created_at', 'desc');

        $search = $this->input('search');

        if ($search !== null) {

            $search_splits = preg_split('/[\p{Z}\p{Cc}]++/u', $search, -1, PREG_SPLIT_NO_EMPTY);
            //半角全角スペース，改行，タブ，ノーブレークスペースなどの空白系の制御文字を対象とする

            foreach ($search_splits as $value) {

                $query->where('title', 'like', '%' . $value . '%')
                    ->orWhere('body', 'like', '%' . $value . '%')
                    ->orWhere('news', 'like', '%' . $value . '%');
            }
        }
        return $query;
    }
}
