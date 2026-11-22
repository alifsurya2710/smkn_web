<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-slate-900 dark:text-red-400">
            Hapus Akun
        </h2>

        <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
            Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-6 py-3 bg-red-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-red-500/25"
    >Hapus Akun Saya</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-white dark:bg-slate-900 rounded-3xl">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">
                Apakah Anda yakin ingin menghapus akun?
            </h2>

            <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">
                Setelah akun Anda dihapus, semua data akan hilang selamanya. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun secara permanen.
            </p>

            <div class="mt-8 space-y-2">
                <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Kata Sandi Konfirmasi</label>
                <div class="relative" x-data="{ showDelPw: false }">
                    <input
                        id="password"
                        name="password"
                        :type="showDelPw ? 'text' : 'password'"
                        class="block w-full pr-11 rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-red-500 focus:ring-red-500/20 transition-all duration-200"
                        placeholder="Masukkan sandi Anda"
                    />
                    <button type="button" @click="showDelPw = !showDelPw"
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                        <svg x-show="!showDelPw" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg x-cloak x-show="showDelPw" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                    </button>
                </div>

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-100 dark:text-slate-400 dark:hover:bg-slate-800 transition-colors">
                    Batal
                </button>

                <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-xl text-sm font-bold hover:bg-red-700 shadow-lg shadow-red-500/25 transition-all">
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
