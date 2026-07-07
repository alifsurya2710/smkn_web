@extends('layouts.dashboard')

@section('title', 'Tambah Pengumuman Popup')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-3xl">
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">Tambah Pengumuman Popup</h2>
                <p class="mt-1 text-sm text-gray-500 italic">Data yang Anda masukkan di sini akan tampil sebagai jendela popup bagi pengunjung.</p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('super_admin.popup_announcements.index') }}" class="inline-flex items-center px-4 py-2 border border-blue-400 rounded-md shadow-sm text-xs font-black text-blue-600 bg-white hover:bg-gray-50 transition-all uppercase tracking-widest leading-6">
                    Batal
                </a>
            </div>
        </div>

        <form action="{{ route('super_admin.popup_announcements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="bg-white shadow-xl ring-1 ring-slate-900/5 sm:rounded-2xl p-8 space-y-8 border-t-8 border-blue-600">
                <!-- Data Master -->
                <div class="space-y-6">
                    <div class="sm:col-span-full">
                        <label for="title" class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-2 leading-6">Judul Pengumuman (Opsional)</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="block w-full border-0 border-b-2 border-slate-200 py-3 text-slate-900 focus:ring-0 focus:border-blue-600 font-bold placeholder:text-slate-300 transition-all sm:text-sm sm:leading-6" placeholder="Contoh: Libur Sekolah Menjelang Puasa">
                        @error('title') <p class="mt-2 text-xs text-red-600 font-bold italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-full">
                        <label for="image" class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-4 leading-6">Gambar Poster / Kabar Berita (Wajib)</label>
                        <div class="p-6 bg-blue-50/50 rounded-2xl border-2 border-dashed border-blue-200">
                           <div class="flex flex-col items-center justify-center space-y-4">
                                <svg class="h-12 w-12 text-blue-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-black text-blue-600 hover:text-blue-500 focus-within:outline-none transition-all uppercase text-[10px] tracking-widest px-4 py-2 border-2 border-blue-100 italic">
                                        <span>Pilih File Gambar</span>
                                        <input id="image" name="image" type="file" class="sr-only">
                                    </label>
                                </div>
                                <p class="text-[10px] font-bold text-slate-400 italic uppercase">Format PNG, JPG, GIF up to 5MB</p>
                           </div>
                        </div>
                        @error('image') <p class="mt-2 text-xs text-red-600 font-bold italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-full">
                        <label for="link" class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-2 leading-6">Tautan Link Klik (Opsional)</label>
                        <input type="url" name="link" id="link" value="{{ old('link') }}" class="block w-full border-0 border-b-2 border-slate-200 py-3 text-slate-900 focus:ring-0 focus:border-blue-600 font-bold placeholder:text-slate-300 transition-all sm:text-sm sm:leading-6" placeholder="https://website.com/link-info">
                        <p class="mt-2 text-[10px] text-slate-400 font-bold italic">Jika diisi, pengunjung bisa klik poster untuk info lebih lanjut.</p>
                        @error('link') <p class="mt-2 text-xs text-red-600 font-bold italic">{{ $message }}</p> @enderror
                    </div>
                </div>

                <hr class="border-slate-100">

                <!-- Periode dan Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="sm:col-span-1">
                        <label for="start_date" class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-2 leading-6">Mulai Muncul (Tanggal)</label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', now()->toDateString()) }}" class="block w-full border-0 border-b-2 border-slate-200 py-3 text-slate-900 focus:ring-0 focus:border-blue-600 font-bold transition-all sm:text-sm sm:leading-6">
                        @error('start_date') <p class="mt-2 text-xs text-red-600 font-bold italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <label for="end_date" class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-2 leading-6">Berhenti Muncul (Tanggal Akhir)</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', now()->addDays(7)->toDateString()) }}" class="block w-full border-0 border-b-2 border-slate-200 py-3 text-slate-900 focus:ring-0 focus:border-blue-600 font-bold transition-all sm:text-sm sm:leading-6">
                        @error('end_date') <p class="mt-2 text-xs text-red-600 font-bold italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="flex items-center space-x-3 cursor-pointer p-4 rounded-xl border-2 border-slate-50 hover:bg-slate-50 transition-all">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600 focus:ring-blue-600 h-5 w-5">
                            <div class="flex flex-col">
                                <span class="text-sm font-black text-slate-900 uppercase tracking-widest">Status Aktif</span>
                                <span class="text-[11px] text-slate-400 italic">Unceklis untuk menyimpan status sebagai draf.</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="inline-flex items-center px-12 py-4 border border-transparent rounded-xl shadow-2xl text-xs font-black text-white bg-blue-600 hover:bg-blue-700 focus:outline-none transition-all uppercase tracking-[0.2em]">
                        Simpan Pengumuman
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
