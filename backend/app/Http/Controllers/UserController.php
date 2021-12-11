<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Models\Article;
use App\Models\User;
use App\Models\NewsLink;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * ユーザー詳細画面(プロフィール)を表示
     *
     * @param \App\Models\Article $article
     * @param \App\Models\User $user
     * @param string $name
     * @return Illuminate\View\View
     */
    public function show(Article $article, User $user, string $name)
    {
        $user = $user->getUserData($name)->load(['articles.user', 'articles.likes', 'articles.tags', 'articles.newsLink']);

        $articles = $user->getUserArticleData();

        $recent_tags = $article->getRecentTags($user->id);

        return view('users.show', compact('user', 'articles', 'recent_tags'));
    }

    /**
     * ユーザデータの編集
     *
     * @param \App\Models\User $user
     * @param string $name
     * @return Illuminate\View\View
     */
    public function edit(User $user, string $name)
    {
        $user = $user->getUserData($name);

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * ユーザデータの更新
     *
     * @param \App\Http\Requests\User\UserRequest $request
     * @param \App\Models\User $user
     * @param string $name
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, User $user, string $name)
    {
        $user = $user->getUserData($name);

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        $user->fill($request->validated())->save();

        return redirect()->route('users.show', ['name' => $user->name])->with('msg_success', 'プロフィールを編集しました');
    }

    /**
     * プロフィールアイコンの編集画面を表示
     *
     * @param \App\Models\User $user
     * @param string $name
     * @return Illuminate\View\View
     */
    public function imageEdit(User $user, string $name)
    {
        $user = $user->getUserData($name);

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        return view('users.image_edit', compact('user'));
    }

    /**
     * プロフィールアイコンの更新
     *
     * @param \App\Http\Requests\User\UserRequest $request
     * @param \App\Models\User $user
     * @param string $name
     * @return Illuminate\Http\RedirectResponse
     */
    public function imageUpdate(UpdateRequest $request, User $user, string $name)
    {
        $user = $user->getUserData($name);

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

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
     *
     * @param \App\Models\Article $article
     * @param \App\Models\User $user
     * @param string $name
     * @return Illuminate\View\View
     */
    public function follower(User $user, Article $article, string $name)
    {
        $user = $user->getUserData($name)->load('followers.followers');

        $followers = $user->getUserFollower();

        return view('users.follower', compact('user', 'followers'));
    }

    /**
     * フォロー詳細画面の表示
     *
     * @param \App\Models\Article $article
     * @param \App\Models\User $user
     * @param string $name
     * @return Illuminate\View\View
     */
    public function following(User $user, Article $article, string $name)
    {
        $user = $user->getUserData($name)->load('followings.followers');

        $followings = $user->getUserFollowing();

        return view('users.following', compact('user', 'followings'));
    }

    /**
     * いいねした投稿を一覧表示
     *
     * @param \App\Models\User $user
     * @param \App\Models\Article $article
     * @param string $name
     * @return Illuminate\View\View
     */
    public function likes(User $user, Article $article, string $name)
    {
        $user = $user->getUserData($name)->load(['likes.user', 'likes.likes', 'likes.tags']);

        $articles = $user->getUserLikedArticleData();

        $articles_count = $user->getCountArticle();

        $recent_tags = $article->getRecentTags($user->id);

        return view('users.likes', compact('user', 'articles', 'recent_tags', 'articles_count'));
    }

    /**
     * ユーザーデータを表示
     *
     * @param \App\Models\User $user
     * @param \App\Models\Article $article
     * @return Illuminate\View\View
     */
    public function userData(User $user, Article $article, NewsLink $newsLink, string $name)
    {
        $user = $user->getUserData($name)->load(['likes.user', 'likes.likes', 'likes.tags']);

        $articles_count = $user->getCountArticle();

        $ranked_articles = $article->getArticleRanking();
        $ranked_news = $newsLink->getNewsRanking();

        $recent_tags = $article->getRecentTags($user->id);

        $days_posted = $user->articles->groupBy('created_date')->count();

        $last_login = $user->last_login_date;

        return view('users.data', compact('user', 'articles_count', 'recent_tags', 'ranked_articles', 'ranked_news', 'days_posted', 'last_login'));
    }

    /**
     * パスワード変更
     *
     * @param \App\Models\User $user
     * @param string $name
     * @return Illuminate\View\View
     */
    public function editPassword(User $user, string $name)
    {
        $user = $user->getUserData($name)->load(['likes.user', 'likes.likes', 'likes.tags']);

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        session()->flash('msg_success', 'パスワードを変更してください');

        return view('users.password_edit', compact('user'));
    }

    /**
     * パスワードの更新
     *
     * @param \App\Http\Requests\User\UpdatePasswordRequest $request
     * @param \App\Models\User $user
     * @param string $name
     * @return Illuminate\Http\RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request, User $user, string $name)
    {
        $user = $user->getUserData($name);

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        $user->fill(['password' => Hash::make($request->input('new_password'))])->save();

        return redirect()->route('users.show', ['name' => $user->name])->with('msg_success', 'パスワードを変更しました');
    }


    /**
     * ユーザーデータの削除(退会)
     *
     * @param \App\Models\User $user
     * @param string $name
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user, string $name)
    {
        $user = $user->getUserData($name)->load(['likes.user', 'likes.likes', 'likes.tags']);

        // UserPolicyのdeleteメソッドでアクセス制限
        $this->authorize('delete', $user);

        if ($user->id != config('user.guest_user_id')) {
            $user->delete();
        }

        return redirect('register')->with('msg_success', 'ユーザー登録をしてください');
    }
}
