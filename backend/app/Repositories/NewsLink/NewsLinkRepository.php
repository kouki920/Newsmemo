<?php

namespace App\Repositories\NewsLink;

use App\Models\NewsLink;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NewsLinkRepository implements NewsLinkRepositoryInterface
{
    /**
     * よく読まれているニュースを取得(過去30日間)
     *
     * @return array
     */
    public function getNewsRanking(NewsLink $newsLink)
    {
        // Carbonを利用し対象データの範囲を本日から30日間とする
        $rankingPeriod = Carbon::today()->subDay(30);

        return $newsLink->select('url', 'news', DB::raw('count(news) as total'))
            ->groupBy('url', 'news')
            ->having('total', '>', 1)
            ->latest('total')
            ->whereDate('created_at', '>=', $rankingPeriod)
            ->take(3)->get();
    }
}
