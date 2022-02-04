<?php

namespace App\Services\User;

use App\Models\User;
use App\Http\Requests\User\UpdateRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
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
        return $this->userRepository->getLoginUserData($name);
    }


    /**
     * ユーザーの投稿を10件ごとに取得
     *
     * @return object
     */
    public function getUserArticleData(User $user)
    {
        return $this->userRepository->getUserArticleData($user);
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
        return $this->userRepository->getUserAndArticleData($name);
    }

    /**
     * ユーザーデータの更新
     *
     * @param \App\Models\User $user
     * @param array $userRecord
     */
    public function update(User $user, array $userRecord)
    {
        $this->userRepository->update($user, $userRecord);
    }
}
