<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $fillable = [
        'user_id', 'email', 'age', 'gender', 'content',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
