<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Http\Requests\User\UpdatePasswordRequest;

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

    public function getRecentTags(User $user)
    {
        return $this->userRepository->getRecentTags($user);
    }

    /**
     * 特定のユーザーのフォローデータを取得
     */
    public function getFollowingOfUser(User $user)
    {
        return $this->userRepository->getFollowingOfUser($user);
    }

    /**
     * 特定のユーザーデータを利用してそのユーザーのフォロワーデータを取得
     */
    public function getFollowerOfUser(User $user)
    {
        return $this->userRepository->getFollowerOfUser($user);
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
        return $this->userRepository->getUserLikedData($name);
    }

    /**
     * ログインユーザーがいいねした投稿を10件ごとに取得
     *
     * @param \App\Models\User $user
     * @return array
     */
    public function getUserLikedArticleData(User $user)
    {
        return $this->userRepository->getUserLikedArticleData($user);
    }

    /**
     * ユーザーの投稿数の合計をカウントするアクセサ
     *
     * @param \App\Models\User $user
     * @return int
     */
    public function getCountArticle(User $user): int
    {
        return $this->userRepository->getCountArticle($user);
    }

    /**
     * 投稿日数の累計をカウントするアクセサ
     *
     * @param \App\Models\User $user
     * @return int
     */
    public function getCountArticleDate(User $user): int
    {
        return $this->userRepository->getCountArticleDate($user);
    }

    /**
     * ユーザーの最終ログイン日時を文字列で取得
     *
     * @param \App\Models\User $user
     * @return string
     */
    public function getLastLoginDate(User $user)
    {
        return $this->userRepository->getLastLoginDate($user);
    }

    /**
     * ユーザーデータの削除(退会)
     *
     * @param \App\Models\User $user
     */
    public function destroy(User $user)
    {
        return $this->userRepository->destroy($user);
    }

    /**
     * ユーザーのパスワードを更新
     *
     * @param \App\Models\User $user
     * @param \App\Http\Requests\User\UpdatePasswordRequest $request
     */
    public function updateUserPassword(User $user, UpdatePasswordRequest $request)
    {
        $this->userRepository->updateUserPassword($user, $request);
    }
}
