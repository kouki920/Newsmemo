<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * 引数の$idでログインユーザーのidを受け取る
     *
     * @param int $id
     */
    public function getCollectionIndex($id)
    {
        return $this->where('user_id', $id)->latest()->get();
    }

    /**
     * コレクションに属するarticleデータを条件付きで取得
     * コレクションメソッドのsortByDescを利用して日付降順でデータを並び替え
     */
    public function getCollectionArticleData()
    {
        return $this->articles->sortByDesc('created_at')->paginate(10);
    }

    /**
     * ログイン済みのユーザが保持するコレクションデータを取得
     * first()の返り値はModelのオブジェクト
     */
    public function getCollectionShow(string $name, $id)
    {
        return $this->where([['name', $name], ['user_id', $id]])->get()->load(['articles.user', 'articles.likes', 'articles.tags', 'articles.newsLink']);

        // return $this->with(['articles.user', 'articles.likes', 'articles.tags', 'articles.newsLink'])->where([['name', $name], ['user_id', $id]])->first();

        // return $this->with('articles')->where([['name', $name], ['user_id', $id]])->get();
    }
}
