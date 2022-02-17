<?php

namespace App\Http\Controllers\NEWSAPI;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\HeadlineCustomRequest;
use App\Services\API\HeadlineNewsServiceInterface;

class HeadlineNewsController extends Controller
{
    private HeadlineNewsServiceInterface $headlineNewsService;

    public function __construct(
        HeadlineNewsServiceInterface $headlineNewsService
    ) {
        $this->headlineNewsService = $headlineNewsService;
    }

    /**
     * NEWSAPIからヘッドラインニュースデータを取得
     * serviceクラスで作成したGuzzleを利用したメソッドを指定
     *
     * @return Illuminate\View\View
     */
    public function defaultIndex()
    {
        $news = $this->headlineNewsService->defaultIndex();

        return view('articles.news_index', compact('news'));
    }

    /**
     * NEWSAPIからカスタムしたヘッドラインニュースデータを取得
     * serviceクラスで作成したGuzzleを利用したメソッドを指定
     *
     * @param \App\Http\Requests\Api\HeadlineCustomRequest $request
     * @return Illuminate\View\View
     */
    public function customIndex(HeadlineCustomRequest $request)
    {
        $news = $this->headlineNewsService->customIndex($request);

        return view('articles.news_index', compact('news'));
    }
}
