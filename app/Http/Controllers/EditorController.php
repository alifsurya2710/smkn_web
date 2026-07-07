<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditorController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_posts' => \App\Models\Post::count(),
            'published_posts' => \App\Models\Post::count(), // Mocked as full for now
            'total_gallery' => \App\Models\Gallery::count(),
            'total_comments' => 0, // Not implemented yet
        ];

        $recent_posts = \App\Models\Post::latest()->take(10)->get();

        return view('editor.dashboard', compact('stats', 'recent_posts'));
    }
}
