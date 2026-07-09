@extends('layouts.landing')

@section('title', 'Program Keahlian')

@section('content')
@php
if (!function_exists('getMajorColorHex')) {
    function getMajorColorHex($color) {
        if (str_starts_with($color, 'bg-[')) {
            preg_match('/bg-\\[([^\]]+)\\]/', $color, $matches);
            if (isset($matches[1])) {
                return $matches[1];
            }
        }
        // Fallback mapping
        $map = [
            'bg-red-500' => '#ef4444',
            'bg-green-400' => '#4ade80',
            'bg-blue-500' => '#3b82f6',
            'bg-yellow-500' => '#eab308',
            'bg-orange-500' => '#f97316',
        ];
        return $map[$color] ?? '#3b82f6';
    }
}
@endphp
<!-- Hero Section -->
<section class="bg-[#0A142F] text-white pt-32 pb-20 relative overflow-hidden">
    @php
        $currentCategory = request('category', 'all');
        $categoryIcons = [
            'TECHNOLOGY' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
            'AUTOMOTIVE' => 'M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z',
            'CREATIVE ARTS' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01',
            'BUSINESS & FINANCE' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6',
            'HEALTH SERVICES' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
            'ELECTRICAL' => 'M13 10V3L4 14h7v7l9-11h-7z',
            'MECHANICAL' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z',
            'TEXTILE' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
        ];
        $categoryTranslations = [
            'TECHNOLOGY' => 'TEKNOLOGI',
            'AUTOMOTIVE' => 'OTOMOTIF',
            'CREATIVE ARTS' => 'SENI KREATIF',
            'BUSINESS & FINANCE' => 'BISNIS & KEUANGAN',
            'HEALTH SERVICES' => 'LAYANAN KESEHATAN',
            'ELECTRICAL' => 'KELISTRIKAN',
            'MECHANICAL' => 'PERMESINAN',
            'TEXTILE' => 'TEKSTIL',
        ];
    @endphp

    <div class="absolute inset-0 z-0">
        @php
            $finalImageUrl = 'https://images.unsplash.com/photo-1544650030-3c519eb3ad4d?q=80&w=2070&auto=format&fit=crop';
            if ($heroImage) {
                if (filter_var($heroImage, FILTER_VALIDATE_URL)) {
                    $finalImageUrl = $heroImage;
                } else {
                    $finalImageUrl = asset('storage/' . $heroImage);
                }
            }
        @endphp
        <img src="{{ $finalImageUrl }}" class="w-full h-full object-cover opacity-60 transition-opacity duration-700" alt="Hero Background">
        <div class="absolute inset-0 bg-gradient-to-b from-[#0A142F]/40 via-[#0A142F]/60 to-[#0A142F]"></div>
    </div>
    
    <!-- Decorative elements -->
    <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-600/10 blur-[100px] rounded-full translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-1/4 h-full bg-blue-400/5 blur-[80px] rounded-full -translate-x-1/2 translate-y-1/2"></div>

    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl">
            <nav class="flex items-center gap-2 text-xs font-medium text-gray-400 mb-6 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-blue-400">Program Keahlian</span>
            </nav>
            
            <h1 class="text-5xl md:text-6xl font-black mb-6 font-outfit tracking-tight leading-tight">
                {!! $heroTitle !!}
            </h1>
            <p class="text-gray-300 text-lg md:text-xl font-inter mb-10 max-w-2xl leading-relaxed">
                {{ $heroDescription }}
            </p>
            
           
                </div>
                
                <div class="bg-white/5 backdrop-blur-md border border-white/10 px-6 py-3 rounded-2xl flex items-center gap-3 group hover:border-white/20 transition-all">
                    <div class="w-10 h-10 rounded-xl bg-green-500/20 flex items-center justify-center text-green-400 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-white">{{ count($majors) }} Program Unggulan</div>
                        <div class="text-[10px] text-gray-400 uppercase tracking-widest">Peminatan Khusus</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content Layout -->
<section class="py-20 bg-[#F8FAFC] min-h-screen">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row gap-12">
        
        <!-- Sidebar Filter -->
        <aside class="w-full lg:w-80 shrink-0">
            <div class="sticky top-24">
                <div class="mb-8 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    </div>
                    <h3 class="text-base font-black text-[#0A142F] font-outfit tracking-tight uppercase">Filter Bidang</h3>
                </div>
                
                <div class="bg-white rounded-2xl shadow-[0_10px_30px_-15px_rgba(0,0,0,0.05)] border border-slate-200/60 overflow-hidden mb-8 p-2">
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('jurusan.index', ['category' => 'all']) }}" class="flex px-4 py-3 {{ $currentCategory == 'all' ? 'bg-[#4F5B6F] text-white' : 'text-slate-500 hover:text-blue-600 hover:bg-blue-50/50' }} font-bold text-sm tracking-wide rounded-xl transition-all {{ $currentCategory == 'all' ? 'shadow-md shadow-[#4F5B6F]/20' : '' }}">
                                <svg class="w-4 h-4 mr-3 {{ $currentCategory == 'all' ? '' : 'opacity-60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                Semua Bidang
                            </a>
                        </li>
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('jurusan.index', ['category' => $category]) }}" class="flex px-4 py-3 {{ $currentCategory == $category ? 'bg-[#4F5B6F] text-white' : 'text-slate-500 hover:text-blue-600 hover:bg-blue-50/50' }} font-bold text-sm tracking-wide transition-all rounded-xl {{ $currentCategory == $category ? 'shadow-md shadow-[#4F5B6F]/20' : '' }}">
                                <svg class="w-4 h-4 mr-3 {{ $currentCategory == $category ? '' : 'opacity-60' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $categoryIcons[strtoupper($category)] ?? 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' }}"></path>
                                </svg>
                                {{ $categoryTranslations[strtoupper($category)] ?? Str::title($category) }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-8 border border-blue-100 shadow-[0_15px_40px_-15px_rgba(59,130,246,0.15)] relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/40 blur-3xl -translate-y-1/2 translate-x-1/2 rounded-full"></div>

                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
                <div>
                    <h2 class="text-3xl font-black text-[#0A142F] font-outfit tracking-tight leading-tight">Program Keahlian</h2>
                    <p class="text-slate-400 font-medium text-sm mt-1 uppercase tracking-widest">Menampilkan {{ count($majors) }} Jurusan Pilihan</p>
                </div>
                
                <div x-data="{ open: false, selected: 'Terpopuler' }" 
                     @click.away="open = false"
                     class="relative flex items-center bg-white px-5 py-3 rounded-2xl shadow-sm border border-slate-100 min-w-[200px]">
                    <span class="text-sm font-bold text-slate-400 mr-2">Urutkan:</span>
                    
                    <button type="button" @click="open = !open" 
                            class="flex items-center justify-between gap-2 w-full text-sm font-black text-[#0A142F] focus:outline-none select-none cursor-pointer">
                        <span x-text="selected"></span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-300"
                             :class="{ 'rotate-180': open }"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                         style="display: none;"
                         class="absolute right-0 top-full mt-2 w-full bg-white rounded-2xl border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.08)] overflow-hidden z-50 p-1.5">
                        
                        <div @click="selected = 'Terpopuler'; open = false; sortMajors('Terpopuler')" 
                             class="flex items-center px-4 py-2.5 rounded-xl text-sm font-bold cursor-pointer transition-colors duration-150"
                             :class="selected === 'Terpopuler' ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50'">
                            Terpopuler
                        </div>
                        
                        <div @click="selected = 'Abjad (A-Z)'; open = false; sortMajors('Abjad (A-Z)')" 
                             class="flex items-center px-4 py-2.5 rounded-xl text-sm font-bold cursor-pointer transition-colors duration-150"
                             :class="selected === 'Abjad (A-Z)' ? 'bg-blue-50 text-blue-600' : 'text-slate-700 hover:bg-slate-50'">
                            Abjad (A-Z)
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid of Majors -->
            <div id="majors-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @foreach($majors as $slug => $major)
                <div data-order="{{ $loop->index }}" data-name="{{ $major->name }}" class="bg-white rounded-3xl shadow-[0_15px_50px_-15px_rgba(0,0,0,0.03)] border border-slate-100/80 overflow-hidden flex flex-col group hover:shadow-[0_25px_60px_-15px_rgba(0,0,0,0.08)] transition-all duration-500 hover:-translate-y-1">
                    <!-- Image and Banner Section -->
                    <div class="h-64 relative overflow-hidden bg-slate-100">
                        <img src="{{ str_starts_with($major->image, 'http') ? $major->image : asset('storage/' . $major->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 blur-[0.5px] group-hover:blur-0" alt="{{ $major->name }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                        
                        <!-- Banner Text Overlay (Avoid badge collision at bottom-right) -->
                        <div class="absolute bottom-4 right-4 left-16 text-right pointer-events-none z-10">
                           <h4 class="font-black text-xs md:text-sm leading-tight uppercase font-outfit drop-shadow-lg scale-y-110 origin-right italic"
                               style="color: {{ getMajorColorHex($major->color) }};">
                               {{ $major->banner_text }}
                           </h4>
                        </div>

                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="text-[10px] font-black px-3 py-1.5 rounded-lg text-white uppercase tracking-widest shadow-lg shadow-black/10"
                                  style="background-color: {{ getMajorColorHex($major->color) }};">
                                {{ $major->category }}
                            </span>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="font-black text-[#0A142F] text-xl leading-tight mb-4 font-outfit transition-colors"
                            onmouseover="this.style.color='{{ getMajorColorHex($major->color) }}'"
                            onmouseout="this.style.color='#0A142F'">
                            {{ $major->name }}
                        </h3>
                        
                        <p class="text-sm text-slate-500 mb-8 font-inter leading-relaxed flex-1 opacity-80 group-hover:opacity-100 transition-opacity">
                            {{ $major->description }}
                        </p>

                        <div class="pt-6 border-t border-slate-50 flex items-center justify-between">
                            <div class="flex items-center text-slate-400 text-xs gap-1.5 font-bold tracking-wide uppercase">
                                <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <span>{{ $major->seats }} Kursi</span>
                            </div>
                            
                            <a href="{{ route('jurusan.detail', $major->slug) }}" 
                               class="text-white text-[10px] font-black px-6 py-3 rounded-xl shadow-lg hover:brightness-110 transition-all uppercase tracking-widest active:scale-95"
                               style="background-color: {{ getMajorColorHex($major->color) }};">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </main>
</section>

<script>
function sortMajors(criteria) {
    const grid = document.getElementById('majors-grid');
    if (!grid) return;
    const cards = Array.from(grid.children);
    
    if (criteria === 'Terpopuler') {
        cards.sort((a, b) => {
            return parseInt(a.getAttribute('data-order')) - parseInt(b.getAttribute('data-order'));
        });
    } else if (criteria === 'Abjad (A-Z)') {
        cards.sort((a, b) => {
            const nameA = a.getAttribute('data-name').trim().toLowerCase();
            const nameB = b.getAttribute('data-name').trim().toLowerCase();
            return nameA.localeCompare(nameB);
        });
    }
    
    // Clear and append sorted cards
    grid.innerHTML = '';
    cards.forEach(card => grid.appendChild(card));
}
</script>
@endsection

