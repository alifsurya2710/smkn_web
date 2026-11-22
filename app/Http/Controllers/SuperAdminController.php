<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $currentYear = date('Y');
        
        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_admin' => \App\Models\User::role('admin')->count(),
            'total_guru' => \App\Models\User::role('guru')->count(),
            'total_posts' => \App\Models\Post::count(),
            'trash_posts' => \App\Models\Post::onlyTrashed()->count(),
        ];

        // Hitung registrasi user per bulan untuk tahun berjalan
        $monthlyRegistrations = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyRegistrations[] = \App\Models\User::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();
        }

        $recent_users = \App\Models\User::latest()->take(5)->get();
        $recent_posts = \App\Models\Post::latest()->take(5)->get();

        return view('super-admin.dashboard', compact('stats', 'recent_users', 'recent_posts', 'monthlyRegistrations', 'currentYear'));
    }

    public function users()
    {
        $users = \App\Models\User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['guru']);
        })->with('roles')->paginate(20);
        
        return view('super-admin.users.index', compact('users'));
    }

    public function createUser()
    {
        // Super admin bisa membuat admin dan guru
        $availableRoles = ['admin', 'guru'];
        return view('super-admin.users.create', compact('availableRoles'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => [
                'required', 'string', 'min:8', 'confirmed',
                'regex:/[A-Z]/', 'regex:/[a-z]/',
                'regex:/[0-9]/', 'regex:/[@$!%*?&]/',
            ],
            'role'     => 'required|in:admin,guru',
        ]);

        $user = \App\Models\User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('super_admin.users')->with('success', 'User ' . $request->role . ' berhasil ditambahkan.');
    }

    public function activityLog()
    {
        return view('super-admin.activity-log.index');
    }

    public function editUser(\App\Models\User $user)
    {
        $roles = \Spatie\Permission\Models\Role::whereIn('name', ['super_admin', 'admin', 'guru'])->get();
        $majors = \App\Models\Major::all();
        return view('super-admin.users.edit', compact('user', 'roles', 'majors'));
    }

    public function updateUser(Request $request, \App\Models\User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'roles' => 'required|array',
            'nisn' => 'nullable|string|max:20',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'nisn' => $request->nisn,
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('super_admin.users')->with('success', 'User berhasil diperbarui.');
    }

    public function destroyUser(\App\Models\User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dipindahkan ke tempat sampah (Trash).');
    }

    public function trashedUsers()
    {
        // Auto-delete users that have been in trash for more than 30 days
        $expiredUsers = \App\Models\User::onlyTrashed()->where('deleted_at', '<', now()->subDays(30))->get();
        foreach ($expiredUsers as $expired) {
            $expired->forceDelete();
        }

        $users = \App\Models\User::onlyTrashed()->with('roles')->paginate(20);
        return view('super-admin.users.trash', compact('users'));
    }

    public function restoreUser($id)
    {
        $user = \App\Models\User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return back()->with('success', 'User berhasil dipulihkan.');
    }

    public function forceDeleteUser($id)
    {
        $user = \App\Models\User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return back()->with('success', 'User berhasil dihapus secara permanen.');
    }
}
