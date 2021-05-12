<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * ユーザー詳細画面の表示
     * @param Article $article
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article, string $name)
    {
        $user = User::where('name', $name)->first()->load(['articles.user', 'articles.likes', 'articles.tags']);

        $articles = $user->articles->sortByDesc('created_at')->paginate(10);

        $total_category = $article->totalCategory($user->id);

        return view('users.show', compact('user', 'articles', 'total_category'));
    }

    /**
     * ユーザデータの編集
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function edit(string $name)
    {
        $user = User::where('name', $name)->first();

        return view('users.edit', compact('user'));
    }

    /**
     * ユーザデータの更新
     * @param UserRequest $request
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();

        $user->fill($request->all())->save();

        return redirect()->route('users.show', ['name' => $user->name])->with('msg_success', 'プロフィールを編集しました');
    }

    /**
     * プロフィールアイコンの編集画面を表示
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function imageEdit(string $name)
    {
        $user = User::where('name', $name)->first();

        return view('users.image_edit', compact('user'));
    }

    /**
     * プロフィールアイコンの更新
     * @param UserRequest $request
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function imageUpdate(UpdateRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();

        $image = $request->getImage($request);

        if ($image->isValid()) {
            $filePath = $image->store('public');
            $user->image = str_replace('public/', '', $filePath);
            $user->save();
        }

        return redirect()->route('users.show', ['name' => $user->name])->with('msg_success', 'プロフィールアイコンを変更しました');
    }

    /**
     * フォロワー詳細画面の表示
     * @param Article $article
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function follower(Article $article, string $name)
    {
        $user = User::where('name', $name)->first()->load('followers.followers');

        $followers = $user->followers->sortByDesc('created_at');

        $total_category = $article->totalCategory($user->id);

        return view('users.follower', compact('user', 'followers', 'total_category'));
    }

    /**
     * フォロー詳細画面の表示
     * @param Article $article
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function following(Article $article, string $name)
    {
        $user = User::where('name', $name)->first()->load('followings.followers');

        $followings = $user->followings->sortByDesc('created_at');

        $total_category = $article->totalCategory($user->id);

        return view('users.following', compact('user', 'followings', 'total_category'));
    }

    /**
     * いいねした投稿を一覧表示
     * @param Article $article
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function likes(Article $article, string $name)
    {
        $user = User::where('name', $name)->first()->load(['likes.user', 'likes.likes', 'likes.tags']);

        $articles = $user->likes->sortByDesc('created_at')->paginate(10);

        $total_category = $article->totalCategory($user->id);

        return view('users.likes', compact('user', 'articles', 'total_category'));
    }
}
