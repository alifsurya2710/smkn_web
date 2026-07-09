@extends('layouts.dashboard')

@section('title', 'Kelola User Editor')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kelola User Editor</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Tambah dan kelola akun editor untuk pengelolaan konten website.</p>
    </div>
    <a href="{{ route('admin.users.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        Tambah Editor
    </a>
</div>

@if(session('success'))
    <div class="mb-6 flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-100">
        <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        </div>
        <p class="text-sm font-semibold text-emerald-700">{{ session('success') }}</p>
    </div>
@endif
@if(session('error'))
    <div class="mb-6 flex items-center gap-3 p-4 rounded-xl bg-red-50 border border-red-100">
        <p class="text-sm font-semibold text-red-700">{{ session('error') }}</p>
    </div>
@endif

<div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700">
        <h3 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-widest">Daftar Editor</h3>
    </div>

    @if($users->isEmpty())
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="w-16 h-16 bg-slate-100 dark:bg-slate-700 rounded-2xl flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h4 class="text-sm font-bold text-slate-700 dark:text-slate-300">Belum ada editor</h4>
            <p class="text-xs text-slate-400 mt-1">Klik tombol "Tambah Editor" untuk membuat akun editor baru.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-700/50">
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pengguna</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Email</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Bergabung</th>
                        <th class="px-6 py-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                    @foreach($users as $user)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold text-sm overflow-hidden flex-shrink-0">
                                    @if($user->photo)
                                        <img src="{{ asset('storage/' . $user->photo) }}" class="w-full h-full object-cover" alt="">
                                    @else
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $user->name }}</p>
                                    <span class="inline-block text-[9px] font-black uppercase tracking-widest text-blue-600 bg-blue-50 dark:bg-blue-900/30 px-1.5 py-0.5 rounded-full mt-0.5">Editor</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-500 dark:text-slate-400">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-xs text-slate-500 dark:text-slate-400">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus user editor {{ $user->name }}?')"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-red-600 border border-red-200 dark:border-red-800/40 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Hapus
                                </button>
                            </form>
                            @else
                            <span class="text-[10px] text-slate-400">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700">
                {{ $users->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
