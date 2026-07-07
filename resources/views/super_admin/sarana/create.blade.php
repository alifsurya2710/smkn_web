@extends('layouts.dashboard')

@section('title', 'Tambah Sarana & Prasarana')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-slate-900">Tambah Sarana & Prasarana</h1>
            <p class="mt-2 text-sm text-slate-700">Buat fasilitas baru sekolah.</p>
        </div>
    </div>

    <div class="mt-8">
        <form action="{{ route('super_admin.sarana.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl md:col-span-2">
            @csrf
            <div class="px-4 py-6 sm:p-8">
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-full">
                        <label for="name" class="block text-sm font-medium leading-6 text-slate-900">Nama Fasilitas</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="icon" class="block text-sm font-medium leading-6 text-slate-900">Icon (FontAwesome/SVG class)</label>
                        <div class="mt-2">
                            <input type="text" name="icon" id="icon" value="{{ old('icon') }}" placeholder="Contoh: fas fa-school" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="order" class="block text-sm font-medium leading-6 text-slate-900">Urutan (Order)</label>
                        <div class="mt-2">
                            <input type="number" name="order" id="order" value="{{ old('order', 0) }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-slate-900">Deskripsi / Detail Fasilitas</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="5" required class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="image" class="block text-sm font-medium leading-6 text-slate-900">Gambar Fasilitas</label>
                        <div class="mt-2">
                            <input type="file" name="image" id="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <div class="relative flex gap-x-3">
                            <div class="flex h-6 items-center">
                                <input id="is_active" name="is_active" type="checkbox" value="1" checked class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-600">
                            </div>
                            <div class="text-sm leading-6">
                                <label for="is_active" class="font-medium text-slate-900">Aktif</label>
                                <p class="text-slate-500 text-xs">Tampilkan fasilitas ini di website.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-slate-900/10 px-4 py-4 sm:px-8">
                <a href="{{ route('super_admin.sarana.index') }}" class="text-sm font-semibold leading-6 text-slate-900">Batal</a>
                <button type="submit" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all">Simpan Sarana</button>
            </div>
        </form>
    </div>
</div>
@endsection
