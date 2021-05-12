<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    /**
     * フォローするメソッド
     * @param Request $request
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return [
            'name' => $name,
            'countFollowings' => $user->count_followings,
            'countFollowers' => $user->count_followers,
        ];
    }

    /**
     * フォローを解除するメソッド
     * @param Request $request
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return [
            'name' => $name,
            'countFollowings' => $user->count_followings,
            'countFollowers' => $user->count_followers,
        ];
    }
}
