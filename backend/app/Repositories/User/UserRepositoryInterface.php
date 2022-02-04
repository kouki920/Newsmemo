<?php

namespace App\Repositories\User;

use App\Models\Article;
use App\Models\User;
use App\Http\Requests\User\UpdateRequest;
use Exception;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getLoginUserData(string $name);

    public function getUserArticleData(User $user);

    public function getUserAndArticleData(string $name);

    public function update(User $user, array $userRecord);
}
