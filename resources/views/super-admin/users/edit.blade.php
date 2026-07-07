@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('content')
<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-2xl font-semibold leading-6 text-gray-900">Edit User</h1>
        <p class="mt-2 text-sm text-gray-700">Ubah informasi dan hak akses pengguna ini.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <a href="{{ route('super_admin.users') }}" class="block rounded-md bg-gray-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-gray-500">
            Kembali
        </a>
    </div>
</div>

<div class="mt-8 bg-white shadow sm:rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <form action="{{ route('super_admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <!-- Profile Image Preview -->
                <div class="flex items-center gap-4 py-4 border-b border-slate-100">
                    <div class="h-16 w-16 rounded-xl bg-blue-600 flex items-center justify-center text-white text-xl font-bold shadow-lg overflow-hidden">
                        @if($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="" class="h-full w-full object-cover">
                        @else
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Pas Foto User</h4>
                        <p class="text-xs text-slate-500">Avatar profil yang ditampilkan di sistem.</p>
                    </div>
                </div>
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nama Lengkap</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Alamat Email</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- NISN -->
                <div>
                    <label for="nisn" class="block text-sm font-medium leading-6 text-gray-900">NISN (Hanya untuk Siswa)</label>
                    <div class="mt-2">
                        <input type="text" name="nisn" id="nisn" value="{{ old('nisn', $user->nisn) }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        @error('nisn') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Roles -->
                <div>
                    <label class="block text-sm font-medium leading-6 text-gray-900 mb-2">Pilih Role Akses</label>
                    <div class="space-y-2">
                        @foreach($roles as $role)
                            <div class="relative flex items-start">
                                <div class="flex h-6 items-center">
                                    <input id="role-{{ $role->id }}" name="roles[]" value="{{ $role->name }}" type="checkbox" @if($user->hasRole($role->name)) checked @endif class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-600">
                                </div>
                                <div class="ml-3 text-sm leading-6">
                                    <label for="role-{{ $role->id }}" class="font-medium text-gray-900">{{ ucfirst($role->name) }}</label>
                                </div>
                            </div>
                        @endforeach
                        @error('roles') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" class="rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
