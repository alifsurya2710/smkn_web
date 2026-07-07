<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Mitra Industri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    <form action="{{ route('super_admin.industrial_partners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="name" :value="__('Nama Perusahaan')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm" :value="old('name')" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="category" :value="__('Kategori (Opsional)')" />
                                    <x-text-input id="category" name="category" type="text" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm" :value="old('category')" placeholder="misal: Manufaktur, IT, Otomotif" />
                                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="website" :value="__('Website Perusahaan (Opsional)')" />
                                    <x-text-input id="website" name="website" type="url" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm" :value="old('website')" placeholder="https://perusahaan.com" />
                                    <x-input-error :messages="$errors->get('website')" class="mt-2" />
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="logo" :value="__('Logo Perusahaan')" />
                                    <div class="mt-1 flex items-center justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl hover:border-blue-400 transition-colors bg-slate-50/30">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-slate-300" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-slate-500">
                                                <label for="logo" class="relative cursor-pointer bg-white rounded-md font-bold text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                    <span>Unggah Logo</span>
                                                    <input id="logo" name="logo" type="file" class="sr-only">
                                                </label>
                                            </div>
                                            <p class="text-xs text-slate-400 font-medium">PNG, JPG up to 2MB. Rekomendasi: Logo berlatar transparan.</p>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="order" :value="__('Urutan Tampil')" />
                                        <x-text-input id="order" name="order" type="number" class="mt-1 block w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm" :value="old('order', 0)" />
                                        <x-input-error :messages="$errors->get('order')" class="mt-2" />
                                    </div>
                                    <div class="flex items-center pt-6">
                                        <label for="is_active" class="inline-flex items-center">
                                            <input id="is_active" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 h-5 w-5" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm font-bold text-gray-700 uppercase tracking-wide">{{ __('Aktifkan Mitra') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-8 border-t border-slate-100">
                            <a href="{{ route('super_admin.industrial_partners.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">Batal</a>
                            <x-primary-button class="bg-[#0A142F] hover:bg-blue-600 px-8 py-3 rounded-2xl shadow-xl shadow-blue-900/10">
                                {{ __('Simpan Mitra') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
