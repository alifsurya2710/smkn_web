@extends('layouts.landing')

@section('title', $title)

@section('content')
<div class="bg-gray-50 min-h-screen pb-20">
    <!-- Header Section -->
    <section class="bg-blue-900 text-white pt-32 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex mb-8 text-sm text-blue-300">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span class="mx-2">/</span>
                <span class="text-white">{{ $category }}</span>
                <span class="mx-2">/</span>
                <span class="text-white">{{ $title }}</span>
            </nav>
            <h1 class="text-4xl md:text-6xl font-bold mb-6">{{ $title }}</h1>
            <p class="text-xl text-blue-100 max-w-3xl leading-relaxed italic">Halaman ini sedang dalam proses pembaharuan konten untuk memberikan informasi terbaik bagi Anda.</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10">
        <div class="bg-white rounded-3xl p-12 shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center min-h-[400px]">
            <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-8">
                <svg class="w-12 h-12 text-blue-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            </div>
            <h2 class="text-3xl font-bold mb-4">Konten Segera Hadir</h2>
            <p class="text-gray-500 max-w-md mx-auto mb-10">Kami sedang menyiapkan informasi detail mengenai {{ $title }} untuk meningkatkan kualitas layanan informasi publik sekolah kami.</p>
            <a href="{{ route('home') }}" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-all">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
