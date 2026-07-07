@extends('layouts.landing')

@section('title', 'Berita & Artikel')

@section('content')
<div class="bg-gray-50 min-h-screen pt-24 pb-20">
    <!-- Header -->
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-extrabold text-[#0A142F] mb-4 font-outfit uppercase">Portal Berita</h1>
            <p class="text-lg text-gray-500 font-inter">Kumpulan informasi terkini, prestasi, event, dan pengumuman resmi dari SMKN 1 Katapang.</p>
        </div>
    </div>

    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Main Content: News Grid -->
            <div class="flex-1">
                @if(request()->has('category') || request()->has('search'))
                <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-5 rounded-2xl shadow-sm border border-blue-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center text-blue-600">
                            @if(request()->has('search'))
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            @endif
                        </div>
                        <div>
                            @if(request()->has('search'))
                            <span class="text-sm text-gray-400 block font-medium uppercase tracking-[0.1em]">Hasil Pencarian</span>
                            <span class="text-[#0A142F] font-bold text-lg font-outfit">"{{ request('search') }}"</span>
                            @else
                            <span class="text-sm text-gray-400 block font-medium uppercase tracking-[0.1em]">Kategori</span>
                            <span class="text-[#0A142F] font-bold text-lg font-outfit capitalize">{{ request('category') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <span class="text-xs text-gray-400 font-medium font-inter">{{ $posts->total() }} Artikel ditemukan</span>
                        <a href="{{ route('berita.index') }}" class="px-4 py-2 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-bold rounded-xl transition-all uppercase tracking-widest">Hapus Filter</a>
                    </div>
                </div>
                @endif

                @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @foreach($posts as $post)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all border border-gray-100 group flex flex-col">
                        <div class="aspect-[4/3] relative overflow-hidden bg-gray-200">
                            <img src="{{ $post->image_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $post->title }}">
                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="bg-blue-600 text-white text-[10px] font-bold px-3 py-1.5 rounded uppercase tracking-wider shadow-sm">{{ $post->category }}</span>
                            </div>
                        </div>
                        
                        <div class="p-6 flex-1 flex flex-col">
                            <!-- Meta Data -->
                            <div class="flex items-center gap-3 text-xs text-gray-400 font-medium mb-3 font-inter">
                                <span class="flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d M Y') }}</span>
                                <span class="flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> {{ $post->author->name ?? 'Admin' }}</span>
                            </div>
                            
                            <!-- Title & Summary -->
                            <h3 class="font-bold text-[#0A142F] group-hover:text-blue-600 transition-colors line-clamp-2 text-lg font-outfit mb-3">
                                <a href="{{ route('berita.detail', $post->slug) }}" class="focus:outline-none::before absolute inset-0">{{ $post->title }}</a>
                            </h3>
                            <p class="text-sm text-gray-500 line-clamp-3 font-inter mb-4 flex-1">
                                {{ Str::limit(strip_tags($post->content), 120) }}
                            </p>
                            
                            <!-- Call to Action -->
                            <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between text-blue-600">
                                <span class="text-sm font-semibold tracking-wide flex items-center gap-1 group-hover:gap-2 transition-all">Baca Selengkapnya <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Custom Pagination Links -->
                <div class="mt-8 flex justify-center">
                    {{ $posts->appends(request()->query())->links() }}
                </div>
                @else
                <!-- Empty State -->
                <div class="bg-white rounded-2xl p-16 text-center border border-gray-100 shadow-sm mt-8">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-[#0A142F] mb-3 font-outfit">Pencarian Tidak Ditemukan</h3>
                    <p class="text-gray-500 font-inter mb-8 max-w-sm mx-auto leading-relaxed">
                        Maaf, kami tidak dapat menemukan berita yang cocok dengan kata kunci <strong class="text-blue-600">"{{ request('search') }}"</strong>. Coba kata kunci lain atau hapus filter.
                    </p>
                    <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-blue-200 text-xs uppercase tracking-widest">
                        Hapus Semua Filter
                    </a>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="w-full lg:w-[320px] shrink-0">
                
                <!-- Search Widget -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 mb-8 shadow-sm">
                    <h3 class="text-base font-bold text-[#0A142F] font-outfit mb-4">Pencarian</h3>
                    <form action="{{ route('berita.index') }}" method="GET">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Cari artikel..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all font-inter">
                            <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </form>
                </div>

                <!-- Categories Widget -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm mb-8">
                    <h3 class="text-base font-bold text-[#0A142F] font-outfit mb-4">Kategori Berita</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('berita.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg {{ !request('category') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 transition-colors' }}">
                                <span class="text-sm">Semua Kategori</span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('berita.index', ['category' => $category->category]) }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg {{ request('category') == $category->category ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 transition-colors' }}">
                                <span class="text-sm capitalize">{{ $category->category }}</span>
                                <span class="text-xs bg-gray-100 text-gray-500 px-2.5 py-0.5 rounded-full font-medium">{{ $category->total }}</span>
                            </a>
                        </li>
                        @endforeach
                        
                        <!-- Static Fallbacks incase Database is empty -->
                        @if(count($categories) == 0)
                            <li><a href="{{ route('berita.index', ['category' => 'prestasi']) }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors"><span class="text-sm">Prestasi</span><span class="text-xs bg-gray-100 text-gray-500 px-2.5 py-0.5 rounded-full font-medium">12</span></a></li>
                            <li><a href="{{ route('berita.index', ['category' => 'event']) }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors"><span class="text-sm">Event</span><span class="text-xs bg-gray-100 text-gray-500 px-2.5 py-0.5 rounded-full font-medium">8</span></a></li>
                            <li><a href="{{ route('berita.index', ['category' => 'akademik']) }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors"><span class="text-sm">Akademik</span><span class="text-xs bg-gray-100 text-gray-500 px-2.5 py-0.5 rounded-full font-medium">15</span></a></li>
                        @endif
                    </ul>
                </div>

                <!-- Info Widget -->
                <div class="bg-gradient-to-br from-[#0A142F] to-blue-900 rounded-2xl p-6 text-white text-center shadow-lg relative overflow-hidden">
                    <div class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <svg class="w-10 h-10 mx-auto text-blue-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <h4 class="font-bold font-outfit text-lg mb-2">Punya Berita Menarik?</h4>
                    <p class="text-sm text-gray-300 mb-6 font-inter leading-relaxed">Kirimkan artikel atau dokumentasi kegiatan untuk dimuat di portal resmi kami.</p>
                    <a href="{{ route('contact') }}" class="inline-block bg-[#F2C94C] hover:bg-yellow-500 text-[#0A142F] font-bold text-sm px-6 py-2.5 rounded-full transition-colors w-full">Kirim Redaksi</a>
                </div>
            </aside>

        </div>
    </div>
</div>
@endsection
