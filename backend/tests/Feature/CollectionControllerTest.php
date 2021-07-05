<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use App\Models\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CollectionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * コレクション一覧画面の表示テスト
     * ログイン時、ステータスコード200、viewファイル(collections.index)が使用されているかのテスト
     * factoryで作成したコレクション名が表示されているかのテスト
     */
    public function testAuthIndex()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $collection = factory(Collection::class)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post(route('collections.index', ['id' => $user->id]));

        $response->assertStatus(200)->assertViewIs('collections.index')->assertSee($collection->name);
    }

    /**
     * コレクション登録機能のテスト
     * ログイン時、コレクション登録の処理が機能するかのテスト
     */
    public function testAuthStore()
    {

        $article = factory(Article::class)->create();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('collections.store', ['article' => $article]));

        $response->assertStatus(200);
    }

    /**
     * コレクション名更新機能のテスト
     * ログイン時、ステータスコード200、viewファイル(collections.index)が表示されるかのテスト
     * テスト用に設定したデータがテーブルに保存されているかテスト
     */
    public function testAuthUpdate()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $collection = factory(Collection::class)->create(['user_id' => $user->id]);

        $data = ['name' => 'test'];

        $response = $this->actingAs($user)->patch(route('collections.update', ['collection' => $collection, 'id' => $user->id]), $data);

        $this->assertDatabaseHas('collections', [
            'name' => $data,
        ]);

        $response->assertStatus(200)->assertViewIs('collections.index');
    }

    /**
     * コレクション削除機能のテスト
     * ログイン時、ステータスコード200、テスト実行後viewファイル(collections.index)が表示されるかテスト
     * ファクトリーで作詞したテストデータが削除されるかテスト
     */
    public function testAuthDestroy()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $collection = factory(Collection::class)->create(['user_id' => $user->id]);

        // テストデータが各DBに登録されているかテスト
        $this->assertDatabaseHas('collections', [
            'name' => $collection->name,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->delete(route('collections.destroy', ['collection' => $collection, 'id' => $user->id]));

        // テストデータがDBから削除されているかテスト
        $this->assertDeleted('collections', [
            'name' => $collection->name,
            'user_id' => $user->id,
        ]);

        $response->assertStatus(200)->assertViewIs('collections.index');
    }
}
