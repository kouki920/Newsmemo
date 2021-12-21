<?php

namespace App\Http\Requests\Collection;

use App\Models\Article;
use App\Models\Collection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'collections' => 'json|regex:/^(?!.*\/).*$/u | max:255',
        ];
    }

    /**
     * JSON形式の文字列のままだとPHPで取り扱うことはできないので、json_decode関数で連想配列に変換
     * 連想配列をcollect関数でコレクションに変換後、コレクションメソッドでデータを加工する
     * sliceメソッドでタグの個数制限と、mapメソッドの繰り返し処理で登録するタグデータをタグ名('Example')のみの新しいコレクションとして作成する
     * mapメソッドのクロージャの引数($requestTag)にはmapメソッドで利用するコレクションの要素が入る(フォームで入力したtagデータのコレクション形式)
     * 結果的にmapメソッドの戻り値は、return $requestTag->textで['text' => 'Example',]に該当する['Example',]といったコレクションになる
     */
    public function passedValidation()
    {
        $this->collections = collect(json_decode($this->collections))
            ->slice(0, 1)
            ->map(function ($requestCollection) {
                return $requestCollection->text;
            });
    }

    /**
     * コレクションを保存する
     * passedValidationメソッドで$this->collectionsをコレクションに変換後、eachメソッドを使いコレクションの各要素に対して順に繰り返し処理を実行
     * eachメソッドのクロージャの引数($collectionName)には、passedValidationメソッドの戻り値(['Example',])が入る
     * use ($article)でクロージャの外側に定義されている変数$articleを利用可能にする
     * firstOrCreateメソッドで引数として渡した「カラム名と値のペア」を持つレコードがテーブルに存在するかどうかを判定
     * 存在すればそのモデルを返しテーブルに存在しなければ、そのレコードをテーブルに保存した上で、Collectionモデルを返す
     * 変数$collectionにはCollectionモデルが代入されるので、syncWithoutDetaching()で中間テーブル = article_collectionテーブルにデータを追加
     *
     * @param Article $article
     */
    public function collectionRegister(Article $article)
    {
        $this->collections->each(function ($collectionName) use ($article) {
            $collection = Collection::firstOrCreate(['name' => $collectionName, 'user_id' => Auth::id()]);
            $article->collections()->syncWithoutDetaching($collection);
        });
    }
}
