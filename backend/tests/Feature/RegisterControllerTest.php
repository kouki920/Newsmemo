<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;


    ### ユーザー登録画面表示のテスト ###
    public function testGuestShow()
    {
        $response = $this->get(route('register'));
        $response->assertViewIs('auth.register');
    }


    ### ユーザー登録のテスト ###

    public function testCreate()
    {
        $response = $this
            ->from('articles')
            ->post(
                route('register'),
                [
                    'name' => 'testUser',
                    'email' => 'test@example.com',
                    'password' => 'password123',
                    'password_confirmation' => 'password123',
                ]
            );

        $response->assertRedirect(route('articles.index'));
    }


    ### エラー時のテスト ###

    // 名前未入力
    public function testNameError()
    {
        $response = $this
            ->post(
                route('register'),
                [
                    'name' => '',
                    'email' => 'test@example.com',
                    'password' => 'password123',
                    'password_confirmation' => 'password123',
                ]
            );

        $errorMessage = 'ユーザー名は必ず指定してください。';
        $this->get(route('register'))->assertSee($errorMessage);
    }

    // メールアドレス未入力
    public function testEmailError()
    {
        $response = $this
            ->post(
                route('register'),
                [
                    'name' => 'testUser',
                    'email' => '',
                    'password' => 'password123',
                    'password_confirmation' => 'password123',
                ]
            );

        $errorMessage = 'メールアドレスは必ず指定してください。';
        $this->get(route('register'))->assertSee($errorMessage);
    }

    // パスワード未入力
    public function testPasswordError()
    {
        $response = $this
            ->post(
                route('register'),
                [
                    'name' => 'testUser',
                    'email' => 'test@example.com',
                    'password' => '',
                    'password_confirmation' => '',
                ]
            );

        $errorMessage = 'パスワードは必ず指定してください。';
        $this->get(route('register'))->assertSee($errorMessage);
    }

    // 有効ではないメールアドレスを入力
    public function testNotEmailError()
    {
        $response = $this
            ->post(
                route('register'),
                [
                    'name' => 'testUser',
                    'email' => 'test@example.hoge',
                    'password' => 'password123',
                    'password_confirmation' => 'password123',
                ]
            );

        $errorMessage = 'メールアドレスには、有効なメールアドレスを指定してください。';
        $this->get(route('register'))->assertSee($errorMessage);
    }

    // メールアドレスの重複
    public function testDuplicateEmailError()
    {
        $user = factory(User::class)->create();

        $email = $user->email;

        $response = $this
            ->post(
                route('register'),
                [
                    'name' => 'testUser',
                    'email' => $email,
                    'password' => 'password123',
                    'password_confirmation' => 'password123',
                ]
            );

        $errorMessage = 'メールアドレスの値は既に存在しています。';
        $this->get(route('register'))->assertSee($errorMessage);
    }
}
