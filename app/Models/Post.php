<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $with = ['topic'];
    protected $fillable = [
        'title',
        'content',
        'category_id',
        'topic_id',
        'user_id',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
