<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Galeri Video YouTube') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Kelola video YouTube untuk galeri timeline publik.</p>
            </div>
            <button onclick="document.getElementById('addVideoModal').classList.remove('hidden')" 
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Video
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-400 text-green-700 rounded-lg flex items-center shadow-sm">
                    <svg class="h-5 w-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-400 text-red-700 rounded-lg flex items-center shadow-sm">
                    <svg class="h-5 w-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Video Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($videos as $video)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group">
                        <!-- Thumbnail -->
                        <div class="relative aspect-video overflow-hidden bg-gray-100">
                            <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="https://youtube.com/watch?v={{ $video->youtube_id }}" target="_blank" class="p-3 bg-white/20 backdrop-blur-md rounded-full text-white hover:bg-white/40 transition-colors">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"></path></svg>
                                </a>
                            </div>
                            <div class="absolute top-2 right-2 flex gap-2">
                                <span class="px-2 py-1 {{ $video->is_active ? 'bg-green-500' : 'bg-gray-500' }} text-white text-[10px] font-bold rounded uppercase">
                                    {{ $video->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="p-4">
                            <div class="flex justify-between items-start gap-2">
                                <h3 class="font-bold text-gray-900 line-clamp-1 flex-1">{{ $video->title }}</h3>
                                <span class="text-xs font-medium text-gray-400">#{{ $video->order }}</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $video->description ?: 'Tidak ada deskripsi.' }}</p>
                            
                            <!-- Actions -->
                            <div class="mt-4 flex items-center justify-between border-t border-gray-50 pt-4">
                                <div class="flex gap-2">
                                    <button onclick="editVideo({{ $video->id }}, '{{ addslashes($video->title) }}', 'https://youtube.com/watch?v={{ $video->youtube_id }}', '{{ addslashes($video->description) }}', {{ $video->order }})" 
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <form action="{{ route('super_admin.youtube_videos.toggle', $video->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 {{ $video->is_active ? 'text-amber-600 hover:bg-amber-50' : 'text-green-600 hover:bg-green-50' }} rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                        </button>
                                    </form>
                                </div>
                                <form action="{{ route('super_admin.youtube_videos.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-xl shadow-sm border border-dashed border-gray-300 p-12 text-center">
                        <div class="p-4 bg-gray-50 rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Belum ada video</h3>
                        <p class="text-gray-500 mt-1">Tambahkan video YouTube pertama Anda untuk ditampilkan di galeri.</p>
                        <button onclick="document.getElementById('addVideoModal').classList.remove('hidden')" class="mt-4 text-blue-600 font-semibold hover:underline">Tambah Video</button>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Add Modal -->
    <div id="addVideoModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="document.getElementById('addVideoModal').classList.add('hidden')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('super_admin.youtube_videos.store') }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">Tambah Video YouTube</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Video</label>
                                <input type="text" name="title" required class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Konten Video SMKN 1 Katapang">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">URL YouTube</label>
                                <input type="url" name="youtube_url" required class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="https://www.youtube.com/watch?v=...">
                                <p class="text-xs text-gray-400 mt-1 italic">*Mendukung format link youtube.com atau youtu.be</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (Opsional)</label>
                                <textarea name="description" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                                <input type="number" name="order" value="0" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
                        <button type="button" onclick="document.getElementById('addVideoModal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editVideoModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="document.getElementById('editVideoModal').classList.add('hidden')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="editForm" method="POST">
                    @csrf @method('PUT')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Edit Video YouTube</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Video</label>
                                <input type="text" name="title" id="edit_title" required class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">URL YouTube</label>
                                <input type="url" name="youtube_url" id="edit_url" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Biarkan kosong jika tidak ingin mengubah link">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (Opsional)</label>
                                <textarea name="description" id="edit_description" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                                <input type="number" name="order" id="edit_order" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Perbarui</button>
                        <button type="button" onclick="document.getElementById('editVideoModal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editVideo(id, title, url, description, order) {
            document.getElementById('editForm').action = `/super-admin/youtube-videos/${id}`;
            document.getElementById('edit_title').value = title;
            document.getElementById('edit_url').value = url;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_order').value = order;
            document.getElementById('editVideoModal').classList.remove('hidden');
        }
    </script>
</x-app-layout>
