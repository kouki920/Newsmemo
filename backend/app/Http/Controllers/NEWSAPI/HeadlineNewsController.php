<?php

namespace App\Http\Controllers\NEWSAPI;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\HeadlineCustomRequest;
use App\Services\HeadlineNewsService;

class HeadlineNewsController extends Controller
{
    /**
     * NEWSAPIからヘッドラインニュースデータを取得
     * serviceクラスで作成したGuzzleを利用したメソッドを指定
     *
     * @param \App\Services\HeadlineNewsService $head_news_service
     * @return array
     */
    public function defaultIndex(HeadlineNewsService $head_news_service)
    {
        $news = $head_news_service->defaultIndex();

        return view('articles.news_index', ['news' => $news]);
    }

    /**
     * NEWSAPIからカスタムしたヘッドラインニュースデータを取得
     * serviceクラスで作成したGuzzleを利用したメソッドを指定
     *
     * @param \App\Http\Requests\Api\HeadlineCustomRequest $request
     * @param \App\Services\HeadlineNewsService $head_news_service
     * @return array
     */
    public function customIndex(HeadlineCustomRequest $request, HeadlineNewsService $head_news_service)
    {
        $news = $head_news_service->customIndex($request);

        return view('articles.news_index', compact('news'));
    }
}
