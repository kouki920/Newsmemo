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

    /**
     * タグ入力時に予測変換を表示させる
     * Vue Tags Inputでは、タグ名に対しtextというキーが付いている必要があるのでmapメソッドを使用して同様の連想配列を作成
     */
    public function getTagPredictiveConversionAttribute()
    {
        return $this->all()->map(function ($tag) {
            return ['text' => $tag->name];
        });
    }
}
