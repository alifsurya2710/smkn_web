@extends('layouts.dashboard')

@section('title', 'Kelola Album Galeri')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Album Galeri</h1>
            <p class="mt-1 text-sm text-slate-500">Kelola album foto kegiatan sekolah, prestasi, dan dokumentasi lainnya.</p>
        </div>
        <a href="{{ route('super_admin.albums.create') }}" class="inline-flex items-center gap-2 bg-slate-900 text-white px-6 py-3 rounded-2xl text-sm font-bold hover:bg-slate-800 transition-all shadow-xl shadow-slate-900/10">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Album Baru
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3 animate-fade-in-down">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-[2rem] overflow-hidden shadow-sm border border-slate-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Album</th>
                        <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Kategori</th>
                        <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Status</th>
                        <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Jumlah Foto</th>
                        <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($albums as $album)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-8 py-6 border-b border-slate-50">
                            <div class="flex items-center gap-4">
                                <div class="h-16 w-16 rounded-xl bg-slate-100 overflow-hidden flex-shrink-0 border border-slate-100">
                                    <img src="{{ asset('storage/' . $album->cover_image) }}" class="h-full w-full object-cover">
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $album->title }}</div>
                                    <div class="text-[10px] text-slate-400 mt-1 uppercase tracking-wider">{{ $album->created_at->format('d M Y') }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6 border-b border-slate-50">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 uppercase tracking-wider italic">
                                {{ $album->category }}
                            </span>
                        </td>
                        <td class="px-8 py-6 border-b border-slate-50">
                            @if($album->is_featured)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-600 uppercase tracking-wider italic">
                                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    Featured Album
                                </span>
                            @else
                                <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Reguler</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 border-b border-slate-50">
                            <span class="text-sm font-bold text-slate-900">{{ $album->photos_count }}</span>
                            <span class="text-[10px] text-slate-400 uppercase tracking-widest ml-1">Photos</span>
                        </td>
                        <td class="px-8 py-6 border-b border-slate-50 border-r border-transparent group-hover:border-r-slate-200 transition-all">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('super_admin.albums.edit', $album->id) }}" class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('super_admin.albums.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus album ini beserta seluruh fotonya?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="h-20 w-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="h-10 w-10 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900">Belum Ada Album</h3>
                                <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-widest">Klik "Buat Album Baru" untuk memulai dokumentasi.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($albums->hasPages())
        <div class="px-8 py-6 border-t border-slate-50 bg-slate-50/30">
            {{ $albums->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
