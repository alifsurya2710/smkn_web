<section>
    <header>
        <h2 class="text-xl font-bold text-slate-900 dark:text-white">
            Perbarui Kata Sandi
        </h2>
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
            Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6" id="password-update-form">
        @csrf
        @method('put')

        {{-- Kata Sandi Saat Ini --}}
        <div class="space-y-2">
            <label for="update_password_current_password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                Kata Sandi Saat Ini
            </label>
            <div class="relative" x-data="{ showCurrent: false }">
                <input id="update_password_current_password"
                       name="current_password"
                       :type="showCurrent ? 'text' : 'password'"
                       class="block w-full pr-11 rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900/50 dark:text-white focus:border-blue-500 focus:ring-blue-500/20 transition-all duration-200"
                       autocomplete="current-password" />
                <button type="button" @click="showCurrent = !showCurrent"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                    <svg x-show="!showCurrent" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg x-cloak x-show="showCurrent" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        {{-- Kata Sandi Baru --}}
        <div class="space-y-2">
            <label for="update_password_password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                Kata Sandi Baru
            </label>
            <div class="relative" x-data="{ showNew: false }">
                <input id="update_password_password"
                       name="password"
                       :type="showNew ? 'text' : 'password'"
                       class="block w-full pr-11 rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900/50 dark:text-white focus:border-blue-500 focus:ring-blue-500/20 transition-all duration-200"
                       autocomplete="new-password"
                       oninput="checkPasswordStrength(this.value)" />
                <button type="button" @click="showNew = !showNew"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                    <svg x-show="!showNew" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg x-cloak x-show="showNew" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />

            {{-- Password Strength Meter --}}
            <div id="strength-meter" class="mt-3 hidden">
                {{-- Progress Bar --}}
                <div class="flex gap-1 mb-3">
                    <div id="bar-1" class="h-1.5 flex-1 rounded-full bg-slate-200 dark:bg-slate-700 transition-all duration-300"></div>
                    <div id="bar-2" class="h-1.5 flex-1 rounded-full bg-slate-200 dark:bg-slate-700 transition-all duration-300"></div>
                    <div id="bar-3" class="h-1.5 flex-1 rounded-full bg-slate-200 dark:bg-slate-700 transition-all duration-300"></div>
                    <div id="bar-4" class="h-1.5 flex-1 rounded-full bg-slate-200 dark:bg-slate-700 transition-all duration-300"></div>
                    <div id="bar-5" class="h-1.5 flex-1 rounded-full bg-slate-200 dark:bg-slate-700 transition-all duration-300"></div>
                </div>

                {{-- Strength Label --}}
                <p id="strength-label" class="text-xs font-bold mb-3 transition-colors duration-200"></p>

                {{-- Requirements Checklist --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-1.5 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700">
                    <div id="req-length" class="req-item flex items-center gap-2 text-xs font-medium text-slate-400 dark:text-slate-500 transition-all duration-200">
                        <span class="req-icon w-4 h-4 rounded-full border-2 border-slate-300 dark:border-slate-600 flex items-center justify-center flex-shrink-0 transition-all duration-200">
                            <svg class="check-icon hidden w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Minimal 8 karakter
                    </div>
                    <div id="req-upper" class="req-item flex items-center gap-2 text-xs font-medium text-slate-400 dark:text-slate-500 transition-all duration-200">
                        <span class="req-icon w-4 h-4 rounded-full border-2 border-slate-300 dark:border-slate-600 flex items-center justify-center flex-shrink-0 transition-all duration-200">
                            <svg class="check-icon hidden w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Huruf besar (A-Z)
                    </div>
                    <div id="req-lower" class="req-item flex items-center gap-2 text-xs font-medium text-slate-400 dark:text-slate-500 transition-all duration-200">
                        <span class="req-icon w-4 h-4 rounded-full border-2 border-slate-300 dark:border-slate-600 flex items-center justify-center flex-shrink-0 transition-all duration-200">
                            <svg class="check-icon hidden w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Huruf kecil (a-z)
                    </div>
                    <div id="req-number" class="req-item flex items-center gap-2 text-xs font-medium text-slate-400 dark:text-slate-500 transition-all duration-200">
                        <span class="req-icon w-4 h-4 rounded-full border-2 border-slate-300 dark:border-slate-600 flex items-center justify-center flex-shrink-0 transition-all duration-200">
                            <svg class="check-icon hidden w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Angka (0-9)
                    </div>
                    <div id="req-symbol" class="req-item flex items-center gap-2 text-xs font-medium text-slate-400 dark:text-slate-500 transition-all duration-200 sm:col-span-2">
                        <span class="req-icon w-4 h-4 rounded-full border-2 border-slate-300 dark:border-slate-600 flex items-center justify-center flex-shrink-0 transition-all duration-200">
                            <svg class="check-icon hidden w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Simbol (@$!%*?&)
                    </div>
                </div>
            </div>
        </div>

        {{-- Konfirmasi Kata Sandi Baru --}}
        <div class="space-y-2">
            <label for="update_password_password_confirmation" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                Konfirmasi Kata Sandi Baru
            </label>
            <div class="relative" x-data="{ showConfirm: false }">
                <input id="update_password_password_confirmation"
                       name="password_confirmation"
                       :type="showConfirm ? 'text' : 'password'"
                       class="block w-full pr-11 rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900/50 dark:text-white focus:border-blue-500 focus:ring-blue-500/20 transition-all duration-200"
                       autocomplete="new-password"
                       oninput="checkConfirmMatch()" />
                <button type="button" @click="showConfirm = !showConfirm"
                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                    <svg x-show="!showConfirm" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg x-cloak x-show="showConfirm" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                </button>
            </div>
            {{-- Match indicator --}}
            <p id="match-indicator" class="text-xs font-semibold hidden mt-1 transition-all duration-200"></p>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 dark:bg-blue-500 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-400 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-blue-500/25">
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

<script>
(function() {
    // Requirement rules
    var rules = {
        'req-length': { test: function(v) { return v.length >= 8; } },
        'req-upper':  { test: function(v) { return /[A-Z]/.test(v); } },
        'req-lower':  { test: function(v) { return /[a-z]/.test(v); } },
        'req-number': { test: function(v) { return /[0-9]/.test(v); } },
        'req-symbol': { test: function(v) { return /[@$!%*?&]/.test(v); } },
    };

    var strengthConfig = [
        { label: 'Sangat Lemah', color: 'text-red-500',    bars: 1, barColor: 'bg-red-500' },
        { label: 'Lemah',        color: 'text-orange-500', bars: 2, barColor: 'bg-orange-500' },
        { label: 'Cukup',        color: 'text-amber-500',  bars: 3, barColor: 'bg-amber-500' },
        { label: 'Kuat',         color: 'text-blue-500',   bars: 4, barColor: 'bg-blue-500' },
        { label: 'Sangat Kuat',  color: 'text-emerald-500',bars: 5, barColor: 'bg-emerald-500' },
    ];

    window.checkPasswordStrength = function(value) {
        var meter = document.getElementById('strength-meter');
        var label = document.getElementById('strength-label');

        if (!value) {
            meter.classList.add('hidden');
            resetBars();
            return;
        }

        meter.classList.remove('hidden');

        // Check each requirement
        var passed = 0;
        Object.keys(rules).forEach(function(id) {
            var el = document.getElementById(id);
            var icon = el.querySelector('.req-icon');
            var checkIcon = el.querySelector('.check-icon');
            var ok = rules[id].test(value);

            if (ok) {
                passed++;
                // Checked state
                el.classList.remove('text-slate-400', 'dark:text-slate-500');
                el.classList.add('text-emerald-600', 'dark:text-emerald-400');
                icon.classList.remove('border-slate-300', 'dark:border-slate-600');
                icon.classList.add('bg-emerald-500', 'border-emerald-500');
                checkIcon.classList.remove('hidden');
                checkIcon.style.stroke = '#fff';
            } else {
                // Unchecked state
                el.classList.add('text-slate-400');
                el.classList.remove('text-emerald-600', 'dark:text-emerald-400');
                icon.classList.remove('bg-emerald-500', 'border-emerald-500');
                icon.classList.add('border-slate-300');
                checkIcon.classList.add('hidden');
            }
        });

        // Update strength bars & label
        var cfg = strengthConfig[passed - 1] || strengthConfig[0];
        updateBars(passed, cfg.barColor);
        label.textContent = '🔒 Keamanan: ' + cfg.label;
        label.className = 'text-xs font-bold mb-3 transition-colors duration-200 ' + cfg.color;

        // Also recheck confirm match
        checkConfirmMatch();
    };

    window.checkConfirmMatch = function() {
        var newPass = document.getElementById('update_password_password').value;
        var confirm = document.getElementById('update_password_password_confirmation').value;
        var indicator = document.getElementById('match-indicator');

        if (!confirm) {
            indicator.classList.add('hidden');
            return;
        }

        indicator.classList.remove('hidden');
        if (newPass === confirm) {
            indicator.textContent = '✓ Kata sandi cocok';
            indicator.className = 'text-xs font-semibold mt-1 transition-all duration-200 text-emerald-600 dark:text-emerald-400';
        } else {
            indicator.textContent = '✗ Kata sandi tidak cocok';
            indicator.className = 'text-xs font-semibold mt-1 transition-all duration-200 text-red-500 dark:text-red-400';
        }
    };

    function resetBars() {
        for (var i = 1; i <= 5; i++) {
            var bar = document.getElementById('bar-' + i);
            bar.className = 'h-1.5 flex-1 rounded-full bg-slate-200 dark:bg-slate-700 transition-all duration-300';
        }
    }

    function updateBars(count, colorClass) {
        for (var i = 1; i <= 5; i++) {
            var bar = document.getElementById('bar-' + i);
            if (i <= count) {
                bar.className = 'h-1.5 flex-1 rounded-full transition-all duration-300 ' + colorClass;
            } else {
                bar.className = 'h-1.5 flex-1 rounded-full bg-slate-200 dark:bg-slate-700 transition-all duration-300';
            }
        }
    }
})();
</script>
