<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private const COMMENT_VALIDATOR = [
        'comment' => 'required|max:300',
        'author_id' => 'required|integer',
        'response_id' => 'nullable|integer',
    ];

    public function showComments($postId)
    {
        $comments = Comment::where('post_id', $postId)
            ->with([
                'user' => function ($query) {
                    $query->select('id', 'name','avatar','last_seen');
                },
                'respondedUser' => function ($query) {
                    $query->select('id', 'name');
                }
            ])
            ->latest()
            ->get();
        return view('comment.all', [
        'postId' => $postId,
        'comments' => $comments
        ]);
    }

    public function response($postId, User $user)
    {
        return view('comment.response',
        [
            'postId' => $postId,
            'user' => $user,
        ]);
    }

    public function addComment(Request $request, $postId)
    {
        $validated = $request->validate(self::COMMENT_VALIDATOR);

        Comment::create([
            'comment' => $validated['comment'],
            'user_id' => $validated['author_id'],
            'response_id' => $validated['response_id'],
            'post_id' => $postId,
        ]);

        return redirect()->route('post.show',['post'=>$postId]);
    }

    public function destroy(Request $request,Comment $comment)
    {
        $postId = $comment->post_id;
        $this->authorize('deleteComment', $comment);
        $comment->delete();

        return redirect()->route('post.show',['post'=>$postId]);
    }
}
