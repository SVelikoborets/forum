<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private const TOPIC_VALIDATOR = [
        'name' => 'required|unique:topics,name|max:20',
        'category' => 'integer|required',
    ];

    public function index()
    {
        $categories = Category::with(['posts' => function($query) {
            $query->withCount('comments')
            ->orderBy('comments_count', 'desc');
        }])->get();

        $top  = Post::withCount('comments')
            ->whereHas('topic.user', function ($query) {
                $query->where('banned', false);
            })
            ->orderBy('comments_count', 'desc')
            ->take(3)
            ->with('user')
            ->get();

        if ($top->isEmpty()) {
            return view('main.index', [
                'top' => [],
                'categories' => $categories,
            ]);
        }

        return view('main.index',
            [
                'top' => $top,
                'categories' => $categories,
            ]);
    }

    public function profile(User $user)
    {
        if($user->isBanned()){
            return view('errors.banned');
        }

        return view('main.profile',
        [
            'user' => $user,
            'topicsList' => $user->topics,
            'posts' => $user->posts()->paginate(8),
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $topics = Topic::where('name', 'like', "%$query%")
            ->whereHas('user', function ($query){
            $query->where('banned',0);
        })
            ->paginate(10);

        $posts = Post::where('title', 'like', "%$query%")
            ->orWhere('content', 'like', "%$query%")
            ->whereHas('topic.user', function ($query){
                $query->where('banned',0);
            })
            -> paginate(10);

        $users = User::where('name', 'like', "%$query%")
            ->paginate(10);

        return view('main.search', compact('topics', 'posts', 'users', 'query'));
    }
}
