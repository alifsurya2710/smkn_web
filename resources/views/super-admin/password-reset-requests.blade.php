@extends('layouts.dashboard')

@section('title', 'Permintaan Reset Kata Sandi')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Permintaan Reset Kata Sandi</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Kelola permintaan reset password dari pengguna.</p>
    </div>
    @if($pendingCount > 0)
        <span class="inline-flex items-center gap-2 bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-bold">
            <span class="w-2 h-2 bg-red-500 rounded-full animate-ping inline-flex"></span>
            {{ $pendingCount }} Permintaan Pending
        </span>
    @endif
</div>

@if(session('success'))
    <div class="mb-6 flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-100">
        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <p class="text-sm font-semibold text-emerald-700">{{ session('success') }}</p>
    </div>
@endif

<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700">
        <h3 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-widest">Daftar Permintaan</h3>
    </div>

    @if($requests->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
            <h4 class="text-sm font-bold text-slate-700 dark:text-slate-300">Tidak ada permintaan</h4>
            <p class="text-xs text-slate-400 mt-1">Belum ada pengguna yang mengajukan reset kata sandi.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-700/50">
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pengguna</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Role</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Waktu Permintaan</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                    @foreach($requests as $req)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors {{ $req->status === 'pending' ? 'bg-amber-50/30 dark:bg-amber-900/10' : '' }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold text-sm overflow-hidden flex-shrink-0">
                                    @if($req->user->photo)
                                        <img src="{{ asset('storage/' . $req->user->photo) }}" class="w-full h-full object-cover" alt="">
                                    @else
                                        {{ strtoupper(substr($req->user->name, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $req->user->name }}</p>
                                    <p class="text-[11px] text-slate-400">{{ $req->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-slate-100 dark:bg-slate-700 px-2 py-1 text-[9px] font-bold text-slate-600 dark:text-slate-300 uppercase tracking-tight">
                                {{ $req->user->roles->first()->name ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-xs text-slate-700 dark:text-slate-300">{{ $req->created_at->format('d M Y') }}</p>
                            <p class="text-[10px] text-slate-400">{{ $req->created_at->format('H:i') }} WIB &bull; {{ $req->created_at->diffForHumans() }}</p>
                        </td>
                        <td class="px-6 py-4">
                            @if($req->status === 'pending')
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 dark:bg-amber-900/30 px-2.5 py-1 text-[10px] font-bold text-amber-700 dark:text-amber-400 uppercase tracking-tight ring-1 ring-amber-200 dark:ring-amber-700">
                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                    Pending
                                </span>
                            @else
                                <div>
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 dark:bg-emerald-900/30 px-2.5 py-1 text-[10px] font-bold text-emerald-700 dark:text-emerald-400 uppercase tracking-tight ring-1 ring-emerald-200 dark:ring-emerald-700">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        Selesai
                                    </span>
                                    @if($req->resolver)
                                        <p class="text-[10px] text-slate-400 mt-1">oleh {{ $req->resolver->name }}</p>
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($req->status === 'pending')
                                <div x-data="{ modalOpen: false }" class="flex items-center gap-2">
                                    <button @click="modalOpen = true"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                        </svg>
                                        Reset Password
                                    </button>
                                    {{-- Tombol Hapus untuk pending --}}
                                    @php
                                        $destroyRoutePending = auth()->user()->hasRole(['super_admin','super-admin'])
                                            ? route('super_admin.password_reset_requests.destroy', $req)
                                            : route('admin.password_reset_requests.destroy', $req);
                                    @endphp
                                    <form method="POST" action="{{ $destroyRoutePending }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Tolak dan hapus permintaan ini?')"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-600 border border-red-200 dark:border-red-800/40 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            Tolak
                                        </button>
                                    </form>

                                    {{-- Modal Reset Password --}}
                                    <div x-show="modalOpen" x-cloak
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
                                        <div @click.away="modalOpen = false"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0 scale-95"
                                             x-transition:enter-end="opacity-100 scale-100"
                                             class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl w-full max-w-md p-6"
                                             x-data="{
                                                showPw: false, showPwC: false, pw: '',
                                                get hasMin()    { return this.pw.length >= 8 },
                                                get hasUpper()  { return /[A-Z]/.test(this.pw) },
                                                get hasLower()  { return /[a-z]/.test(this.pw) },
                                                get hasNumber() { return /[0-9]/.test(this.pw) },
                                                get hasSymbol() { return /[@$!%*?&]/.test(this.pw) },
                                                get allPass()   { return this.hasMin && this.hasUpper && this.hasLower && this.hasNumber && this.hasSymbol },
                                             }">
                                            <div class="flex items-center gap-3 mb-5">
                                                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                                </div>
                                                <div>
                                                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">Reset Kata Sandi</h3>
                                                    <p class="text-xs text-slate-500 dark:text-slate-400">untuk {{ $req->user->name }}</p>
                                                </div>
                                            </div>
                                            @php
                                                $resolveRoute = auth()->user()->hasRole(['super_admin','super-admin'])
                                                    ? route('super_admin.password_reset_requests.resolve', $req)
                                                    : route('admin.password_reset_requests.resolve', $req);
                                            @endphp
                                            <form method="POST" action="{{ $resolveRoute }}">
                                                @csrf
                                                <div class="space-y-4">
                                                    {{-- Input password baru --}}
                                                    <div>
                                                        <label class="text-[11px] font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wide">Password Baru</label>
                                                        <div class="relative mt-1.5">
                                                            <input :type="showPw ? 'text' : 'password'" name="new_password" x-model="pw" required placeholder="Buat password yang kuat"
                                                                   class="block w-full pr-10 px-3 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white dark:bg-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                                            <button type="button" @click="showPw = !showPw" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                                                                <svg x-show="!showPw" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                                <svg x-cloak x-show="showPw" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                                            </button>
                                                        </div>
                                                        {{-- Checklist syarat password --}}
                                                        <div x-show="pw.length > 0" x-cloak
                                                             x-transition:enter="transition ease-out duration-200"
                                                             x-transition:enter-start="opacity-0 -translate-y-1"
                                                             x-transition:enter-end="opacity-100 translate-y-0"
                                                             class="mt-2 p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-slate-100 dark:border-slate-600">
                                                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Syarat Kata Sandi</p>
                                                            <div class="grid grid-cols-2 gap-x-3 gap-y-1.5">
                                                                <div class="flex items-center gap-1.5">
                                                                    <div :class="hasMin ? 'bg-emerald-500' : 'bg-slate-300 dark:bg-slate-600'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors duration-200"><svg x-show="hasMin" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div>
                                                                    <span :class="hasMin ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors duration-200">Min. 8 karakter</span>
                                                                </div>
                                                                <div class="flex items-center gap-1.5">
                                                                    <div :class="hasUpper ? 'bg-emerald-500' : 'bg-slate-300 dark:bg-slate-600'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors duration-200"><svg x-show="hasUpper" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div>
                                                                    <span :class="hasUpper ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors duration-200">Huruf besar (A-Z)</span>
                                                                </div>
                                                                <div class="flex items-center gap-1.5">
                                                                    <div :class="hasLower ? 'bg-emerald-500' : 'bg-slate-300 dark:bg-slate-600'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors duration-200"><svg x-show="hasLower" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div>
                                                                    <span :class="hasLower ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors duration-200">Huruf kecil (a-z)</span>
                                                                </div>
                                                                <div class="flex items-center gap-1.5">
                                                                    <div :class="hasNumber ? 'bg-emerald-500' : 'bg-slate-300 dark:bg-slate-600'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors duration-200"><svg x-show="hasNumber" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div>
                                                                    <span :class="hasNumber ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors duration-200">Angka (0-9)</span>
                                                                </div>
                                                                <div class="flex items-center gap-1.5 col-span-2">
                                                                    <div :class="hasSymbol ? 'bg-emerald-500' : 'bg-slate-300 dark:bg-slate-600'" class="w-3.5 h-3.5 rounded-full flex items-center justify-center flex-shrink-0 transition-colors duration-200"><svg x-show="hasSymbol" class="w-2 h-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg></div>
                                                                    <span :class="hasSymbol ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-400'" class="text-[10px] font-semibold transition-colors duration-200">Simbol (@$!%*?&)</span>
                                                                </div>
                                                            </div>
                                                            <div class="mt-2 pt-2 border-t border-slate-100 dark:border-slate-600">
                                                                <div class="flex gap-1">
                                                                    <div :class="[hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length >= 1 ? 'bg-red-400' : 'bg-slate-200 dark:bg-slate-600'" class="h-1 flex-1 rounded-full transition-colors duration-300"></div>
                                                                    <div :class="[hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length >= 2 ? 'bg-orange-400' : 'bg-slate-200 dark:bg-slate-600'" class="h-1 flex-1 rounded-full transition-colors duration-300"></div>
                                                                    <div :class="[hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length >= 3 ? 'bg-yellow-400' : 'bg-slate-200 dark:bg-slate-600'" class="h-1 flex-1 rounded-full transition-colors duration-300"></div>
                                                                    <div :class="[hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length >= 4 ? 'bg-blue-400' : 'bg-slate-200 dark:bg-slate-600'" class="h-1 flex-1 rounded-full transition-colors duration-300"></div>
                                                                    <div :class="allPass ? 'bg-emerald-500' : 'bg-slate-200 dark:bg-slate-600'" class="h-1 flex-1 rounded-full transition-colors duration-300"></div>
                                                                </div>
                                                                <p class="text-[9px] font-bold mt-1" :class="{ 'text-red-500': [hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length <= 1, 'text-orange-500': [hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length === 2, 'text-yellow-600': [hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length === 3, 'text-blue-500': [hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length === 4, 'text-emerald-500': allPass }">
                                                                    <span x-text="allPass ? 'Kata sandi kuat ✓' : [hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length <= 1 ? 'Sangat lemah' : [hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length === 2 ? 'Lemah' : [hasMin,hasUpper,hasLower,hasNumber,hasSymbol].filter(Boolean).length === 3 ? 'Cukup' : 'Hampir kuat'"></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Konfirmasi password --}}
                                                    <div>
                                                        <label class="text-[11px] font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wide">Konfirmasi Password Baru</label>
                                                        <div class="relative mt-1.5">
                                                            <input :type="showPwC ? 'text' : 'password'" name="new_password_confirmation" required placeholder="Ulangi password baru"
                                                                   class="block w-full pr-10 px-3 py-2.5 border border-slate-200 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white dark:bg-slate-700 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                                            <button type="button" @click="showPwC = !showPwC" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                                                                <svg x-show="!showPwC" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                                <svg x-cloak x-show="showPwC" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex gap-3 mt-6">
                                                    <button type="button" @click="modalOpen = false"
                                                            class="flex-1 py-2.5 border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-300 text-sm font-semibold rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                                                        Batal
                                                    </button>
                                                    <button type="submit" :disabled="!allPass"
                                                            :class="allPass ? 'bg-blue-600 hover:bg-blue-700 cursor-pointer' : 'bg-slate-300 dark:bg-slate-600 cursor-not-allowed'"
                                                            class="flex-1 py-2.5 text-white text-sm font-semibold rounded-xl transition-colors">
                                                        Simpan Password
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @php
                                    $destroyRoute = auth()->user()->hasRole(['super_admin','super-admin'])
                                        ? route('super_admin.password_reset_requests.destroy', $req)
                                        : route('admin.password_reset_requests.destroy', $req);
                                @endphp
                                <form method="POST" action="{{ $destroyRoute }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Hapus riwayat permintaan ini?')"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($requests->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700">
                {{ $requests->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
