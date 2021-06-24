<?php

namespace App\Models;

use App\Mail\BareMail;
use App\Notifications\PasswordResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'introduction', 'image', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * フォローにおけるユーザーモデルとユーザーモデルの関係は多対多なのでBelongsToManyを使用
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'follows', 'followee_id', 'follower_id')->withTimestamps();
    }

    /**
     * フォローとフォロー解除時に使用するリレーション
     */
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }

    /**
     * 各ユーザーの詳細ページでユーザーの投稿を一覧表示する為のリレーション
     */
    public function articles(): HasMany
    {
        return $this->hasMany('App\Models\Article');
    }

    /**
     * ユーザーがいいねした投稿にアクセスすることを可能にするリレーション
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Article', 'likes')->withTimestamps();
    }

    /**
     * 追加メモ(非公開)のリレーション
     */
    public function memos(): HasMany
    {
        return $this->hasMany('App\Models\Memo');
    }

    /**
     * ログインデータのリレーション
     */
    public function logins(): HasMany
    {
        return $this->hasMany('App\Models\Login');
    }

    /**
     * コレクションとのリレーション
     */
    public function collections(): HasMany
    {
        return $this->hasMany('App\Models\Collection');
    }

    /**
     * 投稿数のカウントメソッド
     *
     * @return int
     */
    public function getCountArticle(): int
    {
        return $this->articles()->count();
    }

    /**
     * フォロワー数を表示するアクセサ
     *
     * @return int
     */
    public function getCountFollowersAttribute(): int
    {
        return $this->followers()->count();
    }

    /**
     * フォロー数を表示するアクセサ
     *
     * @return int
     */
    public function getCountFollowingsAttribute(): int
    {
        return $this->followings()->count();
    }

    /**
     * フォローしているかどうかを判定するメソッド
     *
     * @return bool
     */
    public function isFollowedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->followers->where('id', $user->id)->count()
            : false;
    }

    /**
     * パスワードリセットに関するメソッドのオーバーライド
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token, new BareMail()));
    }
}
