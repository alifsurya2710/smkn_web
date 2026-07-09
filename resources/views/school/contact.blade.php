@extends('layouts.landing')

@section('title', 'Hubungi Kami')

@section('content')
<div class="bg-gray-50 pb-20 -mt-20"> <!-- Negative margin to counteract the layout padding for the map, or we can just keep normal layout -->
    
    <!-- Hero Section -->
    <section class="relative bg-blue-900 text-white pt-40 pb-32 overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
             <img src="{{ asset('images/school-building.jpg') }}" alt="SMKN 1 Katapang Building" class="w-full h-full object-cover opacity-40">
             <div class="absolute inset-0 bg-blue-900/60 blend-multiply"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 text-white drop-shadow-md">
                Hubungi Kami
            </h1>
            <div class="flex items-center justify-center gap-2 text-sm text-blue-100 font-medium">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                <span>&raquo;</span>
                <span>Hubungi Kami</span>
            </div>
        </div>
    </section>

    <!-- Contact Cards (Overlapping) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 -mt-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Instagram -->
            <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transform transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="w-12 h-12 bg-gray-50 border border-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Instagram</h3>
                <a href="https://www.instagram.com/smkn1katapang" target="_blank" class="text-sm text-gray-500 hover:text-blue-600 transition-colors">@smkn1katapang</a>
            </div>

            <!-- Call Us -->
            <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transform transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="w-12 h-12 bg-gray-50 border border-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Telepon Kami</h3>
                <a href="tel:+62225893737" class="text-sm text-gray-500 hover:text-blue-600 transition-colors">+62 22 5893737</a>
            </div>

            <!-- Whatsapp -->
            <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transform transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="w-12 h-12 bg-gray-50 border border-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Whatsapp</h3>
                <a href="https://wa.me/62225893737" class="text-sm text-gray-500 hover:text-blue-600 transition-colors">+62 22 5893737</a>
            </div>

            <!-- Email Us -->
            <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center text-center transform transition duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="w-12 h-12 bg-gray-50 border border-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-900 mb-1">Email Kami</h3>
                <a href="mailto:smkn1katapang@gmail.com" class="text-sm text-gray-500 hover:text-blue-600 transition-colors">smkn1katapang@gmail.com</a>
            </div>

        </div>
    </div>

    <!-- Map Section -->
    <div class="mt-16 w-full h-[600px] bg-gray-200">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15840.457816086884!2d107.54519502949779!3d-6.994792617300326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ee61e05d2ba7%3A0x67db233959b8eb23!2sSMK%20Negeri%201%20Katapang!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>
@endsection
