<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\SchoolProfile;
use App\Models\User;

class SchoolController extends Controller
{


    public function index()
    {
        $profile = SchoolProfile::first();
        $featuredMajors = \App\Models\Major::where('is_active', true)->orderBy('order')->take(3)->get();
        $majors = \App\Models\Major::where('is_active', true)->orderBy('order')->get();

        // Landing Stats (defaults if not in profile)
        $statsSiswa = $profile->landing_stats_siswa ?? '1200';
        $statsPengajar = $profile->landing_stats_pengajar ?? '85';
        $statsMitra = $profile->landing_stats_mitra ?? '15';

        $recentPosts = \App\Models\Post::latest()->take(4)->get();

        // Testimonials
        $testimonis = collect();
        $averageRating = 0;
        $totalTestimoni = 0;
        
        try {
            if (\Schema::hasTable('testimonis')) {
                $testimonis = \App\Models\Testimoni::approved()->latest()->take(6)->get();
                $averageRating = \App\Models\Testimoni::averageRating();
                $totalTestimoni = \App\Models\Testimoni::approved()->count();
            }
        } catch (\Exception $e) {
            // Silently fail if table doesn't exist yet
        }

        return view('school.home', compact('profile', 'featuredMajors', 'majors', 'statsSiswa', 'statsPengajar', 'statsMitra', 'recentPosts', 'testimonis', 'averageRating', 'totalTestimoni'));
    }


    public function about()
    {
        $profile = SchoolProfile::first();
        return view('school.about', compact('profile'));
    }

    public function contact()
    {
        return view('school.contact');
    }

    public function jurusanIndex(Request $request)
    {
        $query = \App\Models\Major::where('is_active', true);

        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        $majors = $query->orderBy('order')->get();
        
        // Get all unique categories for the sidebar
        $categories = \App\Models\Major::where('is_active', true)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        // Get hero settings for Jurusan index
        $heroTitle = \App\Models\Setting::getByKey('major_hero_title', 'PROGRAM <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300">JURUSAN</span>');
        $heroDescription = \App\Models\Setting::getByKey('major_hero_description', 'Temukan jurusan yang tepat untuk membangun masa depan Anda. Setiap program dirancang dengan kurikulum berstandar industri dan didukung pembelajaran praktis di laboratorium dengan fasilitas terkini');
        $heroImage = \App\Models\Setting::getByKey('major_hero_image');

        return view('school.jurusan-index', compact('majors', 'categories', 'heroTitle', 'heroDescription', 'heroImage'));
    }

    public function jurusan($slug)
    {
        $jurusan = \App\Models\Major::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $profile = SchoolProfile::first();
        
        // Fetch related news (by major_id first, fallback to general news)
        $relatedNews = \App\Models\Post::where('major_id', $jurusan->id)
            ->latest()
            ->take(3)
            ->get();
            
        // Fallback to recent news if no specific ones found
        if ($relatedNews->isEmpty()) {
            $relatedNews = \App\Models\Post::latest()->take(3)->get();
        }

        // Fetch other active majors for the "Other Majors" section
        $otherMajors = \App\Models\Major::where('id', '!=', $jurusan->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->take(3)
            ->get();

        return view('school.jurusan-detail', [
            'jurusan' => $jurusan,
            'profile' => $profile,
            'slug' => $slug,
            'relatedNews' => $relatedNews,
            'otherMajors' => $otherMajors
        ]);
    }

    public function profile($slug) 
    { 
        if ($slug == 'blud') {
            $settings = \App\Models\Setting::where('group', 'blud')->get()->pluck('value', 'key');
            return view('school.blud', compact('settings'));
        }
        if ($slug == 'teaching-factory') {
            $settings = \App\Models\Setting::where('group', 'tefa')->get()->pluck('value', 'key');
            return view('school.teaching-factory', compact('settings'));
        }
        $title = Str::headline($slug);
        return view("school.generic-content", ['title' => $title, 'category' => 'Profile']); 
    }

    public function bidangKerja($slug) 
    { 
        $settings = \App\Models\Setting::where('group', 'bidang_kerja')->get()->pluck('value', 'key');
        $title = Str::headline($slug);
        
        $partners = [];
        if ($slug === 'hubungan-industri') {
            $partners = \App\Models\IndustrialPartner::where('is_active', true)->orderBy('order')->get();
        }
        
        return view("school.bidang-kerja", compact('title', 'slug', 'settings', 'partners')); 
    }

    public function programUnggulan($slug) 
    { 
        $title = Str::headline($slug);
        return view("school.generic-content", ['title' => $title, 'category' => 'Program Unggulan']); 
    }

    public function staff()
    {
        $profile = SchoolProfile::first();
        $management = User::role('guru')->where('is_management', true)->orderBy('order')->get();
        $teachers = User::role('guru')->where('is_management', false)->orderBy('order', 'asc')->orderBy('name', 'asc')->get()->groupBy(function($item) {
            $pos = trim($item->position ?? '');
            $sub = trim($item->subject ?? '');

            if (stripos($pos, 'toolman') !== false || stripos($pos, 'produktif') !== false) {
                return $pos;
            }

            if (!empty($sub) && strtolower($sub) !== 'umum' && strtolower($sub) !== '-') {
                return $sub;
            }

            if (!empty($pos) && strtolower($pos) !== 'guru') {
                return $pos;
            }

            return 'Umum';
        });
        return view('school.staff', compact('profile', 'management', 'teachers'));
    }

    public function facilities()
    {
        $facilities = \App\Models\Facility::where('is_active', true)->orderBy('order')->get();
        return view('school.facilities', compact('facilities'));
    }
}
