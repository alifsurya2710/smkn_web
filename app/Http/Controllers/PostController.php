<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('author')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $majors = \App\Models\Major::where('is_active', true)->get();
        return view('posts.create', compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'major_id' => 'nullable|exists:majors,id',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title) . '-' . time();
        $post->content = $request->content;
        $post->category = $request->category ?? 'news';
        $post->author_id = Auth::id();
        $post->major_id = $request->major_id;
        $post->quote = $request->quote;
        $post->quote_author = $request->quote_author;
        
        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->save();

        return redirect()->route('editor.posts.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Display a public listing of all news/articles.
     */
    public function indexPublic(Request $request)
    {
        $category = $request->query('category');
        $search = $request->query('search');
        
        $query = Post::with('author')->latest();
        
        if ($category) {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        $posts = $query->paginate(9);
        
        $categories = Post::select('category', \DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();
            
        return view('school.berita-index', compact('posts', 'categories'));
    }

    /**
     * Display the specified resource publicly.
     */
    public function showPublic($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $recentPosts = Post::where('id', '!=', $post->id)
            ->with('author')
            ->latest()
            ->take(3)
            ->get();
            
        $categories = Post::select('category', \DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();

        return view('school.berita-detail', compact('post', 'recentPosts', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $majors = \App\Models\Major::where('is_active', true)->get();
        return view('posts.edit', compact('post', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'major_id' => 'nullable|exists:majors,id',
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category = $request->category ?? $post->category;
        $post->major_id = $request->major_id;
        $post->quote = $request->quote;
        $post->quote_author = $request->quote_author;
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($post->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($post->image);
            }
            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->save();

        return redirect()->route('editor.posts.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('editor.posts.index')->with('success', 'Berita berhasil dihapus.');
    }
}
