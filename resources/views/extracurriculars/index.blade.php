@extends('layouts.landing')

@section('title', 'Ekstrakurikuler')

@section('content')
<div class="bg-gray-50 min-h-screen font-inter overflow-hidden">
    <!-- HERO SECTION -->
    <div class="relative h-[55vh] min-h-[500px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <!-- School Gate Image from Mockup or dynamic from settings -->
            @php
                $heroImage = \App\Models\Setting::getByKey('extracurricular_hero_image');
                $heroTitle = \App\Models\Setting::getByKey('extracurricular_hero_title', 'Ekstrakurikuler');
                $heroDesc = \App\Models\Setting::getByKey('extracurricular_hero_description', 'Temukan bakat Anda, pelajari keahlian baru, dan ciptakan kenangan bersama beragam organisasi siswa kami.');
            @endphp
            <img src="{{ $heroImage ? asset('storage/' . $heroImage) : 'https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=2000' }}" class="w-full h-full object-cover" alt="SMKN 1 Katapang Gate">
            <div class="absolute inset-0 bg-[#0A142F]/60 backdrop-blur-[1px]"></div>
        </div>
        <div class="relative z-10 text-center px-4 max-w-4xl space-y-6" data-aos="zoom-in">
            <h1 class="text-5xl md:text-8xl font-extrabold text-white tracking-tight font-outfit uppercase">{{ $heroTitle }}</h1>
            <p class="text-lg md:text-xl text-white/80 leading-relaxed font-medium max-w-2xl mx-auto">
                {{ $heroDesc }}
            </p>
        </div>
    </div>

    <!-- SEARCH & FILTER BAR -->
    <div class="max-w-6xl mx-auto px-4 -mt-12 relative z-20" data-aos="fade-up" data-aos-delay="200">
        <div class="bg-white rounded-[2rem] shadow-2xl p-3 flex flex-col lg:flex-row items-center gap-4 border border-gray-100">
            <!-- Search -->
            <div class="flex-1 w-full relative">
                <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <input type="text" id="extraSearch" placeholder="Cari ekskul (misal: Futsal, Drumband...)" 
                       class="block w-full pl-14 pr-6 py-5 border-none focus:ring-0 text-gray-700 placeholder-gray-400 font-medium rounded-2xl">
            </div>
            
            <!-- Category Tabs -->
            <div class="flex flex-wrap items-center justify-center gap-2 p-1">
                <button class="category-btn active px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] transition-all bg-[#0A142F] text-white shadow-lg cursor-pointer" data-category="all">Semua Kegiatan</button>
                <button class="category-btn px-6 py-3 rounded-xl text-[10px] font-bold uppercase tracking-[0.2em] transition-all text-gray-500 hover:bg-gray-50 cursor-pointer" data-category="Sports">Olahraga</button>
                <button class="category-btn px-6 py-3 rounded-xl text-[10px] font-bold uppercase tracking-[0.2em] transition-all text-gray-500 hover:bg-gray-50 cursor-pointer" data-category="Arts & Culture">Seni & Budaya</button>
                <button class="category-btn px-6 py-3 rounded-xl text-[10px] font-bold uppercase tracking-[0.2em] transition-all text-gray-500 hover:bg-gray-50 cursor-pointer" data-category="Academic">Akademik</button>
                <button class="category-btn px-6 py-3 rounded-xl text-[10px] font-bold uppercase tracking-[0.2em] transition-all text-gray-500 hover:bg-gray-50 cursor-pointer" data-category="Religious">Religius</button>
            </div>
        </div>
    </div>

    <!-- EXTRACURRICULAR GRID -->
    <div class="max-w-7xl mx-auto px-6 py-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-16" id="extraGrid">
            @foreach($extras as $extra)
            <div class="extra-card group flex flex-col h-full bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100/50 hover:border-blue-100 transform" 
                 data-category="{{ $extra->category }}"
                 data-aos="fade-up" 
                 data-aos-delay="{{ ($loop->index % 4) * 100 }}">
                <!-- Card Inner -->
                <div class="h-60 overflow-hidden relative">
                    <img src="{{ $extra->image_url }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="{{ $extra->name }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-md rounded-full text-[9px] font-black uppercase tracking-widest text-[#0A142F] border border-white/20">
                            {{ $extra->category }}
                        </span>
                    </div>
                </div>
                
                <div class="p-8 flex flex-col flex-1">
                    <h3 class="text-2xl font-black text-[#0A142F] mb-4 font-outfit uppercase tracking-tight group-hover:text-blue-600 transition-colors">{{ $extra->name }}</h3>
                    <p class="text-sm text-gray-400 font-medium leading-relaxed mb-8 flex-1 line-clamp-3">
                        {{ $extra->description }}
                    </p>
                    <div class="mt-auto flex items-center justify-end">
                         <a href="{{ route('extracurriculars.show', $extra->slug) }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-[#0A142F] group/link hover:text-blue-600 transition-colors">
                            Lihat details
                            <svg class="h-4 w-4 transform group-hover/link:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('extraSearch');
        const categoryBtns = document.querySelectorAll('.category-btn');
        const extraCards = document.querySelectorAll('.extra-card');

        function filterExtras() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const activeCategory = document.querySelector('.category-btn.active').dataset.category;

            let visibleCount = 0;

            extraCards.forEach(card => {
                const name = card.querySelector('h3').textContent.toLowerCase();
                const description = card.querySelector('p').textContent.toLowerCase();
                const category = card.dataset.category ? card.dataset.category.toLowerCase() : '';
                
                const matchesSearch = name.includes(searchTerm) || description.includes(searchTerm);
                const matchesCategory = activeCategory === 'all' || category === activeCategory.toLowerCase();

                if (matchesSearch && matchesCategory) {
                    card.style.display = 'flex';
                    // Trigger reflow for transition
                    card.offsetHeight;
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0) scale(1)';
                    visibleCount++;
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px) scale(0.95)';
                    card.style.display = 'none';
                }
            });

            // Handle empty search results
            let emptyMsg = document.getElementById('emptySearchMsg');
            if (visibleCount === 0) {
                if (!emptyMsg) {
                    emptyMsg = document.createElement('div');
                    emptyMsg.id = 'emptySearchMsg';
                    emptyMsg.className = 'col-span-full py-20 text-center flex flex-col items-center justify-center space-y-4';
                    emptyMsg.innerHTML = `
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-gray-400">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <p class="text-gray-500 font-medium">Tidak ada ekstrakurikuler yang ditemukan.</p>
                        <button onclick="document.getElementById('extraSearch').value = ''; document.querySelector('.category-btn[data-category=\'all\']').click();" class="text-blue-600 font-bold hover:underline">Hapus Filter</button>
                    `;
                    document.getElementById('extraGrid').appendChild(emptyMsg);
                }
                emptyMsg.style.display = 'flex';
            } else if (emptyMsg) {
                emptyMsg.style.display = 'none';
            }
        }

        searchInput.addEventListener('input', filterExtras);

        categoryBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                categoryBtns.forEach(b => {
                    b.classList.remove('active', 'bg-[#0A142F]', 'text-white', 'shadow-lg');
                    b.classList.add('text-gray-500');
                });
                btn.classList.add('active', 'bg-[#0A142F]', 'text-white', 'shadow-lg');
                btn.classList.remove('text-gray-500');
                filterExtras();
            });
        });
        
        // Initial AOS refresh
        setTimeout(() => {
            AOS.refresh();
        }, 100);
    });
</script>
@endpush
@endsection
