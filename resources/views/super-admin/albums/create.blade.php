@extends('layouts.dashboard')

@section('title', 'Buat Album Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('super_admin.albums.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-slate-900 transition-colors uppercase tracking-[0.2em] mb-4">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-2xl font-bold text-slate-900">Buat Album Baru</h1>
    </div>

    <form action="{{ route('super_admin.albums.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">
            <div class="bg-white rounded-[2rem] p-10 shadow-sm border border-slate-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Juduk Album</label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all" placeholder="Contoh: Lomba Futsal Antar Kelas 2024">
                        @error('title') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Deskripsi</label>
                        <textarea name="description" rows="3" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all" placeholder="Berikan deskripsi singkat tentang kegiatan dalam album ini...">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Kategori</label>
                        <select name="category" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all">
                            <option value="">Pilih Kategori</option>
                            <option value="Events" {{ old('category') == 'Events' ? 'selected' : '' }}>Events</option>
                            <option value="Sports" {{ old('category') == 'Sports' ? 'selected' : '' }}>Sports</option>
                            <option value="Academic" {{ old('category') == 'Academic' ? 'selected' : '' }}>Academic</option>
                            <option value="Excursions" {{ old('category') == 'Excursions' ? 'selected' : '' }}>Excursions</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Kaitan Jurusan (Opsional)</label>
                        <select name="major_id" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all">
                            <option value="">(Umum / Tidak Berkaitan)</option>
                            @foreach($majors as $m)
                                <option value="{{ $m->id }}" {{ old('major_id') == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Kaitan Ekstrakurikuler (Opsional)</label>
                        <select name="extracurricular_id" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all">
                            <option value="">(Umum / Tidak Berkaitan)</option>
                            @foreach($extracurriculars as $e)
                                <option value="{{ $e->id }}" {{ old('extracurricular_id') == $e->id ? 'selected' : '' }}>{{ $e->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured') ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-slate-900"></div>
                            <span class="ml-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Featured Album</span>
                        </label>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Cover Album</label>
                        <input type="file" name="cover_image" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-slate-900 file:text-white hover:file:bg-slate-800 transition-all">
                        <p class="mt-2 text-[10px] text-slate-400 italic ml-1">* Foto ini akan muncul sebagai cover di halaman galeri utama.</p>
                        @error('cover_image') <p class="mt-2 text-[10px] text-red-500 font-bold uppercase tracking-widest ml-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-slate-900 text-white px-10 py-4 rounded-2xl text-sm font-bold uppercase tracking-[0.2em] hover:bg-slate-800 transition-all shadow-xl shadow-slate-900/10">Simpan & Lanjutkan</button>
            </div>
        </div>
    </form>
</div>
@endsection
