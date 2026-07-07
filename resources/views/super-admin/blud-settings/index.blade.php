@extends('layouts.dashboard')

@section('title', 'Pengaturan Fitur BLUD')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-slate-900 font-outfit uppercase tracking-tight">Pengaturan Halaman BLUD</h1>
            <p class="mt-2 text-sm text-slate-700">Atur konten untuk halaman BLUD (Badan Layanan Umum Daerah).</p>
        </div>
    </div>

    @if(session('success'))
    <div class="mt-4 p-4 bg-emerald-50 border-l-4 border-emerald-400 text-emerald-700">
        {{ session('success') }}
    </div>
    @endif

    <div class="mt-8">
        <form action="{{ route('super_admin.blud_settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Section 1: Top Content -->
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-slate-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-slate-900 font-outfit uppercase">Bagian Atas (Header)</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-600">Konten judul dan deskripsi utama BLUD.</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                    <div class="sm:col-span-full">
                        <label for="blud_title" class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Judul Halaman</label>
                        <div class="mt-2">
                            <input type="text" name="blud_title" id="blud_title" value="{{ $settings['blud_title'] ?? 'PRA BLUD SMKN 1 KATAPANG' }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="blud_description" class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Deskripsi Utama</label>
                        <div class="mt-2">
                            <textarea id="blud_description" name="blud_description" rows="5" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ $settings['blud_description'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="blud_head_name" class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Nama Tokoh (Kanan Atas)</label>
                        <div class="mt-2">
                            <input type="text" name="blud_head_name" id="blud_head_name" value="{{ $settings['blud_head_name'] ?? 'Insan Yuliardi M, ST' }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Foto Tokoh</label>
                        <div class="mt-2 flex items-center gap-x-3">
                            <div class="h-16 w-16 overflow-hidden rounded-lg bg-slate-100 border">
                                @if(isset($settings['blud_head_photo']))
                                    <img src="{{ asset('storage/' . $settings['blud_head_photo']) }}" alt="" class="h-full w-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full text-slate-300 inline-block">
                                        <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    </div>
                                @endif
                            </div>
                            <input type="file" name="blud_head_photo" class="block w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Bottom Content (Teal Section) -->
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 py-12 md:grid-cols-3 border-b border-slate-900/10 mb-8">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-slate-900 font-outfit uppercase">Bagian Bawah (Berwarna Teal)</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-600">Konten pesan atau kata-kata sambutan di bagian bawah.</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                    <div class="sm:col-span-full">
                        <label for="blud_message_1" class="block text-sm font-medium leading-6 text-slate-900 font-semibold text-emerald-700">Slide Pesan 1 (Awal)</label>
                        <div class="mt-2">
                            <textarea id="blud_message_1" name="blud_message_1" rows="4" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ $settings['blud_message_1'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-full border-t border-slate-100 pt-8">
                        <label for="blud_message_2" class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Slide Pesan 2</label>
                        <div class="mt-2">
                            <textarea id="blud_message_2" name="blud_message_2" rows="4" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ $settings['blud_message_2'] ?? '' }}</textarea>
                        </div>
                        <p class="mt-2 text-xs text-slate-500">Opsional: Biarkan kosong jika hanya ingin menampilkan 1 slide.</p>
                    </div>

                    <div class="sm:col-span-full border-t border-slate-100 pt-8">
                        <label for="blud_message_3" class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Slide Pesan 3</label>
                        <div class="mt-2">
                            <textarea id="blud_message_3" name="blud_message_3" rows="4" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ $settings['blud_message_3'] ?? '' }}</textarea>
                        </div>
                        <p class="mt-2 text-xs text-slate-500">Opsional: Biarkan kosong jika tidak digunakan.</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit" class="rounded-xl bg-blue-600 px-10 py-3 text-sm font-bold text-white shadow-lg shadow-blue-500/20 hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all uppercase tracking-widest">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
