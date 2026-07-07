@extends('layouts.dashboard')

@section('title', 'Audit Trail - Activity Log')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900">Audit Trail (Log Aktivitas)</h1>
    <p class="text-sm text-slate-500">Pantau semua perubahan data penting yang dilakukan oleh staf dan pengajar.</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between">
        <h3 class="text-xs font-bold text-slate-900 uppercase tracking-widest">Aktivitas Terbaru</h3>
        <button class="text-[10px] font-bold text-red-600 uppercase">Bersihkan Log Lama</button>
    </div>
    
    @if(!class_exists('\Spatie\Activitylog\Models\Activity'))
        <div class="p-12 text-center bg-amber-50">
            <div class="h-16 w-16 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-amber-600">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
            <h4 class="text-sm font-bold text-amber-900">Sistem Audit Belum Aktif</h4>
            <p class="text-xs text-amber-700 mt-2 max-w-sm mx-auto line-height-relaxed">Fitur Activity Log memerlukan instalasi library Spatie. Harap jalankan <code>composer require spatie/laravel-activitylog</code> di terminal Anda.</p>
        </div>
    @else
        @php
            $activities = \Spatie\Activitylog\Models\Activity::with('causer')->latest()->paginate(20);
        @endphp

        @if($activities->isEmpty())
             <div class="p-12 text-center">
                <p class="text-xs text-slate-400 italic">Belum ada aktivitas yang tercatat.</p>
             </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Waktu</th>
                            <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pelaku</th>
                            <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Aksi</th>
                            <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Modul</th>
                            <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($activities as $activity)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 text-[11px] text-slate-500 whitespace-nowrap">
                                {{ $activity->created_at->format('d/m/Y H:i:s') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="h-6 w-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-600">
                                        {{ substr($activity->causer->name ?? 'Sys', 0, 1) }}
                                    </div>
                                    <span class="text-xs font-semibold text-slate-700">{{ $activity->causer->name ?? 'System' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-tight 
                                    {{ $activity->description === 'created' ? 'bg-emerald-50 text-emerald-700' : 
                                       ($activity->description === 'updated' ? 'bg-blue-50 text-blue-700' : 'bg-red-50 text-red-700') }}">
                                    {{ $activity->description }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-xs font-medium text-slate-600 uppercase tracking-tighter">
                                {{ class_basename($activity->subject_type) }}
                            </td>
                            <td class="px-6 py-4">
                                <button class="text-[10px] font-bold text-blue-600 hover:text-blue-800 uppercase tracking-widest">Detail JSON</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-50">
                {{ $activities->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
