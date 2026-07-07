<section>
    <header>
        <h2 class="text-xl font-bold text-slate-900 dark:text-white">
            Perbarui Kata Sandi
        </h2>

        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
            Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div class="space-y-2">
            <label for="update_password_current_password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" 
                   class="block w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900/50 dark:text-white focus:border-blue-500 focus:ring-blue-500/20 transition-all duration-200" 
                   autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <label for="update_password_password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" 
                   class="block w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900/50 dark:text-white focus:border-blue-500 focus:ring-blue-500/20 transition-all duration-200" 
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Konfirmasi Kata Sandi Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                   class="block w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900/50 dark:text-white focus:border-blue-500 focus:ring-blue-500/20 transition-all duration-200" 
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 dark:bg-blue-500 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-400 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-blue-500/25">
                Perbarui Kata Sandi
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-medium text-emerald-600 dark:text-emerald-400 flex items-center gap-2"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Berhasil diperbarui.
                </p>
            @endif
        </div>
    </form>
</section>
