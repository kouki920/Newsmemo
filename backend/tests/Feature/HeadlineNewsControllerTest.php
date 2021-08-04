<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HeadlineNewsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ヘッドラインニュースの一覧表示機能のテスト
     * 未ログイン時、ログイン画面にリダイレクトするテスト
     */
    public function testGuestHeadlineNewsDefaultIndex()
    {
        $response = $this->get(route('news.default_index'));

        $response->assertRedirect('login');
    }

    /**
     * ヘッドラインニュースの一覧表示機能のテスト
     * ログイン時、ヘッドラインニュース一覧画面に遷移するかのテスト、指定した文字列が表示されているかのテスト
     */
    public function testHeadlineNewsIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('news.default_index'));

        $response->assertStatus(200)
            ->assertViewIs('articles.news_index')
            ->assertSee('ニュース')
            ->assertSee('COVID-19')
            ->assertSee('投稿')
            ->assertSee('マイページ');
    }
}
