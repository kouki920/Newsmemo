<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * ログイン後の処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @override \Illuminate\Http\Foundation\Auth\AuthenticatesUsers
     */
    protected function authenticated(Request $request, $user)
    {

        $dt = now();

        $login = new \App\Models\Login();
        $login->user_id = $user->id;
        $login->year = $dt->year;
        $login->month = $dt->month;
        $login->day = $dt->day;
        $login->hour = $dt->hour;
        $login->minute = $dt->minute;
        $login->second = $dt->second;
        $login->save();
    }

    /**
     * ゲストユーザーログイン
     */
    public function guestLogin(Login $login)
    {
        if (Auth::loginUsingId(config('user.guest_user_id'))) {
            $dt = now();

            $login->user_id = config('user.guest_user_id');
            $login->year = $dt->year;
            $login->month = $dt->month;
            $login->day = $dt->day;
            $login->hour = $dt->hour;
            $login->minute = $dt->minute;
            $login->second = $dt->second;
            $login->save();
            return redirect(route('articles.index'))->with('msg_success', 'ゲストユーザーでログインしました');
        }
        return redirect(route('login'))->with('msg_error', 'ゲストログインに失敗しました');
    }

    protected function loggedOut(Request $request)
    {
        return redirect(route('login'))->with('msg_success', 'ログアウトしました');
    }
}
