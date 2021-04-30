<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class Article extends Model
{

    protected $fillable = [
        'title', 'body', 'news', 'url',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'likes')->withTimestamps();
    }

    public function isLikedBy(?User $user): bool
    {
        return $user ? (bool)$this->likes->where('id', $user->id)->count() : false;
    }

    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();
    }

    /**
     * 後で読むボタンを押された数が多い順にメモデータを取得する
     */
    public function articleRanking()
    {
        $ranked_article = Article::withCount('likes')->orderBy('likes_count', 'desc')->limit(3)->get();

        return $ranked_article;
    }

    /**
     * よく読まれているニュースを取得する
     */
    public function newsRanking()
    {
        $news = Article::select('url', 'news', DB::raw('count(*) as total'))->groupBy('url', 'news')->having('total', '>', 1)->orderBy('total', 'desc')->limit(3)->get();

        return $news;
    }

    /**
     * メモデータにあるタグ情報を使いカテゴリ別に統計を出しグラフ化
     */
    public function totalCategory($id)
    {
        $articles = Article::with('tags')->where('user_id', $id)->get();

        $tags = [];
        foreach ($articles as $article) {
            $tags[] = [
                'tags' => Arr::pluck($article->tags()->select('name')->get()->toArray(), 'name')
            ];
        }
        $count = count($tags);
        for ($i = 0; $i < $count; $i++) {
            $tag[] = ($tags[$i]['tags']);
        }
        $filter_result = array_filter($tag);
        // 多次元配列のarray_uniqueをするためにSORT_REGULAを用いる
        $unique_result = array_unique($filter_result, SORT_REGULAR);

        $items = [];
        foreach ($unique_result as $value) {
            foreach ($value as $sub_value) {
                $items = $sub_value;
            }
        }
        // return $unique_result;
        return $items;
        // foreach ($unique_result as $key => $unique_result) {
        //     foreach ($unique_result as $key => $value) {
        //         return $value;
        //     }
        // }
        // return $value;
    }
}
