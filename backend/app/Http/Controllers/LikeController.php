<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * いいね機能のアクションメソッド
     * detachで複数回いいねの対策
     * @param Request $request
     * @param Article $article
     * @return array
     */
    public function like(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }

    /**
     * いいね解除機能のアクションメソッド
     * detachで複数回いいねの対策
     * @param Request $request
     * @param Article $article
     * @return array
     */
    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'id' => $article->id,
            'countLikes' => $article->count_likes,
        ];
    }
}
