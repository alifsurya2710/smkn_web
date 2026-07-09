@extends('layouts.dashboard')

@section('title', 'Tambah User Baru')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah User Baru</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Buat akun admin atau editor baru untuk sistem.</p>
    </div>
    <a href="{{ route('super_admin.users') }}"
       class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
    </a>
</div>

<div class="max-w-2xl">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700">
            <h3 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-widest">Informasi User</h3>
        </div>
        <div class="p-6">
            @if($errors->any())
                <div class="mb-5 p-4 bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800/40 rounded-xl">
                    <ul class="space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-xs text-red-600 dark:text-red-400">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('super_admin.users.store') }}"
                  x-data="{
                      showPw: false, showPwC: false, pw: '',
                      get hasMin()    { return this.pw.length >= 8 },
                      get hasUpper()  { return /[A-Z]/.test(this.pw) },
                      get hasLower()  { return /[a-z]/.test(this.pw) },
                      get hasNumber() { return /[0-9]/.test(this.pw) },
                      get hasSymbol() { return /[@$!%*?&]/.test(this.pw) },
                      get allPass()   { return this.hasMin && this.hasUpper && this.hasLower && this.hasNumber && this.hasSymbol },
                  }">
                @csrf
                <div class="space-y-5">

                    {{-- Nama --}}
                    <div>
                        <label class="text-[11px] font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wide">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               placeholder="Masukkan nama lengkap"
                               class="mt-1.5 block w-full px-3 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white dark:bg-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="text-[11px] font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wide">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               placeholder="email@example.com"
                               class="mt-1.5 block w-full px-3 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white dark:bg-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>

                    {{-- Role --}}
                    <div>
                        <label class="text-[11px] font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wide">Role</label>
                        <div class="mt-1.5 grid grid-cols-2 gap-3">
                            @foreach($availableRoles as $role)
                            <label class="relative flex items-center gap-3 p-3.5 border-2 rounded-xl cursor-pointer transition-all
                                          {{ old('role') === $role ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20' : 'border-slate-200 dark:border-slate-600 hover:border-blue-300' }}">
                                <input type="radio" name="role" value="{{ $role }}"
                                       {{ old('role') === $role ? 'checked' : '' }}
                                       class="sr-only peer">
                                <div class="w-9 h-9 rounded-lg flex items-center justify-center
                                            {{ $role === 'admin' ? 'bg-purple-100 dark:bg-purple-900/30' : 'bg-blue-100 dark:bg-blue-900/30' }}">
                                    @if($role === 'admin')
                                        <svg class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    @else
                                        <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800 dark:text-white capitalize">{{ $role }}</p>
                                    <p class="text-[10px] text-slate-400">
                                        {{ $role === 'admin' ? 'Kelola konten & user editor' : 'Kelola berita & galeri' }}
                                    </p>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="text-[11px] font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wide">Password</label>
                        <div class="relative mt-1.5">
                            <input :type="showPw ? 'text' : 'password'" name="password" x-model="pw" required
                                   placeholder="Buat password yang kuat"
                                   class="block w-full pr-10 px-3 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white dark:bg-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <button type="button" @click="showPw = !showPw" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400">
                                <svg x-show="!showPw" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-cloak x-show="showPw" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                        {{-- Checklist --}}
                        <div x-show="pw.length > 0" x-cloak class="mt-2 p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-slate-100 dark:border-slate-600">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Syarat Password</p>
                            <div class="grid grid-cols-2 gap-x-3 gap-y-1.5">
                                <div class="flex items-center gap-1.5">
                                    <div :class="hasMin ? 'bg-emerald-500' : 'bg-slate-300'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors"><svg x-show="hasMin" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div>
                                    <span :class="hasMin ? 'text-emerald-600' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors">Min. 8 karakter</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <div :class="hasUpper ? 'bg-emerald-500' : 'bg-slate-300'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors"><svg x-show="hasUpper" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div>
                                    <span :class="hasUpper ? 'text-emerald-600' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors">Huruf besar (A-Z)</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <div :class="hasLower ? 'bg-emerald-500' : 'bg-slate-300'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors"><svg x-show="hasLower" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div>
                                    <span :class="hasLower ? 'text-emerald-600' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors">Huruf kecil (a-z)</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <div :class="hasNumber ? 'bg-emerald-500' : 'bg-slate-300'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors"><svg x-show="hasNumber" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div>
                                    <span :class="hasNumber ? 'text-emerald-600' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors">Angka (0-9)</span>
                                </div>
                                <div class="flex items-center gap-1.5 col-span-2">
                                    <div :class="hasSymbol ? 'bg-emerald-500' : 'bg-slate-300'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors"><svg x-show="hasSymbol" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div>
                                    <span :class="hasSymbol ? 'text-emerald-600' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors">Simbol (@$!%*?&)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label class="text-[11px] font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wide">Konfirmasi Password</label>
                        <div class="relative mt-1.5">
                            <input :type="showPwC ? 'text' : 'password'" name="password_confirmation" required
                                   placeholder="Ulangi password"
                                   class="block w-full pr-10 px-3 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white dark:bg-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <button type="button" @click="showPwC = !showPwC" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400">
                                <svg x-show="!showPwC" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-cloak x-show="showPwC" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="pt-2 flex gap-3">
                        <button type="submit" :disabled="!allPass"
                                :class="allPass ? 'bg-blue-600 hover:bg-blue-700 cursor-pointer' : 'bg-slate-300 dark:bg-slate-600 cursor-not-allowed'"
                                class="flex-1 py-2.5 text-white text-sm font-semibold rounded-xl transition-colors">
                            Simpan User
                        </button>
                        <a href="{{ route('super_admin.users') }}"
                           class="px-6 py-2.5 border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-300 text-sm font-semibold rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
