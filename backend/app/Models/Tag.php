<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Article')->withTimestamps();
    }

    /**
     * タグ機能で自動的にハッシュタグ文字が付与されるようにする
     *
     * @return string
     */
    public function getHashtagAttribute(): string
    {
        return '#' . $this->name;
    }

    /**
     * タグ名指定でデータを取得する
     *
     * @param string $name
     */
    public function getTagData(string $name)
    {
        return $this->where('name', $name)->first();
    }

    /**
     * タグに属するメモデータを取得
     */
    public function getTagArticle()
    {
        return $this->articles->sortByDesc('created_at')->paginate(10);
    }
}
