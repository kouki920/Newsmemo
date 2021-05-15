<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class NewsLink extends Model
{
    protected $fillable = [
        'news', 'url',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo('App\Models\Article');
    }

    /**
     * よく読まれているニュースを取得する
     */
    public function newsRanking()
    {
        $news = NewsLink::select('url', 'news', DB::raw('count(*) as total'))
            ->groupBy('url', 'news')
            ->having('total', '>', 1)
            ->orderBy('total', 'desc')
            ->limit(3)->get();

        return $news;
    }
}
