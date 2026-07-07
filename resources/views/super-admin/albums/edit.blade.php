@extends('layouts.dashboard')

@section('title', 'Edit Album & Upload Foto')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('super_admin.albums.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-slate-900 transition-colors uppercase tracking-[0.2em] mb-4">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-2xl font-bold text-slate-900">Edit Album & Kelola Foto</h1>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3 animate-fade-in-down">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar: Album Info -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100 sticky top-8">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-6">Informasi Album</h3>
                
                <form action="{{ route('super_admin.albums.update', $album->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-1">Judul</label>
                        <input type="text" name="title" value="{{ old('title', $album->title) }}" required class="w-full bg-slate-50 border-none rounded-2xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-1">Kategori</label>
                        <select name="category" required class="w-full bg-slate-50 border-none rounded-2xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all">
                            <option value="Events" {{ $album->category == 'Events' ? 'selected' : '' }}>Events</option>
                            <option value="Sports" {{ $album->category == 'Sports' ? 'selected' : '' }}>Sports</option>
                            <option value="Academic" {{ $album->category == 'Academic' ? 'selected' : '' }}>Academic</option>
                            <option value="Excursions" {{ $album->category == 'Excursions' ? 'selected' : '' }}>Excursions</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-1">Kaitan Jurusan (Opsional)</label>
                        <select name="major_id" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all">
                            <option value="">(Umum / Tidak Berkaitan)</option>
                            @foreach($majors as $m)
                                <option value="{{ $m->id }}" {{ $album->major_id == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-1">Kaitan Ekstrakurikuler (Opsional)</label>
                        <select name="extracurricular_id" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-3 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all">
                            <option value="">(Umum / Tidak Berkaitan)</option>
                            @foreach($extracurriculars as $e)
                                <option value="{{ $e->id }}" {{ $album->extracurricular_id == $e->id ? 'selected' : '' }}>{{ $e->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ $album->is_featured ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-slate-900"></div>
                            <span class="ml-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest">Featured</span>
                        </label>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3 ml-1">Cover Baru (Opsional)</label>
                        <div class="relative h-40 w-full rounded-2xl bg-slate-100 overflow-hidden mb-3">
                            <img src="{{ asset('storage/' . $album->cover_image) }}" class="h-full w-full object-cover">
                        </div>
                        <input type="file" name="cover_image" class="text-[10px] text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-slate-900 file:text-white transition-all w-full">
                    </div>

                    <button type="submit" class="w-full bg-slate-200 text-slate-900 py-3 rounded-2xl text-[10px] font-bold uppercase tracking-widest hover:bg-slate-300 transition-all">Update Info Album</button>
                </form>
            </div>
        </div>

        <!-- Main: Photo Gallery -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Upload Box -->
            <div class="bg-indigo-900/5 border border-indigo-100 rounded-[2rem] p-8 text-center">
                <h3 class="text-sm font-bold text-slate-900 mb-4 tracking-tight">Unggah Foto Baru</h3>
                <form action="{{ route('super_admin.albums.upload', $album->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                        <input type="file" name="photos[]" multiple required class="text-xs text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-2xl file:border-0 file:text-xs file:font-bold file:uppercase file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 transition-all shadow-lg shadow-indigo-600/10">
                        <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-2xl text-xs font-bold uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-600/10">Upload Sekarang</button>
                    </div>
                    <p class="mt-4 text-[10px] text-slate-400 italic">Anda dapat memilih lebih dari satu foto sekaligus.</p>
                </form>
            </div>

            <!-- Existing Photos Grid -->
            <div class="bg-white rounded-[2rem] p-10 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em]">Koleksi Foto ({{ $album->photos->count() }})</h3>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @forelse($album->photos as $photo)
                    <div class="aspect-square rounded-2xl bg-slate-100 overflow-hidden relative group">
                        <img src="{{ asset('storage/' . $photo->image) }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                            <!-- In a real app we might have a delete button for single photos too -->
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-20 text-center border-2 border-dashed border-slate-100 rounded-3xl">
                        <p class="text-[10px] text-slate-400 uppercase tracking-widest">Belum ada foto di album ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
