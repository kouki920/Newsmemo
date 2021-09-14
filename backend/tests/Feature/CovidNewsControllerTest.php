<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CovidNewsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * コロナ関連ニュースの一覧表示機能のテスト
     * 未ログイン時、ログイン画面にリダイレクトするテスト
     */
    public function testGuestCovidNewsDefaultIndex()
    {
        $response = $this->get(route('news.covid_default_index'));

        $response->assertRedirect('login');
    }

    /**
     * コロナ関連ニュースの一覧表示機能のテスト
     * ログイン時、コロナ関連のニュース一覧画面に遷移できるかテスト、指定した文字列が表示されているかのテスト
     */
    public function testCovidNewsDefaultIndex()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('news.covid_default_index'));

        $response->assertStatus(200)
            ->assertViewIs('articles.covid_index')
            ->assertSee('ニュース')
            ->assertSee('COVID-19')
            ->assertSee('投稿')
            ->assertSee('マイページ');
    }
}
