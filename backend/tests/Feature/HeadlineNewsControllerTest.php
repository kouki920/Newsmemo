<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HeadlineNewsControllerTest extends TestCase
{
    use RefreshDatabase;

    ### ヘッドラインニュース一覧表示のテスト ###

    // ログイン時
    public function testCovidNewsIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('news.default_index'));

        $response->assertStatus(200)
            ->assertViewIs('articles.news_index');
    }
}
