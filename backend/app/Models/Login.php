<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Login extends Model
{
    //created_at,updated_at は使わない
    public $timestamps = false;

    protected $appends = [
        'login_date'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * year,month,dayを結合させてY-m-dの形にするアクセサ
     * @return login_date
     */
    public function getLoginDateAttribute(): string
    {
        return $this->year . $this->month . $this->day;
    }
}
