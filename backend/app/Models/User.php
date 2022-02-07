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
        'name', 'email', 'introduction', 'image', 'password', 'last_login_at',
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
     * last_login_atカラムを取得した際に自動的にDateTime型に置き換える
     */
    protected $dates = [
        'last_login_at'
    ];

    protected $appends = [
        'last_login_date'
    ];


    /**
     * フォローにおけるユーザーモデルとユーザーモデルの関係は多対多なのでBelongsToManyを使用
     *
     * 中間テーブルのカラム名と、リレーション元/先のテーブル名(users)に[リレーション元/先のテーブル名の単数形_id]
     * という規則性がない為、第3引数と第4引数に中間テーブルのカラム名を指定
     * followee_id = フォローしている側のuserのid(リレーション元)、follower_id = フォローされている側のuserのid(リレーション先)
     *
     * あるユーザーがあるユーザーをフォロー中かどうか判定するメソッドで使用される
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User', 'follows', 'followee_id', 'follower_id')->withTimestamps();
    }

    /**
     * フォローとフォロー解除時に使用するリレーションメソッド(FollowControllerで使用)
     *
     * 中間テーブルのカラム名と、リレーション元/先のテーブル名(users)に[リレーション元/先のテーブル名の単数形_id]
     * という規則性がない為、中間テーブルのカラム名を指定
     * follower_id = フォローする側のuserのid(リレーション元)、followee_id = フォローされる側のuserのid(リレーション先)
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
     * お問い合わせモデルとのリレーション
     */
    public function contacts(): HasMany
    {
        return $this->hasMany('App\Models\Contact');
    }

    /**
     * コレクションとのリレーション
     */
    public function collections(): HasMany
    {
        return $this->hasMany('App\Models\Collection');
    }

    /**
     * フォロワー数をカウントするアクセサ
     *
     * @return int
     */
    public function getCountFollowersAttribute(): int
    {
        return $this->followers()->count();
    }

    /**
     * フォロー数をカウントするアクセサ
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
     * ユーザーがログイン状態である時に、ユーザーページに表示されるフォローボタンの初期状態を決める
     * trueの場合、Articleモデルからlikesテーブル経由で紐付くユーザーモデルをwhere()で絞ってコレクションの要素数を数値で返す
     * (bool)で論理値に変換する、1以上の数値を論理値へ型キャストしてtrueにする、0の場合論理値がfalseになる
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
