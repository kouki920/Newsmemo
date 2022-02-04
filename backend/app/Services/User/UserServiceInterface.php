<?php

namespace App\Services\User;

use App\Models\User;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Support\Collection;

interface UserServiceInterface
{
    public function getLoginUserData(string $name);

    public function getUserArticleData(User $user);

    public function getUserAndArticleData(string $name);

    public function update(User $user, array $userRecord);
}
