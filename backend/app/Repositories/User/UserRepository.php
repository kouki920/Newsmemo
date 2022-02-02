<?php

namespace App\Repositories\User;

use App\Models\Article;
use App\Models\User;
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
    public function getLoginUserData(User $user, string $name)
    {
        return $user->where('name', $name)->first();
    }
}
