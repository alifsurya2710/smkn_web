@extends('layouts.landing')

@section('title', 'E-Rapor Saya')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900">E-Rapor Digital</h1>
            <p class="text-sm text-slate-500 mt-2">Daftar nilai dan laporan hasil belajar Anda.</p>
        </div>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-rapor').submit();" class="text-sm font-semibold text-red-600 hover:text-red-500 bg-red-50 px-4 py-2 rounded-lg transition-all">
            Keluar / Selesai
        </a>
        <form id="logout-rapor" action="{{ route('rapor.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-50">
        <h3 class="text-xs font-bold text-slate-900 uppercase tracking-widest">Daftar Rapor</h3>
    </div>
    
    @if($reports->isEmpty())
        <div class="p-12 text-center">
            <div class="h-20 w-20 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <svg class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            </div>
            <h4 class="text-lg font-bold text-slate-900 mb-2">Belum ada rapor diupload</h4>
            <p class="text-sm text-slate-500">Silakan hubungi administrator atau wali kelas jika rapor Anda belum muncul di sini.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 text-left">
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tahun Ajaran</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Semester</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Catatan Guru</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($reports as $report)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-slate-900">{{ $report->academicYear->name ?? $report->academic_year }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $report->semester == 'Ganjil' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                {{ $report->semester }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-xs text-slate-600 max-w-xs truncate">{{ $report->teacher_notes ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4 text-right">
                            @php
                                $signedUrl = URL::temporarySignedRoute(
                                    'rapor.download', 
                                    now()->addMinutes(60), 
                                    ['report' => $report->id]
                                );
                            @endphp
                            <a href="{{ $signedUrl }}" class="inline-flex items-center gap-2 bg-slate-900 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-black transition-all shadow-sm hover:shadow-md">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                Download Rapor
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

    <div class="mt-8 bg-blue-50 border border-blue-100 p-6 rounded-2xl flex gap-4 items-start">
        <div class="p-2 bg-blue-100 rounded-xl text-blue-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
        <div>
            <h4 class="text-sm font-bold text-blue-900 mb-1">Keamanan Data Terjamin</h4>
            <p class="text-xs text-blue-700 leading-relaxed">File rapor disimpan di penyimpanan terenkripsi dan hanya dapat diakses melalui tautan yang aman dan terbatas waktu. Jangan membagikan tautan unduhan kepada siapapun.</p>
        </div>
    </div>
</div>
@endsection
