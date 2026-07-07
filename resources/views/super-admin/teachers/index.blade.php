@extends('layouts.dashboard')

@section('title', 'Kelola Guru')

@section('content')
<div class="sm:flex sm:items-center mb-8">
    <div class="sm:flex-auto">
        <h1 class="text-2xl font-bold text-slate-900">Kelola Guru</h1>
        <p class="mt-2 text-sm text-slate-500">Daftar tenaga pengajar, pimpinan sekolah, dan staff manajemen.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 flex gap-3">
        <button onclick="document.getElementById('importModal').classList.remove('hidden')" class="inline-flex items-center gap-2 bg-white text-slate-900 border border-slate-200 px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-50 transition-all shadow-sm">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
            Import Excel
        </button>
        <a href="{{ route('super_admin.teachers.create') }}" class="inline-flex items-center gap-2 bg-slate-900 text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-800 transition-all shadow-sm">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Guru
        </a>
    </div>
</div>

<!-- Hero Settings Accordion -->
<div x-data="{ open: false }" class="mb-8 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden text-sm">
    <button @click="open = !open" type="button" class="w-full flex items-center justify-between px-6 py-4 bg-slate-50 hover:bg-slate-100 transition-colors cursor-pointer text-left">
        <div>
            <h3 class="text-sm font-bold text-slate-900">Pengaturan Hero Banner (Halaman Guru & Staff)</h3>
            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-1">Sesuaikan tampilan awal di halaman publik</p>
        </div>
        <svg class="h-5 w-5 text-slate-500 transform transition-transform duration-200" :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </button>
    <div x-show="open" x-collapse x-cloak>
        <div class="p-6 border-t border-slate-100">
            <form action="{{ route('super_admin.teachers.hero.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Judul Hero</label>
                            <input type="text" name="staff_hero_title" value="{{ old('staff_hero_title', $profile->staff_hero_title) }}" placeholder="Contoh: Guru & Tata Usaha" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-3 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Deskripsi Hero</label>
                            <textarea name="staff_hero_description" rows="3" placeholder="Contoh: Dedikasi Untuk Mencetak Generasi Unggul" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-3 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all">{{ old('staff_hero_description', $profile->staff_hero_description) }}</textarea>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Gambar Background / Relate Hero</label>
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-6">
                                <div class="h-28 w-48 rounded-2xl bg-slate-100 flex-shrink-0 overflow-hidden border border-slate-100">
                                    @if($profile->staff_hero_image)
                                        <img src="{{ asset('storage/' . $profile->staff_hero_image) }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-slate-300 italic text-[10px]">NO IMAGE</div>
                                    @endif
                                </div>
                                <input type="file" name="staff_hero_image" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-slate-900 file:text-white hover:file:bg-slate-800 transition-all">
                            </div>
                            
                            @if($profile->staff_hero_image)
                            <label class="flex items-center gap-2 cursor-pointer bg-red-50 w-max px-3 py-2 rounded-lg border border-red-100 transition-colors hover:bg-red-100">
                                <input type="checkbox" name="remove_staff_hero_image" value="1" class="rounded border-red-300 text-red-600 focus:ring-red-600 cursor-pointer">
                                <span class="text-[10px] font-bold text-red-600 uppercase tracking-widest">Hapus Gambar Hero</span>
                            </label>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-slate-800 transition-all shadow-xl shadow-slate-900/10">Simpan Hero</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest sm:pl-6">Guru / Staff</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">NIP</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jabatan / Mapel</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white italic">
                @forelse($teachers as $teacher)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 sm:pl-6">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 flex-shrink-0 bg-slate-100 rounded-xl overflow-hidden border border-slate-100">
                                @if($teacher->photo)
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" class="h-full w-full object-cover">
                                @else
                                    <div class="h-full w-full flex items-center justify-center text-slate-400 bg-blue-50 text-blue-600 font-bold uppercase">
                                        {{ substr($teacher->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-slate-900">{{ $teacher->name }}{{ $teacher->title ? ', ' . $teacher->title : '' }}</span>
                                <span class="text-xs text-slate-400">{{ $teacher->email }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 font-medium tracking-tight">
                        {{ $teacher->nip ?? '-' }}
                    </td>
                    <td class="whitespace-nowrap px-3 py-4">
                        <div class="text-sm text-slate-900 font-bold uppercase tracking-tight">{{ $teacher->position ?? 'GURU' }}</div>
                        <div class="flex flex-col text-[10px] text-slate-400 font-bold tracking-widest leading-relaxed">
                            <span>MAPEL: {{ $teacher->subject ?? 'UMUM' }}</span>
                            <span>GOL: {{ $teacher->rank ?? '-' }}</span>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4">
                        @if($teacher->is_management)
                            <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-[9px] font-bold text-blue-700 uppercase tracking-tight ring-1 ring-inset ring-blue-700/10">Manajemen</span>
                        @else
                            <span class="inline-flex items-center rounded-md bg-slate-50 px-2 py-1 text-[9px] font-bold text-slate-600 uppercase tracking-tight ring-1 ring-inset ring-slate-500/10">Reguler</span>
                        @endif
                    </td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                        <div class="flex items-center justify-end gap-2">
                             <a href="{{ route('super_admin.teachers.edit', $teacher) }}" class="p-2 text-slate-400 hover:text-blue-600 bg-slate-50 hover:bg-blue-50 rounded-lg transition-colors">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </a>
                            <form action="{{ route('super_admin.teachers.destroy', $teacher) }}" method="POST" onsubmit="return confirm('Hapus data guru ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-600 bg-slate-50 hover:bg-red-50 rounded-lg transition-colors">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center">
                        <div class="flex flex-col items-center">
                            <div class="h-16 w-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-4">
                                <svg class="h-8 w-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            </div>
                            <h3 class="text-sm font-bold text-slate-900">Belum Ada Guru</h3>
                            <p class="text-xs text-slate-500 mt-1">Mulai tambahkan data guru secara manual atau import Excel.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($teachers->hasPages())
    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
        {{ $teachers->links() }}
    </div>
    @endif
</div>

<!-- Modal Import -->
<div id="importModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" aria-hidden="true" onclick="document.getElementById('importModal').classList.add('hidden')"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-[2rem] px-8 pt-10 pb-12 text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-slate-900 mb-2">Import Data Guru</h3>
                <p class="text-sm text-slate-500">Gunakan file .xlsx atau .csv dengan header: <b>nama, gelar, email, nip, jabatan, mapel, manajemen (1/0)</b>.</p>
            </div>
            <form action="{{ route('super_admin.teachers.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="relative group h-40 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center hover:border-blue-500 transition-colors">
                    <input type="file" name="file" class="absolute inset-0 opacity-0 cursor-pointer" onchange="this.nextElementSibling.innerText = this.files[0].name">
                    <div class="text-sm text-slate-400 group-hover:text-blue-600 font-medium transition-colors">Klik untuk pilih file atau seret kesini</div>
                    <svg class="h-10 w-10 text-slate-200 group-hover:text-blue-500 mt-4 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div class="mt-8 flex gap-3">
                    <button type="button" onclick="document.getElementById('importModal').classList.add('hidden')" class="flex-1 py-3 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 hover:bg-slate-50 transition-colors">Batal</button>
                    <button type="submit" class="flex-1 py-3 bg-slate-900 text-white rounded-xl text-sm font-bold hover:bg-slate-800 transition-colors shadow-lg shadow-slate-900/10">Import Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
