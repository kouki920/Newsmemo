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
     * 一覧表示するためにarticlesテーブルからデータを取得する
     */
    public function getArticleIndex($request)
    {
        return $this->with(['user', 'likes', 'tags', 'newsLink'])
            ->orderBy('created_at', 'desc')
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
     * 後で読むボタンを押された数が多い順にメモデータを取得する
     *
     * @param $query
     * @return array
     */
    public function getArticleRanking()
    {
        return $this->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->limit(3)->get();
    }

    /**
     * 各メモデータにあるタグ情報を使いユーザが最近使用したタグを表示させる
     * メモに紐づくタグデータをtags-tableから最新順で5件分のみ取得
     *
     * @param $query
     * @return array
     */
    public function getTotalCategory($id)
    {
        $articles = Article::with('tags')
            ->where('user_id', $id)
            ->latest()->take(5)->get();

        $tag_name = [];
        foreach ($articles as $value) {
            foreach ($value->tags as $values) {
                $tag_name[] = $values->name;
            }
        }
        return $tag_name;
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
}
