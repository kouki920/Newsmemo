<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
     * よく読まれているニュースを取得(過去30日間)
     *
     * @return array
     */
    public function getNewsRanking()
    {
        // Carbonを利用し対象データの範囲を本日から30日間とする
        $rankingPeriod = Carbon::today()->subDay(30);

        return $this->select('url', 'news', DB::raw('count(*) as total'))
            ->groupBy('url', 'news')
            ->having('total', '>', 1)
            ->latest('total')
            ->whereDate('created_at', '>=', $rankingPeriod)
            ->take(3)->get();
    }
}
