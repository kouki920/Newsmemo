<?php

namespace App\Http\Controllers\NEWSAPI;

use App\Http\Requests\Api\CovidCustomRequest;
use App\Http\Controllers\Controller;
use app\Interfaces\CovidNewsInterface;
use App\Services\CovidNewsService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class CovidNewsController extends Controller
{
    public function defaultIndex()
    {
        try {
            $url = config('newsapi.news_api_url') . "everything?q=コロナウイルス&pageSize=40&sortBy=publishedAt&apiKey=" . config('newsapi.news_api_key');
            $method = "GET";

            $client = new Client();
            $response = $client->request($method, $url);

            $results = $response->getBody();
            $articles = json_decode($results, true);

            $news = [];
            $count = 40;

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
        session()->flash('msg_success', 'ニュースを取得しました');
        return view('articles.covid_index', compact('news'));
    }

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
            $count = 50;

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
        session()->flash('msg_success', 'ニュースを取得しました');
        return view('articles.covid_index', compact('news'));
    }
}
