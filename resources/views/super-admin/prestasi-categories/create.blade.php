@extends('layouts.dashboard')

@section('title', 'Tambah Kategori Prestasi')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl">Buat Kategori Baru</h2>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('super_admin.prestasi_categories.store') }}" method="POST">
                @csrf
                <div>
                    <label for="nama_kategori" class="block text-sm font-medium leading-6 text-gray-900">Nama Kategori</label>
                    <div class="mt-2">
                        <input type="text" name="nama_kategori" id="nama_kategori" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" placeholder="Contoh: Akademik, Olahraga, Seni">
                    </div>
                    @error('nama_kategori')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8 flex items-center justify-end gap-x-6">
                    <a href="{{ route('super_admin.prestasi_categories.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Batal</a>
                    <button type="submit" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
