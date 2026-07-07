<?php

use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrestasiCategoryController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\StudentReportController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\ChatbotController;

Route::post('/chat', [ChatbotController::class, 'sendMessage'])->name('chat.send');

use App\Http\Controllers\SuperAdmin\TeacherManagementController;
use App\Http\Controllers\SuperAdmin\LandingSettingController;
use App\Http\Controllers\SuperAdmin\SchoolProfileController;
use App\Http\Controllers\SuperAdmin\AlbumController;
use App\Http\Controllers\GalleryController;

Route::get('/media', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/media/album/{slug}', [GalleryController::class, 'showAlbum'])->name('gallery.album');

// Public Routes
Route::get('/', [SchoolController::class, 'index'])->name('home');
Route::get('/jurusan', [SchoolController::class, 'jurusanIndex'])->name('jurusan.index');
Route::get('/jurusan/{slug}', [SchoolController::class, 'jurusan'])->name('jurusan.detail');
Route::get('/profile/{slug}', [SchoolController::class, 'profile'])->name('profile.item');
Route::get('/bidang-kerja/{slug}', [SchoolController::class, 'bidangKerja'])->name('bidang-kerja.item');
Route::get('/program-unggulan/{slug}', [SchoolController::class, 'programUnggulan'])->name('program-unggulan.item');
Route::get('/tentang-kami', [SchoolController::class, 'about'])->name('about');
Route::get('/fasilitas', [SchoolController::class, 'facilities'])->name('facilities');
Route::get('/kontak', [SchoolController::class, 'contact'])->name('contact');
Route::get('/berita', [PostController::class, 'indexPublic'])->name('berita.index');
Route::get('/berita/{slug}', [PostController::class, 'showPublic'])->name('berita.detail');
Route::get('/ekstrakurikuler', [ExtracurricularController::class, 'index'])->name('extracurriculars.index');
Route::get('/ekstrakurikuler/{slug}', [ExtracurricularController::class, 'show'])->name('extracurriculars.show');
Route::get('/guru-staff', [SchoolController::class, 'staff'])->name('staff.index');
Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb.index');
Route::get('/prestasi', [AchievementController::class, 'indexPublic'])->name('prestasi.index');
Route::get('/prestasi/{id}', [AchievementController::class, 'showPublic'])->name('prestasi.detail');

// Testimonial Public Submission (AJAX)
Route::post('/testimoni', [App\Http\Controllers\TestimoniController::class, 'store'])->name('testimoni.store');

// Public E-Rapor Routes (Search by Name & NISN)
Route::get('/e-rapor', [StudentReportController::class, 'index'])->name('e-rapor');
Route::post('/e-rapor/verify', [StudentReportController::class, 'verify'])->name('rapor.verify.post');
Route::post('/e-rapor/logout', [StudentReportController::class, 'logoutRapor'])->name('rapor.logout');
Route::get('/e-rapor/download/{report}', [StudentReportController::class, 'download'])->name('rapor.download')->middleware('signed');

// Auth Routes (Breeze Defaults)
require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->hasRole(['super_admin', 'super-admin'])) return redirect()->route('super_admin.dashboard');
        if ($user->hasRole(['admin'])) return redirect()->route('admin.dashboard');
        if ($user->hasRole(['editor'])) return redirect()->route('editor.dashboard');
        if ($user->hasRole(['guru'])) return redirect()->route('guru.dashboard');
        if ($user->hasRole(['siswa'])) return redirect()->route('e-rapor');
        return view('dashboard');
    })->name('dashboard');

    // Shared Content Management (Super Admin & Admin)
    Route::middleware('role:super_admin|super-admin|admin')->group(function () {
        Route::resource('/super-admin/jurusan', App\Http\Controllers\SuperAdmin\MajorManagementController::class)->names('super_admin.jurusan');
        Route::resource('/super-admin/prestasi-categories', PrestasiCategoryController::class)->names('super_admin.prestasi_categories');
        Route::resource('/super-admin/prestasi', AchievementController::class)->names('super_admin.prestasi');
        Route::resource('/super-admin/ekskul', App\Http\Controllers\SuperAdmin\ExtracurricularManagementController::class)->names('super_admin.ekskul');
        Route::resource('/super-admin/sarana', App\Http\Controllers\SuperAdmin\FacilityManagementController::class)->names('super_admin.sarana');
        Route::get('/super-admin/school-profile', [SchoolProfileController::class, 'edit'])->name('super_admin.school_profile.edit');
        Route::post('/super-admin/school-profile', [SchoolProfileController::class, 'update'])->name('super_admin.school_profile.update');
        Route::post('/super-admin/teachers/import', [TeacherManagementController::class, 'import'])->name('super_admin.teachers.import');
        Route::post('/super-admin/teachers/hero', [TeacherManagementController::class, 'updateHero'])->name('super_admin.teachers.hero.update');
        Route::resource('/super-admin/teachers', TeacherManagementController::class)->names('super_admin.teachers');
        Route::resource('/super-admin/industrial-partners', \App\Http\Controllers\SuperAdmin\IndustrialPartnerController::class)->names('super_admin.industrial_partners');
    });

    // Gallery & Albums (Super Admin, Admin, & Editor)
    Route::middleware('role:super_admin|super-admin|admin|editor')->group(function () {
        Route::post('/super-admin/albums/{album}/upload', [AlbumController::class, 'uploadPhotos'])->name('super_admin.albums.upload');
        Route::resource('/super-admin/albums', AlbumController::class)->names('super_admin.albums');
    });

    // Super Admin Only
    Route::middleware('role:super_admin|super-admin')->prefix('super-admin')->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('super_admin.dashboard');
        Route::get('/users', [SuperAdminController::class, 'users'])->name('super_admin.users');
        Route::get('/users/trash', [SuperAdminController::class, 'trashedUsers'])->name('super_admin.users.trash');
        Route::get('/users/{user}/edit', [SuperAdminController::class, 'editUser'])->name('super_admin.users.edit');
        Route::put('/users/{user}', [SuperAdminController::class, 'updateUser'])->name('super_admin.users.update');
        Route::delete('/users/{user}', [SuperAdminController::class, 'destroyUser'])->name('super_admin.users.destroy');
        Route::post('/users/{id}/restore', [SuperAdminController::class, 'restoreUser'])->name('super_admin.users.restore');
        Route::delete('/users/{id}/force-delete', [SuperAdminController::class, 'forceDeleteUser'])->name('super_admin.users.force_delete');
        Route::get('/activity-log', [SuperAdminController::class, 'activityLog'])->name('super_admin.activity_log');
        
        // E-Rapor Management
        Route::get('/e-rapor', [App\Http\Controllers\SuperAdmin\StudentReportManagementController::class, 'index'])->name('super_admin.rapor.index');
        Route::get('/e-rapor/recap', [App\Http\Controllers\SuperAdmin\StudentReportManagementController::class, 'recap'])->name('super_admin.rapor.recap');
        Route::post('/e-rapor/recap', [App\Http\Controllers\SuperAdmin\StudentReportManagementController::class, 'bulkStore'])->name('super_admin.rapor.bulk_store');
        Route::get('/e-rapor/create', [App\Http\Controllers\SuperAdmin\StudentReportManagementController::class, 'create'])->name('super_admin.rapor.create');
        Route::post('/e-rapor', [App\Http\Controllers\SuperAdmin\StudentReportManagementController::class, 'store'])->name('super_admin.rapor.store');
        Route::get('/e-rapor/{rapor}/edit', [App\Http\Controllers\SuperAdmin\StudentReportManagementController::class, 'edit'])->name('super_admin.rapor.edit');
        Route::put('/e-rapor/{rapor}', [App\Http\Controllers\SuperAdmin\StudentReportManagementController::class, 'update'])->name('super_admin.rapor.update');
        Route::delete('/e-rapor/{rapor}', [App\Http\Controllers\SuperAdmin\StudentReportManagementController::class, 'destroy'])->name('super_admin.rapor.destroy');
        Route::post('/e-rapor/import', [App\Http\Controllers\SuperAdmin\StudentReportManagementController::class, 'import'])->name('super_admin.rapor.import');
        Route::get('/e-rapor/export', [App\Http\Controllers\SuperAdmin\StudentReportManagementController::class, 'export'])->name('super_admin.rapor.export');

        // BLUD CMS
        Route::get('/blud-settings', [App\Http\Controllers\SuperAdmin\BludSettingController::class, 'index'])->name('super_admin.blud_settings.index');
        Route::post('/blud-settings', [App\Http\Controllers\SuperAdmin\BludSettingController::class, 'update'])->name('super_admin.blud_settings.update');

        // Teaching Factory CMS
        Route::get('/tefa-settings', [App\Http\Controllers\SuperAdmin\TefaSettingController::class, 'index'])->name('super_admin.tefa_settings.index');
        Route::post('/tefa-settings', [App\Http\Controllers\SuperAdmin\TefaSettingController::class, 'update'])->name('super_admin.tefa_settings.update');

        // PPDB CMS
        Route::get('/ppdb-settings', [App\Http\Controllers\SuperAdmin\PpdbSettingController::class, 'index'])->name('super_admin.ppdb_settings.index');
        Route::post('/ppdb-settings', [App\Http\Controllers\SuperAdmin\PpdbSettingController::class, 'update'])->name('super_admin.ppdb_settings.update');

        // Bidang Kerja CMS
        Route::get('/bidang-kerja-settings', [App\Http\Controllers\SuperAdmin\BidangKerjaSettingController::class, 'index'])->name('super_admin.bidang_kerja_settings.index');
        Route::post('/bidang-kerja-settings', [App\Http\Controllers\SuperAdmin\BidangKerjaSettingController::class, 'update'])->name('super_admin.bidang_kerja_settings.update');

        // Landing Page CMS
        Route::get('/landing-settings', [LandingSettingController::class, 'index'])->name('super_admin.landing_settings.index');
        Route::post('/landing-settings', [LandingSettingController::class, 'update'])->name('super_admin.landing_settings.update');

        // YouTube Videos
        Route::resource('/youtube-videos', \App\Http\Controllers\SuperAdmin\YoutubeVideoController::class)->names('super_admin.youtube_videos');
        Route::post('/youtube-videos/{youtubeVideo}/toggle', [\App\Http\Controllers\SuperAdmin\YoutubeVideoController::class, 'toggleStatus'])->name('super_admin.youtube_videos.toggle');

        // Popup Announcements
        Route::resource('/popup-announcements', \App\Http\Controllers\SuperAdmin\PopupAnnouncementController::class)->names('super_admin.popup_announcements');

        // Testimonial Management
        Route::get('/testimonis', [App\Http\Controllers\TestimoniController::class, 'adminIndex'])->name('super_admin.testimonis.index');
        Route::post('/testimonis/{testimoni}/approve', [App\Http\Controllers\TestimoniController::class, 'approve'])->name('super_admin.testimonis.approve');
        Route::delete('/testimonis/{testimoni}', [App\Http\Controllers\TestimoniController::class, 'destroy'])->name('super_admin.testimonis.destroy');
    });

    // Admin Panel
    Route::middleware('role:admin|super_admin|super-admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/ppdb', [AdminController::class, 'ppdb'])->name('admin.ppdb');
        Route::get('/e-rapor', [AdminController::class, 'eRapor'])->name('admin.e_rapor');
    });

    // Editor Panel
    Route::middleware('role:editor|admin|super_admin|super-admin')->prefix('editor')->group(function () {
        Route::get('/dashboard', [EditorController::class, 'dashboard'])->name('editor.dashboard');
        Route::resource('/posts', PostController::class)->names('editor.posts');
    });

    // Guru Dashboard
    Route::middleware('role:guru')->prefix('guru')->group(function () {
        Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    });

    // Removed Siswa Dashboard from here to allow public search by Username/NISN
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Social Login Routes
Route::get('auth/{provider}/redirect', [App\Http\Controllers\Auth\SocialController::class, 'redirectToProvider'])
    ->name('social.redirect');
Route::get('auth/{provider}/callback', [App\Http\Controllers\Auth\SocialController::class, 'handleProviderCallback'])
    ->name('social.callback');
