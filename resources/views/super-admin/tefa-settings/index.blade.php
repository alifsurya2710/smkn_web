@extends('layouts.dashboard')

@section('title', 'Pengaturan Teaching Factory')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-slate-900 font-outfit uppercase tracking-tight">Pengaturan Halaman Teaching Factory (TEFA)</h1>
            <p class="mt-2 text-sm text-slate-700">Atur konten untuk halaman Teaching Factory.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="mt-4 p-4 bg-emerald-50 border-l-4 border-emerald-400 text-emerald-700">
        {{ session('success') }}
    </div>
    @endif

    <div class="mt-8">
        <form action="{{ route('super_admin.tefa_settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Section 1: Top Content -->
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-slate-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-slate-900 font-outfit uppercase text-blue-600">Bagian Atas (Header)</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-600">Konten judul dan deskripsi utama TEFA.</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                    <div class="sm:col-span-3">
                        <label for="tefa_hero_title" class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Judul Besar Hero</label>
                        <div class="mt-2">
                            <input type="text" name="tefa_hero_title" id="tefa_hero_title" value="{{ $settings['tefa_hero_title'] ?? 'TEACHING FACTORY' }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="tefa_hero_subtitle" class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Sub-judul Hero</label>
                        <div class="mt-2 text-blue-600">
                            <input type="text" name="tefa_hero_subtitle" id="tefa_hero_subtitle" value="{{ $settings['tefa_hero_subtitle'] ?? 'SMKN 1 KATAPANG' }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="tefa_title" class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Judul di Bawah Hero (Body)</label>
                        <div class="mt-2">
                            <input type="text" name="tefa_title" id="tefa_title" value="{{ $settings['tefa_title'] ?? 'TEACHING FACTORY SMKN 1 KATAPANG' }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Gambar Hero Banner (Background)</label>
                        <div class="mt-2 space-y-4">
                            @if(isset($settings['tefa_hero_image']))
                                <div class="relative aspect-[4/1] rounded-xl overflow-hidden border bg-slate-100">
                                    <img src="{{ asset('storage/' . $settings['tefa_hero_image']) }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <input type="file" name="tefa_hero_image" class="block w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <div class="sm:col-span-full">
                        <label for="tefa_description" class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Deskripsi Utama</label>
                        <div class="mt-2">
                            <textarea id="tefa_description" name="tefa_description" rows="5" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ $settings['tefa_description'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="tefa_head_name" class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Nama Tokoh Utama</label>
                        <div class="mt-2">
                            <input type="text" name="tefa_head_name" id="tefa_head_name" value="{{ $settings['tefa_head_name'] ?? 'Kepala Program TEFA' }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Foto Tokoh</label>
                        <div class="mt-2 flex items-center gap-x-3">
                            <div class="h-16 w-16 overflow-hidden rounded-lg bg-slate-100 border text-blue-600">
                                @if(isset($settings['tefa_head_photo']))
                                    <img src="{{ asset('storage/' . $settings['tefa_head_photo']) }}" alt="" class="h-full w-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full text-slate-300 inline-block">
                                        <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    </div>
                                @endif
                            </div>
                            <input type="file" name="tefa_head_photo" class="block w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Manfaat TEFA -->
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-slate-900/10 py-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-slate-900 font-outfit uppercase text-emerald-600">Manfaat Teaching Factory</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-600">Atur 6 poin manfaat utama yang ditampilkan dalam bentuk grid.</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2 md:col-span-2">
                    @php
                        $defaults = [
                            1 => ['title' => 'Efisien', 'desc' => 'Meningkatnya efisiensi dan efektivitas pengantaran soft skills dan hard skills kepada peserta'],
                            2 => ['title' => 'Budaya Industri', 'desc' => 'Meningkatnya kolaborasi dengan dunia usaha/dunia industri (DUDI) melalui penyelarasan kurikulum, penyediaan instruktur, alih pengetahuan/teknologi, pengenalan standar dan budaya Industri'],
                            3 => ['title' => 'Kompetensi Guru', 'desc' => 'Meningkatnya kompetensi pendidik dan tenaga kependidikan melalui interaksi dengan dunia usaha/dunia'],
                            4 => ['title' => 'Paradigma', 'desc' => 'Terjadinya perubahan paradigma pembelajaran dan budaya kerja di institusi pendidikan dan pelatihan kejuruan'],
                            5 => ['title' => 'Portofolio', 'desc' => 'Merperkaya portofolio dan pengalaman siswa melalui produk yang telah dibuat dan/atau kegiatan yang telah dilaksanakan'],
                            6 => ['title' => 'Inovasi', 'desc' => 'Mendorong inovasi dan kreativitas dalam proses belajar mengajar yang berorientasi pada kebutuhan pasar'],
                        ];
                    @endphp
                    @for($i = 1; $i <= 6; $i++)
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                             <div class="mb-4">
                                <label for="tefa_benefit_{{ $i }}_title" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Poin {{ $i }} - Judul</label>
                                <input type="text" name="tefa_benefit_{{ $i }}_title" id="tefa_benefit_{{ $i }}_title" value="{{ $settings['tefa_benefit_'.$i.'_title'] ?? $defaults[$i]['title'] }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-xs">
                             </div>
                             <div>
                                <label for="tefa_benefit_{{ $i }}_description" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Deskripsi</label>
                                <textarea id="tefa_benefit_{{ $i }}_description" name="tefa_benefit_{{ $i }}_description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-xs">{{ $settings['tefa_benefit_'.$i.'_description'] ?? $defaults[$i]['desc'] }}</textarea>
                             </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Section 3: Langkah-langkah TEFA -->
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-slate-900/10 py-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-slate-900 font-outfit uppercase text-blue-600">Langkah-langkah TEFA</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-600">Alur atau tahapan pembelajaran Teaching Factory (6 langkah).</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2 md:col-span-2">
                    @php
                        $stepDefaults = [
                            1 => ['title' => '1. Menerima Order', 'desc' => 'Peserta didik berperan sebagai penerima order dan berkomunikasi dengan pemberi order berkaitan dengan pesanan/layanan jasa yang diinginkan.'],
                            2 => ['title' => '2. Menganalisis order', 'desc' => 'Peserta didik berperan melakukan analisis terhadap pesanan pemberi order berkaitan dengan produk/layanan jasa sehubungan dengan gambar detail, spesifikasi, bahan, waktu pengerjaan dan harga.'],
                            3 => ['title' => '3. Menyatakan kesiapan mengerjakan order', 'desc' => 'Peserta didik menyatakan kesiapan untuk melakukan pekerjaan berdasarkan hasil analisis dan kompetensi yang dimilikinya.'],
                            4 => ['title' => '4. Mengerjakan Order', 'desc' => 'Melaksanakan pekerjaan sesuai spesifikasi kerja yang sudah dihasilkan dari proses analisis order.'],
                            5 => ['title' => '5. Mengevaluasi produk', 'desc' => 'Melakukan penilaian terhadap produk/jasa dengan cara membandingkan parameter yang dihasilkan dengan data parameter pada spesifikasi order.'],
                            6 => ['title' => '6. Menyerahkan order', 'desc' => 'Peserta didik menyerahkan order baik produk/jasa setelah yakin semua persyaratan spesifikasi order telah terpenuhi.'],
                        ];
                    @endphp
                    @for($i = 1; $i <= 6; $i++)
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                             <div class="mb-4">
                                <label for="tefa_step_{{ $i }}_title" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Langkah {{ $i }} - Judul</label>
                                <input type="text" name="tefa_step_{{ $i }}_title" id="tefa_step_{{ $i }}_title" value="{{ $settings['tefa_step_'.$i.'_title'] ?? $stepDefaults[$i]['title'] }}" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-xs">
                             </div>
                             <div>
                                <label for="tefa_step_{{ $i }}_description" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Deskripsi Detail</label>
                                <textarea id="tefa_step_{{ $i }}_description" name="tefa_step_{{ $i }}_description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-xs">{{ $settings['tefa_step_'.$i.'_description'] ?? $stepDefaults[$i]['desc'] }}</textarea>
                             </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Section 4: Slider Messages -->
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 py-12 md:grid-cols-3 border-b border-slate-900/10 mb-8">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-slate-900 font-outfit uppercase text-blue-600">Slider Pesan</h2>
                    <p class="mt-1 text-sm leading-6 text-slate-600">Konten pesan atau kutipan di bagian bawah (Slider).</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                    <div class="sm:col-span-full">
                        <label for="tefa_message_1" class="block text-sm font-medium leading-6 text-slate-900 font-semibold text-blue-600">Slide Pesan 1</label>
                        <div class="mt-2">
                            <textarea id="tefa_message_1" name="tefa_message_1" rows="4" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ $settings['tefa_message_1'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-full border-t border-slate-100 pt-8">
                        <label for="tefa_message_2" class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Slide Pesan 2</label>
                        <div class="mt-2">
                            <textarea id="tefa_message_2" name="tefa_message_2" rows="4" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ $settings['tefa_message_2'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-full border-t border-slate-100 pt-8">
                        <label for="tefa_message_3" class="block text-sm font-medium leading-6 text-slate-900 font-semibold">Slide Pesan 3</label>
                        <div class="mt-2">
                            <textarea id="tefa_message_3" name="tefa_message_3" rows="4" class="block w-full rounded-md border-0 py-1.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">{{ $settings['tefa_message_3'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit" class="rounded-xl bg-blue-600 px-10 py-3 text-sm font-bold text-white shadow-lg shadow-blue-500/20 hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-all uppercase tracking-widest">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
