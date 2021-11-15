<?php

namespace App\Services;

use App\Http\Requests\Api\CovidCustomRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class CovidNewsService
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
            $url = config('newsapi.news_api_url') . "everything?q=+COVID-19 AND 新型コロナ&language=jp&pageSize=40&sortBy=publishedAt&apiKey=" . config('newsapi.news_api_key');
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
     * @param \App\Http\Requests\Api\CovidCustomRequest $request
     * @return array
     */
    public function customIndex(CovidCustomRequest $request)
    {
        try {
            if (isset($request)) {
                $language = $request->language;
                $url = config('newsapi.news_api_url') . "everything?q=COVID-19&language=" . $language . "&pageSize=50&sortBy=publishedAt&apiKey=" . config('newsapi.news_api_key');
            }

            $method = "GET";

            $client = new Client();
            $response = $client->request($method, $url);

            $results = $response->getBody();
            $articles = json_decode($results, true);

            $news = [];
            $count = 35;

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
