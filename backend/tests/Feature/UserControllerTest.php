<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use App\Models\NewsLink;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ユーザーマイページ画面表示のテスト
     * ログイン時,ステータスコード200の確認、viewファイル('users.show')が利用されているかのテスト
     */
    public function testAuthShow()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.show', ['name' => $user->name]));

        $response->assertStatus(200)->assertViewIs('users.show')
            ->assertSee('最近使用したタグ')
            ->assertSee('編集')
            ->assertSee('投稿')
            ->assertSee('ブックマーク')
            ->assertSee('その他');
    }

    /**
     * ユーザー編集機能 画面表示のテスト
     * ログイン時、ステータスコード200、viewファイル('users.edit')の使用、レスポンスに含まれる文字列のテスト
     */
    public function testAuthUserEditScreen()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.edit', ['name' => $user->name]));

        $response->assertStatus(200)->assertViewIs('users.edit')
            ->assertSee('プロフィールの編集')
            ->assertSee($user->name)
            ->assertSee($user->email)
            ->assertSee($user->introduction);
    }

    /**
     * ユーザーアイコンの変更画面表示テスト
     */
    public function testAuthImageEdit()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.image_edit', ['name' => $user->name]));

        $response->assertStatus(200)->assertViewIs('users.image_edit')
            ->assertSee('ユーザーアイコンの編集');
    }

    /**
     * ユーザー退会機能のテスト
     * 削除後、登録画面にリダイレクトするかのテスト
     */
    public function testAuthDestroy()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->delete(route('users.destroy', ['name' => $user->name]));

        $response->assertRedirect(route('register'));
    }
}
