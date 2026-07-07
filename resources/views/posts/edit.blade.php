@extends('layouts.dashboard')

@section('title', 'Edit Berita')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">Edit Berita: {{ $post->title }}</h2>
        </div>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('editor.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Judul Berita</label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Kategori</label>
                        <div class="mt-2">
                            <select id="category" name="category" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="news" {{ $post->category == 'news' ? 'selected' : '' }}>Berita Umum</option>
                                <option value="activity" {{ $post->category == 'activity' ? 'selected' : '' }}>Kegiatan Siswa</option>
                                <option value="announcement" {{ $post->category == 'announcement' ? 'selected' : '' }}>Pengumuman</option>
                                <option value="achievement" {{ $post->category == 'achievement' ? 'selected' : '' }}>Prestasi</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="major_id" class="block text-sm font-medium leading-6 text-gray-900">Program Keahlian (Opsional)</label>
                        <div class="mt-2">
                            <select id="major_id" name="major_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="">(Umum / Tidak Berkaitan)</option>
                                @foreach($majors as $m)
                                    <option value="{{ $m->id }}" {{ $post->major_id == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium leading-6 text-gray-900">Konten</label>
                        <div class="mt-2">
                            <textarea id="content" name="content" rows="10" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ old('content', $post->content) }}</textarea>
                        </div>
                    </div>

                    <div>
                        <label for="quote" class="block text-sm font-medium leading-6 text-gray-900">Kutipan Menarik (Opsional)</label>
                        <div class="mt-2">
                            <textarea id="quote" name="quote" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" placeholder="Masukkan kutipan menarik jika ada...">{{ old('quote', $post->quote) }}</textarea>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Kata-kata ini akan muncul dalam gaya kotak khusus (highlight quote) di dalam artikel.</p>
                    </div>

                    <div>
                        <label for="quote_author" class="block text-sm font-medium leading-6 text-gray-900">Tokoh Kutipan (Opsional)</label>
                        <div class="mt-2">
                            <input type="text" name="quote_author" id="quote_author" value="{{ old('quote_author', $post->quote_author) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6" placeholder="Contoh: Bilqis Ramdhani, Peraih Medali Perak...">
                        </div>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Gambar Utama (Biarkan kosong jika tidak ingin mengubah)</label>
                        @if($post->image)
                            <div class="mt-2 mb-4">
                                <img src="{{ asset('storage/' . $post->image) }}" class="h-32 w-auto rounded-lg shadow-sm">
                            </div>
                        @endif
                        <div class="mt-2">
                            <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-x-6">
                    <a href="{{ route('editor.posts.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Batal</a>
                    <button type="submit" class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Perbaharui Berita</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
