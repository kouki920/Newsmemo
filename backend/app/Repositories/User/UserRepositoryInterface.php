<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Http\Requests\User\UpdatePasswordRequest;

interface UserRepositoryInterface
{
    public function getLoginUserData(string $name);

    public function getUserArticleData(User $user);

    public function getUserAndArticleData(string $name);

    public function update(User $user, array $userRecord);

    public function getRecentTags(User $user);

    public function getFollowingOfUser(User $user);

    public function getFollowerOfUser(User $user);

    public function getUserLikedData(string $name);

    public function getUserLikedArticleData(User $user);

    public function getCountArticle(User $user): int;

    public function getCountArticleDate(User $user): int;

    public function getLastLoginDate(User $user);

    public function destroy(User $user);

    public function updateUserPassword(User $user, UpdatePasswordRequest $request);
}
