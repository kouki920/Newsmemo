<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ログイン成功のテスト
     *
     */
    public function testLogin()
    {
        // ログイン用のユーザーを作成
        $user = factory(User::class)->create();

        // 認証されていないことを確認
        $this->assertFalse(Auth::check());

        // ログイン実行
        $response  = $this->post(route('login'), ['email' => $user->email, 'password' => 'password123']);

        // ステータスコードとリダイレクト先を確認
        $response->assertStatus(302)->assertRedirect('/articles');

        // 認証されていることを確認
        $this->assertTrue(Auth::check());
    }

    /**
     * ログイン失敗のテスト
     */
    public function testLoginFailure()
    {
        // ログイン用のユーザーを作成
        $user = factory(User::class)->create();

        // 認証されていないことを確認
        $this->assertFalse(Auth::check());

        // ログイン実行
        $response  = $this->post(route('login'), ['email' => $user->email, 'password' => 'password111']);

        // 認証失敗で、認証されていないことを確認
        $this->assertFalse(Auth::check());

        // セッションにエラーを含むことを確認
        $response->assertSessionHasErrors(['email']);

        // エラーメッセージの確認
        $this->assertEquals('ログイン情報が登録されていません。', session('errors')->first('email'));
    }
}
