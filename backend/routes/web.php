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

Route::resource('/articles', 'ArticleController')->except(['show'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']);

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
    // フォロー、フォロー解除
    Route::middleware('auth')->group(function () {
        Route::put('/{name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });
});

# NEWS API関連機能
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/default', 'HeadlineNewsController@defaultIndex')->name('default_index');
    Route::post('/custom', 'HeadlineNewsController@customIndex')->name('custom_index');
});
