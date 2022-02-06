<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Http\Requests\User\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * ユーザーデータの更新
     *
     * @param \App\Models\User $user
     * @param array $userRecord
     */
    public function update(User $user, array $userRecord)
    {
        $user->fill($userRecord)->save();
    }

    /**
     * ユーザーデータをname指定で取得
     *
     * @param \App\Models\User $user
     * @param string $name
     * @return object
     */
    public function getLoginUserData(string $name)
    {
        return $this->user->where('name', $name)->first();
    }

    /**
     * ユーザーの投稿を10件ごとに取得
     *
     * @param \App\Models\User $user
     * @return object
     */
    public function getUserArticleData(User $user)
    {
        return $user->articles->sortByDesc('created_at')->paginate(10);
    }

    /**
     * ユーザーデータをname指定で取得
     * リレーションデータをwith()で取得
     *
     * @param string $name
     * @return object
     */
    public function getUserAndArticleData(string $name)
    {
        return $this->user->with(['articles.user', 'articles.likes', 'articles.tags', 'articles.newsLink'])->where('name', $name)->first();
    }

    /**
     * 各投稿データにあるタグ情報を使いユーザが最近使用したタグを表示させる
     * 投稿に紐づくタグデータを最新順で5件分のみ取得
     * articlesのリレーション先であるtagsのnameデータ配列が欲しいのでforeachの繰り返し処理で配列を作成
     * array_unique()で配列の重複データを除外
     *
     * @param \App\Models\User $user
     * @return array
     */
    public function getRecentTags(User $user)
    {
        $articles = $user->articles->load('tags')
            ->where('user_id', $user->id)
            ->sortByDesc('created_at')->take(5)->all();

        $recentTags = [];
        foreach ($articles as $article) {
            foreach ($article->tags as $tag) {
                $recentTags[] = $tag->name;
            }
        }

        return array_unique($recentTags);
    }

    /**
     * 特定のユーザーのフォローデータを取得
     */
    public function getFollowingOfUser(User $user)
    {
        return $user->followings->sortByDesc('created_at')->load('followers');
    }

    /**
     * 特定のユーザーデータを利用してそのユーザーのフォロワーデータを取得
     */
    public function getFollowerOfUser(User $user)
    {
        return $user->followers->sortByDesc('created_at')->load('followers');
    }

    /**
     * ユーザーデータをname指定で取得(いいね欄の表示時)
     * リレーションデータをwith()で取得
     *
     * @param string $name
     * @return object
     */
    public function getUserLikedData(string $name)
    {
        return $this->user->with(['likes.user', 'likes.likes', 'likes.tags', 'likes.newsLink'])->where('name', $name)->first();
    }

    /**
     * ログインユーザーがいいねした投稿を10件ごとに取得
     *
     * @param \App\Models\User $user
     * @return array
     */
    public function getUserLikedArticleData(User $user)
    {
        return $user->likes->sortByDesc('created_at')->paginate(10);
    }

    /**
     * ユーザーの投稿数の合計をカウントするアクセサ
     *
     * @return int
     */
    public function getCountArticle(User $user): int
    {
        return $user->articles()->count();
    }

    /**
     * 投稿日数の累計をカウントするアクセサ
     *
     * @return int
     */
    public function getCountArticleDate(User $user): int
    {
        return $user->articles->groupBy('created_date')->count();
    }

    /**
     * ユーザーの最終ログイン日時を文字列で取得
     *
     * @return string
     */
    public function getLastLoginDate(User $user)
    {
        if (isset($user->last_login_at)) {
            return $user->last_login_at->format('Y-m-d');
        }
    }

    /**
     * ユーザーデータの削除(退会)
     *
     * @param \App\Models\User $user
     */
    public function destroy(User $user)
    {
        if ($user->id != config('user.guest_user_id')) {
            $user->delete();
        }
    }

    /**
     * ユーザーのパスワードを更新
     *
     * @param \App\Models\User $user
     * @param \App\Http\Requests\User\UpdatePasswordRequest $request
     */
    public function updateUserPassword(User $user, UpdatePasswordRequest $request)
    {
        $user->fill(['password' => Hash::make($request->input('new_password'))])->save();
    }
}
