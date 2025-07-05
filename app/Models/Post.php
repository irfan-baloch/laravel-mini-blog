<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $fillable = ['title', 'slug', 'body', 'image', 'status', 'user_id', 'category_id'];

   public function user()
   {
    return $this->belongsTo(User::class);
   }

   // One Post can have many comments
   public function comments()
   {
      return $this->hasMany(Comment::class);
   }

   public function category()
   {
      return $this->belongsTo(Category::class);
   }

   public function tags()
   {
      return $this->belongsToMany(Tag::class);
   }

}
