<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use App\Models\Memo;
use App\Models\NewsLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MemoControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 非公開メモ登録機能のテスト
     * ログイン時、メモがテーブルに保存されているかのテスト、登録後リダイレクトするかのテスト
     *
     * @return void
     */
    public function testAuthStore()
    {
        $user = factory(User::class)->create();

        $article = factory(Article::class)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->from('articles.show')->post(route('memos.store', ['article' => $article]),  [
            'user_id' => $user->id,
            'article_id' => $article->id,
            'body' => 'テスト',
        ]);

        $this->assertDatabaseHas('memos', [
            'user_id' => $user->id,
            'article_id' => $article->id,
            'body' => 'テスト',
        ]);

        $response->assertStatus(302);
    }

    /**
     * 非公開メモ編集画面表示のテスト
     * ログイン時、ステータスコード200、編集画面を表示するかのテスト
     */
    public function testAuthEdit()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $article = factory(Article::class)->create();

        $news_link = factory(NewsLink::class)->create([
            'article_id' => $article->id,
        ]);

        $memo = factory(Memo::class)->create(['user_id' => $user->id, 'article_id' => $article->id]);

        $response = $this->actingAs($user)->get(route('memos.edit', ['memo' => $memo, 'article' => $article]));

        $response->assertStatus(200)->assertViewIs('memos.edit')
            ->assertSee('編集');
    }

    /**
     * 非公開メモ削除機能のテスト
     */
    public function testAuthDestroy()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $article = factory(Article::class)->create(
            [
                'user_id' => $user->id,
            ]
        );

        $memo = factory(Memo::class)->create(['user_id' => $user->id, 'article_id' => $article->id]);

        $this->assertDatabaseHas('memos', [
            'user_id' => $memo->user_id,
            'article_id' => $memo->article_id,
            'body' => $memo->body,
        ]);

        $response = $this->actingAs($user)->from('articles.show')->delete(route('memos.destroy', ['memo' => $memo]));

        $this->assertDeleted('memos', [
            'user_id' => $memo->user_id,
            'article_id' => $memo->article_id,
            'body' => $memo->body,
        ]);

        $response->assertStatus(302)->assertRedirect('articles.show');
    }
}
