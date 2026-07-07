<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Gallery;
use Illuminate\Http\Request;

use App\Models\YoutubeVideo;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        
        $featuredAlbums = Album::where('is_featured', true)
            ->withCount('photos')
            ->latest()
            ->take(6)
            ->get();

        $youtubeVideos = YoutubeVideo::where('is_active', true)
            ->orderBy('order')
            ->latest()
            ->get();

        $query = Gallery::with('album')->latest();

        if ($category && $category !== 'All') {
            $query->where('category', $category);
        }

        $photos = $query->paginate(12);

        return view('gallery.index', compact('featuredAlbums', 'photos', 'category', 'youtubeVideos'));
    }

    public function showAlbum($slug)
    {
        $album = Album::where('slug', $slug)->with('photos')->firstOrFail();
        return view('gallery.show', compact('album'));
    }
}
