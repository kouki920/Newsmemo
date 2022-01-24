<?php

namespace App\Repositories\Article;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * 一覧表示するためにarticlesテーブルからデータを取得する
     * search()でscopeSearchを利用
     *
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
     * キーワード検索(クエリスコープ)
     * リレーション先のテーブル(news_linksのnewsカラム)を含めた検索
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $query, $params)
    {
        if (!empty($params)) {
            $query->whereIn('articles.id', function ($query) use ($params) {
                $query->from('news_links')->select('news_links.article_id')
                    ->where('news', 'like', '%' . $params . '%')
                    ->orWhere('body', 'like', '%' . $params . '%');
            });
        }
        return $query;
    }

    /**
     * 投稿のランキングデータの取得(過去30日間)
     * withCount(リレーション名)でリレーション先のいいね数の合計を計算する
     * リレーション先(likes)の合計値はリレーション関数名_countというkey名で取得できる
     * ブックマークされた数(likes_count)が多い順にメモデータを取得する
     *
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
}
