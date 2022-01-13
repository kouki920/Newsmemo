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
     * @param \App\Models\User $user
     * @param string $name
     * @return array
     */
    public function follow(Request $request, User $user, string $name)
    {
        // ユーザーデータをname指定で取得(フォローされる側)
        $user = $user->getLoginUserData($name);

        // 取得したuserデータのidとリクエスト側のログインユーザーのidが一致した場合、エラーページを表示させる
        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        // ユーザーが対象ユーザーを複数回重ねてフォローできないようにするための考慮
        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        // 非同期通信に対するレスポンス(JSON形式に変換されてレスポンス)
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
     * @param \App\Models\User $user
     * @param string $name
     * @return array
     */
    public function unfollow(Request $request, User $user, string $name)
    {
        // ユーザーデータをname指定で取得
        $user = $user->getLoginUserData($name);

        // 取得したuserデータのidとリクエスト側のログインユーザーのidが一致した場合、エラーページを表示させる
        if ($user->id === $request->user()->id) {
            return abort('404', 'Cannot follow yourself.');
        }

        // フォロー解除
        $request->user()->followings()->detach($user);

        // 非同期通信に対するレスポンス(JSON形式に変換されてレスポンス)
        return [
            'name' => $name,
            'countFollowings' => $user->count_followings,
            'countFollowers' => $user->count_followers,
        ];
    }
}
