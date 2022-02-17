<?php

namespace Tests\Unit\Requests;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Article\StoreRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleStoreRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 投稿機能のバリデーションテスト
     *
     * @param array 項目名の配列
     * @param array 値の配列
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider dataArticleStore
     *
     */
    public function testArticleStore(array $keys, array $values, bool $expect)
    {
        $this->withoutExceptionHandling();

        $dataList = array_combine($keys, $values);

        $request = new StoreRequest();

        $rules = $request->rules();

        $validator = Validator::make($dataList, $rules);

        $result = $validator->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataArticleStore()
    {
        return [
            'OK' => [
                ['user_id', 'body', 'tags', 'news', 'url'],
                ['1', 'test', '"tags"', 'news_title', 'http://www.example.com'],
                true
            ],
            '本文[必須エラーテスト]' => [
                ['user_id', 'body', 'tags', 'news', 'url'],
                ['1', null, '"tags"', 'news_title', 'http://www.example.com'],
                false
            ],
            '本文[最大文字数エラーテスト]' => [
                ['user_id', 'body', 'tags', 'news', 'url'],
                ['1', str_repeat('a', 256), '"tags"', 'news_title', 'http://www.example.com'],
                false
            ],
            'タグ[null許容テスト]' => [
                ['user_id', 'body', 'tags', 'news', 'url'],
                ['1', 'test', null, 'news_title', 'http://www.example.com'],
                true
            ],
            'タグ[json形式エラーテスト]' => [
                ['user_id', 'body', 'tags', 'news', 'url'],
                ['1', 'test', 'tags', 'news_title', 'http://www.example.com'],
                false
            ],
            'ニュースタイトル[必須エラーテスト]' => [
                ['user_id', 'body', 'tags', 'news', 'url'],
                ['1', 'test', '"tags"', null, 'http://www.example.com'],
                false
            ],
            'ニュースタイトル[文字列エラーテスト]' => [
                ['user_id', 'body', 'tags', 'news', 'url'],
                ['1', 'test', '"tags"', 1, 'http://www.example.com'],
                false
            ],
            'ニュースタイトル[最大文字数エラーテスト]' => [
                ['user_id', 'body', 'tags', 'news', 'url'],
                ['1', 'test', '"tags"', str_repeat('a', 256), 'http://www.example.com'],
                false
            ],
            'ニュースurl[必須エラーテスト]' => [
                ['user_id', 'body', 'tags', 'news', 'url'],
                ['1', 'test', '"tags"', 'news_title', null],
                false
            ],
            'ニュースurl[最大文字数エラーテスト]' => [
                ['user_id', 'body', 'tags', 'news', 'url'],
                ['1', 'test', '"tags"', 'news_title', str_repeat('a', 256)],
                false
            ]
        ];
    }
}
