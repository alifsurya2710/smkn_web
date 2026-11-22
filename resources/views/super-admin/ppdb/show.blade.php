@extends('layouts.dashboard')

@section('title', 'Verifikasi Pendaftaran SPMB - ' . $application->registration_number)

@section('content')
<div class="space-y-6" x-data="{
    statusModal: false,
    selectedStatus: '{{ $application->status }}',
    catatan: '{{ addslashes($application->catatan ?? '') }}',
    previewImage: '',
    showImageModal: false,

    openStatus(st) {
        this.selectedStatus = st;
        this.statusModal = true;
    },

    openImg(url) {
        this.previewImage = url;
        this.showImageModal = true;
    }
}">

    {{-- Breadcrumb & Back Button --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('super_admin.ppdb_applications.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-slate-500 hover:text-green-700 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Daftar Pendaftar
        </a>
        <div class="flex items-center gap-2">
            @if($application->status === 'approved')
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    STATUS: DITERIMA (APPROVED)
                </span>
            @elseif($application->status === 'rejected')
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-red-50 text-red-700 border border-red-200">
                    <svg class="w-3.5 h-3.5 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    STATUS: DITOLAK (REJECTED)
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200">
                    <svg class="w-3.5 h-3.5 text-amber-600 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    STATUS: MENUNGGU VERIFIKASI
                </span>
            @endif
        </div>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
    <div class="p-4 bg-green-50 border border-green-200 rounded-2xl text-green-800 text-xs font-bold flex items-center gap-3">
        <svg class="w-5 h-5 text-green-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif
    @if(session('warning'))
    <div class="p-4 bg-amber-50 border border-amber-200 rounded-2xl text-amber-800 text-xs font-bold flex items-center gap-3">
        <svg class="w-5 h-5 text-amber-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
        <span>{{ session('warning') }}</span>
    </div>
    @endif
    @if($errors->any())
    <div class="p-4 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-xs font-semibold">
        @foreach($errors->all() as $err)
            <p>{{ $err }}</p>
        @endforeach
    </div>
    @endif

    {{-- Detail Card --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Kolom Kiri & Tengah: Informasi Lengkap & Berkas --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Info Siswa & Orang Tua --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 p-6 shadow-sm">
                <div class="flex items-center gap-3 pb-4 mb-4 border-b border-slate-100 dark:border-slate-700">
                    <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center text-green-700 font-bold">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900 dark:text-white">Identitas Calon Murid & Wali</h2>
                        <p class="text-xs text-slate-400">Data pendaftaran nomor: <span class="font-mono font-bold text-slate-700 dark:text-slate-300">{{ $application->registration_number }}</span></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div class="p-3.5 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Nama Calon Murid</span>
                        <span class="text-sm font-extrabold text-slate-900 dark:text-white mt-0.5 block">{{ $application->full_name }}</span>
                    </div>

                    <div class="p-3.5 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Nama Orang Tua / Wali</span>
                        <span class="text-sm font-bold text-slate-900 dark:text-white mt-0.5 block">{{ $application->parent_name ?? '-' }}</span>
                    </div>

                    <div class="p-3.5 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Nomor WhatsApp / HP</span>
                        <span class="text-sm font-bold text-slate-900 dark:text-white mt-0.5 block">{{ $application->phone }}</span>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $application->phone) }}" target="_blank" class="inline-flex items-center gap-1 text-[11px] text-green-600 font-bold hover:underline mt-1">
                            <span>Hubungi via WhatsApp</span>
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>

                    <div class="p-3.5 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Alamat Email Pendaftar</span>
                        <span class="text-sm font-bold text-slate-900 dark:text-white mt-0.5 block">{{ $application->email }}</span>
                    </div>

                    <div class="p-3.5 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">NISN (Nomor Induk Siswa Nasional)</span>
                        <span class="text-xs font-semibold text-slate-800 dark:text-slate-200 mt-0.5 block">{{ $application->nisn ?? 'Tidak ada / Belum memiliki' }}</span>
                    </div>

                    <div class="p-3.5 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Jalur & Kategori Pendaftaran</span>
                        @php
                            $badgeJalur = match($application->jalur_pendaftaran) {
                                'yatim' => 'bg-emerald-100 text-emerald-800',
                                'kurang_mampu' => 'bg-amber-100 text-amber-800',
                                'prestasi' => 'bg-purple-100 text-purple-800',
                                default => 'bg-blue-100 text-blue-800',
                            };
                            $labelJalur = match($application->jalur_pendaftaran) {
                                'yatim' => 'Anak Yatim / Piatu (Gratis Rp 0)',
                                'kurang_mampu' => 'Kurang Mampu (Rp 50.000)',
                                'prestasi' => 'Berprestasi (Rp 100.000)',
                                default => 'Reguler (Rp 150.000)',
                            };
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {{ $badgeJalur }} mt-1">
                            {{ $labelJalur }}
                        </span>
                        <span class="block text-xs font-bold text-slate-700 dark:text-slate-300 mt-1">Nominal Biaya: {{ $application->nominal_biaya == 0 ? 'Gratis (Rp 0)' : 'Rp ' . number_format($application->nominal_biaya, 0, ',', '.') }}</span>
                    </div>

                    <div class="p-3.5 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block">Riwayat Pendidikan PAUD / KB</span>
                        @if($application->pernah_paud)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800 mt-1">
                                Pernah Menempuh PAUD / KB
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-slate-200 text-slate-700 mt-1">
                                Belum / Tidak Pernah PAUD
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Dokumen & Berkas Persyaratan --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 p-6 shadow-sm">
                <div class="flex items-center gap-3 pb-4 mb-5 border-b border-slate-100 dark:border-slate-700">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center text-blue-700 font-bold">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-slate-900 dark:text-white">Dokumen & Berkas yang Diunggah</h2>
                        <p class="text-xs text-slate-400">Klik pada dokumen untuk melihat ukuran penuh / mengunduh.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- 1. Kartu Keluarga (KK) --}}
                    <div class="p-4 bg-slate-50 dark:bg-slate-700/40 rounded-2xl border border-slate-200/80 dark:border-slate-600 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200">1. Foto Kartu Keluarga (KK)</span>
                                <span class="text-[10px] font-bold text-red-500 uppercase tracking-widest">Wajib</span>
                            </div>
                            @if($application->foto_kk)
                                <div class="aspect-[4/3] rounded-xl overflow-hidden bg-slate-200 relative group cursor-pointer" @click="openImg('{{ asset('storage/' . $application->foto_kk) }}')">
                                    <img src="{{ asset('storage/' . $application->foto_kk) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" alt="Kartu Keluarga">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity text-white text-xs font-bold gap-1">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                        Lihat Foto
                                    </div>
                                </div>
                                <div class="mt-2.5 flex items-center justify-between">
                                    <a href="{{ asset('storage/' . $application->foto_kk) }}" target="_blank" class="text-[11px] font-bold text-blue-600 hover:underline">Buka di Tab Baru &rarr;</a>
                                    <a href="{{ asset('storage/' . $application->foto_kk) }}" download class="text-[11px] font-semibold text-slate-500 hover:text-slate-700">Unduh</a>
                                </div>
                            @else
                                <div class="p-6 text-center text-slate-400 bg-white rounded-xl border border-dashed border-slate-300">
                                    Berkas belum diunggah
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- 2. Akta Kelahiran --}}
                    <div class="p-4 bg-slate-50 dark:bg-slate-700/40 rounded-2xl border border-slate-200/80 dark:border-slate-600 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200">2. Foto Akta Kelahiran</span>
                                <span class="text-[10px] font-bold text-red-500 uppercase tracking-widest">Wajib</span>
                            </div>
                            @if($application->foto_akta)
                                <div class="aspect-[4/3] rounded-xl overflow-hidden bg-slate-200 relative group cursor-pointer" @click="openImg('{{ asset('storage/' . $application->foto_akta) }}')">
                                    <img src="{{ asset('storage/' . $application->foto_akta) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" alt="Akta Kelahiran">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity text-white text-xs font-bold gap-1">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                        Lihat Foto
                                    </div>
                                </div>
                                <div class="mt-2.5 flex items-center justify-between">
                                    <a href="{{ asset('storage/' . $application->foto_akta) }}" target="_blank" class="text-[11px] font-bold text-blue-600 hover:underline">Buka di Tab Baru &rarr;</a>
                                    <a href="{{ asset('storage/' . $application->foto_akta) }}" download class="text-[11px] font-semibold text-slate-500 hover:text-slate-700">Unduh</a>
                                </div>
                            @else
                                <div class="p-6 text-center text-slate-400 bg-white rounded-xl border border-dashed border-slate-300">
                                    Berkas belum diunggah
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- 3. Rapot / Keterangan PAUD (Kondisional) --}}
                    <div class="p-4 bg-slate-50 dark:bg-slate-700/40 rounded-2xl border border-slate-200/80 dark:border-slate-600 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold text-slate-800 dark:text-slate-200">3. Rapot / Keterangan PAUD</span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                    {{ $application->pernah_paud ? 'Wajib Bagi PAUD' : 'Tidak Ada (Bukan PAUD)' }}
                                </span>
                            </div>
                            @if($application->foto_rapot_paud)
                                <div class="aspect-[4/3] rounded-xl overflow-hidden bg-slate-200 relative group cursor-pointer" @click="openImg('{{ asset('storage/' . $application->foto_rapot_paud) }}')">
                                    <img src="{{ asset('storage/' . $application->foto_rapot_paud) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" alt="Rapot PAUD">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity text-white text-xs font-bold gap-1">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                        Lihat Foto
                                    </div>
                                </div>
                                <div class="mt-2.5 flex items-center justify-between">
                                    <a href="{{ asset('storage/' . $application->foto_rapot_paud) }}" target="_blank" class="text-[11px] font-bold text-blue-600 hover:underline">Buka di Tab Baru &rarr;</a>
                                    <a href="{{ asset('storage/' . $application->foto_rapot_paud) }}" download class="text-[11px] font-semibold text-slate-500 hover:text-slate-700">Unduh</a>
                                </div>
                            @else
                                <div class="p-6 text-center text-slate-400 bg-white dark:bg-slate-800 rounded-xl border border-dashed border-slate-300 dark:border-slate-600">
                                    Tidak melampirkan rapot (bukan lulusan PAUD)
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- 4. Bukti Pembayaran Pendaftaran --}}
                    <div class="p-4 bg-emerald-50/70 dark:bg-emerald-900/20 rounded-2xl border border-emerald-200 dark:border-emerald-800 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold text-emerald-900 dark:text-emerald-300">4. Bukti Transfer Pembayaran</span>
                                <span class="text-[10px] font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-full uppercase tracking-wider">Transfer BRI</span>
                            </div>
                            @if($application->bukti_transfer)
                                <div class="aspect-[4/3] rounded-xl overflow-hidden bg-slate-200 relative group cursor-pointer" @click="openImg('{{ asset('storage/' . $application->bukti_transfer) }}')">
                                    <img src="{{ asset('storage/' . $application->bukti_transfer) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" alt="Bukti Transfer">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity text-white text-xs font-bold gap-1">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                        Periksa Bukti
                                    </div>
                                </div>
                                <div class="mt-2.5 flex items-center justify-between">
                                    <a href="{{ asset('storage/' . $application->bukti_transfer) }}" target="_blank" class="text-[11px] font-bold text-emerald-700 hover:underline">Buka di Tab Baru &rarr;</a>
                                    <a href="{{ asset('storage/' . $application->bukti_transfer) }}" download class="text-[11px] font-semibold text-slate-500 hover:text-slate-700">Unduh</a>
                                </div>
                            @else
                                <div class="p-6 text-center text-slate-400 bg-white rounded-xl border border-dashed border-slate-300">
                                    Bukti pembayaran belum diunggah
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- Kolom Kanan: Panel Keputusan (Approve / Reject) & Notifikasi Email --}}
        <div class="space-y-6">

            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 p-6 shadow-sm sticky top-20">
                <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider pb-3 border-b border-slate-100 dark:border-slate-700">
                    Aksi Keputusan Verifikasi
                </h3>

                <p class="text-xs text-slate-500 dark:text-slate-400 mt-3 leading-relaxed">
                    Setiap perubahan status (Approve / Reject) akan secara otomatis mengirimkan <strong>surat pemberitahuan resmi ke Gmail</strong> pendaftar (<span class="font-semibold text-slate-700 dark:text-slate-200">{{ $application->email }}</span>).
                </p>

                {{-- Status Saat Ini --}}
                <div class="mt-4 p-4 rounded-xl {{ $application->status === 'approved' ? 'bg-emerald-50 border border-emerald-200' : ($application->status === 'rejected' ? 'bg-red-50 border border-red-200' : 'bg-amber-50 border border-amber-200') }}">
                    <span class="text-[10px] font-bold uppercase tracking-widest block {{ $application->status === 'approved' ? 'text-emerald-700' : ($application->status === 'rejected' ? 'text-red-700' : 'text-amber-700') }}">
                        Status Pendaftaran:
                    </span>
                    <span class="text-sm font-black uppercase tracking-wider block mt-0.5 {{ $application->status === 'approved' ? 'text-emerald-900' : ($application->status === 'rejected' ? 'text-red-900' : 'text-amber-900') }}">
                        {{ $application->status === 'approved' ? 'Diterima (Approved)' : ($application->status === 'rejected' ? 'Ditolak (Rejected)' : 'Menunggu Verifikasi') }}
                    </span>
                    @if($application->catatan)
                        <div class="mt-2 pt-2 border-t {{ $application->status === 'approved' ? 'border-emerald-200 text-emerald-800' : ($application->status === 'rejected' ? 'border-red-200 text-red-800' : 'border-amber-200 text-amber-800') }} text-xs">
                            <span class="font-bold block text-[10px] uppercase">Catatan / Alasan:</span>
                            <p class="mt-0.5 italic">{{ $application->catatan }}</p>
                        </div>
                    @endif
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-6 space-y-3">
                    {{-- Tombol Approve --}}
                    <button type="button" @click="openStatus('approved')"
                            class="w-full py-3 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white font-bold text-xs uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        <span>Terima Pendaftaran (Approve)</span>
                    </button>

                    {{-- Tombol Reject --}}
                    <button type="button" @click="openStatus('rejected')"
                            class="w-full py-3 px-4 rounded-xl bg-red-600 hover:bg-red-700 active:scale-95 text-white font-bold text-xs uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        <span>Tolak Pendaftaran (Reject)</span>
                    </button>

                    @if($application->status !== 'pending')
                    <button type="button" @click="openStatus('pending')"
                            class="w-full py-2.5 px-4 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-600 font-semibold text-xs transition-colors text-center">
                        Kembalikan ke Status Pending
                    </button>
                    @endif
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700 text-[11px] text-slate-400 space-y-1">
                    <p>• Pendaftar dapat melihat status di beranda SPMB.</p>
                    <p>• Notifikasi email akan otomatis masuk ke inbox Gmail pendaftar.</p>
                </div>
            </div>

        </div>

    </div>

    {{-- Modal Konfirmasi Keputusan (Approve / Reject) --}}
    <div x-show="statusModal" x-cloak class="fixed inset-0 z-[1000] overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm" @click="statusModal = false"></div>

        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative w-full max-w-lg bg-white dark:bg-slate-800 rounded-3xl shadow-2xl z-10 p-6 sm:p-8 border border-slate-100 dark:border-slate-700"
                 @click.away="statusModal = false">
                
                <form method="POST" action="{{ route('super_admin.ppdb_applications.update_status', $application->id) }}">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="status" :value="selectedStatus">

                    {{-- Header Modal --}}
                    <div class="text-center mb-6">
                        <div class="w-14 h-14 rounded-2xl mx-auto flex items-center justify-center text-white text-2xl shadow-lg mb-3"
                             :class="selectedStatus === 'approved' ? 'bg-emerald-600 shadow-emerald-500/20' : (selectedStatus === 'rejected' ? 'bg-red-600 shadow-red-500/20' : 'bg-amber-600 shadow-amber-500/20')">
                            <template x-if="selectedStatus === 'approved'">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </template>
                            <template x-if="selectedStatus === 'rejected'">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            </template>
                            <template x-if="selectedStatus === 'pending'">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </template>
                        </div>

                        <h3 class="text-lg font-bold text-slate-900 dark:text-white font-outfit"
                            x-text="selectedStatus === 'approved' ? 'Konfirmasi Penerimaan (Approve)' : (selectedStatus === 'rejected' ? 'Konfirmasi Penolakan (Reject)' : 'Kembalikan ke Status Pending')">
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                            Calon Murid: <strong>{{ $application->full_name }}</strong> ({{ $application->registration_number }})
                        </p>
                    </div>

                    {{-- Form Input Catatan / Alasan --}}
                    <div class="mb-6 space-y-2">
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">
                            <span x-show="selectedStatus === 'rejected'" class="text-red-600">Alasan Penolakan (Wajib Diisi) *</span>
                            <span x-show="selectedStatus !== 'rejected'">Catatan untuk Orang Tua / Wali (Opsional)</span>
                        </label>
                        <textarea name="catatan" rows="4" x-model="catatan"
                                  :required="selectedStatus === 'rejected'"
                                  :placeholder="selectedStatus === 'rejected' ? 'Contoh: Foto Kartu Keluarga kurang jelas / Bukti transfer belum terbaca. Silakan unggah ulang berkas.' : 'Contoh: Selamat ananda telah diterima, silakan tunggu informasi jadwal orientasi.'"
                                  class="w-full p-3.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-xs text-slate-900 dark:text-white focus:border-green-500 focus:ring-green-500 leading-relaxed"></textarea>
                        
                        <p class="text-[11px] text-slate-400 leading-normal">
                            * Catatan ini akan dicantumkan langsung di dalam email notifikasi yang dikirimkan ke <strong>{{ $application->email }}</strong>.
                        </p>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex gap-3 justify-end">
                        <button type="button" @click="statusModal = false" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-6 py-2.5 rounded-xl text-white text-xs font-bold uppercase tracking-wider transition-all shadow-md"
                                :class="selectedStatus === 'approved' ? 'bg-emerald-600 hover:bg-emerald-700' : (selectedStatus === 'rejected' ? 'bg-red-600 hover:bg-red-700' : 'bg-slate-800 hover:bg-slate-900')">
                            Simpan &amp; Kirim Notifikasi Email
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- Modal Preview Gambar Dokumen --}}
    <div x-show="showImageModal" x-cloak class="fixed inset-0 z-[1100] flex items-center justify-center p-4 bg-slate-900/90 backdrop-blur-md" style="display: none;">
        <div class="relative max-w-4xl max-h-[90vh] flex flex-col items-center justify-center" @click.away="showImageModal = false">
            <button @click="showImageModal = false" class="absolute -top-12 right-0 text-white hover:text-red-400 p-2 bg-white/10 rounded-full">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <img :src="previewImage" class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl bg-white p-2">
        </div>
    </div>

</div>
@endsection
