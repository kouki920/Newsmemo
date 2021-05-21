<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;


    ### ユーザーマイページ画面表示のテスト ###

    // ログイン時
    public function testAuthShow()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.show', ['name' => $user->name]));

        $response->assertStatus(200)->assertViewIs('users.show');
    }


    ### ユーザー編集機能 画面表示のテスト ###

    // ログイン時
    public function testAuthEdit()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.edit', ['name' => $user->name]));

        $response->assertStatus(200)->assertViewIs('users.edit');
    }


    ### ユーザー退会機能のテスト ###

    // ログイン時
    public function testAuthDestroy()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->delete(route('users.destroy', ['name' => $user->name]));

        $response->assertRedirect(route('register'));
    }
}
