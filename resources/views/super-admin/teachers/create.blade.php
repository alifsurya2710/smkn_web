@extends('layouts.dashboard')

@section('title', 'Tambah Guru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Tambah Guru Baru</h1>
            <p class="mt-1 text-sm text-slate-500">Lengkapi data untuk menambahkan tenaga pengajar baru ke dalam sistem.</p>
        </div>
        <a href="{{ route('super_admin.teachers.index') }}" class="text-xs font-bold text-slate-400 uppercase tracking-widest hover:text-slate-900 transition-colors">Kembali</a>
    </div>

    <form action="{{ route('super_admin.teachers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Data Dasar -->
                <div class="space-y-6">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Informasi Utama</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-1">Nama Lengkap & Gelar</label>
                            <input type="text" name="name" required class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3.5 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all" placeholder="Contoh: Budi Santoso, S.Pd., M.M">
                        </div>
                    </div>
                </div>

                <!-- Data Profesional -->
                <div class="space-y-6">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Detail Profesional</h3>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-1">NIP (Opsional)</label>
                                <input type="text" name="nip" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3.5 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all" placeholder="Nomor Induk Pegawai">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-1">Pangkat/Gol (Opsional)</label>
                                <input type="text" name="rank" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3.5 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all" placeholder="Contoh: Penata / IIIc">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-1">Jabatan</label>
                            <input type="text" name="position" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3.5 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all" placeholder="Contoh: Guru Produktif / Wakasek">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-1">Mata Pelajaran</label>
                            <input type="text" name="subject" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-3.5 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all" placeholder="Contoh: Teknik Pemesinan">
                        </div>
                         <div class="pt-2">
                             <div class="flex items-center gap-3 bg-slate-50 p-4 rounded-2xl border border-transparent hover:border-blue-100 transition-all w-max">
                                <input type="checkbox" name="is_management" value="1" class="h-5 w-5 rounded-lg border-slate-300 text-slate-900 focus:ring-slate-900">
                                <label class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">Manajemen</label>
                             </div>
                         </div>
                    </div>
                </div>
            </div>

            <!-- Foto -->
            <div class="mt-12 pt-12 border-t border-slate-50">
                 <div class="flex flex-col md:flex-row gap-8 items-center">
                    <div class="h-32 w-32 bg-slate-100 rounded-[2rem] flex flex-col items-center justify-center text-slate-400 italic text-xs overflow-hidden border border-slate-100" id="photo-preview-container">
                        <span>PREVIEW</span>
                    </div>
                    <div class="flex-1">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Foto Profil</label>
                        <input type="file" name="photo" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-slate-900 file:text-white hover:file:bg-slate-800 transition-all">
                        <p class="mt-2 text-[10px] text-slate-400 uppercase tracking-tight">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                    </div>
                 </div>
            </div>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="flex-1 py-4 bg-slate-900 text-white rounded-2xl text-sm font-bold uppercase tracking-widest hover:bg-slate-800 transition-all shadow-xl shadow-slate-900/10">Simpan Data Guru</button>
            <a href="{{ route('super_admin.teachers.index') }}" class="flex-1 py-4 bg-white text-slate-900 border border-slate-200 rounded-2xl text-sm text-center font-bold uppercase tracking-widest hover:bg-slate-50 transition-all">Batal</a>
        </div>
    </form>
</div>

@if(session('error'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session("error") }}',
            confirmButtonColor: '#ef4444'
        });
    });
</script>
@endif
@endsection
