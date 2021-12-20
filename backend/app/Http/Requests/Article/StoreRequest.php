<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Article;
use App\Models\Tag;

class StoreRequest extends FormRequest
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
            'tags' => 'nullable|json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
            'news' => 'required | string | max:255',
            'url' => 'required | url | max:255',
        ];
    }

    /**
     * バリデーション後、json形式の文字列をjson_decode関数で連想配列[['text' => 'Example','tiClass' => ['ti-valid'],],...に変換
     * 連想配列をcollect関数でコレクションに変換後、コレクションメソッドでデータを加工する
     * sliceメソッドでタグの個数制限と、mapメソッドの繰り返し処理で登録するタグデータをタグ名('Example')のみの新しいコレクションとして作成する
     * mapメソッドのクロージャの引数($requestTag)にはmapメソッドで利用するコレクションの要素が入る(フォームで入力したtagデータのコレクション形式)
     * 結果的にmapメソッドの戻り値は、return $requestTag->textで['text' => 'Example',]に該当する['Example',]といったコレクションになる
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
        $this->tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->sync($tag);
        });
    }
}
