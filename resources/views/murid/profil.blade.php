@extends('layouts.dashboard')

@section('title', 'Profil Saya')

@section('content')
<div x-data="{
    deleteModal: false,
    deletePassword: '',
    deleteLoading: false,
    deleteError: '',
    showDeletePw: false,

    submitDelete() {
        if (!this.deletePassword) {
            this.deleteError = 'Kata sandi wajib diisi.';
            return;
        }
        this.deleteLoading = true;
        this.deleteError = '';
        document.getElementById('delete-account-form').submit();
    }
}" class="max-w-2xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
        <div class="bg-gradient-to-r from-[#0D2461] to-green-700 px-6 py-5 flex items-center gap-4">
            <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center text-white font-extrabold text-2xl overflow-hidden border-2 border-white/30 shrink-0">
                @if(Auth::user()->photo)
                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="w-full h-full object-cover" alt="">
                @else
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                @endif
            </div>
            <div>
                <h1 class="text-lg font-bold text-white font-outfit">{{ Auth::user()->name }}</h1>
                <p class="text-green-200 text-xs">{{ Auth::user()->email }}</p>
                <span class="inline-block mt-1 text-[10px] font-black uppercase tracking-widest bg-green-500/30 text-green-200 px-2 py-0.5 rounded-full border border-green-400/30">Murid Baru</span>
            </div>
        </div>

        {{-- Success / Error Flash --}}
        @if(session('status') === 'profile-updated')
        <div class="mx-6 mt-4 p-3 bg-green-50 border border-green-200 rounded-xl text-green-700 text-xs font-semibold flex items-center gap-2">
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            Profil berhasil diperbarui!
        </div>
        @endif
    </div>

    {{-- Edit Profil Form --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-6">
        <div class="flex items-center gap-2 mb-5 pb-4 border-b border-slate-100 dark:border-slate-700">
            <div class="w-8 h-8 bg-green-100 rounded-xl flex items-center justify-center">
                <svg class="w-4 h-4 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <div>
                <h2 class="text-sm font-bold text-slate-900 dark:text-white">Edit Profil</h2>
                <p class="text-[11px] text-slate-400">Perbarui nama dan email akun Anda</p>
            </div>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PATCH')

            {{-- Foto Profil --}}
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center font-bold text-green-700 text-xl overflow-hidden shrink-0">
                    @if(Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" class="w-full h-full object-cover" alt="">
                    @else
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    @endif
                </div>
                <div class="flex-1">
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Foto Profil</label>
                    <input type="file" name="photo" accept="image/*"
                           class="block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    <p class="text-[10px] text-slate-400 mt-1">JPG, PNG. Maks 2MB</p>
                </div>
            </div>

            {{-- Nama --}}
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-white focus:border-green-500 focus:ring-green-500">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Alamat Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-white focus:border-green-500 focus:ring-green-500">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- No Telp --}}
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Nomor WhatsApp / HP</label>
                <input type="text" name="no_telp" value="{{ old('no_telp', Auth::user()->no_telp ?? '') }}"
                       placeholder="081234567890"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-white focus:border-green-500 focus:ring-green-500">
            </div>

            <button type="submit"
                    class="w-full py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl text-xs uppercase tracking-wider transition-all shadow-sm">
                Simpan Perubahan
            </button>
        </form>
    </div>

    {{-- Ganti Password --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-6">
        <div class="flex items-center gap-2 mb-5 pb-4 border-b border-slate-100 dark:border-slate-700">
            <div class="w-8 h-8 bg-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <div>
                <h2 class="text-sm font-bold text-slate-900 dark:text-white">Ganti Kata Sandi</h2>
                <p class="text-[11px] text-slate-400">Pastikan menggunakan kata sandi yang kuat</p>
            </div>
        </div>

        @if(session('status') === 'password-updated')
        <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-xl text-green-700 text-xs font-semibold flex items-center gap-2">
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            Kata sandi berhasil diperbarui!
        </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Kata Sandi Saat Ini <span class="text-red-500">*</span></label>
                <input type="password" name="current_password" required autocomplete="current-password"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-sm focus:border-blue-500 focus:ring-blue-500">
                @error('current_password', 'updatePassword')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Kata Sandi Baru <span class="text-red-500">*</span></label>
                <input type="password" name="password" required autocomplete="new-password"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-sm focus:border-blue-500 focus:ring-blue-500">
                @error('password', 'updatePassword')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Konfirmasi Sandi Baru <span class="text-red-500">*</span></label>
                <input type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <button type="submit"
                    class="w-full py-3 bg-[#0D2461] hover:bg-[#0a1c4f] text-white font-bold rounded-xl text-xs uppercase tracking-wider transition-all shadow-sm">
                Perbarui Kata Sandi
            </button>
        </form>
    </div>

    {{-- Hapus Akun --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-red-100 dark:border-red-900/30 p-6">
        <div class="flex items-center gap-2 mb-5 pb-4 border-b border-red-100 dark:border-red-900/30">
            <div class="w-8 h-8 bg-red-100 rounded-xl flex items-center justify-center">
                <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </div>
            <div>
                <h2 class="text-sm font-bold text-red-700 dark:text-red-400">Hapus Akun</h2>
                <p class="text-[11px] text-slate-400">Tindakan ini tidak dapat dibatalkan</p>
            </div>
        </div>

        <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">
            Setelah akun dihapus, semua data termasuk formulir pendaftaran SPMB yang telah diisi akan ikut terhapus secara permanen. Masukkan kata sandi Anda untuk mengonfirmasi penghapusan akun.
        </p>

        {{-- Form hapus akun --}}
        <div x-data="{ showPw: false }">
            <form id="delete-account-form" method="POST" action="{{ route('profile.destroy') }}" @submit.prevent="
                if (!$el.querySelector('[name=password]').value) {
                    alert('Kata sandi wajib diisi.');
                    return;
                }
                $el.submit();
            ">
                @csrf
                @method('DELETE')
                @error('password', 'userDeletion')
                <div class="mb-3 p-3 bg-red-50 border border-red-200 rounded-xl text-red-600 text-xs font-semibold">{{ $message }}</div>
                @enderror
                <div class="mb-4">
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                        Masukkan Kata Sandi untuk Konfirmasi <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input :type="showPw ? 'text' : 'password'" name="password" required
                               placeholder="••••••••"
                               class="w-full pl-4 pr-10 py-2.5 rounded-xl border border-red-200 dark:border-red-800/50 bg-white dark:bg-slate-700 text-sm text-slate-900 dark:text-white focus:border-red-400 focus:ring-red-300">
                        <button type="button" @click="showPw = !showPw"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                            <svg x-show="!showPw" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg x-show="showPw" x-cloak class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <button type="submit"
                        class="w-full py-3 bg-red-600 hover:bg-red-700 active:scale-95 text-white font-bold rounded-xl text-xs uppercase tracking-wider transition-all shadow-sm flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Hapus Akun Saya Secara Permanen
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
