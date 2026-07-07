@extends('layouts.dashboard')

@section('title', 'Manajemen E-Rapor')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-2xl font-semibold leading-6 text-gray-900">E-Rapor Digital</h1>
        <p class="mt-2 text-sm text-gray-700">Kelola rapor digital siswa. Tambahkan manual atau import melalui Excel.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none flex gap-2">
        <a href="{{ route('super_admin.rapor.recap') }}" class="block rounded-md bg-slate-900 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-black transition-all">
            Recap Masal
        </a>
        <a href="{{ route('super_admin.rapor.create') }}" class="block rounded-md bg-slate-900 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-black transition-all">
            Tambah Manual
        </a>
        <button type="button" onclick="document.getElementById('import-form-container').classList.toggle('hidden')" class="block rounded-md bg-slate-900 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-black transition-all">
            Import CSV
        </button>
        <a href="{{ route('super_admin.rapor.export') }}" class="block rounded-md bg-slate-900 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-black transition-all">
            Export CSV
        </a>
    </div>
</div>

<div id="import-form-container" class="mt-6 hidden bg-white p-6 rounded-lg shadow-sm border border-green-100">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Import Data Rapor (CSV)</h3>
    <form action="{{ route('super_admin.rapor.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="excel_ay" class="block text-sm font-medium text-gray-700">Tahun Ajaran</label>
                <input list="academic_years_list" name="academic_year" id="excel_ay" required placeholder="Contoh: 2023/2024" class="mt-1 block w-full text-sm border-gray-300 rounded-md">
                <datalist id="academic_years_list">
                    @foreach($academic_years as $ay)
                        <option value="{{ $ay->name }}">
                    @endforeach
                </datalist>
            </div>
            <div>
                <label for="excel_sem" class="block text-sm font-medium text-gray-700">Semester</label>
                <select name="semester" id="excel_sem" required class="mt-1 block w-full text-sm border-gray-300 rounded-md">
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                </select>
            </div>
            <div>
                <label for="excel_file" class="block text-sm font-medium text-gray-700">Pilih File CSV</label>
                <input type="file" name="file" id="excel_file" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 border border-gray-300 rounded-md">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-slate-900 text-base font-medium text-white hover:bg-black sm:text-sm transition-all">
                    Upload & Import
                </button>
            </div>
        </div>
        <p class="mt-2 text-xs text-gray-500 italic">Format: NISN, Semester (opsional), Catatan (opsional)</p>
    </form>
</div>

@if(session('success'))
    <div class="mt-6 bg-green-50 border-l-4 border-green-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

<div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Siswa</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Jurusan</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tahun Ajaran</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Semester</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">File</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($reports as $report)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                {{ $report->student->name ?? $report->nama ?? '-' }}<br>
                                <span class="text-xs text-gray-500">NISN: {{ $report->student->nisn ?? $report->nisn ?? '-' }}</span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $report->student->major->name ?? $report->jurusan ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $report->academicYear->name ?? $report->academic_year ?? '-' }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $report->semester }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                @if($report->file_path)
                                    <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                        {{ $report->file_name }}
                                    </span>
                                @else
                                    <span class="text-gray-400">No file</span>
                                @endif
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('super_admin.rapor.edit', $report->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                    <form action="{{ route('super_admin.rapor.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rapor ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-sm text-gray-500">Belum ada data rapor.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
