<?php

namespace App\Http\Controllers\NEWSAPI;

use App\Http\Requests\Api\CovidCustomRequest;
use App\Http\Controllers\Controller;
use App\Services\CovidNewsService;

class CovidNewsController extends Controller
{
    private CovidNewsService $covidNewsService;

    public function __construct(
        CovidNewsService $covidNewsService
    ) {
        $this->covidNewsService = $covidNewsService;
    }

    /**
     * NEWSAPIからCOVID関連のニュースデータを取得
     * serviceクラスで作成したGuzzleを利用したメソッドを指定
     *
     * @param \App\Services\CovidNewsService $covidNewsService
     * @return array
     */
    public function defaultIndex()
    {
        $news = $this->covidNewsService->defaultIndex();

        return view('articles.covid_index', compact('news'));
    }

    /**
     * NEWSAPIからCOVID関連のニュースデータを取得
     * serviceクラスで作成したGuzzleを利用したメソッドを指定
     *
     * @param \App\Http\Requests\Api\CovidCustomRequest
     * @param \App\Services\CovidNewsService $covidNewsService
     * @return array
     */
    public function customIndex(CovidCustomRequest $request)
    {
        $news = $this->covidNewsService->customIndex($request);

        return view('articles.covid_index', compact('news'));
    }
}
