@extends('layouts.dashboard')

@section('title', 'Manajemen Pengumuman Popup')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-slate-900">Pengumuman Popup</h1>
            <p class="mt-2 text-sm text-slate-700">Kelola pengumuman atau poster yang akan muncul saat pengunjung pertama kali membuka website.</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('super_admin.popup_announcements.create') }}" class="block rounded-md bg-blue-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all">Tambah Pengumuman</a>
        </div>
    </div>

    @if(session('success'))
    <div class="mt-4 p-4 bg-emerald-50 border-l-4 border-emerald-400 text-emerald-700">
        {{ session('success') }}
    </div>
    @endif

    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg bg-white">
                    <table class="min-w-full divide-y divide-slate-300">
                        <thead class="bg-slate-50 text-slate-900">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-black uppercase tracking-widest sm:pl-6 italic">Poster</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-black uppercase tracking-widest italic">Judul</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-black uppercase tracking-widest italic">Periode Aktif</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-black uppercase tracking-widest italic">Status</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse($announcements as $announcement)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 sm:pl-6">
                                    <div class="h-20 w-20 flex-shrink-0">
                                        <img class="h-20 w-20 rounded-lg object-cover shadow-sm border border-slate-200" src="{{ asset('storage/' . $announcement->image) }}" alt="">
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <div class="font-bold text-slate-900">{{ $announcement->title ?? 'Tanpa Judul' }}</div>
                                    @if($announcement->link)
                                    <div class="text-[10px] text-blue-500 font-medium truncate max-w-[200px]">{{ $announcement->link }}</div>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Dari: {{ $announcement->start_date->format('d M Y') }}</span>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sampai: {{ $announcement->end_date->format('d M Y') }}</span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    @php
                                        $today = now()->toDateString();
                                        $isCurrentlyActive = $announcement->is_active && 
                                                           $announcement->start_date->toDateString() <= $today && 
                                                           $announcement->end_date->toDateString() >= $today;
                                    @endphp
                                    
                                    @if($isCurrentlyActive)
                                        <span class="inline-flex items-center rounded-md bg-emerald-50 px-2 py-1 text-[10px] font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/20 uppercase tracking-widest">Aktif Sekarang</span>
                                    @elseif(!$announcement->is_active)
                                        <span class="inline-flex items-center rounded-md bg-slate-50 px-2 py-1 text-[10px] font-bold text-slate-700 ring-1 ring-inset ring-slate-600/20 uppercase tracking-widest">Dinonaktifkan</span>
                                    @elseif($announcement->end_date->toDateString() < $today)
                                        <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-[10px] font-bold text-red-700 ring-1 ring-inset ring-red-600/20 uppercase tracking-widest">Kadaluarsa</span>
                                    @else
                                        <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-[10px] font-bold text-blue-700 ring-1 ring-inset ring-blue-600/20 uppercase tracking-widest">Terjadwal</span>
                                    @endif
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('super_admin.popup_announcements.edit', $announcement->id) }}" class="text-blue-600 hover:text-blue-900 transition-colors uppercase text-[10px] font-black tracking-widest">Edit</a>
                                        <form action="{{ route('super_admin.popup_announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 transition-colors uppercase text-[10px] font-black tracking-widest">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-3 py-10 text-center text-sm text-slate-500 italic">Belum ada pengumuman popup yang dibuat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
