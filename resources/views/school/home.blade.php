@php
    use App\Models\Setting;
    use App\Models\Major;
    use App\Models\Achievement;
    use App\Models\Facility;
    use App\Models\SchoolProfile;
@endphp

@extends('layouts.landing')
@section('title', 'Beranda')
@section('content')
@php
    $heroTitle = Setting::getByKey('landing_hero_title', 'SMK BISA, SMK HEBAT, SMK JUARA');
    $heroDesc = Setting::getByKey('landing_hero_description', 'Membentuk generasi yang kompeten dan berkarakter...');
    
    $heroVideo = Setting::getByKey('landing_hero_video');
    $heroImages = [];
    
    if (!$heroVideo) {
        for($i = 1; $i <= 3; $i++) {
            $img = Setting::getByKey('landing_hero_image_'.$i);
            if($img) {
                $heroImages[] = asset('storage/'.$img);
            }
        }
        // Fallback if none uploaded
        if(empty($heroImages)) {
            $heroImages = [
                'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541339907198-e08756ebafe3?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1986&auto=format&fit=crop'
            ];
        }
    }

    $statsSiswa = Setting::getByKey('stats_siswa_count', '1830');
    $statsPengajar = Setting::getByKey('stats_pengajar_count', '115');
    $statsMitra = Setting::getByKey('stats_mitra_count', '50');
    $statsAlumni = Setting::getByKey('stats_alumni_working_count', '850');

    $recentAchievements = Achievement::with('category')->where('is_featured', true)->latest()->take(4)->get();
    $facilities = Facility::where('is_active', true)->orderBy('order')->take(3)->get();
    $profile = SchoolProfile::first();
@endphp

@if($heroVideo)
    <!-- Video/GIF Hero Background -->
    <section class="relative h-[75vh] min-h-[600px] overflow-hidden bg-black">
        <div class="absolute inset-0">
            @php
                $ext = pathinfo($heroVideo, PATHINFO_EXTENSION);
            @endphp
            @if(in_array($ext, ['mp4', 'webm']))
                <video autoplay muted loop playsinline class="w-full h-full object-cover">
                    <source src="{{ asset('storage/' . $heroVideo) }}" type="video/{{ $ext }}">
                </video>
            @else
                <img src="{{ asset('storage/' . $heroVideo) }}" class="w-full h-full object-cover" alt="Hero Background">
            @endif
            
            <!-- Cinematic Overlays (Brighter) -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-black/30"></div>
            <div class="absolute inset-0 bg-black/5"></div>
            
            <!-- Content Wrapper -->
            <div class="absolute inset-0 flex items-center justify-center pt-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="max-w-4xl" data-aos="fade-up" data-aos-duration="1500">
                        <h1 class="text-5xl md:text-8xl font-black text-white leading-none font-outfit uppercase tracking-tighter mb-6">
                            {!! $heroTitle !!}
                        </h1>
                        <p class="text-lg md:text-2xl text-gray-200 mb-12 leading-relaxed max-w-2xl font-inter opacity-90">
                            {{ $heroDesc }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @include('school.partials.hero-indicators')
    </section>
@else
    <!-- Legacy Hero Slider Section -->
    <section class="relative h-[75vh] min-h-[600px] overflow-hidden bg-black" 
             x-data="{ 
                active: 0, 
                slides: {{ json_encode($heroImages) }},
                init() {
                    setInterval(() => {
                        this.active = (this.active + 1) % this.slides.length;
                    }, 7500);
                }
             }">    
        
        <!-- Slides -->
        <template x-for="(slide, index) in slides" :key="index">
            <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
                 x-show="active === index"
                 x-transition:enter="opacity-0"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="opacity-100"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                
                <!-- Ken Burns Image -->
                <img :src="slide" 
                     class="w-full h-full object-cover scale-105 animate-soft-zoom" 
                     loading="lazy" 
                     alt="School Hero">
                
                <!-- Cinematic Overlays (Brighter) -->
                <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-black/30"></div>
                <div class="absolute inset-0 bg-black/5"></div>
                
                <!-- Content Wrapper -->
                <div class="absolute inset-0 flex items-center justify-center pt-20">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                        <div class="max-w-4xl">
                            <!-- Typewriter Title -->
                            <div class="overflow-hidden mb-6">
                                <h1 class="text-5xl md:text-8xl font-black text-white leading-none font-outfit uppercase tracking-tighter"
                                    x-show="active === index"
                                    x-transition:enter="transition ease-out duration-1000 delay-300"
                                    x-transition:enter-start="opacity-0 transform translate-y-10"
                                    x-transition:enter-end="opacity-100 transform translate-y-0">
                                    {!! $heroTitle !!}
                                </h1>
                            </div>
                            
                            <!-- Fade Up Description -->
                            <p class="text-lg md:text-2xl text-gray-200 mb-12 leading-relaxed max-w-2xl font-inter opacity-0 transform translate-y-8 transition-all duration-1000 delay-700"
                               :class="active === index ? 'opacity-90 translate-y-0' : ''">
                                {{ $heroDesc }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <!-- Slider Dot Indicators -->
        <div class="absolute bottom-32 left-0 right-0 z-30 flex justify-center gap-3">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="active = index" 
                        class="h-1.5 transition-all duration-500 rounded-full"
                        :class="active === index ? 'w-12 bg-blue-500' : 'w-3 bg-white/30 hover:bg-white/50'"></button>
            </template>
        </div>
        @include('school.partials.hero-indicators')
    </section>
@endif

@include('school.partials.stats-card')



<!-- Sambutan Kepala Sekolah -->
<section class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center gap-16 md:gap-24">
            <div class="w-full md:w-[40%] relative" data-aos="fade-right">
                <div class="relative z-10 rounded-[2.5rem] overflow-hidden shadow-2xl aspect-[4/5]">
                    @if($profile && $profile->principal_photo)
                        <img src="{{ asset('storage/' . $profile->principal_photo) }}" alt="Kepala Sekolah" class="w-full h-full object-cover">
                    @else
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=1974&auto=format&fit=crop" alt="Kepala Sekolah" class="w-full h-full object-cover grayscale">
                    @endif
                </div>
                <!-- Decorative back frame -->
                <div class="absolute -top-4 -left-4 w-full h-full border-2 border-gray-200 rounded-[2.5rem] z-0"></div>
                <div class="absolute -bottom-6 -right-6 p-6 bg-black/80 backdrop-blur-md rounded-2xl z-20 max-w-[200px] border border-white/10" data-aos="zoom-in" data-aos-delay="400">
                    <p class="text-white text-xs font-inter italic leading-relaxed">"Pendidikan adalah senjata paling ampuh untuk mengubah dunia."</p>
                </div>
            </div>
            
            <div class="w-full md:w-[60%]" data-aos="fade-left" data-aos-delay="200">
                <div class="text-gray-400 font-bold tracking-[0.2em] uppercase text-xs mb-4">Sambutan Hangat</div>
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#0A142F] mb-8 font-outfit">Sambutan Kepala Sekolah</h2>
                <div class="text-gray-600 mb-10 font-inter leading-relaxed text-lg">
                    @if($profile && $profile->principal_message)
                        {!! nl2br(e(Str::limit($profile->principal_message, 500))) !!}
                    @else
                        <p class="mb-6">Selamat datang di platform digital resmi SMKN 1 Katapang. Sebagai lembaga pendidikan vokasi unggulan, kami berkomitmen penuh untuk menyelenggarakan sistem pendidikan yang relevan dengan dinamika industri modern.</p>
                        <p>Fokus utama kami bukan hanya pada transfer pengetahuan teknis, melainkan juga pada pembentukan karakter (soft skills) dan jiwa kewirausahaan. Kami mengundang putra-putri terbaik bangsa untuk bergabung dan berkembang bersama kami.</p>
                    @endif
                </div>
                <div>
                    <h4 class="text-xl font-extrabold text-gray-900 font-outfit uppercase">{{ $profile->principal_name ?? 'Hendra Hermansah, S.Pd., M.M' }}</h4>
                    <p class="text-gray-400 text-sm font-bold uppercase tracking-widest mt-1">Kepala SMK Negeri 1 Katapang</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Program Keahlian Section -->
<section class="py-24 bg-[#FBFCFE]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="text-blue-600 font-bold tracking-[0.2em] uppercase text-xs mb-3">Pilihan Keahlian</div>
            <h2 class="text-3xl md:text-5xl font-extrabold text-[#0A142F] mb-4 font-outfit uppercase">Program Keahlian Unggulan</h2>
            <p class="text-gray-400 max-w-2xl mx-auto font-inter text-lg">Pelajari keahlian yang paling dibutuhkan di era transformasi digital dan otomasi industri saat ini.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @forelse($featuredMajors as $major)
            <div class="group relative bg-white border border-gray-100 rounded-[32px] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-[480px]" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                <!-- Major Image -->
                <div class="h-1/2 relative overflow-hidden">
                    <img src="{{ $major->image ? (Str::startsWith($major->image, 'http') ? $major->image : asset('storage/'.$major->image)) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2070&auto=format&fit=crop' }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60"></div>
                    
                    <!-- Top Badge -->
                    <div class="absolute top-6 left-6">
                        <div class="px-3 py-1 bg-blue-600 rounded-full text-[10px] font-bold text-white uppercase tracking-widest shadow-lg">
                            {{ $major->category ?? 'UNGGULAN' }}
                        </div>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="p-8 flex-1 flex flex-col justify-between relative bg-white">
                    <!-- Acronym Background Shadow -->
                    <div class="absolute top-4 right-8 text-7xl font-black text-gray-50 pointer-events-none group-hover:text-blue-50 transition-all duration-700">
                        {{ $major->acronym }}
                    </div>

                    <div class="relative z-10">
                        <h3 class="text-2xl font-extrabold text-[#0A142F] mb-3 font-outfit uppercase group-hover:text-blue-600 transition-colors">
                            {{ $major->name }}
                        </h3>
                        <p class="text-gray-500 text-sm font-medium leading-relaxed line-clamp-3">
                            {{ $major->description ?? 'Membentuk tenaga kerja profesional dan kompeten di bidangnya dengan standar industri global.' }}
                        </p>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-50 mt-auto relative z-10">
                        <a href="{{ route('jurusan.detail', $major->slug) }}" class="text-[11px] font-extrabold text-[#0A142F] uppercase tracking-[0.2em] group-hover:text-blue-600 transition-all flex items-center gap-2">
                            Pelajari &rarr;
                        </a>
                        <span class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">DEPARTEMEN {{ $major->acronym }}</span>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-span-full py-20 text-center text-gray-400 italic">Belum ada program keahlian yang ditampilkan.</div>
            @endforelse
        </div>
        
        <div class="text-center" data-aos="zoom-in">
            <a href="{{ route('jurusan.index') }}" class="inline-flex justify-center items-center px-10 py-4 bg-white border-2 border-gray-100 hover:border-blue-600 hover:text-blue-600 text-[#0A142F] font-extrabold rounded-2xl shadow-sm transition-all text-xs uppercase tracking-widest">
                Lihat Semua Jurusan
            </a>
        </div>
    </div>
</section>

<!-- Fasilitas Sekolah Section -->
<section class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16" data-aos="fade-up">
            <div class="max-w-2xl">
                <div class="text-blue-600 font-bold tracking-[0.2em] uppercase text-xs mb-3">Lingkungan Belajar</div>
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#0A142F] mb-4 font-outfit uppercase">Fasilitas Sekolah</h2>
                <p class="text-gray-400 font-medium text-lg leading-relaxed font-inter">Kami menyediakan fasilitas terbaik yang mendukung kenyamanan dan fokus siswa dalam menuntut ilmu.</p>
            </div>
            <a href="{{ route('facilities') }}" class="text-sm font-bold text-[#0A142F] border-b-2 border-[#0A142F] pb-1 hover:text-blue-600 hover:border-blue-600 transition-all uppercase tracking-widest hidden md:block">Lihat Seluruh Fasilitas &rarr;</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @if($facilities->count() > 0)
                @foreach($facilities as $facility)
                <div class="group relative rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                    <div class="aspect-[3/4] overflow-hidden">
                        <img src="{{ $facility->image ? asset('storage/' . $facility->image) : 'https://images.unsplash.com/photo-1541339907198-e08756ebafe3?q=80&w=2070&auto=format&fit=crop' }}" alt="{{ $facility->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0A142F] via-[#0A142F]/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                    <div class="absolute bottom-10 left-8 right-8 transform group-hover:-translate-y-2 transition-transform duration-500">
                        <div class="mb-4 transform -translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-500">
                            <span class="inline-flex items-center justify-center w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl text-white border border-white/30">
                                {!! $facility->icon ?? '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>' !!}
                            </span>
                        </div>
                        <h3 class="text-2xl font-extrabold text-white mb-2 font-outfit uppercase tracking-tight">{{ $facility->name }}</h3>
                        <p class="text-white/70 text-sm font-inter line-clamp-2">{{ $facility->description ?? 'Fasilitas berstandar nasional untuk menunjang kegiatan belajar mengajar.' }}</p>
                    </div>
                </div>
                @endforeach
            @else
                <!-- Fallback design if no facilities in DB -->
                @php
                    $fallback = [
                        ['name' => 'Lab Komputer', 'img' => 'https://images.unsplash.com/photo-1547082299-de196eaf2e78'],
                        ['name' => 'Perpustakaan', 'img' => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da'],
                        ['name' => 'Gedung Olahraga', 'img' => 'https://images.unsplash.com/photo-1518605368461-1e125222058c']
                    ];
                @endphp
                @foreach($fallback as $item)
                <div class="group relative rounded-3xl overflow-hidden shadow-sm" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                    <div class="aspect-[3/4]">
                        <img src="{{ $item['img'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0A142F] via-[#0A142F]/20 to-transparent"></div>
                    <div class="absolute bottom-10 left-8 right-8">
                        <h3 class="text-2xl font-extrabold text-white mb-2 font-outfit uppercase">{{ $item['name'] }}</h3>
                        <p class="text-white/70 text-sm font-inter">Kenyamanan belajar adalah prioritas kami dalam menyediakan fasilitas.</p>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Berita & Kegiatan Section -->
<section class="py-24 bg-gray-50 border-t border-gray-100 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12" data-aos="fade-up">
            <div>
                 <div class="text-blue-600 font-bold tracking-[0.2em] uppercase text-xs mb-3">Update Terbaru</div>
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#0A142F] font-outfit uppercase">Berita & Kegiatan</h2>
            </div>
            <a href="{{ route('berita.index') }}" class="text-sm font-bold text-[#0A142F] border-b-2 border-[#0A142F] pb-1 hover:text-blue-600 hover:border-blue-600 transition-all uppercase tracking-widest hidden md:block">Lihat Semua Berita &rarr;</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @forelse($recentPosts as $post)
                <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 group flex flex-col hover:shadow-md transition-all" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="h-40 relative overflow-hidden">
                        <img src="{{ $post->image_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-[#0A142F] text-[10px] font-bold px-2 py-1 rounded">{{ Str::upper($post->category ?? 'BERITA') }}</span>
                        <p class="absolute bottom-3 left-3 text-white text-[10px] font-medium opacity-0 group-hover:opacity-100 transition-opacity">{{ $post->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="p-4 flex-1">
                        <a href="{{ route('berita.detail', $post->slug) }}">
                            <h3 class="font-bold text-gray-900 group-hover:text-blue-600 text-sm font-outfit line-clamp-2 transition-colors">{{ $post->title }}</h3>
                        </a>
                    </div>
                </div>
            @empty
                @for($i = 0; $i < 4; $i++)
                <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 group flex flex-col hover:shadow-md transition-all" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="h-40 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1504711331083-9c895941bf81?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-[#0A142F] text-[10px] font-bold px-2 py-1 rounded">BERITA</span>
                        <p class="absolute bottom-3 left-3 text-white text-[10px] font-medium opacity-0 group-hover:opacity-100 transition-opacity">{{ date('d M Y', strtotime('-'.$i.' days')) }}</p>
                    </div>
                    <div class="p-4 flex-1">
                        <h3 class="font-bold text-gray-900 group-hover:text-blue-600 text-sm font-outfit line-clamp-2 transition-colors">Informasi terbaru mengenai kegiatan kurikulum dan kesiswaan di SMKN 1 Katapang.</h3>
                    </div>
                </div>
                @endfor
            @endforelse
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-24 bg-white overflow-hidden" id="testimonials">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="text-blue-600 font-bold tracking-[0.2em] uppercase text-xs mb-3">Apa Kata Mereka?</div>
            <h2 class="text-3xl md:text-5xl font-extrabold text-[#0A142F] mb-4 font-outfit uppercase">Testimoni & Rating</h2>
            <div class="flex items-center justify-center gap-2 mb-4">
                <div class="flex text-yellow-400">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-6 h-6 {{ $i <= round($averageRating) ? 'fill-current' : 'text-gray-300 fill-current' }}" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    @endfor
                </div>
                <span class="text-xl font-bold text-gray-900">{{ number_format($averageRating, 1) }}</span>
                <span class="text-gray-400">({{ $totalTestimoni }} Testimoni)</span>
            </div>
            <p class="text-gray-400 max-w-2xl mx-auto font-inter text-lg">Bagikan pengalaman Anda selama berada di SMKN 1 Katapang.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-20">
            @forelse($testimonis as $testimoni)
            <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 hover:shadow-xl transition-all duration-500" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="flex text-yellow-400 mb-4">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= $testimoni->rating ? 'fill-current' : 'text-gray-200 fill-current' }}" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    @endfor
                </div>
                <p class="text-gray-600 mb-6 italic leading-relaxed font-inter">"{{ $testimoni->pesan }}"</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg">
                        {{ substr($testimoni->nama, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 font-outfit uppercase text-xs tracking-wider">{{ $testimoni->nama }}</h4>
                        <p class="text-gray-400 text-[10px]">{{ $testimoni->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-10 text-center text-gray-400 italic">Belum ada testimoni. Jadilah yang pertama memberikan kesan!</div>
            @endforelse
        </div>

        <!-- Submission Form -->
        <div class="max-w-xl mx-auto bg-[#0A142F] rounded-[2rem] p-8 md:p-10 shadow-2xl relative overflow-hidden" data-aos="zoom-in">
            <!-- Decorative circle -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-600/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-blue-400/20 rounded-full blur-3xl"></div>

            <div class="relative z-10">
                <h3 class="text-lg font-bold text-white mb-1 font-outfit uppercase tracking-wider">Kirim Testimoni Anda</h3>
                <p class="text-gray-400 mb-6 text-[11px]">Masukan Anda sangat berarti bagi perkembangan sekolah kami.</p>

                <form id="testimoni-form" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-white text-[10px] font-bold uppercase tracking-widest mb-1.5 opacity-70">Nama Lengkap</label>
                            <input type="text" name="nama" id="form-nama" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-blue-500 focus:bg-white/10 transition-all outline-none" placeholder="Masukkan nama Anda..." required>
                        </div>
                        
                        <div>
                            <label class="block text-white text-[10px] font-bold uppercase tracking-widest mb-1.5 opacity-70">Rating Bintang</label>
                            <div class="flex gap-1.5" id="star-rating">
                                @for($i = 1; $i <= 5; $i++)
                                <button type="button" data-rating="{{ $i }}" class="star-btn text-gray-600 hover:text-yellow-400 transition-colors">
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </button>
                                @endfor
                                <input type="hidden" name="rating" id="rating-value" value="5">
                            </div>
                        </div>

                        <div>
                            <label class="block text-white text-[10px] font-bold uppercase tracking-widest mb-1.5 opacity-70">Pesan Testimoni</label>
                            <textarea name="pesan" id="form-pesan" rows="3" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-blue-500 focus:bg-white/10 transition-all outline-none" placeholder="Tuliskan pengalaman atau pesan Anda..." required></textarea>
                        </div>

                        <div id="testimoni-feedback" class="hidden rounded-xl p-3 text-[10px] font-bold uppercase tracking-widest text-center"></div>

                        <button type="submit" id="btn-submit-testimoni" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg text-[10px] uppercase tracking-[0.2em]">
                            Kirim Testimoni
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const starBtns = document.querySelectorAll('.star-btn');
        const ratingInput = document.getElementById('rating-value');
        
        // Star Rating Logic
        starBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                ratingInput.value = rating;
                
                // Update stars color
                starBtns.forEach(sb => {
                    const sbRating = sb.getAttribute('data-rating');
                    if (sbRating <= rating) {
                        sb.classList.remove('text-gray-600');
                        sb.classList.add('text-yellow-400');
                    } else {
                        sb.classList.remove('text-yellow-400');
                        sb.classList.add('text-gray-600');
                    }
                });
            });
        });

        // Form Submission Logic
        const testimoniForm = document.getElementById('testimoni-form');
        const submitBtn = document.getElementById('btn-submit-testimoni');
        const feedback = document.getElementById('testimoni-feedback');

        testimoniForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Mengirim...';
            feedback.classList.add('hidden');

            try {
                const response = await fetch('{{ route("testimoni.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    feedback.textContent = data.message;
                    feedback.className = 'rounded-xl p-4 text-xs font-bold uppercase tracking-widest text-center bg-green-500/10 text-green-400 block';
                    
                    testimoniForm.reset();
                    // Reset stars
                    starBtns.forEach(sb => {
                        sb.classList.remove('text-yellow-400');
                        sb.classList.add('text-gray-600');
                    });
                    ratingInput.value = 5;
                    starBtns[4].click();
                } else {
                    feedback.textContent = 'Gagal mengirim testimoni. Silakan coba lagi nanti.';
                    feedback.className = 'rounded-xl p-4 text-xs font-bold uppercase tracking-widest text-center bg-red-500/10 text-red-400 block';
                }
            } catch (error) {
                console.error(error);
                feedback.textContent = 'Terjadi kesalahan koneksi. Silakan coba lagi.';
                feedback.className = 'rounded-xl p-4 text-xs font-bold uppercase tracking-widest text-center bg-red-500/10 text-red-400 block';
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Kirim Testimoni';
                feedback.classList.remove('hidden');
            }
        });
        
        // Trigger initial star state (5 stars)
        starBtns[4].click();
    });
</script>
@endpush
