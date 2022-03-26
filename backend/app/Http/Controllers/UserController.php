<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\UpdatePasswordRequest;
use App\Models\Article;
use App\Models\User;
use App\Models\NewsLink;
use App\Services\User\UserServiceInterface;
use App\Services\Article\ArticleServiceInterface;
use App\Services\NewsLink\NewsLinkService;
use App\Services\NewsLink\NewsLinkServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private User $user;
    private Article $article;
    private NewsLink $news_link;
    private UserServiceInterface $userService;
    private ArticleServiceInterface $articleService;
    private NewsLinkServiceInterface $newsLinkService;

    public function __construct(
        User $user,
        Article $article,
        NewsLink $news_link,
        UserServiceInterface $userService,
        ArticleServiceInterface $articleService,
        NewsLinkServiceInterface $newsLinkService
    ) {
        $this->user = $user;
        $this->article = $article;
        $this->news_link = $news_link;
        $this->userService = $userService;
        $this->articleService = $articleService;
        $this->newsLinkService = $newsLinkService;
    }

    /**
     * ユーザー詳細画面(プロフィール)を表示
     *
     * @param \App\Models\User $user
     * @param string $name
     * @return Illuminate\View\View
     */
    public function show(User $user, string $name)
    {
        // ログインユーザーの情報を取得
        $user = $this->userService->getUserAndArticleData($name);

        // 取得したユーザーデータをもとにユーザーの投稿データを取得
        $articles = $this->userService->getUserArticleData($user);

        // ログインユーザーが最近使用したタグデータを取得
        $recentTags = $this->userService->getRecentTags($user);

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
            $path = Storage::disk('s3')->putFile('/profile', $image, 'public');
            $user->image = Storage::disk('s3')->url($path);

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
        $followers = $this->userService->getFollowerOfUser($user);

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
        $followings = $this->userService->getFollowingOfUser($user);

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
        $user = $this->userService->getUserLikedData($name);

        // いいねに関する投稿データを取得
        $articles = $this->userService->getUserLikedArticleData($user);

        // 最近使用したタグデータを取得
        $recentTags = $this->userService->getRecentTags($user);

        return view('users.likes', compact('user', 'articles', 'recentTags'));
    }

    /**
     * ユーザーデータを表示
     *
     * @param string $name
     * @param \App\Models\NewsLink $newsLink
     * @param \App\Models\Article $article
     * @return Illuminate\View\View
     */
    public function userData(string $name, NewsLink $newsLink, Article $article)
    {
        // ログインユーザーのデータを取得
        $user = $this->userService->getLoginUserData($name);

        // 取得したユーザーの投稿数の合計を取得
        $articles_count = $this->userService->getCountArticle($user);

        // 投稿ランキングデータを取得
        $rankedArticles = $this->articleService->getArticleRanking($article);

        // ニュースランキングデータを取得
        $rankedNews = $this->newsLinkService->getNewsRanking($newsLink);

        // 最近使用したタグデータを取得
        $recentTags = $this->userService->getRecentTags($user);

        // 投稿日数の累計データを取得
        $days_posted = $this->userService->getCountArticleDate($user);

        // ログインユーザーの最終ログイン日時を取得
        $last_login = $this->userService->getLastLoginDate($user);

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

        // パスワードの更新
        $this->userService->updateUserPassword($user, $request);

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
        $this->userService->destroy($user);

        return redirect('register')->with('msg_success', __('app.user_notification'));
    }
}
