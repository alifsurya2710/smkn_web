<section>
    <header>
        <h2 class="text-xl font-bold text-slate-900 dark:text-white">
            Informasi Profil
        </h2>

        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
            Perbarui informasi nama dan alamat email akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex items-center gap-6 pb-4">
            <div class="relative group">
                <div class="h-24 w-24 rounded-2xl bg-blue-600 flex items-center justify-center text-white text-3xl font-bold shadow-xl shadow-blue-500/20 overflow-hidden">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Profile Photo" class="h-full w-full object-cover">
                    @else
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    @endif
                </div>
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-2xl cursor-pointer" onclick="document.getElementById('photo-input').click()">
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </div>
            </div>
            <div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white">Foto Profil</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Gunakan foto formal untuk identitas website.</p>
                <input type="file" id="photo-input" name="photo" class="hidden" accept="image/*" onchange="
                    const reader = new FileReader(); 
                    reader.onload = (e) => { 
                        const container = document.querySelector('.h-24.w-24');
                        let img = container.querySelector('img');
                        if (!img) {
                            container.innerHTML = '<img class=\'h-full w-full object-cover\' alt=\'Profile Photo\'>';
                            img = container.querySelector('img');
                        }
                        img.src = e.target.result;
                        container.classList.remove('bg-blue-600', 'text-white', 'text-3xl', 'font-bold');
                    }; 
                    reader.readAsDataURL(this.files[0]);
                " />
                <x-input-error class="mt-2" :messages="$errors->get('photo')" />
            </div>
        </div>

        <div class="space-y-2">
            <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Nama Lengkap</label>
            <input id="name" name="name" type="text" 
                   class="block w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900/50 dark:text-white focus:border-blue-500 focus:ring-blue-500/20 transition-all duration-200" 
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">Alamat Email</label>
            <input id="email" name="email" type="email" 
                   class="block w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900/50 dark:text-white focus:border-blue-500 focus:ring-blue-500/20 transition-all duration-200" 
                   value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 rounded-xl bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800">
                    <p class="text-xs text-amber-800 dark:text-amber-300">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button form="send-verification" class="ml-2 font-bold underline hover:text-amber-900">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-xs text-emerald-600 dark:text-emerald-400">
                            {{ __('Tautan verifikasi baru telah dikirimkan ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 dark:bg-blue-500 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-400 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-blue-500/25">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-medium text-emerald-600 dark:text-emerald-400 flex items-center gap-2"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Berhasil disimpan.
                </p>
            @endif
        </div>
    </form>
</section>
