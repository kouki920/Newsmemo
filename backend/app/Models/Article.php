<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class Article extends Model
{

    protected $fillable = [
        'body', 'user_id',
    ];

    protected $appends = [
        'created_date'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'likes')->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();
    }

    public function collections(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Collection')->withTimestamps();
    }

    public function memos(): HasMany
    {
        return $this->hasMany('App\Models\Memo');
    }

    public function newsLink(): HasOne
    {
        return $this->hasOne('App\Models\NewsLink');
    }

    /**
     * ユーザーがいいね済みかどうかを判定
     * where()で記事をいいねしたユーザーの中に、引数として渡された$userがいるかどうかを判定
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function isLikedBy(?User $user): bool
    {
        return $user ? (bool)$this->likes->where('id', $user->id)->count() : false;
    }

    /**
     *  現在のいいね数を算出するアクセサ
     * $article->count_likesで呼び出せるようにする
     *
     * @return int
     */
    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

    /**
     * 一覧表示するためにarticlesテーブルからデータを取得する
     */
    public function getArticleIndex($request)
    {
        return $this->with(['user', 'likes', 'tags', 'newsLink'])
            ->latest()
            ->search($request->input('search'))
            ->paginate(10);
    }

    /**
     * 検索ワードを含むarticleデータだけに限定する
     * リレーション先のテーブル(news_linksのnewsカラム)を含めた検索
     *
     * @param $query
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function scopeSearch($query, $request)
    {
        if (null !== $request) {
            return Article::with(['user', 'likes', 'tags', 'newsLink'])
                ->whereIn('articles.id', function ($query) use ($request) {
                    $query->from('news_links')->select('news_links.article_id')
                        ->where('news', 'like', '%' . $request . '%')
                        ->orWhere('body', 'like', '%' . $request . '%');
                });
        }
    }

    /**
     * トレンドメモのランキングデータの取得
     * ブックマークされた数が多い順にメモデータを取得する
     *
     * @param $query
     * @return array
     */
    public function getArticleRanking()
    {
        return $this->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->whereRaw('created_at > NOW() - INTERVAL 1 MONTH')
            ->take(3)->get();
    }

    /**
     * 各メモデータにあるタグ情報を使いユーザが最近使用したタグを表示させる
     * メモに紐づくタグデータをtags-tableから最新順で5件分のみ取得
     *
     * @param $query
     * @return array
     */
    public function getRecentTags($id)
    {
        $articles = Article::with('tags')
            ->where('user_id', $id)
            ->latest()->take(5)->get();

        $tag_name = [];
        foreach ($articles as $article) {
            foreach ($article->tags as $tag) {
                $tag_name[] = $tag->name;
            }
        }

        return array_unique($tag_name);
    }

    /**
     * created_atカラムのフォーマットを変更するアクセサ
     *
     * @return string
     */
    public function getCreatedDateAttribute(): string
    {
        return $this->created_at->format('Y-m-d');
    }

    /**
     * articleデータに付属する非公開メモを取得する
     */
    public function getArticleMemo()
    {
        return $this->memos->where('article_id', $this->id)->sortBy('created_at');
    }
}
