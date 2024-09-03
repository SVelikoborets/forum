<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['comment','user_id','response_id','post_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
       return $this->belongsTo(Post::class);
    }

    public function respondedUser()
    {
        return $this->belongsTo(User::class, 'response_id', 'id');
    }
}
