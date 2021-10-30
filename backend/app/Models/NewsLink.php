<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class NewsLink extends Model
{
    protected $fillable = [
        'article_id', 'news', 'url',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo('App\Models\Article');
    }

    /**
     * よく読まれているニュースを取得する
     *
     * @param $query
     * @return array
     */
    public function getNewsRanking()
    {
        return $this->select('url', 'news', DB::raw('count(*) as total'))
            ->groupBy('url', 'news')
            ->having('total', '>', 1)
            ->latest('total')
            ->whereRaw('created_at > NOW() - INTERVAL 1 MONTH')
            ->limit(3)->get();
    }
}
