<?php

namespace App\Repositories\User;

use App\Models\Article;
use App\Models\User;
use App\Http\Requests\User\UpdateRequest;
use Carbon\CarbonImmutable as Carbon;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
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
     * ユーザーデータの更新
     *
     * @param \App\Models\User $user
     * @param array $userRecord
     */
    public function update(User $user, array $userRecord)
    {
        $user->fill($userRecord)->save();
    }
}
