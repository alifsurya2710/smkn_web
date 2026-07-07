@extends('layouts.landing')

@section('title', $achievement->title)

@section('content')
<div class="bg-gray-50 min-h-screen pt-28 pb-20">
    <div class="max-w-4xl mx-auto px-6">
        <!-- Breadcrumb & Header -->
        <div class="mb-10" data-aos="fade-up">
            <nav class="flex items-center space-x-2 text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-6 font-inter">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Beranda</a>
                <span>/</span>
                <a href="{{ route('prestasi.index') }}" class="hover:text-blue-600 transition">Prestasi</a>
                <span>/</span>
                <span class="text-gray-900">Detail</span>
            </nav>
            
            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-[10px] font-extrabold uppercase tracking-widest rounded-lg mb-4">
                {{ $achievement->category->name ?? 'Prestasi' }}
            </span>
            <h1 class="text-3xl md:text-5xl font-black text-[#0A142F] font-outfit leading-tight mb-4 tracking-tight">
                {{ $achievement->title }}
            </h1>
            <div class="flex items-center gap-4 text-xs text-gray-400 font-bold uppercase tracking-widest font-inter">
                <span>{{ $achievement->date ? $achievement->date->format('d M Y') : $achievement->year }}</span>
                <span class="w-1.5 h-1.5 bg-gray-200 rounded-full"></span>
                <span>SMKN 1 Katapang</span>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-[2rem] overflow-hidden shadow-sm border border-gray-100 mb-12" data-aos="fade-up" data-aos-delay="100">
            <!-- Resized Image Area -->
            <div class="p-4 md:p-8 bg-gray-50/50">
                <div class="max-w-2xl mx-auto rounded-2xl overflow-hidden shadow-md border border-gray-100 bg-white">
                    <img src="{{ $achievement->image_url }}" class="w-full h-auto" alt="{{ $achievement->title }}">
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-8 md:p-14">
                <div class="prose prose-blue max-w-none font-inter text-gray-600">
                    <h2 class="text-lg font-black text-[#0A142F] mb-6 font-outfit uppercase tracking-widest border-l-4 border-blue-600 pl-4">Rincian Pencapaian</h2>
                    <div class="text-base md:text-lg text-gray-500 leading-relaxed space-y-4">
                        {!! nl2br(e($achievement->description)) !!}
                    </div>
                </div>

                @if($achievement->extracurricular)
                <div class="mt-12 pt-10 border-t border-gray-100">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 p-6 bg-blue-50/50 rounded-2xl border border-blue-100">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-blue-600 shadow-sm">
                                <i class="fas fa-users text-lg"></i>
                            </div>
                            <div>
                                <span class="text-[9px] font-black text-blue-500 uppercase tracking-widest block mb-0.5">Organisasi</span>
                                <h4 class="text-base font-bold text-[#0A142F] font-outfit">{{ $achievement->extracurricular->name }}</h4>
                            </div>
                        </div>
                        <a href="{{ route('extracurriculars.show', $achievement->extracurricular->slug) }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all text-[10px] uppercase tracking-widest">
                            Halaman Ekskul
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- RELATED ACHIEVEMENTS -->
        @if($otherAchievements->count() > 0)
        <div class="mt-20 px-4">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-black text-[#0A142F] font-outfit uppercase tracking-wider">Prestasi Lainnya</h3>
                <div class="h-1 flex-1 bg-gray-100 ml-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($otherAchievements as $other)
                <a href="{{ route('prestasi.detail', $other->id) }}" class="group block">
                    <div class="bg-white border border-gray-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 h-full">
                        <div class="aspect-video relative overflow-hidden bg-gray-100">
                            <img src="{{ $other->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                        </div>
                        <div class="p-6">
                            <span class="text-[8px] font-black text-blue-600 uppercase tracking-widest mb-3 block">
                                {{ $other->category->name }}
                            </span>
                            <h4 class="text-sm font-bold text-[#0A142F] font-outfit group-hover:text-blue-600 transition-colors line-clamp-2 leading-snug">
                                {{ $other->title }}
                            </h4>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

