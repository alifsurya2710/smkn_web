@extends('layouts.dashboard')

@section('title', 'Edit Ekstrakurikuler')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-slate-900">Edit Ekstrakurikuler</h1>
            <p class="mt-2 text-sm text-slate-700">Perbarui informasi {{ $ekskul->name }}.</p>
        </div>
    </div>

    <div class="mt-8">
        <form action="{{ route('super_admin.ekskul.update', $ekskul->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl md:col-span-2">
            @csrf
            @method('PUT')
            <div class="px-4 py-6 sm:p-8">
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-full">
                        <label for="name" class="block text-sm font-medium leading-6 text-slate-900">Nama Ekskul</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" value="{{ old('name', $ekskul->name) }}" required class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="category" class="block text-sm font-medium leading-6 text-slate-900">Kategori</label>
                        <div class="mt-2">
                            <select name="category" id="category" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                <option value="Sports" {{ old('category', $ekskul->category) == 'Sports' ? 'selected' : '' }}>Sports</option>
                                <option value="Arts & Culture" {{ old('category', $ekskul->category) == 'Arts & Culture' ? 'selected' : '' }}>Arts & Culture</option>
                                <option value="Academic" {{ old('category', $ekskul->category) == 'Academic' ? 'selected' : '' }}>Academic</option>
                                <option value="Religious" {{ old('category', $ekskul->category) == 'Religious' ? 'selected' : '' }}>Religious</option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="mentor" class="block text-sm font-medium leading-6 text-slate-900">Pembina (Guru)</label>
                        <div class="mt-2">
                            <input type="text" name="mentor" id="mentor" value="{{ old('mentor', $ekskul->mentor) }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="coach" class="block text-sm font-medium leading-6 text-slate-900">Pelatih (Eksternal/Internal)</label>
                        <div class="mt-2">
                            <input type="text" name="coach" id="coach" value="{{ old('coach', $ekskul->coach) }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="schedule" class="block text-sm font-medium leading-6 text-slate-900">Jadwal Latihan</label>
                        <div class="mt-2">
                            <input type="text" name="schedule" id="schedule" value="{{ old('schedule', $ekskul->schedule) }}" placeholder="Contoh: Sabtu, 10:00 - selesai" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-slate-900">Deskripsi Kegiatian</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="5" required class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ old('description', $ekskul->description) }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="image" class="block text-sm font-medium leading-6 text-slate-900">Gambar Cover / Logo</label>
                        <div class="mt-2 flex items-center gap-x-4">
                            @if($ekskul->image)
                                <img src="{{ asset('storage/' . $ekskul->image) }}" class="h-20 w-20 object-cover rounded-lg border">
                            @endif
                            <input type="file" name="image" id="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="order" class="block text-sm font-medium leading-6 text-slate-900">Urutan (Order)</label>
                        <div class="mt-2">
                            <input type="number" name="order" id="order" value="{{ old('order', $ekskul->order) }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-full border-t border-slate-900/10 pt-8 mt-8">
                        <h3 class="text-base font-semibold leading-7 text-slate-900">Detail Layout (Desain Premium)</h3>
                        <p class="mt-1 text-sm leading-6 text-slate-600">Konfigurasi konten untuk halaman detail ekskul.</p>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="about_title" class="block text-sm font-medium leading-6 text-slate-900">Judul Bagian "About"</label>
                        <div class="mt-2">
                            <input type="text" name="about_title" id="about_title" value="{{ old('about_title', $ekskul->about_title) }}" placeholder="Contoh: About Our Club" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="about_description" class="block text-sm font-medium leading-6 text-slate-900">Deskripsi Bagian "About"</label>
                        <div class="mt-2">
                            <textarea id="about_description" name="about_description" rows="5" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ old('about_description', $ekskul->about_description) }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="about_image" class="block text-sm font-medium leading-6 text-slate-900">Gambar Bagian "About" (Samping Teks)</label>
                        <div class="mt-2 flex items-center gap-x-4">
                            @if($ekskul->about_image)
                                <img src="{{ asset('storage/' . $ekskul->about_image) }}" class="h-20 w-20 object-cover rounded-lg border">
                            @endif
                            <input type="file" name="about_image" id="about_image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="footer_description" class="block text-sm font-medium leading-6 text-slate-900">Deskripsi Footer (Kustom)</label>
                        <div class="mt-2">
                            <textarea id="footer_description" name="footer_description" rows="3" placeholder="Deskripsi singkat di bagian paling bawah halaman..." class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ old('footer_description', $ekskul->footer_description) }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-full" x-data="{ 
                        links: {{ $ekskul->social_links ? json_encode($ekskul->social_links) : '{}' }},
                        addLink() {
                            let platform = prompt('Platform (instagram, twitter, facebook, youtube):');
                            if(platform) {
                                let url = prompt('URL:');
                                if(url) this.links[platform] = url;
                            }
                        },
                        removeLink(platform) {
                            delete this.links[platform];
                        }
                    }">
                        <label class="block text-sm font-medium leading-6 text-slate-900">Social Links (Instagram, etc)</label>
                        <div class="mt-4 space-y-2">
                            <template x-for="(url, platform) in links" :key="platform">
                                <div class="flex items-center gap-2">
                                    <span class="px-3 py-1 bg-slate-100 rounded text-xs font-bold uppercase" x-text="platform"></span>
                                    <input type="hidden" :name="'social_links['+platform+']'" :value="url">
                                    <span class="text-xs text-slate-500 truncate flex-1" x-text="url"></span>
                                    <button type="button" @click="removeLink(platform)" class="text-red-500 hover:text-red-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            </template>
                            <button type="button" @click="addLink()" class="mt-2 inline-flex items-center gap-x-1.5 text-xs font-semibold leading-6 text-blue-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Link Sosial
                            </button>
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <div class="relative flex gap-x-3">
                            <div class="flex h-6 items-center">
                                <input id="is_active" name="is_active" type="checkbox" value="1" {{ $ekskul->is_active ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-600">
                            </div>
                            <div class="text-sm leading-6">
                                <label for="is_active" class="font-medium text-slate-900">Aktif</label>
                                <p class="text-slate-500 text-xs">Tampilkan ekskul ini di website.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-slate-900/10 px-4 py-4 sm:px-8">
                <a href="{{ route('super_admin.ekskul.index') }}" class="text-sm font-semibold leading-6 text-slate-900">Batal</a>
                <button type="submit" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all">Perbarui Ekskul</button>
            </div>
        </form>
    </div>
</div>
@endsection
