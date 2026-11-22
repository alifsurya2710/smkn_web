<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define roles: super_admin, admin, guru, pendaftar
        $roles = ['super_admin', 'admin', 'guru', 'pendaftar'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Create Default Users for RA AL-IKHWAN
        $users = [
            [
                'name' => 'Super Admin RA AL-IKHWAN',
                'email' => 'superadmin@ra-alikhwan.id',
                'password' => 'Admin@12345',
                'role' => 'super_admin',
            ],
            [
                'name' => 'Admin RA AL-IKHWAN',
                'email' => 'admin@ra-alikhwan.id',
                'password' => 'Admin@12345',
                'role' => 'admin',
            ],
            [
                'name' => 'Guru RA AL-IKHWAN',
                'email' => 'guru@ra-alikhwan.id',
                'password' => 'Guru@12345',
                'role' => 'guru',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                ]
            );

            // Sync roles to ensure they have the correct standard role
            $user->syncRoles([$userData['role']]);
        }
    }
}
