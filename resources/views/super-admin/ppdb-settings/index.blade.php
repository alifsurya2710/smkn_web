@extends('layouts.dashboard')

@section('title', 'Manajemen Foto SPMB')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-2xl font-semibold leading-6 text-slate-900">Manajemen Foto SPMB</h1>
        <p class="mt-2 text-sm text-slate-700">Pilih foto terbaru untuk diperbarui pada halaman publik SPMB sekolah.</p>
    </div>
</div>

@if(session('success'))
    <div class="mt-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

<form action="{{ route('super_admin.ppdb_settings.update') }}" method="POST" enctype="multipart/form-data" class="mt-8">
    @csrf

    <div class="space-y-12">
        <div class="border-b border-slate-900/10 pb-12">
            
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 py-8 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-slate-900 font-outfit uppercase text-blue-600">Foto Utama (Hero)</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-600">Gambar besar yang pertama kali dilihat saat membuka halaman SPMB. Direkomendasikan resolusi HD (landscape).</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                    <div class="sm:col-span-full">
                        <label class="block text-sm font-medium leading-6 text-slate-900">Foto Pilihan</label>
                        <div class="mt-2 flex items-center gap-x-6">
                            @if(isset($settings['ppdb_hero_image']) && $settings['ppdb_hero_image'])
                                <img src="{{ asset('storage/' . $settings['ppdb_hero_image']) }}" alt="Hero Image" class="h-32 w-48 object-cover rounded-md shadow-sm border border-slate-200">
                            @else
                                <div class="h-32 w-48 rounded-md bg-slate-50 flex items-center justify-center border-2 border-dashed border-slate-300">
                                    <span class="text-xs text-slate-400">Belum ada foto</span>
                                </div>
                            @endif
                            <div>
                                <input type="file" name="ppdb_hero_image" id="ppdb_hero_image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer border border-slate-200 rounded-md">
                                <p class="mt-1 text-xs text-slate-500">Maks. 5MB. Format: JPG, PNG.</p>
                                @error('ppdb_hero_image') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-10 py-12 border-t border-slate-900/10 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-slate-900 font-outfit uppercase text-blue-600">Foto Info Pendaftaran (Grid Bawah)</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-600">Tiga buah foto yang tampil pada bagian Kartu Informasi Jadwal, Kartu Alur, dan Kartu Kuota SPMB. Gambar potret direkomendasikan.</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                    
                    <!-- Jadwal Photo -->
                    <div class="sm:col-span-full">
                        <label class="block text-sm font-medium leading-6 text-slate-900 line-through-off">Foto Kartu Jadwal</label>
                        <div class="mt-2 flex items-center gap-x-6">
                            @if(isset($settings['ppdb_jadwal_image']) && $settings['ppdb_jadwal_image'])
                                <img src="{{ asset('storage/' . $settings['ppdb_jadwal_image']) }}" alt="Jadwal" class="h-40 w-28 object-cover rounded-lg shadow-sm border border-slate-200">
                            @else
                                <div class="h-40 w-28 rounded-lg bg-slate-50 flex items-center justify-center border-2 border-dashed border-slate-300">
                                    <span class="text-[10px] text-slate-400">Tanpa Foto</span>
                                </div>
                            @endif
                            <div>
                                <input type="file" name="ppdb_jadwal_image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer border border-slate-200 rounded-md">
                                <p class="mt-1 text-xs text-slate-500">Potret ideal, maks. 5MB.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Alur Photo -->
                    <div class="sm:col-span-full border-t border-slate-100 pt-6">
                        <label class="block text-sm font-medium leading-6 text-slate-900">Foto Kartu Alur</label>
                        <div class="mt-2 flex items-center gap-x-6">
                            @if(isset($settings['ppdb_alur_image']) && $settings['ppdb_alur_image'])
                                <img src="{{ asset('storage/' . $settings['ppdb_alur_image']) }}" alt="Alur" class="h-40 w-28 object-cover rounded-lg shadow-sm border border-slate-200">
                            @else
                                <div class="h-40 w-28 rounded-lg bg-slate-50 flex items-center justify-center border-2 border-dashed border-slate-300">
                                    <span class="text-[10px] text-slate-400">Tanpa Foto</span>
                                </div>
                            @endif
                            <div>
                                <input type="file" name="ppdb_alur_image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer border border-slate-200 rounded-md">
                                <p class="mt-1 text-xs text-slate-500">Potret ideal, maks. 5MB.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kuota Photo -->
                    <div class="sm:col-span-full border-t border-slate-100 pt-6">
                        <label class="block text-sm font-medium leading-6 text-slate-900">Foto Kartu Kuota</label>
                        <div class="mt-2 flex items-center gap-x-6">
                            @if(isset($settings['ppdb_kuota_image']) && $settings['ppdb_kuota_image'])
                                <img src="{{ asset('storage/' . $settings['ppdb_kuota_image']) }}" alt="Kuota" class="h-40 w-28 object-cover rounded-lg shadow-sm border border-slate-200">
                            @else
                                <div class="h-40 w-28 rounded-lg bg-slate-50 flex items-center justify-center border-2 border-dashed border-slate-300">
                                    <span class="text-[10px] text-slate-400">Tanpa Foto</span>
                                </div>
                            @endif
                            <div>
                                <input type="file" name="ppdb_kuota_image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer border border-slate-200 rounded-md">
                                <p class="mt-1 text-xs text-slate-500">Potret ideal, maks. 5MB.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6 pb-20">
        <button type="submit" class="rounded-md bg-blue-600 px-8 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all font-outfit uppercase tracking-widest">
            Simpan Perubahan
        </button>
    </div>
</form>
@endsection
