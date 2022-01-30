<?php

namespace App\Repositories\Collection;

use App\Models\Collection;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class CollectionRepository implements CollectionRepositoryInterface
{

    private Collection $collection;

    public function __construct(Collection $collection)
    {
        $this->$collection = $collection;
    }

    /**
     * コレクション名の一覧を取得
     * 引数の$idでログインユーザーのidを受け取る
     *
     * @param int $id
     * @return array
     */
    public function getCollectionIndex(Collection $collection, $id)
    {
        return $collection->where('user_id', $id)->latest()->get();
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
    public function registerCollection(Article $article, $collections)
    {
        $collections->each(function ($collectionName) use ($article) {
            $collection = Collection::firstOrCreate(['name' => $collectionName, 'user_id' => Auth::id()]);
            $article->collections()->syncWithoutDetaching($collection);
        });
    }

    /**
     * リクエストフォームで送られてきた$nameと$idに一致するcollectionデータを取得
     */
    public function getCollectionData($collection, string $name, $id)
    {
        return $collection->with(['articles.user', 'articles.likes', 'articles.tags', 'articles.newsLink'])->where([['name', $name], ['user_id', $id]])->first();
    }

    /**
     * $nameと$idに一致するコレクションデータに属するarticlesデータを取得する
     */
    public function getCollectionArticleData($collections)
    {
        return $collections->articles->sortByDesc('created_at')->paginate(10);
    }
}
