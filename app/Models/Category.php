<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $with =['topics'];

    public function topics()
    {
        return $this->hasMany(Topic::class)->whereHas('user', function ($query) {
            $query->where('banned', 0);
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->whereHas('topic.user', function ($query) {
            $query->where('banned', 0);
        });
    }
}
