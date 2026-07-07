@extends('layouts.landing')

@section('title', 'Informasi PPDB')

@section('content')
<!-- Hero Section -->
<div class="relative h-[40vh] min-h-[300px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0 overflow-hidden">
        @if(isset($settings['ppdb_hero_image']))
            <img src="{{ asset('storage/' . $settings['ppdb_hero_image']) }}" class="w-full h-full object-cover animate-soft-zoom" alt="PPDB Hero">
        @else
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover animate-soft-zoom" alt="PPDB Hero">
        @endif
        <div class="absolute inset-0 bg-[#0A142F]/80 backdrop-blur-[2px] mix-blend-multiply"></div>
    </div>
    
    <div class="relative z-10 text-center px-4" data-aos="zoom-in">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 font-outfit uppercase tracking-tight">Informasi PPDB</h1>
        <nav class="flex justify-center space-x-2 text-gray-300 text-sm font-medium uppercase tracking-widest font-inter">
            <a href="{{ route('home') }}" class="hover:text-white transition">HOME</a>
            <span>&raquo;</span>
            <span class="text-white">PPDB</span>
        </nav>
    </div>
</div>

<!-- Intro Section -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
        <div class="flex items-center justify-center space-x-2 text-gray-500 mb-4">
            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
            <span class="text-xs font-bold uppercase tracking-[0.3em]">SPMB / PPDB 2025</span>
        </div>
        <h2 class="text-3xl md:text-5xl font-extrabold text-[#0A142F] mb-8 font-outfit uppercase">Seleksi Penerimaan Murid Baru</h2>
        <div class="text-gray-500 leading-relaxed text-lg font-inter space-y-6">
            <p>SMK Negeri 1 Katapang berkomitmen untuk menyelenggarakan proses penerimaan murid baru yang transparan, akuntabel, dan bebas dari gratifikasi. Seluruh data yang dikumpulkan dalam sistem SPMB Dinas Pendidikan Provinsi Jawa Barat 2025 hanya akan digunakan untuk keperluan seleksi akademik dan administrasi sesuai ketentuan yang berlaku.</p>
            <p>Pastikan Anda membaca seluruh syarat dan jadwal yang telah ditetapkan agar tidak terjadi kesalahan dalam proses pendaftaran.</p>
        </div>
    </div>
</section>

<!-- Infographic Grid -->
<section class="py-20 bg-gray-50 border-t border-gray-100" x-data="{ showModal: false, activeImage: '' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1: Jadwal -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group" data-aos="fade-up">
                <div class="p-2">
                    <div class="aspect-[3/4] rounded-2xl overflow-hidden relative" @click="activeImage = '{{ isset($settings['ppdb_jadwal_image']) ? asset('storage/' . $settings['ppdb_jadwal_image']) : 'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?q=80&w=2068&auto=format&fit=crop' }}'; showModal = true" class="cursor-pointer">
                        <!-- Use placeholder or user-provided image if available -->
                        @if(isset($settings['ppdb_jadwal_image']))
                            <img src="{{ asset('storage/' . $settings['ppdb_jadwal_image']) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 cursor-pointer">
                        @else
                            <img src="https://images.unsplash.com/photo-1506784983877-45594efa4cbe?q=80&w=2068&auto=format&fit=crop" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 cursor-pointer">
                        @endif
                        <div class="absolute inset-0 bg-blue-600/10 group-hover:bg-transparent transition-colors pointer-events-none"></div>
                        <div class="absolute inset-0 flex items-center justify-center p-8 bg-[#0A142F]/60 backdrop-blur-[2px] opacity-100 group-hover:opacity-0 transition-opacity duration-500 pointer-events-none">
                             <div class="text-center">
                                 <div class="bg-white/20 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 border border-white/30">
                                     <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 00-2 2z"></path></svg>
                                 </div>
                                 <h3 class="text-white text-xl font-bold uppercase tracking-widest font-outfit">Jadwal PPDB</h3>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 text-center">
                    <p class="text-gray-400 text-sm font-bold uppercase tracking-widest mb-2 font-inter">Tahapan Seleksi</p>
                    <a href="#" @click.prevent="activeImage = '{{ isset($settings['ppdb_jadwal_image']) ? asset('storage/' . $settings['ppdb_jadwal_image']) : 'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?q=80&w=2068&auto=format&fit=crop' }}'; showModal = true" class="text-[#0A142F] font-bold text-sm border-b-2 border-transparent hover:border-blue-600 hover:text-blue-600 transition-all uppercase tracking-widest inline-block pb-1">Detail Jadwal &rarr;</a>
                </div>
            </div>

            <!-- Card 2: Pendaftaran -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group" data-aos="fade-up" data-aos-delay="200">
                <div class="p-2">
                    <div class="aspect-[3/4] rounded-2xl overflow-hidden relative" @click="activeImage = '{{ isset($settings['ppdb_alur_image']) ? asset('storage/' . $settings['ppdb_alur_image']) : 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=2070&auto=format&fit=crop' }}'; showModal = true" class="cursor-pointer">
                        @if(isset($settings['ppdb_alur_image']))
                            <img src="{{ asset('storage/' . $settings['ppdb_alur_image']) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 cursor-pointer">
                        @else
                            <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 cursor-pointer">
                        @endif
                        <div class="absolute inset-0 bg-blue-600/10 group-hover:bg-transparent transition-colors pointer-events-none"></div>
                        <div class="absolute inset-0 flex items-center justify-center p-8 bg-[#0A142F]/60 backdrop-blur-[2px] opacity-100 group-hover:opacity-0 transition-opacity duration-500 pointer-events-none">
                             <div class="text-center">
                                 <div class="bg-white/20 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 border border-white/30">
                                     <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                 </div>
                                 <h3 class="text-white text-xl font-bold uppercase tracking-widest font-outfit">Alur Daftar</h3>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 text-center">
                    <p class="text-gray-400 text-sm font-bold uppercase tracking-widest mb-2 font-inter">Prosedur Online</p>
                    <a href="#" @click.prevent="activeImage = '{{ isset($settings['ppdb_alur_image']) ? asset('storage/' . $settings['ppdb_alur_image']) : 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=2070&auto=format&fit=crop' }}'; showModal = true" class="text-[#0A142F] font-bold text-sm border-b-2 border-transparent hover:border-blue-600 hover:text-blue-600 transition-all uppercase tracking-widest inline-block pb-1">Lihat Panduan &rarr;</a>
                </div>
            </div>

            <!-- Card 3: Kuota -->
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 group" data-aos="fade-up" data-aos-delay="400">
                <div class="p-2">
                    <div class="aspect-[3/4] rounded-2xl overflow-hidden relative" @click="activeImage = '{{ isset($settings['ppdb_kuota_image']) ? asset('storage/' . $settings['ppdb_kuota_image']) : 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop' }}'; showModal = true" class="cursor-pointer">
                        @if(isset($settings['ppdb_kuota_image']))
                            <img src="{{ asset('storage/' . $settings['ppdb_kuota_image']) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 cursor-pointer">
                        @else
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 cursor-pointer">
                        @endif
                        <div class="absolute inset-0 bg-blue-600/10 group-hover:bg-transparent transition-colors pointer-events-none"></div>
                        <div class="absolute inset-0 flex items-center justify-center p-8 bg-[#0A142F]/60 backdrop-blur-[2px] opacity-100 group-hover:opacity-0 transition-opacity duration-500 pointer-events-none">
                             <div class="text-center">
                                 <div class="bg-white/20 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 border border-white/30">
                                     <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                 </div>
                                 <h3 class="text-white text-xl font-bold uppercase tracking-widest font-outfit">Kuota & Jalur</h3>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 text-center">
                    <p class="text-gray-400 text-sm font-bold uppercase tracking-widest mb-2 font-inter">Informasi Jalur</p>
                    <a href="#" @click.prevent="activeImage = '{{ isset($settings['ppdb_kuota_image']) ? asset('storage/' . $settings['ppdb_kuota_image']) : 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop' }}'; showModal = true" class="text-[#0A142F] font-bold text-sm border-b-2 border-transparent hover:border-blue-600 hover:text-blue-600 transition-all uppercase tracking-widest inline-block pb-1">Detail Kuota &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine Modal Viewer -->
    <div x-show="showModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-[#0A142F]/90 backdrop-blur-md" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
         
        <div class="relative w-full max-w-5xl max-h-[90vh] flex flex-col items-center justify-center p-4" @click.away="showModal = false">
            <button @click="showModal = false" class="absolute -top-12 right-0 text-white hover:text-red-400 transition-colors bg-white/10 rounded-full p-2" title="Tutup">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="bg-white p-2 rounded-xl shadow-2xl relative w-full h-full flex justify-center items-center overflow-hidden">
                <img :src="activeImage" class="max-w-full max-h-[85vh] object-contain rounded-lg">
            </div>
        </div>
    </div>
</section>



@endsection
