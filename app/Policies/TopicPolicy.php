<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;

    public function deletePost(User $user, Post $post)
    {
        return $user->id === $post->topic->user_id|| $user->id === $post->user_id;
    }

    public function editPost(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    public function deleteComment(User $user, Comment $comment)
    {
        return $user->id === $comment->post->user_id || $user->id === $comment->user_id || $user->id === $comment->post->topic->user_id;
    }
}
