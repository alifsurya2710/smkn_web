<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Mitra Industri') }}
            </h2>
            <a href="{{ route('super_admin.industrial_partners.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                Tambah Mitra
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Logo</th>
                                    <th scope="col" class="px-6 py-3">Nama</th>
                                    <th scope="col" class="px-6 py-3">Kategori</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Urutan</th>
                                    <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($partners as $partner)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-2">
                                            @if($partner->logo)
                                                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="h-10 w-auto object-contain">
                                            @else
                                                <div class="h-10 w-10 bg-gray-100 rounded flex items-center justify-center text-[10px] text-gray-400">NO LOGO</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 font-bold text-gray-900">{{ $partner->name }}</td>
                                        <td class="px-6 py-4">{{ $partner->category ?? '-' }}</td>
                                        <td class="px-6 py-4">
                                            @if($partner->is_active)
                                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold uppercase">Aktif</span>
                                            @else
                                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-bold uppercase">Non-Aktif</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">{{ $partner->order }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('super_admin.industrial_partners.edit', $partner) }}" class="font-semibold text-blue-600 hover:underline">Edit</a>
                                                <form action="{{ route('super_admin.industrial_partners.destroy', $partner) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mitra ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="font-semibold text-red-600 hover:underline">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">Belum ada mitra industri terdaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
