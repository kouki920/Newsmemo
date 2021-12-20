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
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'body' => 'required | max:200',
            'tags' => 'nullable | json | regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
            'news' => 'required | string | max:255',
            'url' => 'required | url | max:255',
        ];
    }

    /**
     * バリデーション後、下記メソッド内でjson形式の文字列を連想配列に変換
     * 連想配列をコレクションに変更後、コレクションメソッドでタグの個数制限と登録するタグをタグ名のみにする
     */
    public function passedValidation(): void
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
     * passedValidationメソッドで$this->tagをコレクションに変換しているので、eachメソッドを使いコレクションの各要素に対して順に繰り返し処理を実行
     * eachメソッドのクロージャの引数($tagName)には、passedValidationメソッドの戻り値(['Example',])が入る
     * use ($article)でクロージャの外側に定義されている変数($article)を利用可能にする
     * firstOrCreateメソッドで引数として渡した「カラム名と値のペア」を持つレコードがテーブルに存在するかどうかを判定
     * 存在すればそのモデルを返しテーブルに存在しなければ、そのレコードをテーブルに保存した上で、Tagモデルを返す
     * 変数$tagにはTagモデルが代入されるので、sync()でリレーション先(中間テーブル = article_tagテーブル)にデータを追加する
     * @param Article $article
     */
    public function tagsRegister(Article $article): void
    {
        $article->tags()->detach();
        $this->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });
    }
}
