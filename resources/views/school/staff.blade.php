@extends('layouts.landing')

@section('content')
<!-- HERO SECTION -->
<div class="relative h-[450px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0 overflow-hidden">
        <img src="{{ $profile->staff_hero_image ? asset('storage/' . $profile->staff_hero_image) : 'https://images.unsplash.com/photo-1523050335392-1fb0f3403362?q=80&w=2000' }}" class="w-full h-full object-cover brightness-[0.4] animate-soft-zoom" alt="School Building">
        <div class="absolute inset-0 bg-blue-900/30 backdrop-blur-[2px] mix-blend-multiply"></div>
    </div>
    <div class="relative z-10 text-center px-4 max-w-4xl space-y-4">
        <h1 class="text-6xl font-extrabold text-white tracking-tight uppercase">{{ $profile->staff_hero_title ?? 'Guru & Tata Usaha' }}</h1>
        <div class="h-1 w-32 bg-yellow-400 mx-auto rounded-full"></div>
        <p class="text-xl text-slate-200 font-medium max-w-2xl mx-auto uppercase tracking-[0.2em] opacity-80">
            {{ $profile->staff_hero_description ?? 'Dedikasi Untuk Mencetak Generasi Unggul' }}
        </p>
    </div>
</div>

<div class="bg-slate-50 py-24 space-y-32">
    <!-- KEPALA SEKOLAH -->
    <section class="max-w-7xl mx-auto px-6">
        <div class="text-center space-y-4 mb-16">
            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.3em]">Pimpinan Lembaga</span>
            <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Kepala Sekolah</h2>
        </div>
        
        <div class="flex justify-center">
            <div class="group relative bg-white p-4 rounded-[40px] shadow-2xl shadow-slate-200/50 border border-slate-100 max-w-sm transition-transform hover:scale-[1.02] duration-500">
                <div class="relative aspect-[4/5] overflow-hidden rounded-[32px] mb-8">
                    @if($profile && $profile->principal_photo)
                        <img src="{{ asset('storage/' . $profile->principal_photo) }}" alt="Kepala Sekolah" class="w-full h-full object-cover">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($profile->principal_name ?? 'Hendra Hermansah') }}&color=1e3a8a&background=e2e8f0&size=512" alt="Kepala Sekolah" class="w-full h-full object-cover">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
                </div>
                <div class="text-center pb-6">
                    <h3 class="text-2xl font-bold text-slate-900 mb-1">{{ $profile->principal_name ?? 'Hendra Hermansah, S.Pd., M.M' }}</h3>
                    <p class="text-sm font-semibold text-slate-500 uppercase tracking-widest">{{ $profile->principal_title ?? 'Kepala Sekolah' }}</p>
                </div>
                <!-- Mini Logo Decoration -->
                <div class="absolute bottom-10 right-10 h-10 w-10 bg-blue-600 rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                    <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                </div>
            </div>
        </div>
    </section>

    <!-- MANAJEMEN SEKOLAH -->
    <section class="max-w-7xl mx-auto px-6">
        <div class="text-center space-y-4 mb-16">
            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.3em]">Unit Kerja</span>
            <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Manajemen Sekolah</h2>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($management as $item)
            <div class="bg-white p-3 rounded-[32px] shadow-lg shadow-slate-100 border border-slate-50 transition-all hover:shadow-xl hover:-translate-y-1">
                <div class="aspect-[4/4] overflow-hidden rounded-[26px] mb-6 shadow-inner bg-slate-100">
                    @if($item->photo)
                        <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($item->name) }}&color=1e3a8a&background=e2e8f0&size=512" alt="{{ $item->name }}" class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="text-center pb-4 px-2">
                    <h4 class="text-lg font-bold text-slate-900 mb-1 leading-tight">{{ $item->name }}{{ $item->title ? ', ' . $item->title : '' }}</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $item->position ?? 'Staff Manajemen' }}</p>
                </div>
            </div>
            @empty
                <div class="col-span-full py-12 text-center text-slate-400 italic">Data manajemen belum tersedia.</div>
            @endforelse
        </div>
    </section>

    <!-- TEACHERS SECTION -->
    <section class="max-w-7xl mx-auto px-6 space-y-24">
        <div class="space-y-12">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-extrabold text-slate-900">Tenaga Pengajar</h3>
                <div class="h-10 w-10 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                </div>
            </div>

            @forelse($teachers as $subject => $group)
                <div class="space-y-8">
                    <div class="flex items-center gap-4">
                        <div class="h-px flex-1 bg-slate-200"></div>
                        @php
                            $groupName = $subject ?? 'Umum';
                            if (!Str::contains(strtoupper($groupName), ['TOOLMAN', 'PRODUKTIF', 'GURU', 'KEPALA'])) {
                                $groupName = 'Guru ' . $groupName;
                            }
                        @endphp
                        <h4 class="text-sm font-black text-blue-600 uppercase tracking-[0.3em]">{{ $groupName }}</h4>
                        <div class="h-px flex-1 bg-slate-200"></div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                        @foreach($group as $teacher)
                        <div class="bg-white p-3 rounded-[32px] shadow-lg shadow-slate-100 border border-slate-50 transition-all hover:shadow-xl hover:-translate-y-1 flex flex-col h-full">
                            <!-- Photo Container -->
                            <div class="aspect-[4/5] overflow-hidden rounded-[26px] mb-6 shadow-inner bg-slate-100 relative group-hover:scale-[1.02] transition-transform duration-500">
                                @if($teacher->photo)
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100 text-slate-300">
                                        <svg class="w-20 h-20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>
                            
                            <!-- Info Container -->
                            <div class="text-center pb-4 px-2 space-y-2 flex-grow flex flex-col justify-center">
                                <h5 class="text-base font-bold text-slate-900 leading-tight">{{ $teacher->name }}{{ $teacher->title ? ', ' . $teacher->title : '' }}</h5>
                                
                                <div class="space-y-1">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                        @if($teacher->nip) NIP. {{ $teacher->nip }} @endif
                                        @if($teacher->nip && $teacher->rank) • @endif
                                        @if($teacher->rank) GOL. {{ $teacher->rank }} @endif
                                    </p>
                                    <p class="text-[9px] font-black text-blue-600 uppercase tracking-[0.2em] pt-1">
                                        {{ $teacher->position ?? 'Tenaga Pengajar' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="py-12 text-center text-slate-400 italic">Data guru belum tersedia.</div>
            @endforelse
        </div>
    </section>

</div>

@endsection
