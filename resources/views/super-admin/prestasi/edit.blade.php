@extends('layouts.dashboard')

@section('title', 'Edit Prestasi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex justify-between items-center">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl">Edit Prestasi: {{ $achievement->title }}</h2>
        <a href="{{ route('super_admin.prestasi.index') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900">&larr; Kembali</a>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('super_admin.prestasi.update', ['prestasi' => $achievement->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Judul Prestasi</label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title" value="{{ old('title', $achievement->title) }}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">Kategori</label>
                        <div class="mt-2">
                            <select id="category_id" name="category_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id', $achievement->category_id) == $category->id) ? 'selected' : '' }}>{{ $category->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="extracurricular_id" class="block text-sm font-medium leading-6 text-gray-900">Ekstrakurikuler (Opsional)</label>
                        <p class="text-xs text-gray-500 mt-1 mb-2">Pilih jika prestasi ini spesifik untuk ekstrakurikuler tertentu. Jika tidak dipilih, akan menjadi prestasi umum sekolah.</p>
                        <div class="mt-2">
                            <select id="extracurricular_id" name="extracurricular_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="">-- Tidak (Prestasi Umum) --</option>
                                @foreach($extracurriculars as $extra)
                                    <option value="{{ $extra->id }}" {{ (old('extracurricular_id', $achievement->extracurricular_id) == $extra->id) ? 'selected' : '' }}>{{ $extra->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-medium leading-6 text-gray-900">Tanggal Diraih</label>
                        <div class="mt-2">
                            <input type="date" name="date" id="date" value="{{ old('date', $achievement->date ? $achievement->date->format('Y-m-d') : '') }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Deskripsi</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="5" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ old('description', $achievement->description) }}</textarea>
                        </div>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Foto Prestasi</label>
                        @if($achievement->image)
                            <div class="mt-2 mb-4">
                                <img src="{{ asset('storage/' . $achievement->image) }}" alt="Preview" class="h-32 w-auto object-cover rounded-md border border-gray-200">
                            </div>
                        @endif
                        <p class="text-xs text-gray-500 mb-2">Biarkan kosong jika tidak ingin mengubah foto saat ini.</p>
                        <div class="mt-1">
                            <input type="file" name="image" id="image" class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-x-6">
                    <a href="{{ route('super_admin.prestasi.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Batal</a>
                    <button type="submit" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">Perbarui Prestasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
