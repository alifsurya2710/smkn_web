@extends('layouts.dashboard')

@section('title', 'Tambah Berita')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">Buat Berita Baru</h2>
        </div>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('editor.posts.store') }}" method="POST" enctype="multipart/form-data" id="post-form">
                @csrf
                <div class="grid grid-cols-1 gap-6">

                    {{-- Judul --}}
                    <div>
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Judul Berita</label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="Masukkan judul berita..." value="{{ old('title') }}">
                        </div>
                        @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Kategori</label>
                        <div class="mt-2">
                            <select id="category" name="category" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="news">Berita Umum</option>
                                <option value="activity">Kegiatan Siswa</option>
                                <option value="announcement">Pengumuman</option>
                                <option value="achievement">Prestasi</option>
                            </select>
                        </div>
                    </div>

                    {{-- Program Keahlian --}}
                    <div>
                        <label for="major_id" class="block text-sm font-medium leading-6 text-gray-900">Program Keahlian (Opsional)</label>
                        <div class="mt-2">
                            <select id="major_id" name="major_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="">(Umum / Tidak Berkaitan)</option>
                                @foreach($majors as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- KONTEN dengan Rich Text Editor (Quill.js) --}}
                    <div>
                        <label class="block text-sm font-medium leading-6 text-gray-900 mb-2">Konten Berita</label>

                        {{-- Quill Editor Container --}}
                        <div class="rounded-lg border border-gray-300 overflow-hidden shadow-sm" style="font-family: inherit;">
                            {{-- Toolbar dikustomisasi seperti Word --}}
                            <div id="quill-toolbar" class="bg-gray-50 border-b border-gray-200">
                                <div class="flex flex-wrap items-center gap-0.5 px-2 py-1.5">
                                    {{-- History --}}
                                    <button class="ql-undo quill-btn" title="Undo">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                                    </button>
                                    <button class="ql-redo quill-btn" title="Redo">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10H11a8 8 0 00-8 8v2M21 10l-6 6m6-6l-6-6"/></svg>
                                    </button>

                                    <div class="w-px h-5 bg-gray-300 mx-1"></div>

                                    {{-- Heading --}}
                                    <select class="ql-header quill-select" title="Ukuran Teks">
                                        <option value="1">Judul 1</option>
                                        <option value="2">Judul 2</option>
                                        <option value="3">Judul 3</option>
                                        <option selected>Normal</option>
                                    </select>

                                    {{-- Font Size --}}
                                    <select class="ql-size quill-select" title="Ukuran Huruf">
                                        <option value="small">Kecil</option>
                                        <option selected>Normal</option>
                                        <option value="large">Besar</option>
                                        <option value="huge">Sangat Besar</option>
                                    </select>

                                    <div class="w-px h-5 bg-gray-300 mx-1"></div>

                                    {{-- Bold, Italic, Underline, Strike --}}
                                    <button class="ql-bold quill-btn" title="Tebal (Ctrl+B)"></button>
                                    <button class="ql-italic quill-btn" title="Miring (Ctrl+I)"></button>
                                    <button class="ql-underline quill-btn" title="Garis Bawah (Ctrl+U)"></button>
                                    <button class="ql-strike quill-btn" title="Coret"></button>

                                    <div class="w-px h-5 bg-gray-300 mx-1"></div>

                                    {{-- Color --}}
                                    <select class="ql-color quill-select" title="Warna Teks"></select>
                                    <select class="ql-background quill-select" title="Warna Sorot"></select>

                                    <div class="w-px h-5 bg-gray-300 mx-1"></div>

                                    {{-- Align --}}
                                    <button class="ql-align quill-btn" value="" title="Rata Kiri"></button>
                                    <button class="ql-align quill-btn" value="center" title="Rata Tengah"></button>
                                    <button class="ql-align quill-btn" value="right" title="Rata Kanan"></button>
                                    <button class="ql-align quill-btn" value="justify" title="Rata Kanan-Kiri"></button>

                                    <div class="w-px h-5 bg-gray-300 mx-1"></div>

                                    {{-- Lists --}}
                                    <button class="ql-list quill-btn" value="ordered" title="Daftar Bernomor"></button>
                                    <button class="ql-list quill-btn" value="bullet" title="Daftar Poin"></button>
                                    <button class="ql-indent quill-btn" value="-1" title="Kurangi Indentasi"></button>
                                    <button class="ql-indent quill-btn" value="+1" title="Tambah Indentasi"></button>

                                    <div class="w-px h-5 bg-gray-300 mx-1"></div>

                                    {{-- Link, Image, Blockquote, Code --}}
                                    <button class="ql-link quill-btn" title="Tambah Tautan"></button>
                                    <button class="ql-image quill-btn" title="Sisipkan Gambar"></button>
                                    <button class="ql-blockquote quill-btn" title="Kutipan"></button>
                                    <button class="ql-code-block quill-btn" title="Blok Kode"></button>

                                    <div class="w-px h-5 bg-gray-300 mx-1"></div>

                                    {{-- Clear format --}}
                                    <button class="ql-clean quill-btn" title="Hapus Format"></button>
                                </div>
                            </div>

                            {{-- Editor Area --}}
                            <div id="quill-editor" style="min-height: 380px; font-size: 14px; line-height: 1.8;"></div>
                        </div>

                        {{-- Hidden textarea untuk submit form --}}
                        <textarea id="content" name="content" class="hidden">{{ old('content') }}</textarea>
                        @error('content') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    {{-- Kutipan --}}
                    <div>
                        <label for="quote" class="block text-sm font-medium leading-6 text-gray-900">Kutipan Menarik (Opsional)</label>
                        <div class="mt-2">
                            <textarea id="quote" name="quote" rows="3"
                                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                      placeholder="Masukkan kutipan menarik jika ada...">{{ old('quote') }}</textarea>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Kata-kata ini akan muncul dalam gaya kotak khusus (highlight quote) di dalam artikel.</p>
                    </div>

                    {{-- Tokoh Kutipan --}}
                    <div>
                        <label for="quote_author" class="block text-sm font-medium leading-6 text-gray-900">Tokoh Kutipan (Opsional)</label>
                        <div class="mt-2">
                            <input type="text" name="quote_author" id="quote_author"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="Contoh: Bilqis Ramdhani, Peraih Medali Perak..."
                                   value="{{ old('quote_author') }}">
                        </div>
                    </div>

                    {{-- Gambar --}}
                    <div>
                        <label for="file-upload" class="block text-sm font-medium leading-6 text-gray-900">Gambar Utama (Thumbnail)</label>
                        <div class="mt-2">
                            <div id="drop-zone"
                                 class="flex flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 py-10 cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition-all duration-200"
                                 onclick="document.getElementById('file-upload').click()"
                                 ondragover="event.preventDefault(); this.classList.add('border-blue-500','bg-blue-50')"
                                 ondragleave="this.classList.remove('border-blue-500','bg-blue-50')"
                                 ondrop="handleDrop(event)">
                                <img id="img-preview" class="hidden max-h-48 rounded-lg mb-4 shadow" />
                                <svg id="upload-icon" class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" /></svg>
                                <div id="upload-text" class="mt-3 text-center">
                                    <p class="text-sm font-semibold text-blue-600">Klik untuk upload gambar</p>
                                    <p class="text-xs text-gray-400 mt-1">atau seret & lepas di sini</p>
                                    <p class="text-xs text-gray-400 mt-0.5">PNG, JPG, GIF hingga 2MB</p>
                                </div>
                                <input id="file-upload" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-x-6">
                    <a href="{{ route('editor.posts.index') }}" class="text-sm font-semibold leading-6 text-gray-900">Batal</a>
                    <button type="submit" onclick="syncContent()"
                            class="rounded-md bg-blue-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                        Terbitkan Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Quill.js CDN --}}
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

<style>
    /* ===== LIGHT MODE ===== */
    #quill-toolbar .ql-formats { margin-right: 0 !important; }
    #quill-toolbar button.ql-active,
    #quill-toolbar button:hover { background: #dbeafe !important; border-radius: 4px; }
    #quill-toolbar .ql-stroke { stroke: #4b5563; }
    #quill-toolbar .ql-fill  { fill:   #4b5563; }
    #quill-toolbar button:hover .ql-stroke { stroke: #1d4ed8; }
    #quill-toolbar button:hover .ql-fill   { fill:   #1d4ed8; }
    #quill-toolbar button.ql-active .ql-stroke { stroke: #1d4ed8; }
    #quill-toolbar button.ql-active .ql-fill   { fill:   #1d4ed8; }
    #quill-toolbar select { border: 1px solid #d1d5db; border-radius: 5px; font-size: 12px; color: #374151; padding: 2px 4px; cursor: pointer; background: #fff; }

    #quill-editor { background: #fff; }
    .ql-container { border: none !important; font-family: 'Figtree', sans-serif !important; }
    .ql-editor { padding: 20px 24px !important; color: #111827; }
    .ql-editor h1 { font-size: 2em; font-weight: 800; margin-bottom: 0.5em; }
    .ql-editor h2 { font-size: 1.5em; font-weight: 700; margin-bottom: 0.4em; }
    .ql-editor h3 { font-size: 1.17em; font-weight: 600; margin-bottom: 0.3em; }
    .ql-editor p  { margin-bottom: 0.8em; }
    .ql-editor blockquote { border-left: 4px solid #3b82f6; padding-left: 16px; color: #6b7280; font-style: italic; margin: 16px 0; }
    .ql-editor.ql-blank::before { color: #9ca3af; font-style: normal !important; }
    .ql-snow .ql-toolbar { display: none; }

    /* ===== DARK MODE ===== */
    .dark #quill-toolbar {
        background-color: #1e293b !important;
        border-color: #334155 !important;
    }
    .dark #quill-toolbar .ql-stroke { stroke: #94a3b8; }
    .dark #quill-toolbar .ql-fill  { fill:   #94a3b8; }
    .dark #quill-toolbar button:hover { background: #1d4ed8 !important; border-radius: 4px; }
    .dark #quill-toolbar button:hover .ql-stroke { stroke: #fff; }
    .dark #quill-toolbar button:hover .ql-fill   { fill:   #fff; }
    .dark #quill-toolbar button.ql-active { background: #1e40af !important; border-radius: 4px; }
    .dark #quill-toolbar button.ql-active .ql-stroke { stroke: #93c5fd; }
    .dark #quill-toolbar button.ql-active .ql-fill   { fill:   #93c5fd; }
    .dark #quill-toolbar select {
        background: #1e293b;
        color: #cbd5e1;
        border-color: #475569;
    }
    .dark #quill-toolbar select option { background: #1e293b; color: #cbd5e1; }
    .dark #quill-toolbar .w-px { background-color: #475569 !important; }
    .dark #quill-toolbar svg { color: #94a3b8; }

    .dark #quill-editor { background: #0f172a !important; }
    .dark .ql-container { background: #0f172a !important; }
    .dark .ql-editor { color: #e2e8f0 !important; caret-color: #60a5fa; }
    .dark .ql-editor h1, .dark .ql-editor h2, .dark .ql-editor h3 { color: #f1f5f9; }
    .dark .ql-editor strong { color: #f1f5f9; }
    .dark .ql-editor a { color: #60a5fa; }
    .dark .ql-editor blockquote { border-color: #3b82f6; color: #94a3b8; }
    .dark .ql-editor code, .dark .ql-editor pre { background: #1e293b; color: #7dd3fc; border-radius: 4px; }
    .dark .ql-editor.ql-blank::before { color: #475569 !important; }
    .dark .ql-editor ol li, .dark .ql-editor ul li { color: #e2e8f0; }

    /* Border wrapper dark mode */
    .dark .quill-wrapper { border-color: #334155 !important; }

    /* Quill tooltip dark mode */
    .dark .ql-snow .ql-tooltip { background: #1e293b; color: #e2e8f0; border-color: #334155; }
    .dark .ql-snow .ql-tooltip input { background: #0f172a; color: #e2e8f0; border-color: #475569; }
</style>

<script>
    // Initialize Quill
    var quill = new Quill('#quill-editor', {
        modules: {
            toolbar: '#quill-toolbar',
            history: { delay: 500, maxStack: 100 }
        },
        placeholder: 'Tulis isi berita di sini... Gunakan toolbar di atas untuk memformat teks seperti di Microsoft Word.',
        theme: 'snow'
    });

    // Load existing content (for validation fail)
    var existingContent = document.getElementById('content').value;
    if (existingContent) { quill.root.innerHTML = existingContent; }

    // Sync Quill content → hidden textarea before submit
    function syncContent() {
        document.getElementById('content').value = quill.root.innerHTML;
    }

    // Also sync on form submit
    document.getElementById('post-form').addEventListener('submit', function() {
        syncContent();
    });

    // Undo / Redo custom buttons
    document.querySelector('.ql-undo').addEventListener('click', function() { quill.history.undo(); });
    document.querySelector('.ql-redo').addEventListener('click', function() { quill.history.redo(); });

    // Image preview for upload
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('img-preview').src = e.target.result;
                document.getElementById('img-preview').classList.remove('hidden');
                document.getElementById('upload-icon').classList.add('hidden');
                document.getElementById('upload-text').innerHTML =
                    '<p class="text-sm font-semibold text-green-600">✓ ' + input.files[0].name + '</p>' +
                    '<p class="text-xs text-gray-400 mt-1">Klik untuk mengganti gambar</p>';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function handleDrop(event) {
        event.preventDefault();
        var files = event.dataTransfer.files;
        if (files.length > 0) {
            document.getElementById('file-upload').files = files;
            previewImage(document.getElementById('file-upload'));
        }
        event.currentTarget.classList.remove('border-blue-500','bg-blue-50');
    }
</script>
@endsection
