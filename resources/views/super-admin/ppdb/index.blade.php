@extends('layouts.dashboard')

@section('title', 'Data Pendaftaran SPMB')

@section('content')
<div class="space-y-6" x-data="{ importModal: false }">
    {{-- Header & Tombol Export/Import --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 dark:text-white font-outfit uppercase tracking-tight">Data Pendaftaran SPMB</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Kelola dan verifikasi berkas calon murid baru RA AL-IKHWAN.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                {{ $stats['pending'] }} Perlu Verifikasi
            </span>

            {{-- Tombol Download Excel --}}
            <a href="{{ route('super_admin.ppdb_applications.export', ['status' => request('status'), 'search' => request('search'), 'jalur' => request('jalur')]) }}" 
               class="inline-flex items-center justify-center gap-1.5 sm:gap-2 px-3 py-2 sm:px-4 sm:py-2 bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white rounded-xl text-[11px] sm:text-xs font-bold uppercase tracking-wider transition-all shadow-md flex-1 sm:flex-initial">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                <span>Download Excel</span>
            </a>

            {{-- Tombol Import Excel --}}
            <button type="button" @click="importModal = true"
                    class="inline-flex items-center justify-center gap-1.5 sm:gap-2 px-3 py-2 sm:px-4 sm:py-2 bg-[#0D2461] hover:bg-[#0a1c4f] active:scale-95 text-white rounded-xl text-[11px] sm:text-xs font-bold uppercase tracking-wider transition-all shadow-md flex-1 sm:flex-initial">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                <span>Import Excel</span>
            </button>
        </div>
    </div>

    {{-- Alert Flash Message --}}
    @if(session('success'))
    <div class="p-4 bg-green-50 border border-green-200 rounded-2xl text-green-800 text-xs font-bold flex items-center gap-3">
        <svg class="w-5 h-5 text-green-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif
    @if(session('error'))
    <div class="p-4 bg-red-50 border border-red-200 rounded-2xl text-red-800 text-xs font-bold flex items-center gap-3">
        <svg class="w-5 h-5 text-red-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('super_admin.ppdb_applications.index') }}" class="p-4 bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm hover:border-slate-300 transition-all">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Pendaftar</p>
            <p class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ $stats['total'] }}</p>
        </a>
        <a href="{{ route('super_admin.ppdb_applications.index', ['status' => 'pending']) }}" class="p-4 bg-amber-50/60 dark:bg-amber-900/10 rounded-2xl border border-amber-200/80 dark:border-amber-900/30 shadow-sm hover:border-amber-400 transition-all">
            <p class="text-[10px] font-bold text-amber-700 dark:text-amber-400 uppercase tracking-widest">Menunggu Verifikasi</p>
            <p class="text-2xl font-black text-amber-900 dark:text-amber-300 mt-1">{{ $stats['pending'] }}</p>
        </a>
        <a href="{{ route('super_admin.ppdb_applications.index', ['status' => 'approved']) }}" class="p-4 bg-emerald-50/60 dark:bg-emerald-900/10 rounded-2xl border border-emerald-200/80 dark:border-emerald-900/30 shadow-sm hover:border-emerald-400 transition-all">
            <p class="text-[10px] font-bold text-emerald-700 dark:text-emerald-400 uppercase tracking-widest">Diterima (Approved)</p>
            <p class="text-2xl font-black text-emerald-900 dark:text-emerald-300 mt-1">{{ $stats['approved'] }}</p>
        </a>
        <a href="{{ route('super_admin.ppdb_applications.index', ['status' => 'rejected']) }}" class="p-4 bg-red-50/60 dark:bg-red-900/10 rounded-2xl border border-red-200/80 dark:border-red-900/30 shadow-sm hover:border-red-400 transition-all">
            <p class="text-[10px] font-bold text-red-700 dark:text-red-400 uppercase tracking-widest">Ditolak (Rejected)</p>
            <p class="text-2xl font-black text-red-900 dark:text-red-300 mt-1">{{ $stats['rejected'] }}</p>
        </a>
    </div>

    {{-- Filter & Search Form --}}
    <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm">
        <form method="GET" action="{{ route('super_admin.ppdb_applications.index') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari nama murid, orang tua, no. telp, no. pendaftaran..."
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-xs text-slate-900 dark:text-white focus:border-green-500 focus:ring-green-500">
                <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <select name="status" class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-xs font-semibold text-slate-700 dark:text-white focus:border-green-500 focus:ring-green-500">
                <option value="all" {{ request('status') === 'all' || !request('status') ? 'selected' : '' }}>Semua Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Diterima (Approved)</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak (Rejected)</option>
            </select>
            <select name="jalur" class="px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-xs font-semibold text-slate-700 dark:text-white focus:border-green-500 focus:ring-green-500">
                <option value="all" {{ request('jalur') === 'all' || !request('jalur') ? 'selected' : '' }}>Semua Jalur</option>
                <option value="reguler" {{ request('jalur') === 'reguler' ? 'selected' : '' }}>Reguler (Rp 150rb)</option>
                <option value="yatim" {{ request('jalur') === 'yatim' ? 'selected' : '' }}>Anak Yatim (Gratis)</option>
                <option value="kurang_mampu" {{ request('jalur') === 'kurang_mampu' ? 'selected' : '' }}>Kurang Mampu (Rp 50rb)</option>
                <option value="prestasi" {{ request('jalur') === 'prestasi' ? 'selected' : '' }}>Berprestasi (Rp 100rb)</option>
            </select>
            <button type="submit" class="px-5 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-xl text-xs font-bold uppercase tracking-wider transition-all shadow-sm">
                Cari Data
            </button>
            @if(request('search') || (request('status') && request('status') !== 'all') || (request('jalur') && request('jalur') !== 'all'))
            <a href="{{ route('super_admin.ppdb_applications.index') }}" class="px-4 py-2.5 border border-slate-200 dark:border-slate-600 text-slate-600 dark:text-slate-300 rounded-xl text-xs font-semibold hover:bg-slate-50 transition-colors text-center">
                Reset
            </a>
            @endif
        </form>
    </div>

    {{-- Table Data --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 dark:bg-slate-700/50 border-b border-slate-100 dark:border-slate-700 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                        <th class="py-3.5 px-4">No. Pendaftaran</th>
                        <th class="py-3.5 px-4">Calon Murid</th>
                        <th class="py-3.5 px-4">Jalur & Biaya</th>
                        <th class="py-3.5 px-4">Orang Tua / Wali</th>
                        <th class="py-3.5 px-4">Kontak</th>
                        <th class="py-3.5 px-4">Status PAUD</th>
                        <th class="py-3.5 px-4">Status Verifikasi</th>
                        <th class="py-3.5 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700 text-xs">
                    @forelse($applications as $app)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                        <td class="py-4 px-4 font-mono font-bold text-slate-900 dark:text-white">
                            {{ $app->registration_number }}
                            <span class="block text-[10px] font-normal text-slate-400">{{ $app->created_at->format('d M Y, H:i') }}</span>
                        </td>
                        <td class="py-4 px-4 font-bold text-slate-900 dark:text-white">
                            {{ $app->full_name }}
                            @if($app->nisn)
                                <span class="block text-[10px] font-normal text-slate-400">NISN: {{ $app->nisn }}</span>
                            @endif
                        </td>
                        <td class="py-4 px-4">
                            @php
                                $badgeJalur = match($app->jalur_pendaftaran) {
                                    'yatim' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                    'kurang_mampu' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'prestasi' => 'bg-purple-50 text-purple-700 border-purple-200',
                                    default => 'bg-blue-50 text-blue-700 border-blue-200',
                                };
                                $labelJalur = match($app->jalur_pendaftaran) {
                                    'yatim' => 'Yatim / Piatu',
                                    'kurang_mampu' => 'Kurang Mampu',
                                    'prestasi' => 'Berprestasi',
                                    default => 'Reguler',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $badgeJalur }}">
                                {{ $labelJalur }}
                            </span>
                            <span class="block text-[11px] font-bold text-slate-700 dark:text-slate-300 mt-1">
                                {{ $app->nominal_biaya == 0 ? 'Gratis' : 'Rp ' . number_format($app->nominal_biaya, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-slate-700 dark:text-slate-300">
                            {{ $app->parent_name ?? '-' }}
                        </td>
                        <td class="py-4 px-4 text-slate-600 dark:text-slate-400">
                            <span class="block font-medium text-slate-800 dark:text-slate-200">{{ $app->phone }}</span>
                            <span class="block text-[10px] text-slate-400">{{ $app->email }}</span>
                        </td>
                        <td class="py-4 px-4">
                            @if($app->pernah_paud)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                    Pernah PAUD
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-slate-100 text-slate-600">
                                    Belum PAUD
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-4">
                            @if($app->status === 'approved')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <svg class="w-3 h-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    Diterima
                                </span>
                            @elseif($app->status === 'rejected')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-50 text-red-700 border border-red-200">
                                    <svg class="w-3 h-3 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    Ditolak
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200">
                                    <svg class="w-3 h-3 text-amber-600 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-center">
                            <a href="{{ route('super_admin.ppdb_applications.show', $app->id) }}" 
                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-slate-900 hover:bg-green-700 text-white font-bold text-xs transition-colors shadow-sm">
                                <span>Periksa Berkas</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-slate-400">
                            <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-slate-700 mx-auto flex items-center justify-center text-slate-400 mb-3">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <p class="font-bold text-slate-700 dark:text-slate-300">Belum Ada Data Pendaftaran</p>
                            <p class="text-xs text-slate-400 mt-1">Data calon murid yang mendaftar melalui formulir SPMB akan muncul di sini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($applications->hasPages())
        <div class="p-4 border-t border-slate-100 dark:border-slate-700">
            {{ $applications->links() }}
        </div>
        @endif
    </div>

    {{-- Modal Import Excel --}}
    <div x-show="importModal" x-cloak class="fixed inset-0 z-[1000] overflow-y-auto" style="display: none;">
        <div class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm" @click="importModal = false"></div>

        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative w-full max-w-lg bg-white dark:bg-slate-800 rounded-3xl shadow-2xl z-10 p-6 sm:p-8 border border-slate-100 dark:border-slate-700"
                 @click.away="importModal = false">
                
                <form method="POST" action="{{ route('super_admin.ppdb_applications.import') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="text-center mb-6">
                        <div class="w-14 h-14 rounded-2xl mx-auto flex items-center justify-center text-white text-2xl shadow-lg mb-3 bg-[#0D2461] shadow-blue-900/20">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white font-outfit">Import Data SPMB dari Excel</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Unggah berkas spreadsheet Excel (.xlsx / .xls / .csv) untuk memasukkan data pendaftar sekaligus.</p>
                    </div>

                    <div class="space-y-4 mb-6">
                        <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-2xl border border-dashed border-slate-300 dark:border-slate-600 text-center">
                            <input type="file" name="excel_file" required accept=".xlsx,.xls,.csv"
                                   class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#0D2461] file:text-white hover:file:bg-[#0a1c4f] cursor-pointer">
                            <p class="text-[10px] text-slate-400 mt-2">Maksimal file 10MB. Format didukung: XLSX, XLS, CSV</p>
                        </div>

                        <div class="p-3.5 bg-blue-50 dark:bg-blue-950/30 rounded-xl border border-blue-200 dark:border-blue-900/30 text-xs text-blue-900 dark:text-blue-300">
                            <span class="font-bold block mb-1">Panduan Kolom Header Excel:</span>
                            <p class="text-[11px] text-blue-800 dark:text-blue-400 leading-relaxed">
                                Pastikan baris pertama berisi judul kolom seperti: <strong>No. Pendaftaran, Nama Calon Murid, Nama Orang Tua / Wali, Nomor HP / WhatsApp, Alamat Email, NISN, Pernah PAUD, Status Pendaftaran</strong>. Anda juga bisa mengekspor data terlebih dahulu untuk dijadikan template.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-3 justify-end">
                        <button type="button" @click="importModal = false" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#0D2461] hover:bg-[#0a1c4f] text-white text-xs font-bold uppercase tracking-wider transition-all shadow-md">
                            Mulai Import Data
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
