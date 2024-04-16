<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_id',
        'picture',
        'content',
        'tag'
    ];

    public function users(): HasOne
{
    return $this->hasOne(User::class);
}

public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}


}
