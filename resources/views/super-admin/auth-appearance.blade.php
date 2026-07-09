@extends('layouts.dashboard')

@section('title', 'Background Halaman Login')

@section('content')
@php
    $isSuperAdmin = auth()->user()->hasRole(['super_admin','super-admin']);
    $updateRoute = $isSuperAdmin ? route('super_admin.auth_appearance.update') : route('admin.auth_appearance.update');
    $resetRoute  = $isSuperAdmin ? route('super_admin.auth_appearance.reset')  : route('admin.auth_appearance.reset');
    $isStorage   = !str_starts_with($authHeroImage, 'images/');
    $imgUrl      = $isStorage ? asset('storage/' . $authHeroImage) : asset($authHeroImage);
@endphp
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Background Halaman Login</h1>
    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Atur gambar background yang tampil di halaman Login, Register, dan Lupa Kata Sandi.</p>
</div>

@if(session('success'))
    <div class="mb-6 flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-100">
        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <p class="text-sm font-semibold text-emerald-700">{{ session('success') }}</p>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

    {{-- Preview --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700">
            <h3 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-widest">Preview Background Saat Ini</h3>
        </div>
        <div class="relative h-80 bg-slate-900">
            @php
                $isStorage = !str_starts_with($authHeroImage, 'images/');
                $imgUrl = $isStorage ? asset('storage/' . $authHeroImage) : asset($authHeroImage);
            @endphp
            <img src="{{ $imgUrl }}"
                 class="w-full h-full object-cover object-center brightness-50"
                 alt="Preview Background"
                 id="preview-img">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/40 to-slate-900/60"></div>
            <div class="absolute bottom-4 left-4 text-white">
                <p class="text-xs font-bold uppercase tracking-widest opacity-70">SMKN 1 KATAPANG</p>
                <p class="text-2xl font-black mt-1">Tampilan Login</p>
            </div>
            {{-- Badge default --}}
            @if(!$isStorage)
                <div class="absolute top-3 right-3 bg-slate-700/80 text-white text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full">
                    Gambar Default
                </div>
            @endif
        </div>
        <div class="px-6 py-4">
            <p class="text-xs text-slate-500 dark:text-slate-400">
                Background ini ditampilkan di sisi kiri halaman Login, Register, dan Lupa Kata Sandi.
            </p>
        </div>
    </div>

    {{-- Upload Form --}}
    <div class="space-y-6">
        {{-- Upload baru --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700">
                <h3 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-widest">Ganti Background</h3>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ $updateRoute }}" enctype="multipart/form-data"
                      x-data="{ fileName: '', previewUrl: '' }">
                    @csrf

                    <div class="space-y-4">
                        {{-- Drop zone --}}
                        <div class="relative border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-xl p-6 text-center hover:border-blue-400 transition-colors cursor-pointer"
                             @click="$refs.fileInput.click()">
                            <div x-show="!previewUrl">
                                <svg class="w-10 h-10 text-slate-300 dark:text-slate-600 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">Klik untuk pilih gambar</p>
                                <p class="text-xs text-slate-400 mt-1">JPG, PNG, WEBP — Maks. 5MB</p>
                                <p class="text-xs text-slate-400">Rekomendasi: 1200 × 1800px (portrait)</p>
                            </div>
                            <div x-show="previewUrl" x-cloak class="relative">
                                <img :src="previewUrl" class="w-full h-48 object-cover rounded-lg" alt="Preview">
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-2" x-text="fileName"></p>
                            </div>
                        </div>

                        <input type="file" name="auth_hero_image" x-ref="fileInput" accept="image/*" class="hidden"
                               @change="
                                   const file = $event.target.files[0];
                                   if (file) {
                                       fileName = file.name;
                                       const reader = new FileReader();
                                       reader.onload = e => previewUrl = e.target.result;
                                       reader.readAsDataURL(file);
                                   }
                               ">

                        @error('auth_hero_image')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror

                        <button type="submit"
                                :disabled="!previewUrl"
                                :class="previewUrl ? 'bg-blue-600 hover:bg-blue-700 cursor-pointer' : 'bg-slate-200 dark:bg-slate-700 cursor-not-allowed text-slate-400'"
                                class="w-full py-2.5 text-white text-sm font-semibold rounded-xl transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            Simpan Background Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Reset ke default --}}
        @if(!str_starts_with($authHeroImage, 'images/'))
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-6">
            <h3 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-widest mb-2">Reset ke Default</h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">Kembalikan background ke gambar bawaan sistem (foto gedung sekolah).</p>
        <form method="POST" action="{{ $resetRoute }}">
                @csrf
                <button type="submit"
                        onclick="return confirm('Reset background ke gambar default?')"
                        class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-red-600 border border-red-200 dark:border-red-800/40 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Reset ke Default
                </button>
            </form>
        </div>
        @endif

    </div>
</div>
@endsection
