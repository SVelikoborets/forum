<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'last_seen',
        'email_verified_at',
        'password',
        'avatar',
        'banned'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function posts()
    {
       return $this->hasMany(Post::class)
           ->whereHas('topic.user', function ($query) {
           $query->where('banned', 0);
       })->latest();
    }

    public function comments()
    {
       return $this->hasMany(Comment::class);
    }

    public function responses()
    {
        return $this->hasMany(Comment::class, 'response_id', 'id');
    }
    public function isBanned()
    {
        return $this->banned;
    }

    public function writeInTopicBy($author)
    {
        return $this->posts()->whereIn('topic_id', $author->topics()->pluck('id'))->exists();
    }

    public function isOnline()
    {
       $last_seen = Carbon::parse($this->last_seen);
        return $this->last_seen && $last_seen->gt(Carbon::now()->subMinutes(5));
    }

}
