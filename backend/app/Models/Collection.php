<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Http\Requests\Collection\StoreRequest;
use Illuminate\Support\Facades\Auth;

class Collection extends Model
{
    protected $fillable = [
        'name', 'user_id'
    ];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Article')->withTimestamps();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * コレクション名の一覧を取得
     *
     */
    public function getCollectionIndex($id)
    {
        return $this->where('user_id', $id)->latest()->get();
    }

    /**
     * コレクションに属するarticleデータを条件付きで取得
     */
    public function getCollectionArticleData()
    {
        return $this->articles->sortByDesc('created_at')->paginate(10);
    }

    /**
     * ログイン済みのユーザが保持するコレクションデータを取得
     */
    public function getCollectionShow(string $name, $id)
    {
        return $this->where('name', $name)->where('user_id', $id)->first()->load(['articles.user', 'articles.likes', 'articles.tags', 'articles.newsLink']);
    }
}
