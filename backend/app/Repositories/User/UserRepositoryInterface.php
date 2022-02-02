<?php

namespace App\Repositories\User;

use App\Models\Article;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getLoginUserData(User $user, string $name);
}
