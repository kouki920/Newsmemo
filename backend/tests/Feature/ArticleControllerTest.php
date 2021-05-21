<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use App\Models\NewsLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;


    ### 投稿一覧表示機能のテスト ###

    // 未ログイン時
    public function testGuestIndex()
    {
        $response = $this->get(route('articles.index'));

        $response->assertRedirect('login');
    }

    // ログイン時
    public function testAuthIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('articles.index'));

        $response->assertStatus(200)
            ->assertViewIs('articles.index')
            ->assertSee($user->name)
            ->assertSee('ニュース')
            ->assertSee('COVID-19')
            ->assertSee('メモリスト')
            ->assertSee('プロフィール');
    }


    ### 投稿画面表示機能のテスト ###

    // 未ログイン時
    public function testGuestCreate()
    {
        $response = $this->post(route('articles.create'));

        $response->assertRedirect('login');
    }

    // ログイン時
    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->post(route('articles.create'));

        $response->assertStatus(200)
            ->assertViewIs('articles.create');
    }


    ### 投稿機能のテスト ###

    // 未ログイン時
    public function testGuestStore()
    {
        $response = $this->post(route('articles.store'));

        $response->assertRedirect('login');
    }

    // ログイン時
    public function testAuthStore()
    {
        // テストデータをDBに保存
        $user = factory(User::class)->create();

        $body = "テスト本文";
        $user_id = $user->id;
        $news = "テストニュース";
        $url = "https://testexample.com/";

        $response = $this->actingAs($user)
            ->post(route(
                'articles.store',
                [
                    'body' => $body,
                    'user_id' => $user_id,
                    'news' => $news,
                    'url' => $url,
                ]
            ));

        // テストデータがDBに登録されているかテスト
        $this->assertDatabaseHas('articles', [
            'body' => $body,
            'user_id' => $user_id
        ]);

        $this->assertDatabaseHas('news_links', [
            'news' => $news,
            'url' => $url,
        ]);

        $response->assertRedirect(route('articles.index'));
    }


    ### 投稿編集機能のテスト ###

    // 未ログイン時
    public function testGuestEdit()
    {
        $article = factory(Article::class)->create()->each(function (Article $article) {
            $article->newsLink()->save(factory(NewsLink::class)->make());
        });

        $response = $this->get(route('articles.edit', ['article' => $article]));
        $response->assertRedirect('login');
    }

    // ログイン時
    public function testAuthEdit()
    {
        $this->withoutExceptionHandling();

        $article = factory(Article::class)->create();
        $article->newsLink()->save(factory(NewsLink::class)->make());

        $user = $article->user;

        $response = $this->actingAs($user)->get(route('articles.edit', ['article' => $article]));

        $response->assertStatus(200)->assertViewIs('articles.edit');
    }

    ### 投稿削除機能のテスト ###

    // ログイン時
    public function testDestroy()
    {
        $this->withoutExceptionHandling();

        // テストデータをDBに保存
        $user = factory(User::class)->create();

        $body = "テスト本文";
        $user_id = $user->id;
        $news = "テストニュース";
        $url = "https://testexample.com/";

        $article = Article::create(
            [
                'body' => $body,
                'user_id' => $user_id,
                'news' => $news,
                'url' => $url,
            ]
        );

        // DBからテストデータを削除
        $response = $this->actingAs($user)->delete(route('articles.destroy', ['article' => $article]));

        // テストデータがDBから削除されているかテスト
        $this->assertDeleted('articles', [
            'body' => $body,
            'user_id' => $user_id
        ]);

        $this->assertDeleted('news_links', [
            'news' => $news,
            'url' => $url,
        ]);

        $response->assertRedirect(route('articles.index'));
    }
}
