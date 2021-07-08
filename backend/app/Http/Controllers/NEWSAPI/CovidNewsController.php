<?php

namespace App\Http\Controllers\NEWSAPI;

use App\Http\Requests\Api\CovidCustomRequest;
use App\Http\Controllers\Controller;
use App\Services\CovidNewsService;

class CovidNewsController extends Controller
{
    /**
     * NEWSAPIからCOVID関連のニュースデータを取得
     * serviceクラスで作成したGuzzleを利用したメソッドを指定
     *
     * @param \App\Services\CovidNewsService $covid_news_service
     * @return array
     */
    public function defaultIndex(CovidNewsService $covid_news_service)
    {
        $news = $covid_news_service->defaultIndex();

        return view('articles.covid_index', compact('news'));
    }

    /**
     * NEWSAPIからCOVID関連のニュースデータを取得
     * serviceクラスで作成したGuzzleを利用したメソッドを指定
     *
     * @param \App\Http\Requests\Api\CovidCustomRequest
     * @param \App\Services\CovidNewsService $covid_news_service
     * @return array
     */
    public function customIndex(CovidCustomRequest $request, CovidNewsService $covid_news_service)
    {
        $news = $covid_news_service->customIndex($request);

        return view('articles.covid_index', compact('news'));
    }
}
