<?php

namespace App\Http\Controllers\NEWSAPI;

use App\Http\Requests\Api\CovidCustomRequest;
use App\Services\API\CovidNewsServiceInterface;
use App\Http\Controllers\Controller;

class CovidNewsController extends Controller
{
    private CovidNewsServiceInterface $covidNewsService;

    public function __construct(
        CovidNewsServiceInterface $covidNewsService
    ) {
        $this->covidNewsService = $covidNewsService;
    }

    /**
     * NEWSAPIからCOVID関連のニュースデータを取得
     * serviceクラスで作成したGuzzleを利用したメソッドを指定
     *
     * @return Illuminate\View\View
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
     * @return Illuminate\View\View
     */
    public function customIndex(CovidCustomRequest $request)
    {
        $news = $this->covidNewsService->customIndex($request);

        return view('articles.covid_index', compact('news'));
    }
}
