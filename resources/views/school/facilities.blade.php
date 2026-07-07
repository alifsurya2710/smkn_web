@extends('layouts.landing')

@section('title', 'Fasilitas Sekolah')

@section('content')
<div class="bg-white min-h-screen pb-24">
    <!-- Header Section -->
    <section class="pt-32 pb-16 text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-center gap-2 mb-4" data-aos="fade-down">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-gray-500 font-outfit">FASILITAS</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-extrabold text-[#0A142F] mb-6 font-outfit" data-aos="fade-up">Fasilitas Kami</h1>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg leading-relaxed" data-aos="fade-up" data-aos-delay="100">
             fasilitas-fasilitas yang ada di SMK Negeri 1 KATAPANG yang menunjang kegiatan belajar mengajar siswa.
            </p>
        </div>
    </section>

    <!-- Facilities Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($facilities->isEmpty())
            <div class="bg-gray-50 rounded-[2rem] p-16 text-center border border-dashed border-gray-200" data-aos="zoom-in">
                <h3 class="text-2xl font-bold text-gray-400">Belum Ada Fasilitas Yang Ditampilkan</h3>
                <p class="text-gray-400 mt-2">Data sedang diperbarui oleh sistem.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($facilities as $index => $facility)
                    <div class="group bg-white rounded-[2rem] p-4 border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="relative aspect-[4/3] rounded-[1.5rem] overflow-hidden mb-6">
                            @if($facility->image)
                                <img src="{{ asset('storage/' . $facility->image) }}" alt="{{ $facility->name }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-[#3d837c] flex items-center justify-center">
                                    <span class="text-white/20 font-bold text-xl uppercase tracking-widest text-center px-6">{{ $facility->name }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="px-2 pb-2">
                            <h3 class="text-2xl font-bold text-[#0A142F] mb-6 font-outfit group-hover:text-[#3d837c] transition-colors">{{ $facility->name }}</h3>
                            
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Load More Placeholder -->
            <div class="mt-20 flex justify-center" data-aos="fade-up">
                <button class="px-10 py-4 border-2 border-black text-black font-bold rounded-xl text-sm hover:bg-black hover:text-white transition-all duration-300">
                    Muat Lebih Banyak
                </button>
            </div>
        @endif
    </div>
</div>
@endsection
