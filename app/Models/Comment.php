<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['user_id', 'post_id', 'body'];

    // Each comment is written by a single user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Each comment belongs to one specific post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
