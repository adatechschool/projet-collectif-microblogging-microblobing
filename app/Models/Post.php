<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function posts(): HasOne
{
    return $this->hasOne(User::class);
}
}
