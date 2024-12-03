<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private const POST_VALIDATOR = [
        'title' => 'required|max:60',
        'content' => 'required',
        'category'=>'required',
        'topic'=>'required',
        'image'=> 'nullable|image'
    ];

    public function posts($topic)
   {
       $topic = Topic::with('category')->where('id', $topic)->firstOrFail();
       $posts = $topic->posts()->with('user')->latest()->paginate(4);
       return view('post.posts',
       [
           'topic' => $topic,
           'posts' => $posts,
       ]);
   }

   public function show($post)
   {
       $post = Post::where('id', $post)
           ->with(['user', 'comments' => function ($query) {
               $query->with(['user' => function ($query) {
                   $query->select('id', 'name','avatar','last_seen');
               }, 'respondedUser' => function ($query) {
                   $query->select('id', 'name');
               }])->latest();
           }])->firstOrFail();

       return view('post.show', ['post' => $post ]);
   }

    public function create($step='first', $selected=null)
    {
        if ($step=='first') {
            return view('post.create', [ 'step' => 1 ]);
        }
        elseif ($step=='second') {
            $category = Category::where('slug', $selected)->firstOrFail();
            $topics = Topic::where('category_id', $category->id)
            ->latest()
            ->paginate(12);

            return view('post.create',
            [
                'step' => 2,
                'category' => $category,
                'topics' => $topics,
            ]);
        }
        else {
            $topic = Topic::where('id', $selected)
            ->with('category')
            ->firstOrFail();

            return view('post.create',
            [
                'step' => 3,
                'topic' => $topic,
            ]);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate(self::POST_VALIDATOR);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalName();
            $path = 'posts/'.$imageName;
            Storage::putFileAs('posts',$image, $imageName);
        }
        else{
            $path=null;
        }

        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category'],
            'topic_id' => $validated['topic'],
            'user_id' => Auth::user()->id,
            'image' => $path,
        ]);

        $request->session()->flash('status', 'Post is added!');
        return redirect()->route('home');
    }

    public function edit(Post $post)
    {
        return view('post.edit',[
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate(self::POST_VALIDATOR);

        if($request->hasFile('image')){
            Storage::delete($post->image);
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalName();
            $path = 'posts/'.$imageName;
            Storage::putFileAs('posts',$image,$imageName);
        }else{
            $path = $post->image;
        }

        $post->fill([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category'],
            'topic_id' => $validated['topic'],
            'user_id' => Auth::user()->id,
            'image' => $path,
        ]);
        $post->save();

        $request->session()->flash('status', 'Your post is updated!');
        return redirect()->route('home');
    }

    public function delete($post)
    {
        $post = Post::where('id', $post)
        ->with('user')
        ->firstOrfail();

        return view('post.delete', ['post' => $post]);
    }

    public function destroy(Request $request,Post $post)
    {
        $this->authorize('deletePost', $post);
        Storage::delete($post->image);
        $post->delete();
        $request->session()->flash('status', 'Post '. $post->title .' was deleted.');
        return redirect()->route('home');
    }

}
