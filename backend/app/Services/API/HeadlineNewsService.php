<?php

namespace App\Services\API;

use App\Http\Requests\Api\HeadlineCustomRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class HeadlineNewsService implements HeadlineNewsServiceInterface
{
    /**
     * NEWSAPI(外部API)を利用してニュースデータを取得
     * 外部APIを利用する為にGuzzleを使い、取得したJSON形式のデータを配列型としてレスポンス
     *
     * @return array
     */
    public function defaultIndex()
    {
        try {
            $url = config('newsapi.news_api_url') . "top-headlines?country=jp&pageSize=30&apiKey=" . config('newsapi.news_api_key');
            $method = "GET";

            $client = new Client();
            $response = $client->request($method, $url);

            $results = $response->getBody();
            $articles = json_decode($results, true);

            $news = [];
            $count = 25;

            for ($id = 0; $id < $count; $id++) {
                array_push($news, [
                    'name' => $articles['articles'][$id]['title'],
                    'url' => $articles['articles'][$id]['url'],
                    'thumbnail' => $articles['articles'][$id]['urlToImage'],
                ]);
            }
        } catch (RequestException $e) {
            echo Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\Message::toString($e->getResponse());
            }
        }

        return $news;
    }

    /**
     * NEWSAPI(外部API)を利用してニュースデータを取得
     * 外部APIを利用する為にGuzzleを使い、取得したJSON形式のデータを配列型としてレスポンス
     *
     * @param \App\Http\Requests\Api\HeadlineCustomRequest $request
     * @return array
     */
    public function customIndex(HeadlineCustomRequest $request)
    {
        try {
            if (isset($request)) {
                $country = $request->country;
                $category = $request->category;
                $url = config('newsapi.news_api_url') . "top-headlines?country=" . $country . "&category=" . $category . "&pageSize=30&apiKey=" . config('newsapi.news_api_key');
            }

            $method = "GET";

            $client = new Client();
            $response = $client->request($method, $url);

            $results = $response->getBody();
            $articles = json_decode($results, true);

            $news = [];
            $count = 25;

            for ($id = 0; $id < $count; $id++) {
                array_push($news, [
                    'name' => $articles['articles'][$id]['title'],
                    'url' => $articles['articles'][$id]['url'],
                    'thumbnail' => $articles['articles'][$id]['urlToImage'],
                ]);
            }
        } catch (RequestException $e) {
            echo Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\Message::toString($e->getResponse());
            }
        }

        return $news;
    }
}
