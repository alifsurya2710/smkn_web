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
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-white focus:border-red-500 focus:ring-red-500/20 transition-all duration-200"
                    placeholder="Masukkan sandi Anda"
                />

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
