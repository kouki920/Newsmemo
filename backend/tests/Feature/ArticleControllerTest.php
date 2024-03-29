<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use App\Models\NewsLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 投稿一覧表示機能のテスト
     * 未ログイン時、login画面にリダイレクトするかどうかをテスト
     */
    public function testGuestIndex()
    {
        // 未ログイン状態でgetリクエストを送る
        $response = $this->get(route('articles.index'));

        // 引数として渡したURLにリダイレクトされたかどうかをテスト
        $response->assertRedirect('login');
    }

    /**
     * 投稿一覧表示機能のテスト
     * ログイン時、ステータスコード200かどうか、viewファイル(articles.index)が使用されているかのテスト
     * 一覧画面で表示される文字列をテスト
     */
    public function testAuthIndex()
    {
        if (!extension_loaded('mysqli')) {
            $this->markTestSkipped(
                'ドライバの理由上、実行できないテスト'
            );
        }

        $this->withoutExceptionHandling();
        // 定義したファクトリーを利用してを作成
        $user = factory(User::class)->create();

        // actingAs()で認証済み状態(ログイン状態)にしてgetリクエストを送る
        $response = $this->actingAs($user)
            ->get(route('articles.index'));

        $response->assertStatus(200)
            ->assertViewIs('articles.index')
            ->assertSee($user->name)
            ->assertSee('NEWS')
            ->assertSee('COVID-19')
            ->assertSee('POST')
            ->assertSee('PROFILE');
    }


    /**
     * 投稿画面の表示機能のテスト
     * 未ログイン時、ログイン画面にリダイレクトするかのテスト
     */
    public function testGuestCreate()
    {
        $response = $this->post(route('articles.create'));

        $response->assertRedirect('login');
    }

    /**
     * 投稿画面表示機能のテスト
     * ログイン時、投稿画面に移動しステータスコードが200かどうかテスト
     * viewファイル(articles/create)が利用されているかテスト
     */
    public function testAuthCreate()
    {
        // 定義したファクトリーを利用してを作成
        $user = factory(User::class)->create();

        // actingAs()で認証済み状態(ログイン状態)にしてpostリクエストを送る
        $response = $this->actingAs($user)
            ->post(route('articles.create'));

        $response->assertStatus(200)
            ->assertViewIs('articles.create');
    }


    /**
     * 投稿機能のテスト
     * 未ログイン時、ログイン画面にリダイレクトするかのテスト
     */
    public function testGuestStore()
    {
        $response = $this->post(route('articles.store'));

        $response->assertRedirect('login');
    }

    /**
     * 投稿機能のテスト
     * ログイン時、認証済みユーザーがデータを登録できるかのテスト
     * DBにデータが登録されているかのテスト
     * 登録成功時、投稿一覧画面に移動するかのテスト
     */
    public function testAuthStore()
    {
        // 定義したファクトリーを利用して、投稿データ、ニュースデータを作成
        $user = factory(User::class)->create();

        $article = factory(Article::class)->create();

        $news_link = factory(NewsLink::class)->create([
            'article_id' => $article->id,
        ]);

        $response = $this->actingAs($user)
            ->post(route(
                'articles.store',
                [
                    'body' => $article->body,
                    'user_id' => $user->id,
                    'news' => $news_link->news,
                    'url' => $news_link->url,
                ]
            ));

        // テストデータが各DBに登録されているかテスト
        $this->assertDatabaseHas('articles', [
            'body' => $article->body,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('news_links', [
            'news' => $news_link->news,
            'url' => $news_link->url,
        ]);

        $response->assertRedirect(route('articles.index'));
    }


    /**
     * 投稿編集画面の表示機能のテスト
     * 未ログイン時、ログイン画面にリダイレクトするかのテスト
     */
    public function testGuestEdit()
    {
        $article = factory(Article::class)->create()->each(function (Article $article) {
            $article->newsLink()->save(factory(NewsLink::class)->make());
        });

        $response = $this->get(route('articles.edit', ['article' => $article]));

        $response->assertRedirect('login');
    }

    /**
     * 投稿編集画面の表示機能のテスト
     * ログイン時、に紐づく投稿データを引数として編集画面に移動しステータスコードが200かどうかテスト
     * viewファイル(articles/edit)が利用されているかどうかのテスト
     */
    public function testAuthEdit()
    {
        $this->withoutExceptionHandling();

        $article = factory(Article::class)->create();
        $news_link = factory(NewsLink::class)->create([
            'article_id' => $article->id,
        ]);

        $user = $article->user;

        $response = $this->actingAs($user)->get(route('articles.edit', ['article' => $article]));

        $response->assertStatus(200)->assertViewIs('articles.edit')
            ->assertSee($news_link->news)
            ->assertSee($news_link->url);
    }

    /**
     * 投稿削除機能のテスト
     * ログイン時、投稿データとニュース関連のデータを削除できるかテスト
     */
    public function testAuthDestroy()
    {
        $this->withoutExceptionHandling();

        // 定義したファクトリーを利用して、投稿データ、newsデータを作成
        $user = factory(User::class)->create();

        $article = factory(Article::class)->create(
            [
                'user_id' => $user->id,
            ]
        );

        $news_link = factory(NewsLink::class)->create(
            [
                'article_id' => $article->id,
            ]
        );

        $this->assertDatabaseHas('articles', [
            'body' => $article->body,
            'user_id' => $article->user_id,
        ]);

        $this->assertDatabaseHas('news_links', [
            'article_id' => $news_link->article_id,
            'news' => $news_link->news,
            'url' => $news_link->url,
        ]);

        // DBからテストデータを削除
        $response = $this->actingAs($user)->delete(route('articles.destroy', ['article' => $article]));

        // テストデータがDBから削除されているかテスト
        $this->assertDeleted('articles', [
            'body' => $article->body,
            'user_id' => $user->id,
        ]);

        $this->assertDeleted('news_links', [
            'article_id' => $article->id,
            'news' => $news_link->news,
            'url' => $news_link->url,
        ]);

        $response->assertRedirect(route('articles.index'));
    }
}
