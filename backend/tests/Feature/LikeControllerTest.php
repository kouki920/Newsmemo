<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * いいねされているかどうかを判定するisLikedByメソッドのテスト
     * 引数がnullの場合をテストする
     */
    public function testIsLikedByNull()
    {
        $article = factory(Article::class)->create();

        $result = $article->isLikedBy(null);

        $this->assertFalse($result);
    }

    /**
     * いいねされているかどうかを判定するisLikedByメソッドのテスト
     * メモをいいねしているUserモデルのインスタンスを引数として渡した場合のテスト
     * attachメソッドを使いlikesテーブルのuser_idとarticle_idに、それぞれ$user->id値と$article->id値を登録する
     */
    public function testIsLikedByTheUser()
    {
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();

        $article->likes()->attach($user);

        $result = $article->isLikedBy($user);

        // 引数がtrueであるかテスト
        $this->assertTrue($result);
    }

    /**
     * いいねされているかどうかを判定するisLikedByメソッドのテスト
     * メモをいいねしていないユーザーをテストする場合
     */
    public function testIsLikedByAnother()
    {
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();

        // $anotherでいいねする方の別ユーザーを作成
        $another = factory(User::class)->create();
        $article->likes()->attach($another);

        // メソッドテストではいいねしていない$user側のデータを引数に入れるP
        $result = $article->isLikedBy($user);

        // 引数がfalseであるかテスト
        $this->assertFalse($result);
    }
}
