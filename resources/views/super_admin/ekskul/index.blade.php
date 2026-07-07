@extends('layouts.dashboard')

@section('title', 'Manajemen Ekstrakurikuler')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-slate-900">Ekstrakurikuler</h1>
            <p class="mt-2 text-sm text-slate-700">Daftar semua kegiatan ekstrakurikuler sekolah.</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('super_admin.ekskul.create') }}" class="block rounded-md bg-blue-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-blue-500 transition-all">Tambah Ekskul</a>
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
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-slate-300">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 sm:pl-6">Nama Ekskul</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Pembina / Pelatih</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Jadwal</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Status</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Aksi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @foreach($ekskuls as $ekskul)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ $ekskul->image ? asset('storage/' . $ekskul->image) : 'https://ui-avatars.com/api/?name=' . urlencode($ekskul->name) }}" alt="">
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-slate-900">{{ $ekskul->name }}</div>
                                            <div class="text-slate-500">{{ $ekskul->category }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                    <div class="text-slate-900">{{ $ekskul->mentor ?? '-' }}</div>
                                    <div class="text-slate-500 text-xs">{{ $ekskul->coach }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                    {{ $ekskul->schedule ?? '-' }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span class="inline-flex items-center rounded-md {{ $ekskul->is_active ? 'bg-emerald-50 text-emerald-700 ring-emerald-600/20' : 'bg-red-50 text-red-700 ring-red-600/20' }} px-2 py-1 text-xs font-medium ring-1 ring-inset">
                                        {{ $ekskul->is_active ? 'Aktif' : 'Non-aktif' }}
                                    </span>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <div class="flex justify-end gap-x-3">
                                        <a href="{{ route('super_admin.ekskul.edit', $ekskul->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                        <form action="{{ route('super_admin.ekskul.destroy', $ekskul->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ekskul ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
