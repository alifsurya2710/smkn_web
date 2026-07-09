<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::role('editor')->with('roles')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => [
                'required', 'string', 'min:8', 'confirmed',
                'regex:/[A-Z]/', 'regex:/[a-z]/',
                'regex:/[0-9]/', 'regex:/[@$!%*?&]/',
            ],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('editor');

        return redirect()->route('admin.users.index')->with('success', 'User editor berhasil ditambahkan.');
    }

    public function destroy(User $user)
    {
        // Admin hanya boleh hapus editor
        if (! $user->hasRole('editor')) {
            return back()->with('error', 'Anda hanya dapat menghapus user dengan role editor.');
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();
        return back()->with('success', 'User editor berhasil dihapus.');
    }
}
