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


    /**
     * ユーザー登録画面表示のテスト
     * 登録画面が表示され、指定した文字列が表示されるかのテスト
     */
    public function testGuestShow()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200)->assertViewIs('auth.register')
            ->assertSee('ユーザー登録')
            ->assertSee('お名前')
            ->assertSee('メールアドレス')
            ->assertSee('パスワード')
            ->assertSee('パスワード(再確認)');
    }

    /**
     * ユーザー登録のテスト
     */
    public function testCreate()
    {
        $this->withoutExceptionHandling();

        $testUserName = 'テストユーザー';
        $testEmail = 'test@gmail.com';
        $testPassword = 'password123';
        $testPasswordConfirmation = 'password123';

        $response = $this
            ->post(
                route('register'),
                [
                    'name' => $testUserName,
                    'email' => $testEmail,
                    'password' => $testPassword,
                    'password_confirmation' => $testPasswordConfirmation,
                ]
            );

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('users', [
            'name' => $testUserName,
            'email' => $testEmail,
        ]);

        $response->assertStatus(302)->assertRedirect(route('articles.index'));
    }

    /**
     * 名前未入力時のエラーテスト
     */
    public function testNameError()
    {
        $testUserName = null;
        $testEmail = 'test@gmail.com';
        $testPassword = 'password123';
        $testPasswordConfirmation = 'password123';

        $response = $this
            ->post(
                route('register'),
                [
                    'name' => $testUserName,
                    'email' => $testEmail,
                    'password' => $testPassword,
                    'password_confirmation' => $testPasswordConfirmation,
                ]
            );

        $errorMessage = 'ユーザー名は必ず指定してください。';
        $this->get(route('register'))->assertSee($errorMessage);
    }

    /**
     * メールアドレス未入力時のエラーテスト
     */
    public function testEmailError()
    {
        $testUserName = 'テストユーザー';
        $testEmail = null;
        $testPassword = 'password123';
        $testPasswordConfirmation = 'password123';

        $response = $this
            ->post(
                route('register'),
                [
                    'name' => $testUserName,
                    'email' => $testEmail,
                    'password' => $testPassword,
                    'password_confirmation' => $testPasswordConfirmation,
                ]
            );

        $errorMessage = 'メールアドレスは必ず指定してください。';
        $this->get(route('register'))->assertSee($errorMessage);
    }

    /**
     * パスワード未入力時のエラーテスト
     */
    public function testPasswordError()
    {
        $testUserName = 'テストユーザー';
        $testEmail = 'test@gmail.com';
        $testPassword = null;
        $testPasswordConfirmation = null;

        $response = $this
            ->post(
                route('register'),
                [
                    'name' => $testUserName,
                    'email' => $testEmail,
                    'password' => $testPassword,
                    'password_confirmation' => $testPasswordConfirmation,
                ]
            );

        $errorMessage = 'パスワードは必ず指定してください。';
        $this->get(route('register'))->assertSee($errorMessage);
    }

    /**
     * パスワード入力値と再確認入力値の不一致時のエラーテスト
     */
    public function testPasswordMismatchError()
    {
        $testUserName = 'テストユーザー';
        $testEmail = 'test@gmail.com';
        $testPassword = 'password123';
        $testPasswordConfirmation = 'password1234';

        $response = $this
            ->post(
                route('register'),
                [
                    'name' => $testUserName,
                    'email' => $testEmail,
                    'password' => $testPassword,
                    'password_confirmation' => $testPasswordConfirmation,
                ]
            );

        $errorMessage = 'パスワードと、確認フィールドとが、一致していません。';
        $this->get(route('register'))->assertSee($errorMessage);
    }

    /**
     * 有効ではないメールアドレスを入力時のエラーテスト
     */
    public function testNotEmailError()
    {
        $testUserName = 'テストユーザー';
        $testEmail = 'test@gmail.hoge';
        $testPassword = 'password123';
        $testPasswordConfirmation = 'password123';

        $response = $this
            ->post(
                route('register'),
                [
                    'name' => $testUserName,
                    'email' => $testEmail,
                    'password' => $testPassword,
                    'password_confirmation' => $testPasswordConfirmation,
                ]
            );

        $errorMessage = 'メールアドレスには、有効なメールアドレスを指定してください。';
        $this->get(route('register'))->assertSee($errorMessage);
    }

    /**
     * メールアドレスの重複時のエラーテスト
     */
    public function testDuplicateEmailError()
    {
        $user = factory(User::class)->create();

        $email = $user->email;

        $testUserName = 'テストユーザー';
        $testEmail = $email;
        $testPassword = 'password123';
        $testPasswordConfirmation = 'password123';


        $response = $this
            ->post(
                route('register'),
                [
                    'name' => $testUserName,
                    'email' => $testEmail,
                    'password' => $testPassword,
                    'password_confirmation' => $testPasswordConfirmation,
                ]
            );

        $errorMessage = 'メールアドレスの値は既に存在しています。';
        $this->get(route('register'))->assertSee($errorMessage);
    }
}
