<!-- Stats Card Section -->
<div class="relative z-40 px-4 -mt-10 md:-mt-12 mb-12" data-aos="fade-up"> 
    <div class="max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
        <!-- Stat 1: Siswa -->
        <div class="bg-white rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.05)] p-4 md:p-5 flex flex-col items-center justify-center text-center border border-gray-50 hover:shadow-lg transition-all duration-500 group"
             x-data="{ count: 0, target: {{ (int) preg_replace('/[^0-9]/', '', $statsSiswa) }} }" 
             x-init="setTimeout(() => { let start = 0; let duration = 2000; let step = target / (duration / 16); let interval = setInterval(() => { start += step; if(start >= target) { count = target; clearInterval(interval); } else { count = Math.floor(start); } }, 16) }, 500)">
            <div class="p-2.5 bg-blue-50/70 rounded-xl text-blue-500 mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h3 class="text-xl md:text-2xl font-black text-[#0A142F] font-outfit" x-text="count + '+'">0</h3>
            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-1.5">Siswa Aktif</p>
        </div>

        <!-- Stat 2: Jurusan -->
        <div class="bg-white rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.05)] p-4 md:p-5 flex flex-col items-center justify-center text-center border border-gray-50 hover:shadow-lg transition-all duration-500 group"
             x-data="{ count: 0, target: {{ \App\Models\Major::count() ?: 9 }} }"
             x-init="setTimeout(() => { let start = 0; let duration = 2000; let step = target / (duration / 16); let interval = setInterval(() => { start += step; if(start >= target) { count = target; clearInterval(interval); } else { count = Math.floor(start); } }, 16) }, 600)">
            <div class="p-2.5 bg-indigo-50/70 rounded-xl text-indigo-500 mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h3 class="text-xl md:text-2xl font-black text-[#0A142F] font-outfit" x-text="count">0</h3>
            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-1.5">Program Keahlian</p>
        </div>

        <!-- Stat 3: Pengajar -->
        <div class="bg-white rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.05)] p-4 md:p-5 flex flex-col items-center justify-center text-center border border-gray-50 hover:shadow-lg transition-all duration-500 group"
             x-data="{ count: 0, target: {{ (int) preg_replace('/[^0-9]/', '', $statsPengajar) }} }"
             x-init="setTimeout(() => { let start = 0; let duration = 2000; let step = target / (duration / 16); let interval = setInterval(() => { start += step; if(start >= target) { count = target; clearInterval(interval); } else { count = Math.floor(start); } }, 16) }, 700)">
            <div class="p-2.5 bg-emerald-50/70 rounded-xl text-emerald-500 mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
            </div>
            <h3 class="text-xl md:text-2xl font-black text-[#0A142F] font-outfit" x-text="count + '+'">0</h3>
            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-1.5">Tenaga Pengajar</p>
        </div>

        <!-- Stat 4: Mitra -->
        <div class="bg-white rounded-2xl shadow-[0_10px_30px_rgba(0,0,0,0.05)] p-4 md:p-5 flex flex-col items-center justify-center text-center border border-gray-100 hover:shadow-lg transition-all duration-500 group"
             x-data="{ count: 0, target: {{ (int) preg_replace('/[^0-9]/', '', $statsMitra) }} }" 
             x-init="setTimeout(() => { let start = 0; let duration = 2000; let step = target / (duration / 16); let interval = setInterval(() => { start += step; if(start >= target) { count = target; clearInterval(interval); } else { count = Math.floor(start); } }, 16) }, 900)">
            <div class="p-2.5 bg-rose-50/70 rounded-xl text-rose-500 mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <h3 class="text-xl md:text-2xl font-black text-[#0A142F] font-outfit" x-text="count + '+'">0</h3>
            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-1.5">Mitra Industri</p>
        </div>
    </div>
</div>
