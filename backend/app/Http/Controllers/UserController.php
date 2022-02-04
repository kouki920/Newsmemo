<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Models\Article;
use App\Models\User;
use App\Models\NewsLink;
use App\Services\User\UserServiceInterface;
use App\Services\Article\ArticleServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private User $user;
    private Article $article;
    private NewsLink $news_link;
    private UserServiceInterface $userService;
    private ArticleServiceInterface $articleService;

    public function __construct(
        User $user,
        Article $article,
        NewsLink $news_link,
        UserServiceInterface $userService,
        ArticleServiceInterface $articleService
    ) {
        $this->user = $user;
        $this->article = $article;
        $this->news_link = $news_link;
        $this->userService = $userService;
        $this->articleService = $articleService;
    }

    /**
     * ユーザー詳細画面(プロフィール)を表示
     *
     * @param string $name
     * @return Illuminate\View\View
     */
    public function show(User $user, string $name)
    {
        // ログインユーザーの情報を取得
        $user = $this->userService->getUserAndArticleData($name);

        // 取得したユーザーデータをもとにユーザーの投稿データを取得
        $articles = $this->userService->getUserArticleData($user);

        // ログインユーザーが使用したタグデータを取得
        $recentTags = $this->article->getRecentTags($user->id);

        return view('users.show', compact('user', 'articles', 'recentTags'));
    }

    /**
     * ユーザデータの編集
     *
     * @param string $name
     * @return Illuminate\View\View
     */
    public function edit(string $name)
    {
        // ログインユーザーの情報を取得
        $user = $this->userService->getLoginUserData($name);

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * ユーザデータの更新
     *
     * @param \App\Http\Requests\User\UserRequest $request
     * @param string $name
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, string $name): RedirectResponse
    {
        // ログインユーザーの情報を取得
        $user = $this->userService->getLoginUserData($name);

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        $userRecord = $request->validated();

        // ユーザーデータの更新
        $this->userService->update($user, $userRecord);

        return redirect()->route('users.show', ['name' => $user->name])->with('msg_success', __('app.user_update'));
    }

    /**
     * プロフィールアイコンの編集画面を表示
     *
     * @param string $name
     * @return Illuminate\View\View
     */
    public function imageEdit(string $name)
    {
        // ログインユーザーの情報を取得
        $user = $this->userService->getLoginUserData($name);

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        return view('users.image_edit', compact('user'));
    }

    /**
     * プロフィールアイコンの更新
     *
     * @param \App\Http\Requests\User\UserRequest $request
     * @param string $name
     * @return Illuminate\Http\RedirectResponse
     */
    public function imageUpdate(UpdateRequest $request, string $name): RedirectResponse
    {
        // ログインユーザーの情報を取得
        $user = $this->userService->getLoginUserData($name);

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        $image = $request->getImage($request);

        if ($image->isValid()) {
            $filePath = $image->store('public');
            $user->image = str_replace('public/', '', $filePath);
            $user->save();
        }

        return redirect()->route('users.show', ['name' => $user->name])->with('msg_success', __('app.icon_update'));
    }

    /**
     * フォロワー詳細画面の表示
     *
     * @param string $name
     * @return Illuminate\View\View
     */
    public function follower(string $name)
    {
        // ログインユーザーのデータを取得
        $user = $this->userService->getLoginUserData($name);

        // 取得したユーザーデータを利用してフォロワーデータを取得
        $followers = $user->getFollowerOfUser();

        return view('users.follower', compact('user', 'followers'));
    }

    /**
     * フォロー詳細画面の表示
     *
     * @param string $name
     * @return Illuminate\View\View
     */
    public function following(string $name)
    {
        // ログインユーザーのデータを取得
        $user = $this->userService->getLoginUserData($name);

        // 取得したユーザーデータを利用してフォローデータを取得
        $followings = $user->getFollowingOfUser();

        return view('users.following', compact('user', 'followings'));
    }

    /**
     * いいねした投稿を一覧表示
     *
     * @param string $name
     * @return Illuminate\View\View
     */
    public function likes(string $name)
    {
        // ログインユーザーのデータを取得(+いいねに関するデータ)
        $user = $this->user->getUserLikedData($name);

        // いいねに関する投稿データを取得
        $articles = $user->getUserLikedArticleData();

        // 最近使用したタグデータを取得
        $recentTags = $this->articleService->getRecentTags($user->id);

        return view('users.likes', compact('user', 'articles', 'recentTags'));
    }

    /**
     * ユーザーデータを表示
     *
     * @param string $name
     * @return Illuminate\View\View
     */
    public function userData(string $name)
    {
        // ログインユーザーのデータを取得
        $user = $this->userService->getLoginUserData($name);

        // 取得したユーザーの投稿数の合計を取得(アクセサの使用)
        $articles_count = $user->count_article;

        // 投稿ランキングデータを取得
        $rankedArticles = $this->article->getArticleRanking();

        // ニュースランキングデータを取得
        $rankedNews = $this->news_link->getNewsRanking();

        // 最近使用したタグデータを取得
        $recentTags = $this->article->getRecentTags($user->id);

        // 投稿日数の累計データを取得(アクセサの使用)
        $days_posted = $user->count_article_date;

        // ログインユーザーの最終ログイン日時を取得(アクセサの使用)
        $last_login = $user->last_login_date;

        return view('users.data', compact('user', 'articles_count', 'recentTags', 'rankedArticles', 'rankedNews', 'days_posted', 'last_login'));
    }

    /**
     * パスワード変更
     *
     * @param string $name
     * @return Illuminate\View\View
     */
    public function editPassword(string $name)
    {
        // ログインユーザーのデータを取得
        $user = $this->userService->getLoginUserData($name);

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        return view('users.password_edit', compact('user'))->with('msg_success', __('app.password_notification'));
    }

    /**
     * パスワードの更新
     *
     * @param \App\Http\Requests\User\UpdatePasswordRequest $request
     * @param string $name
     * @return Illuminate\Http\RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request, string $name): RedirectResponse
    {
        // ログインユーザーのデータを取得
        $user = $this->userService->getLoginUserData($name);

        // UserPolicyのupdateメソッドでアクセス制限
        $this->authorize('update', $user);

        $user->fill(['password' => Hash::make($request->input('new_password'))])->save();

        return redirect()->route('users.show', ['name' => $user->name])->with('msg_success', __('app.password_update'));
    }


    /**
     * ユーザーデータの削除(退会)
     *
     * @param string $name
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(string $name): RedirectResponse
    {
        // ログインユーザーのデータを取得
        $user = $this->userService->getLoginUserData($name);

        // UserPolicyのdeleteメソッドでアクセス制限
        $this->authorize('delete', $user);

        // ゲストーユーザー以外を削除
        if ($user->id != config('user.guest_user_id')) {
            $user->delete();
        }

        return redirect('register')->with('msg_success', __('app.user_notification'));
    }
}
