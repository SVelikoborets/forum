<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       $posts = Post::where('user_id', Auth::user()->id)
           ->whereHas('topic.user', function ($query) {
                $query->where('banned', false);
            })
           ->with(['topic','category'])->latest()->paginate(4,['*'], 'post_page');

       $topics = Topic::where('user_id', Auth::user()->id)
            ->paginate(7,['*'],'topic_page');

       $top = Post::where('user_id', Auth::user()->id)
           ->whereHas('topic.user', function ($query) {
               $query->where('banned', 0);
           })
           ->withCount('comments')
           ->with('category')
           ->orderBy('comments_count', 'desc')
           ->take(2)
           ->get();

       return view('home.home', [
            'posts' => $posts,
            'topics' => $topics,
            'top' => $top,
        ]);
    }


    public function delete($user)
    {
        $user = User::where('id', $user)->firstOrfail();

        return view('home.delete', [ 'user' => $user ]);
    }

    public function avatar(Request $request){

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalName();
            $path = 'avatars/'.$imageName;
            Storage::putFileAs('public/avatars',$image, $imageName);
        }

        $user = Auth::user();

        if ($user->avatar) {
            Storage::delete('public/' . $user->avatar);
        }

        $user->avatar = $path;
        $user->save();

        $request->session()->flash('status', 'Avatar was successfully updated');
        return redirect()->route('home');
    }

    public function destroy($user)
    {
        User::where('id', $user)->delete();
        return redirect()->route('main');
    }

    public function block(Request $request, User $user)
    {
        $user->update([ 'banned' => '1' ]);
        $request->session()->flash( 'status', $user->name .' was blocked.' );
        return redirect()->route('home' );
    }
}
