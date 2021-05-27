<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

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
     * @return login_date
     */
    public function getLoginDateAttribute(): string
    {
        // return $this->select(DB::raw('CONCAT(logins.year,logins.month,logins.day) as total_login'));
        return $this->year . $this->month . $this->day;
    }
}
