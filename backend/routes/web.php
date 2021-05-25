<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\MemoController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;

Auth::routes();

# ゲストユーザーログイン
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');

# 投稿関連
Route::resource('/articles', 'ArticleController')->except(['show', 'create'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']);
Route::post('/articles/create', 'ArticleController@create')->name('articles.create')->middleware('auth');

# いいね機能
Route::prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', 'LikeController@like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'LikeController@unlike')->name('unlike')->middleware('auth');
});

# 投稿のタグ機能
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

# ユーザ関連機能
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{name}', 'UserController@show')->name('show');
    // いいねした投稿を一覧で表示
    Route::get('/{name}/likes', 'UserController@likes')->name('likes');
    // フォロー、フォロワーの一覧表示
    Route::get('/{name}/follower', 'UserController@follower')->name('follower');
    Route::get('/{name}/following', 'UserController@following')->name('following');
    // ユーザーのデータを表示
    Route::get('/{name}/data', 'UserController@userData')->name('userData');
    // プロフィールの編集画面を表示
    Route::get('/{name}/edit', 'UserController@edit')->name('edit');
    // プロフィールの更新
    Route::patch('/{name}/update', 'UserController@update')->name('update');
    // プロフィールアイコンの編集画面を表示
    Route::get('/{name}/image/edit', 'UserController@imageEdit')->name('imageEdit');
    //ユーザーの削除(退会)
    Route::delete('/{name}/destroy', 'UserController@destroy')->name('destroy');
    // プロフィールアイコンの更新
    Route::patch('/{name}/image/update', 'UserController@imageUpdate')->name('imageUpdate');

    Route::middleware('auth')->group(function () {
        // フォロー、フォロー解除
        Route::put('/{name}/follow', 'FollowController@follow')->name('follow');
        Route::delete('/{name}/follow', 'FollowController@unfollow')->name('unfollow');
        // パスワードリセット機能
        Route::get('/{name}/password/edit', 'UserController@editPassword')->name('edit_password');
        Route::post('/{name}/password/update', 'UserController@updatePassword')->name('update_password');
    });
});

# メモ追加機能
Route::prefix('memos')->name('memos.')->middleware('auth')->group(function () {
    Route::post('/{article}/store', 'MemoController@store')->name('store');
    Route::get('/{memo}/edit', 'MemoController@edit')->name('edit');
    Route::post('/{memo}/update', 'MemoController@update')->name('update');
    Route::delete('/{memo}/destroy', 'MemoController@destroy')->name('destroy');
});

# 設定
Route::prefix('setting')->name('setting.')->middleware('auth')->group(function () {
    Route::post('/index', 'SettingController@index')->name('index');
    Route::get('/agreement', 'SettingController@agreement')->name('agreement');
});

# NEWS API関連機能
Route::prefix('news')->name('news.')->group(function () {
    Route::get('/default', 'NEWSAPI\HeadlineNewsController@defaultIndex')->name('default_index');
    Route::post('/custom', 'NEWSAPI\HeadlineNewsController@customIndex')->name('custom_index');
    Route::get('/covid/default', 'NEWSAPI\CovidNewsController@defaultIndex')->name('covid_default_index');
    Route::post('/covid/custom', 'NEWSAPI\CovidNewsController@customIndex')->name('covid_custom_index');
});
