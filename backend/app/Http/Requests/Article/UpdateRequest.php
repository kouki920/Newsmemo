<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Article;
use App\Models\Tag;

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

    /**
     * バリデーション後、下記メソッド内でjson形式の文字列を連想配列に変換
     * 連想配列をコレクションに変更後、コレクションメソッドでタグの個数制限と登録するタグをタグ名のみにする
     */
    public function passedValidation()
    {
        $this->tags = collect(json_decode($this->tags))
            ->slice(0, 5)
            ->map(function ($requestTag) {
                return $requestTag->text;
            });
    }

    /**
     * タグの登録と投稿・タグの紐付けを行う
     * 二重登録を避ける為にdetach()を使用
     * firstOrCreateメソッドで引数として渡した「カラム名と値のペア」を持つレコードがテーブルに存在するかどうかを判定
     * 存在すればそのモデルを返しテーブルに存在しなければ、そのレコードをテーブルに保存した上で、モデルを返す
     * @param Article $article
     */
    public function tagsRegister(Article $article)
    {
        $article->tags()->detach();
        $this->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });
    }
}
