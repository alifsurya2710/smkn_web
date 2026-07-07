@extends('layouts.dashboard')

@section('title', 'Edit Program Keahlian')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-slate-900">Edit Program Keahlian</h1>
            <p class="mt-2 text-sm text-slate-700">Perbarui informasi program keahlian {{ $jurusan->name }}.</p>
        </div>
    </div>

    <div class="mt-8">
        <form action="{{ route('super_admin.jurusan.update', $jurusan->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-sm ring-1 ring-slate-900/5 sm:rounded-xl md:col-span-2">
            @csrf
            @method('PUT')
            <div class="px-4 py-6 sm:p-8">
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-full">
                        <label for="name" class="block text-sm font-medium leading-6 text-slate-900">Nama Jurusan</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" value="{{ old('name', $jurusan->name) }}" required class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="acronym" class="block text-sm font-medium leading-6 text-slate-900">Akronim</label>
                        <div class="mt-2">
                            <input type="text" name="acronym" id="acronym" value="{{ old('acronym', $jurusan->acronym) }}" placeholder="Contoh: PPLG" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="category" class="block text-sm font-medium leading-6 text-slate-900">Kategori</label>
                        <div class="mt-2">
                            <select name="category" id="category" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                <option value="TECHNOLOGY" {{ old('category', $jurusan->category) == 'TECHNOLOGY' ? 'selected' : '' }}>TECHNOLOGY</option>
                                <option value="AUTOMOTIVE" {{ old('category', $jurusan->category) == 'AUTOMOTIVE' ? 'selected' : '' }}>AUTOMOTIVE</option>
                                <option value="CREATIVE ARTS" {{ old('category', $jurusan->category) == 'CREATIVE ARTS' ? 'selected' : '' }}>CREATIVE ARTS</option>
                                <option value="ELECTRICAL" {{ old('category', $jurusan->category) == 'ELECTRICAL' ? 'selected' : '' }}>ELECTRICAL</option>
                                <option value="MECHANICAL" {{ old('category', $jurusan->category) == 'MECHANICAL' ? 'selected' : '' }}>MECHANICAL</option>
                                <option value="TEXTILE" {{ old('category', $jurusan->category) == 'TEXTILE' ? 'selected' : '' }}>TEXTILE</option>
                                <option value="BUSINESS & FINANCE" {{ old('category', $jurusan->category) == 'BUSINESS & FINANCE' ? 'selected' : '' }}>BUSINESS & FINANCE</option>
                                <option value="HEALTH SERVICES" {{ old('category', $jurusan->category) == 'HEALTH SERVICES' ? 'selected' : '' }}>HEALTH SERVICES</option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="color" class="block text-sm font-medium leading-6 text-slate-900">Warna Badge (Tailwind Class)</label>
                        <div class="mt-2">
                            <input type="text" name="color" id="color" value="{{ old('color', $jurusan->color) }}" placeholder="Contoh: bg-[#2F80ED] atau bg-red-500" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="seats" class="block text-sm font-medium leading-6 text-slate-900">Jumlah Kursi (Seats)</label>
                        <div class="mt-2">
                            <input type="number" name="seats" id="seats" value="{{ old('seats', $jurusan->seats) }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="tagline" class="block text-sm font-medium leading-6 text-slate-900">Tagline / Slogan</label>
                        <div class="mt-2">
                            <input type="text" name="tagline" id="tagline" value="{{ old('tagline', $jurusan->tagline) }}" placeholder="Contoh: Empowering the next generation..." class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="detailed_description" class="block text-sm font-medium leading-6 text-slate-900">Deskripsi Detail (Halaman Detail)</label>
                        <div class="mt-2">
                            <textarea id="detailed_description" name="detailed_description" rows="5" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ old('detailed_description', $jurusan->detailed_description) }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="video_url" class="block text-sm font-medium leading-6 text-slate-900">URL Video (YouTube Embed/Link)</label>
                        <div class="mt-2">
                            <input type="text" name="video_url" id="video_url" value="{{ old('video_url', $jurusan->video_url) }}" placeholder="https://..." class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Curriculum Section -->
                    <div class="sm:col-span-full border-t border-slate-100 pt-6">
                        <label class="block text-sm font-bold leading-6 text-slate-900 mb-4 uppercase tracking-wider">Kurikulum Pembelajaran</label>
                        <div id="curriculum-container" class="space-y-3">
                            @php $curriculum = old('curriculum', $jurusan->curriculum ?? []); @endphp
                            @forelse($curriculum as $item)
                                <div class="flex gap-2">
                                    <input type="text" name="curriculum[]" value="{{ $item }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    <button type="button" onclick="this.parentElement.remove()" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            @empty
                                <div class="flex gap-2">
                                    <input type="text" name="curriculum[]" placeholder="Contoh: Dasar Pemrograman" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    <button type="button" onclick="this.parentElement.remove()" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            @endforelse
                        </div>
                        <button type="button" onclick="addItem('curriculum-container', 'curriculum[]')" class="mt-3 inline-flex items-center text-xs font-semibold text-blue-600 hover:text-blue-500">
                            + Tambah Item Kurikulum
                        </button>
                    </div>

                    <!-- Career Paths Section -->
                    <div class="sm:col-span-full border-t border-slate-100 pt-6">
                        <label class="block text-sm font-bold leading-6 text-slate-900 mb-4 uppercase tracking-wider">Peluang Karir</label>
                        <div id="career-container" class="space-y-3">
                            @php $careers = old('career_opportunities', $jurusan->career_opportunities ?? []); @endphp
                            @forelse($careers as $item)
                                <div class="flex gap-2">
                                    <input type="text" name="career_opportunities[]" value="{{ $item }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    <button type="button" onclick="this.parentElement.remove()" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            @empty
                                <div class="flex gap-2">
                                    <input type="text" name="career_opportunities[]" placeholder="Contoh: Web Developer" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    <button type="button" onclick="this.parentElement.remove()" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            @endforelse
                        </div>
                        <button type="button" onclick="addItem('career-container', 'career_opportunities[]')" class="mt-3 inline-flex items-center text-xs font-semibold text-blue-600 hover:text-blue-500">
                            + Tambah Item Karir
                        </button>
                    </div>

                    <!-- Design Highlights Section -->
                    <div class="sm:col-span-full border-t border-slate-100 pt-6">
                        <label class="block text-sm font-bold leading-6 text-slate-900 mb-4 uppercase tracking-wider text-blue-600">Design & Highlight Controls</label>
                        
                        <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="secondary_color" class="block text-sm font-medium leading-6 text-slate-900">Warna Sekunder (Borders/Accents)</label>
                                <div class="mt-2">
                                    <input type="text" name="secondary_color" id="secondary_color" value="{{ old('secondary_color', $jurusan->secondary_color) }}" placeholder="Contoh: bg-blue-500 atau #2F80ED" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="highlight_icon" class="block text-sm font-medium leading-6 text-slate-900">Highlight Icon (SVG/Class)</label>
                                <div class="mt-2">
                                    <input type="text" name="highlight_icon" id="highlight_icon" value="{{ old('highlight_icon', $jurusan->highlight_icon) }}" placeholder="Contoh: code, settings, tools" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-full">
                                <label for="highlight_title" class="block text-sm font-medium leading-6 text-slate-900">Highlight Title (e.g. Fullstack Focus)</label>
                                <div class="mt-2">
                                    <input type="text" name="highlight_title" id="highlight_title" value="{{ old('highlight_title', $jurusan->highlight_title) }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-full">
                                <label for="highlight_description" class="block text-sm font-medium leading-6 text-slate-900">Highlight Description</label>
                                <div class="mt-2">
                                    <textarea id="highlight_description" name="highlight_description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ old('highlight_description', $jurusan->highlight_description) }}</textarea>
                                </div>
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="head_of_major" class="block text-sm font-medium leading-6 text-slate-900">Kepala Jurusan</label>
                        <div class="mt-2">
                            <input type="text" name="head_of_major" id="head_of_major" value="{{ old('head_of_major', $jurusan->head_of_major) }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-slate-900">Deskripsi</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="5" required class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ old('description', $jurusan->description) }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="image" class="block text-sm font-medium leading-6 text-slate-900">Gambar Cover</label>
                        <div class="mt-2 flex items-center gap-x-4">
                            @if($jurusan->image)
                                <img src="{{ asset('storage/' . $jurusan->image) }}" class="h-20 w-20 object-cover rounded-lg border">
                            @endif
                            <input type="file" name="image" id="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="about_image" class="block text-sm font-medium leading-6 text-slate-900">Gambar About (Samping Teks About)</label>
                        <div class="mt-2 flex items-center gap-x-4">
                            @if($jurusan->about_image)
                                <img src="{{ asset('storage/' . $jurusan->about_image) }}" class="h-20 w-20 object-cover rounded-lg border">
                            @endif
                            <input type="file" name="about_image" id="about_image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="order" class="block text-sm font-medium leading-6 text-slate-900">Urutan (Order)</label>
                        <div class="mt-2">
                            <input type="number" name="order" id="order" value="{{ old('order', $jurusan->order) }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-full flex gap-x-8">
                        <div class="relative flex gap-x-3">
                            <div class="flex h-6 items-center">
                                <input id="is_active" name="is_active" type="checkbox" value="1" {{ $jurusan->is_active ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-600">
                            </div>
                            <div class="text-sm leading-6">
                                <label for="is_active" class="font-medium text-slate-900">Aktif</label>
                                <p class="text-slate-500 text-xs">Tampilkan jurusan ini di website.</p>
                            </div>
                        </div>

                        <div class="relative flex gap-x-3">
                            <div class="flex h-6 items-center">
                                <input id="is_featured" name="is_featured" type="checkbox" value="1" {{ $jurusan->is_featured ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-600">
                            </div>
                            <div class="text-sm leading-6">
                                <label for="is_featured" class="font-medium text-slate-900">Featured</label>
                                <p class="text-slate-500 text-xs">Tampilkan di halaman utama (homepage).</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-slate-900/10 px-4 py-4 sm:px-8">
                <a href="{{ route('super_admin.jurusan.index') }}" class="text-sm font-semibold leading-6 text-slate-900">Batal</a>
                <button type="submit" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all">Perbarui Jurusan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function addItem(containerId, name) {
        const container = document.getElementById(containerId);
        const div = document.createElement('div');
        div.className = 'flex gap-2 mt-2';
        div.innerHTML = `
            <input type="text" name="${name}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
            <button type="button" onclick="this.parentElement.remove()" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
        `;
        container.appendChild(div);
    }
</script>
@endpush
