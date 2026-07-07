@extends('layouts.landing')

@section('title', $settings['blud_title'] ?? 'PRA BLUD SMKN 1 KATAPANG')

@section('content')
<div class="bg-white min-h-screen pt-32 pb-0 overflow-hidden">
    <!-- Top Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20 relative">
        <!-- Profile Photo (Centered) -->
        <div class="flex justify-center mb-10" data-aos="zoom-in">
            <div class="text-center group">
                <div class="w-32 h-44 md:w-40 md:h-56 rounded-2xl overflow-hidden border-4 border-white shadow-2xl mb-4 transform group-hover:scale-105 transition-transform duration-500">
                    @if(isset($settings['blud_head_photo']))
                        <img src="{{ asset('storage/' . $settings['blud_head_photo']) }}" alt="Head of BLUD" class="w-full h-full object-cover">
                    @else
                        <img src="https://via.placeholder.com/300x400?text=Foto" alt="Head of BLUD" class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="inline-block px-4 py-2 bg-slate-900 rounded-xl shadow-lg">
                    <p class="text-[11px] md:text-sm font-bold text-white font-outfit uppercase tracking-widest">{{ $settings['blud_head_name'] ?? 'Insan Yuliardi M, ST' }}</p>
                </div>
            </div>
        </div>

        <!-- Title & Main Description -->
        <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
            <h1 class="text-3xl md:text-6xl font-black text-[#0A142F] mb-10 font-outfit uppercase tracking-tighter">
                {{ $settings['blud_title'] ?? 'PRA BLUD SMKN 1 KATAPANG' }}
            </h1>
            
            <div class="text-slate-600 text-sm md:text-lg leading-relaxed font-inter text-center md:text-justify max-w-4xl mx-auto">
                @if(isset($settings['blud_description']))
                    {!! nl2br(e($settings['blud_description'])) !!}
                @else
                    <p>BLUD (Badan Layanan Umum Daerah) SMKN 1 Katapang merupakan sebuah inovasi di bidang pendidikan yang memungkinkan sekolah untuk lebih mandiri dan fleksibel dalam mengelola sumber daya keuangan...</p>
                @endif
            </div>

            <!-- Divider -->
            <div class="mt-20 w-32 h-[1px] bg-slate-200 mx-auto"></div>
        </div>
    </div>

    <!-- Bottom Section (Teal Slider) -->
    @php
        $messages = [];
        if(isset($settings['blud_message_1']) && $settings['blud_message_1']) $messages[] = $settings['blud_message_1'];
        if(isset($settings['blud_message_2']) && $settings['blud_message_2']) $messages[] = $settings['blud_message_2'];
        if(isset($settings['blud_message_3']) && $settings['blud_message_3']) $messages[] = $settings['blud_message_3'];

        // Fallback for demo
        if(empty($messages)) {
            $messages[] = "Assalamu'alaikum warahmatullahi wabarakatuh,\n\nPerkenalkan, saya Andri Lesmana, S.Pd., Kepala Program Keahlian Teknik Kendaraan Ringan di SMKN 1 Katapang. Dengan semangat untuk mencetak generasi yang unggul, kami fokus pada pengembangan keterampilan teknis dan profesional siswa melalui pembelajaran berbasis praktik dan kolaborasi dengan industri. Kami berkomitmen untuk melahirkan lulusan yang kompeten dan siap bersaing di dunia otomotif. Terima kasih atas dukungan dan kepercayaan dari semua pihak dalam mendukung pendidikan di SMKN 1 Katapang.\n\nWassalamu'alaikum warahmatullahi wabarakatuh.";
        }
    @endphp

    <section class="bg-[#69ffc3] py-24 min-h-[500px] flex items-center relative overflow-hidden" 
             x-data="{ 
                active: 0, 
                slides: {{ json_encode($messages) }},
                next() { this.active = (this.active + 1) % this.slides.length },
                prev() { this.active = (this.active - 1 + this.slides.length) % this.slides.length }
             }">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
            <div class="relative min-h-[300px] flex items-center">
                <template x-for="(msg, index) in slides" :key="index">
                    <div x-show="active === index" 
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 transform translate-x-12"
                         x-transition:enter-end="opacity-100 transform translate-x-0"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 transform translate-x-0"
                         x-transition:leave-end="opacity-0 transform -translate-x-12"
                         class="w-full">
                        <div class="md:col-start-3 md:col-span-8 mx-auto max-w-4xl">
                            <div class="text-slate-900 text-base md:text-xl font-medium leading-relaxed font-inter whitespace-pre-line text-center md:text-left italic">
                                "<span x-text="msg"></span>"
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Navigation Arrows -->
                <template x-if="slides.length > 1">
                    <div class="absolute inset-x-0 flex justify-between items-center -mx-4 md:-mx-12">
                        <button @click="prev()" class="p-3 rounded-full bg-white/20 hover:bg-white/40 transition-all text-slate-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button @click="next()" class="p-3 rounded-full bg-white/20 hover:bg-white/40 transition-all text-slate-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7-7"></path></svg>
                        </button>
                    </div>
                </template>
            </div>

            <!-- Carousel Dots -->
            <template x-if="slides.length > 1">
                <div class="mt-16 flex justify-center gap-3">
                    <template x-for="(s, i) in slides.length">
                        <button @click="active = i" 
                                class="h-2 transition-all duration-300 rounded-full"
                                :class="active === i ? 'w-10 bg-slate-900' : 'w-2 bg-slate-900/20'"></button>
                    </template>
                </div>
            </template>
        </div>

        <!-- Decorative background text -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-[20vw] font-black text-black/5 pointer-events-none select-none uppercase font-outfit">
            BLUD
        </div>
    </section>
</div>
@endsection
