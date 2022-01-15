<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * いいね機能のアクションメソッド
     * $article->likesでarticlesモデルからlikesテーブル経由で紐付いているuserモデルのコレクションが返り
     * detach()とattach()で新規登録と複数回いいねの対策を行う
     * 最終的に、articlesモデルとリクエストを送信したユーザーのuserモデルを紐づけるlikesテーブルのレコードを新規登録する
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return array
     */
    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        // 非同期通信に対するレスポンス(JSON形式に変換されてレスポンス)
        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    /**
     * いいね解除機能のアクションメソッド
     * detachで複数回いいねの対策
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Article $article
     * @return array
     */
    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        // 非同期通信に対するレスポンス(JSON形式に変換されてレスポンス)
        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }
}
