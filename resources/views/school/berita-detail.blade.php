@extends('layouts.landing')

@section('title', 'Berita: ' . $post->title)

@section('content')
<div class="bg-gray-50 min-h-screen pt-24 pb-16">
    <!-- Breadcrumbs -->
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <nav class="flex text-sm text-gray-500 font-inter">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Home</a>
            <span class="mx-2">&rsaquo;</span>
            <a href="#" class="hover:text-blue-600 transition-colors">Berita</a>
            <span class="mx-2">&rsaquo;</span>
            <span class="text-gray-900 font-semibold truncate">{{ Str::limit($post->title, 40) }}</span>
        </nav>
    </div>

    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Main Content Area -->
            <article class="flex-1 max-w-3xl">
                <!-- Featured Image -->
                <div class="rounded-2xl overflow-hidden mb-6 relative bg-gray-200 aspect-[16/9]">
                    <img src="{{ $post->image_url }}" class="w-full h-full object-cover" alt="{{ $post->title }}">
                </div>

                <!-- Meta Details -->
                <div class="flex items-center gap-4 text-xs font-semibold text-gray-500 mb-6 font-inter">
                    <span class="bg-gray-200 text-gray-700 font-bold px-3 py-1 rounded-full uppercase tracking-wide">{{ $post->category }}</span>
                    <div class="flex items-center gap-1.5 flex-wrap">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('d F Y') }}
                    </div>
                    <div class="flex items-center gap-1.5 flex-wrap">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Oleh: {{ $post->author->name ?? 'Admin Sekolah' }}
                    </div>
                </div>

                <!-- Title -->
                <h1 class="text-3xl md:text-4xl font-extrabold text-[#0A142F] leading-tight mb-8 font-outfit">{{ $post->title }}</h1>

                <!-- Summary Highlight Quote (from mockup logic if content exists, otherwise static mock) -->
                @php
                    $firstParagraph = Str::limit(strip_tags($post->content), 200);
                    $remainingContent = Str::substr(strip_tags($post->content), 200) ?: 'Puji syukur, Drum Band Dharma Prada Parama bersama Liska.id kembali menorehkan prestasi dalam ajang Cimahi Campernik Sound Sport Competition tingkat Provinsi Jawa Barat dengan meraih Juara 3 Music Performance Divisi Senior Pianica. Prestasi ini menjadi kebanggaan tersendiri.

                    Persiapan intensif telah dilakukan selama lebih dari enam bulan oleh tim SMKN 1 Katapang dalam menghadapi kompetisi tersebut. Melalui bimbingan dan latihan rutin, program pembinaan yang diterapkan terbukti efektif dalam mengasah kemampuan tim hingga berhasil meraih Juara 3 pada ajang bergengsi tersebut.
                    
                    • Pelatihan intensif mingguan di ruang seni sekolah yang modern.
                    • Mentoring langsung oleh dosen dari universitas ternama.
                    • Simulasi ujian dengan standar kompetisi internasional.
                    • Dukungan psikologis untuk menjaga kesehatan mental siswa selama kompetisi.
                    
                    Kepala sekolah Hendra Hermansah menyatakan bahwa prestasi ini menjadi bukti komitmen SMKN 1 Katapang dalam menciptakan lingkungan belajar yang kompetitif dan suportif. Ia menegaskan bahwa sekolah selalu mendorong siswa untuk berani bermimpi besar dan terus mengembangkan potensi terbaik mereka.';
                @endphp

                <div class="pl-4 border-l-4 border-[#F2C94C] mb-8">
                    <p class="text-lg font-medium text-gray-800 leading-relaxed font-inter">
                        {{ $firstParagraph ?: 'Puji syukur, Drum Band Dharma Prada Parama bersama Lisska.id kembali meraih prestasi membanggakan dalam ajang Cimahi Campernik Sound Sport Competition, dengan berhasil menjadi Juara 3 Music Performance Divisi Senior Pianica. Prestasi ini menjadi kebanggaan dan motivasi untuk terus berkembang.' }}
                    </p>
                </div>

                <!-- Article Body -->
                <div class="prose prose-lg prose-blue max-w-none text-gray-700 font-inter mb-10 leading-relaxed whitespace-pre-line">
                    <p>
                        @if($post->content != '')
                            {!! $post->content !!}
                        @else
                            {{ $remainingContent }}
                        @endif
                    </p>
                    
                    <!-- Nested Quote Block -->
                    @if($post->quote)
                    <div class="bg-[#0A142F] text-white p-8 rounded-2xl my-8 relative not-prose">
                        <svg class="absolute top-4 left-4 w-16 h-16 text-white/5" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"></path></svg>
                        <p class="text-lg font-bold mb-6 relative z-10 leading-relaxed font-outfit">"{!! nl2br(e($post->quote)) !!}"</p>
                        @if($post->quote_author)
                        <p class="text-[#F2C94C] font-semibold text-sm">— {{ $post->quote_author }}</p>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Share Tags & Socials -->
                <div class="border-t border-gray-100 pt-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-bold text-gray-400 tracking-widest uppercase">BAGIKAN:</span>
                        <a href="#" class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path></svg></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-sky-400 text-white flex items-center justify-center hover:bg-sky-500 transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path></svg></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center hover:bg-black transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg></a>
                    </div>
                    
                    <div class="flex gap-2 text-xs text-gray-500 font-medium">
                        <span class="hover:text-blue-600 transition cursor-pointer">#{{ strtoupper($post->category) }}</span>
                        <span class="hover:text-blue-600 transition cursor-pointer">#SMKN1KATAPANG</span>
                        <span class="hover:text-blue-600 transition cursor-pointer">#Prestasi</span>
                    </div>
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="w-full lg:w-[340px] shrink-0">
                <!-- Recent News Widget -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 mb-8 shadow-sm">
                    <h3 class="text-xl font-bold text-[#0A142F] font-outfit mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path></svg>
                        Berita Terbaru
                    </h3>
                    
                    <div class="space-y-6 mb-6">
                        @foreach($recentPosts as $idx => $recentPost)
                        <!-- Small News Item -->
                        <a href="{{ route('berita.detail', $recentPost->slug) }}" class="flex gap-4 group">
                            <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-200 shrink-0">
                                <img src="{{ $recentPost->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            </div>
                            <div class="flex flex-col justify-center">
                                <span class="text-[10px] uppercase font-bold text-blue-600 tracking-wider mb-1">{{ $recentPost->category }}</span>
                                <h4 class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors font-outfit line-clamp-2 leading-tight mb-1">
                                    {{ $recentPost->title }}
                                </h4>
                                <span class="text-[10px] text-gray-500 font-medium">{{ \Carbon\Carbon::parse($recentPost->created_at)->translatedFormat('d M Y') }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>

                    <a href="#" class="block w-full text-center py-2.5 border-2 border-blue-50 text-blue-600 font-bold text-sm rounded-lg hover:bg-blue-50 transition">Lihat Semua Berita</a>
                </div>

                <!-- Categories Widget -->
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="text-xl font-bold text-[#0A142F] font-outfit mb-6">Kategori</h3>
                    
                    <div class="flex flex-wrap gap-2">
                        @foreach($categories as $category)
                            <a href="#" class="px-4 py-2 bg-gray-50 hover:bg-blue-50 border border-gray-100 text-gray-700 hover:text-blue-600 font-medium text-xs rounded-lg transition-colors flex items-center gap-2">
                                {{ Str::headline($category->category) }} <span class="text-gray-400">({{ $category->total }})</span>
                            </a>
                        @endforeach
                        
                        <!-- Static Fallbacks -->
                        @if($categories->count() == 0)
                            <a href="#" class="px-4 py-2 bg-gray-50 hover:bg-blue-50 border border-gray-100 text-gray-700 hover:text-blue-600 font-medium text-xs rounded-lg transition-colors flex items-center gap-2">Prestasi <span class="text-gray-400">(12)</span></a>
                            <a href="#" class="px-4 py-2 bg-gray-50 hover:bg-blue-50 border border-gray-100 text-gray-700 hover:text-blue-600 font-medium text-xs rounded-lg transition-colors flex items-center gap-2">Event <span class="text-gray-400">(8)</span></a>
                            <a href="#" class="px-4 py-2 bg-gray-50 hover:bg-blue-50 border border-gray-100 text-gray-700 hover:text-blue-600 font-medium text-xs rounded-lg transition-colors flex items-center gap-2">Akademik <span class="text-gray-400">(15)</span></a>
                            <a href="#" class="px-4 py-2 bg-gray-50 hover:bg-blue-50 border border-gray-100 text-gray-700 hover:text-blue-600 font-medium text-xs rounded-lg transition-colors flex items-center gap-2">Fasilitas <span class="text-gray-400">(5)</span></a>
                            <a href="#" class="px-4 py-2 bg-gray-50 hover:bg-blue-50 border border-gray-100 text-gray-700 hover:text-blue-600 font-medium text-xs rounded-lg transition-colors flex items-center gap-2">Kegiatan Siswa <span class="text-gray-400">(21)</span></a>
                        @endif
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
