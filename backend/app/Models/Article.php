<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class Article extends Model
{

    protected $fillable = [
        'body', 'news', 'url',
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

    public function memos(): HasMany
    {
        return $this->hasMany('App\Models\Memo');
    }

    /**
     * 検索ワードを含むメモだけに限定する
     */
    public function scopeSearch($query, $request)
    {
        if (null !== $request) {
            return $query->where('body', 'like', '%' . $request . '%')
                ->orWhere('news', 'like', '%' . $request . '%');
        }
    }

    /**
     * 後で読むボタンを押された数が多い順にメモデータを取得する
     */
    public function articleRanking()
    {
        $ranked_article = Article::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->limit(3)->get();

        return $ranked_article;
    }

    /**
     * よく読まれているニュースを取得する
     */
    public function newsRanking()
    {
        $news = Article::select('url', 'news', DB::raw('count(*) as total'))
            ->groupBy('url', 'news')
            ->having('total', '>', 1)
            ->orderBy('total', 'desc')
            ->limit(3)->get();

        return $news;
    }

    /**
     * 各メモデータにあるタグ情報を使いユーザが最近使用したタグを表示させる
     */
    public function totalCategory($id)
    {
        // メモに紐づくタグデータをtags-tableから最新順で5件分のみ取得
        $articles = Article::with('tags')
            ->where('user_id', $id)
            ->latest()->take(5)->get();

        // 取得したタグデータのnameカラムを空配列に多次元配列として格納する
        $tags = [];
        foreach ($articles as $article) {
            $tags[] = [
                'tags' => Arr::pluck($article->tags()->select('name')->get()->toArray(), 'name')
            ];
        }

        // タグデータの数だけ繰り返し処理で多次元配列'tags'=>[]を減らす
        $count = count($tags);
        for ($i = 0; $i < $count; $i++) {
            $tag[] = ($tags[$i]['tags']);
        }
        // データが存在する配列のみに絞る
        $filter_array = array_filter($tag);

        // 取得した多次元配列を1つの配列に格納
        $merge_array = array();
        foreach ($filter_array as $value) {
            $merge_array = array_merge($merge_array, $value);
        }

        // 配列において重複する値を削除する為にarray_uniqueを実行する
        $unique_array = array_unique($merge_array);

        return $unique_array;
    }

    public function likeValidated()
    {
        return [
            'id' => $this->id,
            'countLikes' => $this->count_likes,
        ];
    }
}
