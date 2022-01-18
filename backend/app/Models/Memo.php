<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Memo extends Model
{
    protected $fillable = [
        'user_id', 'article_id', 'body',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo('App\Models\Article');
    }
}
