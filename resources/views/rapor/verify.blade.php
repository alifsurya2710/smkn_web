@extends('layouts.landing')

@section('title', 'Verifikasi E-Rapor')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Cek E-Rapor Siswa</h2>
        <p class="mt-2 text-center text-sm text-gray-600">Masukkan Nama Lengkap dan NISN untuk mengunduh rapor.</p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form class="space-y-6" action="{{ route('rapor.verify.post') }}" method="POST">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Nama Lengkap Siswa</label>
                    <div class="mt-1">
                        <input id="username" name="username" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:border-black focus:ring-black sm:text-sm" placeholder="Contoh: Budi Santoso">
                    </div>
                </div>

                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700">NISN (Nomor Induk Siswa Nasional)</label>
                    <div class="mt-1">
                        <input id="nisn" name="nisn" type="text" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:border-black focus:ring-black sm:text-sm" placeholder="10 digit NISN">
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-slate-900 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all font-semibold">Cek & Download Rapor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
