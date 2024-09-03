<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable =
        [
            'name',
            'category_id',
            'user_id'
        ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->where('banned',0);
    }

    public function posts()
    {
        return $this->hasMany(Post::class)
            ->whereHas('user', function ($query) {
            $query->where('banned', false);
        });
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Post::class)
            ->whereHas('user', function ($query) {
            $query->where('banned', false);
        });
    }
    public function isBlocked()
    {
        return $this->user()->isBanned();
    }

}
