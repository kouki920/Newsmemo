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

    public function users(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * コレクション名の一覧を取得
     *
     */
    public function getCollectionIndex($id)
    {
        return $this->where('user_id', $id)->orderBy('created_at', 'desc')->get();
    }

    /**
     * コレクションに属するarticleデータを条件付きで取得
     */
    public function getCollectionArticleData()
    {
        return $this->articles->sortByDesc('created_at')->paginate(10);
    }
}
