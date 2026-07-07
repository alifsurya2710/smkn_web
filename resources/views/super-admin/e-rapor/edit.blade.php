@extends('layouts.dashboard')

@section('title', 'Edit E-Rapor')

@section('content')
<nav class="flex mb-8" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-4">
        <li>
            <div class="flex items-center">
                <a href="{{ route('super_admin.rapor.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">Manajemen E-Rapor</a>
            </div>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                <span class="ml-4 text-sm font-medium text-gray-500">Edit Rapor</span>
            </div>
        </li>
    </ol>
</nav>

<div class="bg-white px-6 py-8 shadow sm:rounded-lg">
    <form action="{{ route('super_admin.rapor.update', $rapor->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nisn" class="block text-sm font-medium text-gray-700">NISN Siswa</label>
                <input type="text" id="nisn" name="nisn" value="{{ old('nisn', $rapor->student->nisn ?? $rapor->nisn) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                @error('nisn')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Siswa <span class="text-xs text-gray-400 font-normal">(opsional)</span></label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $rapor->student->name ?? $rapor->nama) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            </div>

            <div>
                <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan <span class="text-xs text-gray-400 font-normal">(opsional)</span></label>
                <input list="majors_list" id="jurusan" name="jurusan" value="{{ old('jurusan', $rapor->student->major->name ?? $rapor->jurusan) }}" placeholder="Ketik jurusan..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                <datalist id="majors_list">
                    @foreach($majors as $major)
                        <option value="{{ $major->name }}">
                    @endforeach
                </datalist>
            </div>

            <div>
                <label for="academic_year" class="block text-sm font-medium text-gray-700">Tahun Ajaran</label>
                <input list="academic_years_list" id="academic_year" name="academic_year" value="{{ old('academic_year', $rapor->academicYear->name ?? $rapor->academic_year) }}" required placeholder="Contoh: 2023/2024" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                <datalist id="academic_years_list">
                    @foreach($academic_years as $ay)
                        <option value="{{ $ay->name }}">
                    @endforeach
                </datalist>
                @error('academic_year')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                <select id="semester" name="semester" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="Ganjil" {{ $rapor->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                    <option value="Genap" {{ $rapor->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                </select>
                @error('semester')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="file" class="block text-sm font-medium text-gray-700">File Rapor (Ganti Jika Diperlukan)</label>
                <input type="file" name="file" id="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-md">
                @if($rapor->file_path)
                    <p class="mt-2 text-xs text-blue-600">File saat ini: {{ $rapor->file_name }}</p>
                @endif
                <p class="mt-1 text-xs text-gray-500 italic">Maksimal 10MB</p>
                @error('file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="teacher_notes" class="block text-sm font-medium text-gray-700">Hasil Rapor / Catatan Wali Kelas</label>
            <textarea id="teacher_notes" name="teacher_notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ $rapor->teacher_notes }}</textarea>
            @error('teacher_notes')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
            <a href="{{ route('super_admin.rapor.index') }}" class="rounded-md bg-white px-3.5 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-all">
                Batal
            </a>
            <button type="submit" class="rounded-md bg-slate-900 px-3.5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-600 transition-all">
                Update Rapor
            </button>
        </div>
    </form>
</div>
@endsection
