<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Memo extends Model
{
    protected $fillable = [
        'user_id', 'article_id', 'memo',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo('App\Models\Article');
    }

    // public function memosIndex($id)
    // {
    //     return $this->where('article_id', $id)->get();
    // }
}
