<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Post::with(['user', 'media'])->withCount('claps')->latest();

        // $search=$request['search'] ?? '';
        // if($search != null){
        //     $posts=Post::where('title', '=', $search)->get();
        // }

        $search = $request->input('search', '');
        if ($search) {
            // $query->where('title', 'like', "%{$search}%");
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        /* If you uncomment these codes, then you will see nothing in the home page unless you follow any user.
        And If you follow the user then, you will start seeing only their post, not others whom you have not
        followed. Uncomment it if you want */

        // if ($user) {
        //     $ids = $user->following()->pluck('users.id');
        //     $query->whereIn('user_id', $ids);
        // }

        $posts = $query->simplePaginate(10)->appends(['search' => $search]);
        return view('post.index', compact('posts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        // dd($data);

        // $image = $data['image'];
        // unset($data['image']);
        $data['user_id'] = Auth::id();
        // $data['slug'] = Str::slug($data['title']);

        // $imagePath = $image->store('posts/images', 'public');
        // $data['image'] = $imagePath;
        $post = Post::create($data);
        $post->addMediaFromRequest('image')->toMediaCollection();
        return to_route('dashboard')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        $categories = Category::get();
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        $data = $request->validated();
        $post->update($data);
        if ($data['image'] ?? false) {
            $post->addMediaFromRequest('image')->toMediaCollection();
        }
        return to_route('myPosts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $post->clearMediaCollection();
        $post->delete();
        return to_route('dashboard');
    }

    public function category(Category $category)
    {
        $posts = $category->posts()
            ->with(['user', 'media'])->withCount('claps')
            ->latest()->simplePaginate(5);
        return view('post.index', compact('posts'));
    }

    public function myPosts()
    {
        $user = auth()->user();
        $posts = $user->posts()->with(['user', 'media'])->withCount('claps')->latest()->simplePaginate(5);
        return view('post.index', compact('posts'));
    }
}
