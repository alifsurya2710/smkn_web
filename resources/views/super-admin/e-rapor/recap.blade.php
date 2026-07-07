@extends('layouts.dashboard')

@section('title', 'Recap E-Rapor Siswa')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-2xl font-semibold leading-6 text-gray-900">Recap E-Rapor Digital</h1>
        <p class="mt-2 text-sm text-gray-700">Dapatkan data semua siswa dari jurusan tertentu dan isi rapor secara masal.</p>
    </div>
</div>

<div class="mt-6 bg-white p-6 rounded-lg shadow-sm border border-gray-100">
    <form action="{{ route('super_admin.rapor.recap') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
        <div>
            <label for="major_id" class="block text-sm font-medium text-gray-700">Jurusan</label>
            <select id="major_id" name="major_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                <option value="">-- Pilih Jurusan --</option>
                @foreach($majors as $major)
                    <option value="{{ $major->id }}" {{ $major_id == $major->id ? 'selected' : '' }}>{{ $major->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="academic_year_id" class="block text-sm font-medium text-gray-700">Tahun Ajaran</label>
            <select id="academic_year_id" name="academic_year_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                <option value="">-- Pilih Tahun --</option>
                @foreach($academic_years as $ay)
                    <option value="{{ $ay->id }}" {{ $academic_year_id == $ay->id ? 'selected' : '' }}>{{ $ay->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
            <select id="semester" name="semester" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                <option value="Ganjil" {{ $semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                <option value="Genap" {{ $semester == 'Genap' ? 'selected' : '' }}>Genap</option>
            </select>
        </div>
        <div>
            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-slate-900 text-base font-medium text-white hover:bg-black sm:text-sm transition-all focus:ring-2 focus:ring-slate-500">
                Tampilkan Siswa
            </button>
        </div>
    </form>
</div>

@if($students->isNotEmpty())
<div class="mt-8 bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
    <div class="px-4 py-6 sm:px-8">
        <form action="{{ route('super_admin.rapor.bulk_store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="major_id" value="{{ $major_id }}">
            <input type="hidden" name="academic_year_id" value="{{ $academic_year_id }}">
            <input type="hidden" name="semester" value="{{ $semester }}">

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">Siswa</th>
                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status Saat Ini</th>
                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Input Manual / Upload</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($students as $index => $student)
                        @php $report = $student->reports->first(); @endphp
                        <tr>
                            <td class="py-4 pl-4 pr-3 text-sm">
                                <span class="font-medium text-gray-900">{{ $student->name }}</span><br>
                                <span class="text-gray-500 text-xs">{{ $student->nisn }}</span>
                                <input type="hidden" name="reports[{{ $index }}][student_id]" value="{{ $student->id }}">
                            </td>
                            <td class="px-3 py-4 text-xs">
                                @if($report)
                                    <span class="text-green-600 font-semibold italic">Sudah ada rapor</span>
                                    @if($report->file_path)
                                        <br><span class="text-blue-500">{{ $report->file_name }}</span>
                                    @endif
                                @else
                                    <span class="text-gray-400 italic">Belum ada</span>
                                @endif
                            </td>
                            <td class="px-3 py-4 text-sm">
                                <div class="space-y-2">
                                    <textarea name="reports[{{ $index }}][teacher_notes]" rows="2" placeholder="Catatan manual..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-xs tracking-tight">{{ $report->teacher_notes ?? '' }}</textarea>
                                    <input type="file" name="reports[{{ $index }}][file]" class="text-xs file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8 flex items-center justify-between border-t border-gray-100 pt-6">
                <p class="text-xs text-gray-500 italic">* Siswa yang tidak diisi catatan atau file tidak akan diproses.</p>
                <button type="submit" class="rounded-md bg-slate-900 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-black transition-all focus:ring-2 focus:ring-slate-500">
                    Simpan Semua Rekap
                </button>
            </div>
        </form>
    </div>
</div>
@elseif($major_id && $academic_year_id)
<div class="mt-8 text-center bg-white py-12 rounded-xl shadow-sm ring-1 ring-gray-900/5">
    <p class="text-sm text-gray-500">Tidak ada siswa ditemukan untuk jurusan ini.</p>
</div>
@endif

@endsection
