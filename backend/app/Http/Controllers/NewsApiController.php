<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApiRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class NewsApiController extends Controller
{
    public function defaultIndex()
    {
        try {
            $url = config('newsapi.news_api_url') . "top-headlines?country=jp&apiKey=" . config('newsapi.news_api_key');
            $method = "GET";

            $client = new Client();
            $response = $client->request($method, $url);

            $results = $response->getBody();
            $articles = json_decode($results, true);

            $news = [];
            $count = 20;

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
        return view('articles.news_index', compact('news'));
    }

    public function customIndex(ApiRequest $request)
    {
        try {
            if (isset($request)) {
                $country = $request->country;
                $category = $request->category;
                $url = config('newsapi.news_api_url') . "top-headlines?country=" . $country . "&category=" . $category . "&apiKey=" . config('newsapi.news_api_key');
            }

            $method = "GET";

            $client = new Client();
            $response = $client->request($method, $url);

            $results = $response->getBody();
            $articles = json_decode($results, true);

            $news = [];
            $count = 20;

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
        return view('articles.news_index', compact('news'));
    }
}
