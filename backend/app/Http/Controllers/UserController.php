<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()->load(['articles.user', 'articles.likes', 'articles.tags']);

        $articles = $user->articles->sortByDesc('created_at');

        return view('users.show', compact('user', 'articles'));
    }

    public function edit(string $name)
    {
        $user = User::where('name', $name)->first();

        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, string $name)
    {
        $user = User::where('name', $name)->first();

        $user->fill($request->all())->save();

        return redirect()->route('users.show', ['name' => $user->name]);
    }

    public function follower(string $name)
    {
        $user = User::where('name', $name)->first()->load('followers.followers');

        $followers = $user->followers->sortByDesc('created_at');

        return view('users.follower', compact('user', 'followers'));
    }

    public function following(string $name)
    {
        $user = User::where('name', $name)->first()->load('followings.followers');

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.following', compact('user', 'followings'));
    }

    /**
     * いいねした投稿を一覧表示できるメソッド
     */
    public function likes(string $name)
    {
        $user = User::where('name', $name)->first()->load(['likes.user', 'likes.likes', 'likes.tags']);

        $articles = $user->likes->sortByDesc('created_at');

        return view('users.likes', compact('user', 'articles'));
    }

    /**
     * フォローするメソッド
     */
    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $name];
    }

    /**
     * フォローを解除するメソッド
     */
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }
}
