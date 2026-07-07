@extends('layouts.dashboard')

@section('title', 'Manajemen Hero & Landing')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-slate-900">Manajemen Hero & Landing</h1>
            <p class="mt-2 text-sm text-slate-700">Atur konten utama yang muncul di halaman depan website.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="mt-4 p-4 bg-emerald-50 border-l-4 border-emerald-400 text-emerald-700">
        {{ session('success') }}
    </div>
    @endif

    <div class="mt-8">
        <form action="{{ route('super_admin.landing_settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-slate-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-slate-900">Hero Section</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-600">Bagian pertama yang dilihat pengunjung saat membuka website.</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                    <div class="sm:col-span-full">
                        <label for="landing_hero_title" class="block text-sm font-medium leading-6 text-slate-900">Judul Hero (Gunakan &lt;br&gt; untuk baris baru)</label>
                        <div class="mt-2">
                            <input type="text" name="landing_hero_title" id="landing_hero_title" value="{{ $settings['landing_hero_title'] ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="landing_hero_description" class="block text-sm font-medium leading-6 text-slate-900">Deskripsi Hero</label>
                        <div class="mt-2">
                            <textarea id="landing_hero_description" name="landing_hero_description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ $settings['landing_hero_description'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label class="block text-sm font-semibold leading-6 text-slate-900 mb-4">Background Hero (Video / GIF)</label>
                        <div class="p-6 bg-blue-50/50 rounded-2xl border-2 border-dashed border-blue-200">
                            <div class="flex flex-col md:flex-row gap-8 items-start">
                                <div class="w-full md:w-1/2">
                                    <p class="text-xs text-blue-600 font-bold uppercase tracking-widest mb-3 italic">Prioritas Utama</p>
                                    <p class="text-sm text-slate-600 mb-4 leading-relaxed">
                                        Jika Anda mengunggah video atau GIF di sini, maka slider gambar di bawah akan **dinonaktifkan** dan diganti dengan background video/GIF yang elegan.
                                    </p>
                                    <input type="file" name="landing_hero_video" id="landing_hero_video" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition-all">
                                    <p class="mt-2 text-[10px] text-slate-400 font-medium">Format match: MP4, WEBM, GIF. Max 20MB.</p>
                                </div>
                                <div class="w-full md:w-1/2">
                                    @if(isset($settings['landing_hero_video']))
                                        <div class="rounded-xl overflow-hidden shadow-lg border border-blue-100 bg-white p-2">
                                            @php
                                                $path = $settings['landing_hero_video'];
                                                $ext = pathinfo($path, PATHINFO_EXTENSION);
                                            @endphp
                                            @if($ext == 'mp4' || $ext == 'webm')
                                                <video autoplay muted loop class="w-full h-32 object-cover rounded-lg">
                                                    <source src="{{ asset('storage/' . $path) }}" type="video/{{ $ext }}">
                                                </video>
                                            @else
                                                <img src="{{ asset('storage/' . $path) }}" class="w-full h-32 object-cover rounded-lg">
                                            @endif
                                            <div class="mt-2 flex justify-between items-center px-1">
                                                <span class="text-[9px] font-black text-blue-600 uppercase tracking-widest">Preview Aktif</span>
                                                <label class="flex items-center gap-2 cursor-pointer">
                                                     <input type="checkbox" name="delete_hero_video" value="1" class="rounded border-slate-300 text-red-600 focus:ring-red-600 h-3 w-3">
                                                     <span class="text-[9px] font-bold text-red-600 uppercase tracking-widest">Hapus</span>
                                                </label>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-center justify-center h-32 bg-slate-100 rounded-xl border-2 border-dashed border-slate-200">
                                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Belum ada video/GIF</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-full opacity-60 hover:opacity-100 transition-opacity">
                        <label class="block text-sm font-semibold leading-6 text-slate-900 mb-4">Gambar Hero Slider (Backup / Alternatif)</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @for($i = 1; $i <= 3; $i++)
                            <div class="space-y-4 p-4 bg-slate-50 rounded-xl border border-slate-200">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Slide {{ $i }}</span>
                                <div class="relative aspect-video rounded-lg overflow-hidden bg-slate-200 border border-slate-300">
                                    @if(isset($settings['landing_hero_image_'.$i]))
                                        <img src="{{ asset('storage/' . $settings['landing_hero_image_'.$i]) }}" alt="Hero {{ $i }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="flex items-center justify-center h-full text-slate-400">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <input type="file" name="landing_hero_image_{{ $i }}" class="block w-full text-[10px] text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-[10px] file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition-all">
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-slate-900/10 py-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-slate-900">Hero Halaman Ekskul</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-600">Atur tampilan bagian atas di halaman Ekstrakurikuler.</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                    <div class="sm:col-span-full">
                        <label for="extracurricular_hero_title" class="block text-sm font-medium leading-6 text-slate-900">Judul Hero Ekskul</label>
                        <div class="mt-2">
                            <input type="text" name="extracurricular_hero_title" id="extracurricular_hero_title" value="{{ $settings['extracurricular_hero_title'] ?? 'Ekstrakurikuler' }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="extracurricular_hero_description" class="block text-sm font-medium leading-6 text-slate-900">Deskripsi Hero Ekskul</label>
                        <div class="mt-2">
                            <textarea id="extracurricular_hero_description" name="extracurricular_hero_description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ $settings['extracurricular_hero_description'] ?? 'Discover your passion, build new skills, and create lasting memories with our diverse range of student-led clubs and organizations.' }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label class="block text-sm font-medium leading-6 text-slate-900">Gambar Hero Ekskul</label>
                        <div class="mt-2 flex items-center gap-x-3">
                             @if(isset($settings['extracurricular_hero_image']))
                                <img src="{{ asset('storage/' . $settings['extracurricular_hero_image']) }}" alt="Hero Ekskul" class="h-20 w-32 object-cover rounded-lg border">
                             @endif
                             <input type="file" name="extracurricular_hero_image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-slate-900/10 py-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-slate-900">Hero Halaman Jurusan</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-600">Atur tampilan bagian atas di halaman Program Keahlian / Jurusan.</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                    <div class="sm:col-span-full">
                        <label for="major_hero_title" class="block text-sm font-medium leading-6 text-slate-900">Judul Hero Jurusan (Gunakan &lt;span&gt; untuk warna gradasi)</label>
                        <div class="mt-2">
                            <input type="text" name="major_hero_title" id="major_hero_title" value="{{ $settings['major_hero_title'] ?? 'PROGRAM <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300">JURUSAN</span>' }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="major_hero_description" class="block text-sm font-medium leading-6 text-slate-900">Deskripsi Hero Jurusan</label>
                        <div class="mt-2">
                            <textarea id="major_hero_description" name="major_hero_description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ $settings['major_hero_description'] ?? 'Temukan jurusan yang tepat untuk membangun masa depan Anda. Setiap program dirancang dengan kurikulum berstandar industri dan didukung pembelajaran praktis di laboratorium dengan fasilitas terkini' }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label class="block text-sm font-medium leading-6 text-slate-900">Gambar Hero Jurusan</label>
                        <div class="mt-2 flex items-center gap-x-3">
                             @if(isset($settings['major_hero_image']))
                                <img src="{{ asset('storage/' . $settings['major_hero_image']) }}" alt="Hero Jurusan" class="h-20 w-32 object-cover rounded-lg border">
                             @endif
                             <input type="file" name="major_hero_image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-slate-900/10 py-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-slate-900">Statistik Sekolah</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-600">Angka pencapaian yang ditampilkan di bawah Hero.</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-4 md:col-span-2">
                    <div class="sm:col-span-1">
                        <label for="stats_siswa_count" class="block text-sm font-medium leading-6 text-slate-900">Jumlah Siswa</label>
                        <div class="mt-2">
                            <input type="text" name="stats_siswa_count" id="stats_siswa_count" value="{{ $settings['stats_siswa_count'] ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="stats_pengajar_count" class="block text-sm font-medium leading-6 text-slate-900">Jumlah Pengajar</label>
                        <div class="mt-2">
                            <input type="text" name="stats_pengajar_count" id="stats_pengajar_count" value="{{ $settings['stats_pengajar_count'] ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="stats_alumni_working_count" class="block text-sm font-medium leading-6 text-slate-900">Alumni Bekerja</label>
                        <div class="mt-2">
                            <input type="text" name="stats_alumni_working_count" id="stats_alumni_working_count" value="{{ $settings['stats_alumni_working_count'] ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <label for="stats_mitra_count" class="block text-sm font-medium leading-6 text-slate-900">Mitra Industri</label>
                        <div class="mt-2">
                            <input type="text" name="stats_mitra_count" id="stats_mitra_count" value="{{ $settings['stats_mitra_count'] ?? '' }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit" class="rounded-md bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
