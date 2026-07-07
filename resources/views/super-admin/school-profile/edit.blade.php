@extends('layouts.dashboard')

@section('title', 'Edit Profil Sekolah')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900">CMS Profil Sekolah</h1>
        <p class="mt-1 text-sm text-slate-500">Kelola informasi publik sekolah, visi misi, dan profil pimpinan.</p>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-600 px-6 py-4 rounded-2xl text-sm font-bold flex items-center gap-3 animate-fade-in-down">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('super_admin.school_profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div x-data="{ tab: 'general' }" class="space-y-8">
            <!-- Tab Navigation -->
            <div class="flex gap-2 p-1 bg-slate-100 rounded-2xl w-fit border border-slate-200">
                <button type="button" @click="tab = 'general'" :class="tab === 'general' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest transition-all">General & Hero</button>
                <button type="button" @click="tab = 'vision'" :class="tab === 'vision' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest transition-all">Visi & Misi</button>
                <button type="button" @click="tab = 'principal'" :class="tab === 'principal' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest transition-all">Pimpinan</button>
            </div>

            <!-- Tab Content: General & Hero -->
            <div x-show="tab === 'general'" x-transition class="space-y-6">
                <div class="bg-white rounded-[2rem] p-10 shadow-sm border border-slate-100">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-8">Halaman Tentang Kami (Hero)</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Judul Hero</label>
                            <input type="text" name="about_hero_title" value="{{ old('about_hero_title', $profile->about_hero_title) }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-1">Deskripsi Hero</label>
                            <textarea name="about_hero_description" rows="4" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all">{{ old('about_hero_description', $profile->about_hero_description) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3 ml-1">Gambar Hero</label>
                            <div class="flex items-center gap-6">
                                <div class="h-32 w-48 rounded-2xl bg-slate-100 flex-shrink-0 overflow-hidden border border-slate-100">
                                    @if($profile->about_hero_image)
                                        <img src="{{ asset('storage/' . $profile->about_hero_image) }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-slate-300 italic text-[10px]">NO IMAGE</div>
                                    @endif
                                </div>
                                <input type="file" name="about_hero_image" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-slate-900 file:text-white hover:file:bg-slate-800 transition-all">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Visi & Misi -->
            <div x-show="tab === 'vision'" x-transition class="space-y-6">
                <div class="bg-white rounded-[2rem] p-10 shadow-sm border border-slate-100">
                    <div class="mb-10">
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Visi Sekolah</label>
                        <textarea name="vision" rows="3" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all" placeholder="Tuliskan visi sekolah...">{{ old('vision', $profile->vision) }}</textarea>
                    </div>

                    <div x-data="{ missions: {{ json_encode($profile->mission ?? ['']) }} }">
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Misi Sekolah</label>
                        <div class="space-y-3">
                            <template x-for="(mission, index) in missions" :key="index">
                                <div class="flex gap-3">
                                    <input type="text" name="mission[]" x-model="missions[index]" class="flex-1 bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all" placeholder="Tuliskan poin misi...">
                                    <button type="button" @click="missions.splice(index, 1)" class="p-4 text-slate-400 hover:text-red-500 transition-colors">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                        <button type="button" @click="missions.push('')" class="mt-6 inline-flex items-center gap-2 text-xs font-bold text-blue-600 hover:text-blue-700 bg-blue-50 px-4 py-2 rounded-xl transition-all">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Tambah Poin Misi
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Principal -->
            <div x-show="tab === 'principal'" x-transition class="space-y-6">
                <div class="bg-white rounded-[2rem] p-10 shadow-sm border border-slate-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-6">
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Biodata Pimpinan</h3>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-1">Nama Kepala Sekolah</label>
                                <input type="text" name="principal_name" value="{{ old('principal_name', $profile->principal_name) }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-1">Gelar / Jabatan</label>
                                <input type="text" name="principal_title" value="{{ old('principal_title', $profile->principal_title) }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all" placeholder="Contoh: Kepala Sekolah">
                            </div>
                            <div class="pt-6">
                                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3 ml-1">Foto Pimpinan</label>
                                <div class="flex items-center gap-6">
                                    <div class="h-24 w-24 rounded-2xl bg-slate-100 flex-shrink-0 overflow-hidden border border-slate-100">
                                        @if($profile->principal_photo)
                                            <img src="{{ asset('storage/' . $profile->principal_photo) }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-slate-300 italic text-[10px]">NO PHOTO</div>
                                        @endif
                                    </div>
                                    <input type="file" name="principal_photo" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-slate-900 file:text-white hover:file:bg-slate-800 transition-all">
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mb-4">Sambutan / Pesan</h3>
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1.5 ml-1">Isi Sambutan</label>
                            <textarea name="principal_message" rows="10" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-sm font-medium focus:ring-2 focus:ring-slate-900 transition-all" placeholder="Tuliskan kata sambutan pimpinan...">{{ old('principal_message', $profile->principal_message) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-slate-900 text-white px-10 py-4 rounded-2xl text-sm font-bold uppercase tracking-[0.2em] hover:bg-slate-800 transition-all shadow-xl shadow-slate-900/10">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>
@endsection
