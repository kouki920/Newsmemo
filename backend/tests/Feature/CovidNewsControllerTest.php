<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CovidNewsControllerTest extends TestCase
{
    use RefreshDatabase;

    ### コロナ関連ニュース一覧機能のテスト ###

    // ログイン時
    public function testCovidNewsIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('news.covid_default_index'));

        $response->assertStatus(200)
            ->assertViewIs('articles.covid_index');
    }
}
