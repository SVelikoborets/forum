<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    private const TOPIC_VALIDATOR = [
        'name' => 'required|unique:topics,name|max:25',
        'category' => 'required'
    ];

    public function loadTopics($categoryId)
    {
        $topics = Topic::where('category_id', $categoryId)->get();
        return response()->json($topics);
    }

    public function topics($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $topicIds = Topic::where('category_id', $category->id)
            ->whereHas('user', function ($query) {
            $query->where('banned', false);
        })
            ->with('posts')
            ->get()
            ->sortByDesc(function ($topic) {
                return $topic->posts->max('created_at');
            })
            ->pluck('id')
            ->toArray();

        $topics = Topic::whereIn('id', $topicIds)
            ->orderByRaw("FIELD(id, " . implode(',', $topicIds) . ")")
            ->paginate(12);

        return view('topic.topics', [
            'category' => $category,
            'topics' => $topics,
        ]);
    }

    public function create($category=null)
    {
        return view('topic.create',
            [
                'selected'=>$category,
            ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(self::TOPIC_VALIDATOR);

        Topic::create([
            'name' => $validated['name'],
            'category_id' => $validated['category'],
            'user_id' => Auth::user()->id,
        ]);

        $request->session()->flash('status', 'New topic is added!');
        return redirect()->route('home');
    }

    public function edit($topicId)
    {
        $topic = Topic::where('id',$topicId)->with('category')->firstOrFail();
        return view('topic.edit', ['topic' => $topic]);
    }

    public function update(Request $request,Topic $topic)
    {
        $validated = $request->validate([
            'name' => 'required|unique:topics,name,NULL,id,category_id,' . $request->category,
            'category' => 'required|exists:categories,id'
        ]);

        $topic->fill(['name' => $validated['name'],
            'category_id' => $validated['category'],
            'user_id' => Auth::user()->id
        ]);
        $topic->save();

        $topic->posts()->update(['category_id' => $validated['category']]);

        $request->session()->flash('status', 'Your topic is updated!');
        return redirect()->route('home');
    }

    public function delete($topic)
    {
        $topic = Topic::where('id',$topic)->with(['category','user','posts'])->firstOrFail();
        $countPosts = count($topic->posts);
        return view('topic.delete',[
            'topic' => $topic,
            'countPosts' => $countPosts,
        ]);
    }

    public function destroy(Request $request,Topic $topic)
    {
        $topic->delete();
        $request->session()->flash('status', 'Topic was deleted');
        return redirect()->route('home');
    }
}
