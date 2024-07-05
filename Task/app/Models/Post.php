<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    public function comments(): BelongsToMany
    {
        return $this->belongsToMany(Comment::class, 'posts_comments', 'post_id', 'comment_id');
    }
}
