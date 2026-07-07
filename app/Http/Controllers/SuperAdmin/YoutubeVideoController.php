<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\YoutubeVideo;

class YoutubeVideoController extends Controller
{
    public function index()
    {
        $videos = YoutubeVideo::orderBy('order')->latest()->get();
        return view('super_admin.youtube_videos.index', compact('videos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|string',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $youtubeId = $this->getYoutubeId($request->youtube_url);

        if (!$youtubeId) {
            return redirect()->back()->with('error', 'URL YouTube tidak valid.');
        }

        YoutubeVideo::create([
            'title' => $request->title,
            'youtube_id' => $youtubeId,
            'description' => $request->description,
            'order' => $request->order ?? 0,
            'thumbnail_url' => "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg",
        ]);

        return redirect()->back()->with('success', 'Video YouTube berhasil ditambahkan.');
    }

    public function update(Request $request, YoutubeVideo $youtubeVideo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'nullable|string',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only(['title', 'description', 'order']);
        
        if ($request->has('is_active')) {
            $data['is_active'] = $request->is_active;
        }

        if ($request->youtube_url) {
            $youtubeId = $this->getYoutubeId($request->youtube_url);
            if ($youtubeId) {
                $data['youtube_id'] = $youtubeId;
                $data['thumbnail_url'] = "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg";
            }
        }

        $youtubeVideo->update($data);

        return redirect()->back()->with('success', 'Video YouTube berhasil diperbarui.');
    }

    public function destroy(YoutubeVideo $youtubeVideo)
    {
        $youtubeVideo->delete();
        return redirect()->back()->with('success', 'Video YouTube berhasil dihapus.');
    }

    public function toggleStatus(YoutubeVideo $youtubeVideo)
    {
        $youtubeVideo->update(['is_active' => !$youtubeVideo->is_active]);
        return redirect()->back()->with('success', 'Status video berhasil diubah.');
    }

    private function getYoutubeId($url)
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        return $match[1] ?? null;
    }
}
