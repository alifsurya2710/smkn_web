@extends('layouts.landing')

@section('title', $settings['tefa_title'] ?? 'Teaching Factory (TEFA)')

@section('content')
<div class="bg-white min-h-screen pt-0 pb-20 overflow-hidden">
    
    <!-- Hero Banner Section (Full Width, Large) -->
    <section class="relative h-[65vh] min-h-[500px] w-full bg-[#0A142F] flex items-center justify-center overflow-hidden" data-aos="fade" data-aos-duration="1000">
        @if(isset($settings['tefa_hero_image']))
            <img src="{{ asset('storage/' . $settings['tefa_hero_image']) }}" alt="TEFA Hero" class="absolute inset-0 w-full h-full object-cover">
        @endif
        
        <!-- Cinematic Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-[#0A142F]/80"></div>
        <div class="absolute inset-0 backdrop-blur-[1px] bg-black/10"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 text-center" data-aos="zoom-out" data-aos-duration="1200">
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/logo.png') }}" class="h-20 md:h-32 mb-8 drop-shadow-[0_10px_10px_rgba(0,0,0,0.5)]" alt="Logo">
                <div class="space-y-2">
                    <h2 class="text-4xl md:text-8xl font-black text-[#FFD700] uppercase tracking-tighter leading-none drop-shadow-2xl font-outfit">
                        {{ $settings['tefa_hero_title'] ?? 'TEACHING FACTORY' }}
                    </h2>
                    <p class="text-xl md:text-3xl font-bold text-white uppercase tracking-[0.4em] drop-shadow-lg font-inner">
                        {{ $settings['tefa_hero_subtitle'] ?? 'SMKN 1 KATAPANG' }}
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Bottom Decorative Line -->
        <div class="absolute bottom-0 left-0 w-full h-[6px] bg-gradient-to-r from-blue-500 via-[#FFD700] to-blue-500"></div>
    </section>

    <!-- Description Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">
        <div class="bg-white rounded-[2rem] shadow-xl p-8 md:p-16 border border-slate-50" data-aos="fade-up" data-aos-offset="100" data-aos-duration="800" data-aos-delay="200">
            <h2 class="text-2xl md:text-4xl font-extrabold text-[#7C3AED] mb-8 font-outfit uppercase tracking-tight">
                {{ $settings['tefa_title'] ?? 'TEACHING FACTORY SMKN 1 KATAPANG' }}
            </h2>
            
            <div class="text-slate-600 text-base md:text-xl leading-relaxed font-inter text-justify space-y-6">
                @if(isset($settings['tefa_description']))
                    {!! nl2br(e($settings['tefa_description'])) !!}
                @else
                    <p>Teaching Factory (TEFA) merupakan gabungan konsep pembelajaran di sekolah yang berorientasi pada produksi bisnis...</p>
                @endif
            </div>
        </div>

        <!-- Manfaat Section -->
        <div class="mt-24">
            <div class="mb-12 border-l-8 border-[#39C5BB] pl-6" data-aos="fade-right" data-aos-duration="800">
                <h2 class="text-3xl md:text-5xl font-black text-[#0A142F] font-outfit uppercase tracking-tighter">
                    Manfaat <span class="text-[#39C5BB]">Teaching Factory</span>
                </h2>
                <p class="text-slate-400 font-medium mt-2">Implementasi keunggulan dalam pendidikan vokasi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @for($i = 1; $i <= 6; $i++)
                    @php
                        $benefit_title = $settings['tefa_benefit_'.$i.'_title'] ?? null;
                        $benefit_desc = $settings['tefa_benefit_'.$i.'_description'] ?? null;
                    @endphp
                    @if($benefit_title)
                    <div class="bg-white p-10 rounded-[2rem] border border-slate-100 shadow-sm relative overflow-hidden group hover:-translate-y-2 transition-all duration-500 flex flex-col justify-center min-h-[280px]" 
                         data-aos="fade-up" 
                         data-aos-duration="600" 
                         data-aos-delay="{{ 50 + ($i * 50) }}">
                        <!-- Geometric Background Overlay -->
                        <div class="absolute top-0 right-0 -mr-8 -mt-8 w-24 h-24 bg-slate-50 rotate-45 group-hover:bg-teal-50 transition-colors"></div>
                        <div class="absolute bottom-0 left-0 -ml-4 -mb-4 w-12 h-12 border-2 border-slate-100 rounded-full"></div>
                        
                        <div class="relative z-10">
                            <h3 class="text-2xl font-black text-[#0A142F] mb-4 font-outfit uppercase leading-tight">{{ $benefit_title }}</h3>
                            <p class="text-slate-500 text-sm md:text-base leading-relaxed text-center md:text-justify font-inter underline-offset-4">
                                {{ $benefit_desc }}
                            </p>
                        </div>
                    </div>
                    @endif
                @endfor
            </div>
        </div>

        <!-- Alur Pembelajaran Section -->
        <div class="mt-32">
            <div class="max-w-4xl mx-auto text-center mb-16" data-aos="fade-up" data-aos-duration="800">
                <h2 class="text-3xl md:text-5xl font-black text-blue-600 font-outfit uppercase tracking-tighter mb-4">Langkah-Langkah Pembelajaran</h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full"></div>
            </div>

            <div class="space-y-6 max-w-5xl mx-auto">
                @for($i = 1; $i <= 6; $i++)
                    @php
                        $step_title = $settings['tefa_step_'.$i.'_title'] ?? null;
                        $step_desc = $settings['tefa_step_'.$i.'_description'] ?? null;
                    @endphp
                    @if($step_title)
                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-all flex flex-col md:flex-row gap-6 items-start" 
                         data-aos="fade-up" 
                         data-aos-duration="600" 
                         data-aos-delay="{{ $i * 100 }}">
                        <div class="bg-blue-600 text-white w-12 h-12 rounded-2xl flex items-center justify-center text-xl font-black shrink-0 shadow-lg shadow-blue-500/30">
                            {{ $i }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2 font-outfit uppercase tracking-tight">{{ $step_title }}</h3>
                            <p class="text-slate-600 leading-relaxed font-inter text-justify">
                                {{ $step_desc }}
                            </p>
                        </div>
                    </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>

    <!-- Message Slider (Still included for extra content if managed) -->
    @php
        $messages = [];
        if(isset($settings['tefa_message_1']) && $settings['tefa_message_1']) $messages[] = $settings['tefa_message_1'];
        if(isset($settings['tefa_message_2']) && $settings['tefa_message_2']) $messages[] = $settings['tefa_message_2'];
        if(isset($settings['tefa_message_3']) && $settings['tefa_message_3']) $messages[] = $settings['tefa_message_3'];
    @endphp

    @if(!empty($messages))
    <section class="mt-20 py-24 bg-slate-50 overflow-hidden" 
             x-data="{ 
                active: 0, 
                slides: {{ json_encode($messages) }},
                next() { this.active = (this.active + 1) % this.slides.length },
                prev() { this.active = (this.active - 1 + this.slides.length) % this.slides.length }
             }"
             data-aos="fade-up" 
             data-aos-duration="1000">
        
        <div class="max-w-5xl mx-auto px-4">
             <div class="text-center mb-12">
                <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest border-b-2 border-blue-600 pb-1">Testimoni & Pesan</span>
             </div>
            <div class="relative min-h-[200px] flex items-center">
                <template x-for="(msg, index) in slides" :key="index">
                    <div x-show="active === index" 
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         class="w-full text-center italic text-slate-500 font-medium text-lg md:text-2xl leading-relaxed px-12">
                        "<span x-text="msg"></span>"
                    </div>
                </template>

                <template x-if="slides.length > 1">
                    <div class="absolute inset-x-0 flex justify-between items-center">
                        <button @click="prev()" class="p-2 text-slate-300 hover:text-blue-600 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button @click="next()" class="p-2 text-slate-300 hover:text-blue-600 transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7-7"></path></svg>
                        </button>
                    </div>
                </template>
            </div>
        </div>
    </section>
    @endif
</div>
@endsection
