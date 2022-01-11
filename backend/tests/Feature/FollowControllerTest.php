<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FollowControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * フォロー機能のテスト
     * ログイン時、ステータスコード200かどうかテスト、中間テーブルにデータが保存されているかのテスト
     */
    public function testAuthFollow()
    {
        $this->withoutExceptionHandling();

        $user_one = factory(User::class)->create();

        $user_two = factory(User::class)->create();

        $response = $this->actingAs($user_one)->put(route('users.follow', ['name' => $user_two->name]));

        $this->assertDatabaseHas('follows', [
            'follower_id' => $user_one->id,
            'followee_id' => $user_two->id,
        ]);

        $response->assertStatus(200);
    }

    /**
     * フォロー解除機能のテスト
     * ログイン時、中間テーブルのデータが削除されているかのテスト、ステータスコード200かどうかテスト
     */
    public function testAuthUnFollow()
    {
        $this->withoutExceptionHandling();

        $user_one = factory(User::class)->create();

        $user_two = factory(User::class)->create();

        $response = $this->actingAs($user_one)->delete(route('users.unfollow', ['name' => $user_two->name]));

        $this->assertDeleted('follows', [
            'follower_id' => $user_one->id,
            'followee_id' => $user_two->id,
        ]);

        $response->assertStatus(200);
    }
}
