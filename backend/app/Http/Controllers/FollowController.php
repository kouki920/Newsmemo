<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    /**
     * フォローするメソッド
     *
     *
     * @param \Illuminate\Http\Request $request
     * @param string $name
     * @return array
     */
    public function follow(Request $request, User $user, string $name)
    {
        // ユーザーデータをname指定で取得
        $user = $user->getUserData($name);

        // 取得したデータとリクエスト側のユーザーデータが一致指定していない場合、エラーページを表示させる
        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        // ユーザーが対象ユーザーを複数回重ねてフォローできないようにするための考慮
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
     *
     * @param \Illuminate\Http\Request $request
     * @param string $name
     * @return array
     */
    public function unfollow(Request $request, User $user, string $name)
    {
        // ユーザーデータをname指定で取得
        $user = $user->getUserData($name);

        // 取得したデータとリクエスト側のユーザーデータが一致指定していない場合、エラーページを表示させる
        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        // フォロー解除
        $request->user()->followings()->detach($user);

        return [
            'name' => $name,
            'countFollowings' => $user->count_followings,
            'countFollowers' => $user->count_followers,
        ];
    }
}
