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

use App\Http\Controllers\UserController;

Auth::routes();

# ゲストユーザーログイン
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');

# 投稿関連
Route::resource('/articles', 'ArticleController')->except(['show', 'create'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']);
Route::post('/articles/create', 'ArticleController@create')->name('articles.create')->middleware('auth');

Route::prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
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
    // プロフィールの編集画面を表示
    Route::get('/{name}/edit', 'UserController@edit')->name('edit');
    // プロフィールの更新
    Route::patch('/{name}/update', 'UserController@update')->name('update');
    // プロフィールアイコンの編集画面を表示
    Route::get('/{name}/image/edit', 'UserController@imageEdit')->name('imageEdit');
    // プロフィールアイコンの更新
    Route::patch('/{name}/image/update', 'UserController@imageUpdate')->name('imageUpdate');
    // フォロー、フォロー解除
    Route::middleware('auth')->group(function () {
        Route::put('/{name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });
});

# メモ追加機能
Route::prefix('memo')->name('memo.')->middleware('auth')->group(function () {
    Route::post('/store', 'MemoController@store')->name('store');
    Route::get('/edit', 'MemoController@edit')->name('edit');
    Route::delete('/destroy', 'MemoController@delete')->name('destroy');
});

# 設定
Route::post('/setting', 'SettingController@index')->name('setting.index');

# NEWS API関連機能
Route::prefix('news')->name('news.')->group(function () {
    Route::get('/default', 'HeadlineNewsController@defaultIndex')->name('default_index');
    Route::post('/custom', 'HeadlineNewsController@customIndex')->name('custom_index');
    Route::get('/covid/default', 'CovidNewsController@defaultIndex')->name('covid_default_index');
    Route::post('/covid/custom', 'CovidNewsController@customIndex')->name('covid_custom_index');
});
