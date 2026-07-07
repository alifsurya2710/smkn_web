@extends('layouts.dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
            <h2 class="text-2xl font-bold mb-6">Manajemen Testimoni</h2>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pesan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if(\Schema::hasTable('testimonis'))
                            @foreach($testimonis as $testimoni)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $testimoni->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-500">
                                    @for($i = 1; $i <= 5; $i++)
                                        {{ $i <= $testimoni->rating ? '★' : '☆' }}
                                    @endfor
                                    ({{ $testimoni->rating }})
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $testimoni->pesan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $testimoni->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $testimoni->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $testimoni->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        @if($testimoni->status === 'pending')
                                            <form action="{{ route('super_admin.testimonis.approve', $testimoni) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-blue-600 hover:text-blue-900">Approve</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('super_admin.testimonis.destroy', $testimoni) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500 uppercase tracking-widest text-xs italic">Tabel 'testimonis' belum ada. Silakan jalankan migrasi.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $testimonis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
