<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class ArticleRepository implements ArticleRepositoryInterface
{
    private Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }


    /**
     * 投稿の登録
     *
     * @param array $articleRecord
     */
    public function store(array $articleRecord)
    {
        $article = $this->article->create($articleRecord);

        return $article;
    }


    /**
     * 投稿の更新
     *
     * @param \App\Models\Article $article
     * @param array $articleRecord
     */
    public function update(Article $article, array $articleRecord)
    {
        $article->fill($articleRecord)->save();

        $article->tags()->detach();

        return $article;
    }


    /**
     * 投稿の削除
     *
     * @param \App\Models\Article $article
     */
    public function delete(Article $article)
    {
        $article->delete();
    }

    /**
     * 一覧表示するためにarticlesテーブルからデータを取得する
     * search()でscopeSearch(ローカルスコープ)を利用
     *
     * @param \App\Models\Article $article
     * @param \Illuminate\Http\Request $request
     * @return object
     */
    public function getArticleIndex(Article $article, $request)
    {
        return $article->with(['user', 'likes', 'tags', 'newsLink'])
            ->latest()
            ->search($request->input('search'))
            ->paginate(10);
    }

    /**
     * 投稿のランキングデータの取得(過去30日間)
     * withCount(リレーション名)でリレーション先のいいね数の合計を計算する
     * リレーション先(likes)の合計値はリレーション関数名_countというkey名で取得できる
     * ブックマークされた数(likes_count)が多い順にメモデータを取得する
     *
     * @param \App\Models\Article $article
     * @return array
     */
    public function getArticleRanking(Article $article)
    {
        // Carbonを利用し対象データの範囲を本日から30日間とする
        $rankingPeriod = Carbon::today()->subDay(30);

        return $article->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->whereDate('created_at', '>=', $rankingPeriod)
            ->take(3)->get();
    }

    /**
     * タグの登録と投稿・タグの紐付けを行う
     * passedValidationメソッドで$this->tagsをコレクションに変換しているので、eachメソッドを使いコレクションの各要素に対して順に繰り返し処理を実行
     * eachメソッドのクロージャの引数($tagName)には、passedValidationメソッドの戻り値(['Example',])が入る
     * use ($article)でクロージャの外側に定義されている変数($article)を利用可能にする
     * firstOrCreateメソッドで引数として渡した「カラム名と値のペア」を持つレコードがテーブルに存在するかどうかを判定
     * 存在すればそのモデルを返しテーブルに存在しなければ、そのレコードをテーブルに保存した上で、Tagモデルを返す
     * 変数$tagにはTagモデルが代入されるので、sync()でリレーション先(中間テーブル = article_tagテーブル)にデータを追加する
     *
     * @param \App\Models\Article $article
     * @param \Illuminate\Support\Collection $tags
     */
    public function attachTags(Article $article, Collection $tags): void
    {
        $tags->each(function ($tagName) use ($article) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $article->tags()->attach($tag);
        });
    }

    /**
     * tagテーブルにあるデータをVue Tags Input形式に変換する
     * Vue Tags Inputでは、タグ名に対しtextというキーが付いている形式['text' => 'タグ名']である必要がある
     * tagのデータはcollection形式なので、mapメソッドを使用してコレクションであるarticleデータに関するtagデータを同様の連想配列に変換する繰り返し処理を実行させる(呼び出し元のコレクションは変更しない)
     * optionalヘルパでオブジェクト(tag)のプロパティ(name)にアクセスする
     *
     * @return array
     */
    public function changeTagFormat()
    {
        return $this->tags->map(function ($tag) {
            return ['text' => optional($tag)->name];
        });
    }

    /**
     * ニュースのurlとtitleを登録、投稿と紐付けを行う
     * Articleモデルとリレーション関係であるNewsLinkモデル(news_linksテーブル)にデータ(article_id,news,url)を保存
     *
     * @param array $articleRecord
     */
    public function registerNewsLink(Article $article, array $articleRecord): void
    {
        $article->newsLink()->create([
            'article_id' => $article['id'],
            'url' => $articleRecord['url'],
            'news' => $articleRecord['news'],
        ]);
    }

    /**
     * 投稿に関するメモ(マインドマップ)データを取得する
     *
     * @param \App\Models\Article $article
     */
    public function getMemoData(Article $article)
    {
        return $article->memos()->where('article_id', $article->id)->oldest()->get();
    }

    /**
     * 各投稿データにあるタグ情報を使いユーザが最近使用したタグを表示させる
     * 投稿に紐づくタグデータを最新順で5件分のみ取得
     * articlesのリレーション先であるtagsのnameデータ配列が欲しいのでforeachの繰り返し処理で配列を作成
     * array_unique()で配列の重複データを除外
     *
     * @param  int $id
     * @return array
     */
    public function getRecentTags($id)
    {
        $articles = $this->article->with('tags')
            ->where('user_id', $id)
            ->latest()->take(5)->get();

        $recentTags = [];
        foreach ($articles as $article) {
            foreach ($article->tags as $tag) {
                $recentTags[] = $tag->name;
            }
        }

        return array_unique($recentTags);
    }
}
