<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 設定一覧画面の表示テスト
     * ログイン時、ステータスコード200、viewファイル('settings.index')が使用されているかのテスト
     * 画面表示時、利用規約とお問い合わせ文字列が表示されているかのテスト
     *
     */
    public function testAuthIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('settings.index'));

        $response->assertStatus(200)->assertViewIs('settings.index')
            ->assertSee('利用規約')
            ->assertSee('お問い合わせ');
    }
}
