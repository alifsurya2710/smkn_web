@extends('layouts.dashboard')

@section('title', 'Manajemen Bidang Kerja')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-2xl font-semibold leading-6 text-slate-900">Bidang Kerja Sekolah</h1>
        <p class="mt-2 text-sm text-slate-700">Kelola informasi dan foto untuk halaman Kurikulum, Kesiswaan, Sarana Prasarana, dan Hubungan Industri.</p>
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

<form action="{{ route('super_admin.bidang_kerja_settings.update') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-12 pb-20">
    @csrf

    @php
        $areas = [
            'kurikulum' => 'Kurikulum',
            'kesiswaan' => 'Kesiswaan',
            'sarana_prasarana' => 'Sarana Prasarana',
            'hubungan_industri' => 'Hubungan Industri',
        ];
    @endphp

    @foreach($areas as $key => $label)
    <div class="bg-white px-6 py-8 shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl">
        <h2 class="text-lg font-semibold leading-7 text-blue-600 font-outfit uppercase tracking-widest border-b pb-4 mb-6">{{ $label }}</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-medium leading-6 text-slate-900">Foto / Banner {{ $label }}</label>
                <div class="mt-2 border border-slate-200 rounded-lg p-4 bg-slate-50 flex flex-col items-center">
                    @if(isset($settings[$key . '_image']) && $settings[$key . '_image'])
                        <img src="{{ asset('storage/' . $settings[$key . '_image']) }}" alt="{{ $label }}" class="h-32 w-full object-cover rounded shadow-sm mb-4">
                    @else
                        <div class="h-32 w-full rounded bg-slate-100 flex items-center justify-center border-2 border-dashed border-slate-300 mb-4">
                            <span class="text-xs text-slate-400">Belum ada foto</span>
                        </div>
                    @endif
                    <input type="file" name="{{ $key }}_image" class="block w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    <p class="mt-2 text-xs text-slate-500 text-center">Format JPEG, PNG, JPG (maks 5MB).</p>
                </div>
                @error($key.'_image') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>

            <!-- Text Description -->
            <div>
                <label class="block text-sm font-medium leading-6 text-slate-900">Penjelasan Singkat / Deskripsi</label>
                <div class="mt-2">
                    <textarea name="{{ $key }}_text" rows="7" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" placeholder="Ketikkan deskripsi tentang {{ $label }} di sini...">{{ old($key.'_text', isset($settings[$key . '_text']) ? $settings[$key . '_text'] : '') }}</textarea>
                </div>
                <p class="mt-2 text-xs text-slate-500">Mendukung paragraf dan spasi turun baris (enter).</p>
                @error($key.'_text') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>
    @endforeach

    <div class="flex items-center justify-end gap-x-6 sticky bottom-6 z-10">
        <button type="submit" class="rounded-xl bg-blue-600 px-10 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all font-outfit uppercase tracking-widest active:scale-95">
            Simpan Semua Perubahan
        </button>
    </div>
</form>
@endsection
