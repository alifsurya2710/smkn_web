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
        // Define roles (standardizing to underscore as per tests)
        $roles = ['super_admin', 'admin', 'editor', 'guru', 'siswa'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // Create Test Users
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'super@smkn.sch.id',
                'password' => 'password',
                'role' => 'super_admin',
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@smkn.sch.id',
                'password' => 'password',
                'role' => 'admin',
            ],
            [
                'name' => 'Editor User',
                'email' => 'editor@smkn.sch.id',
                'password' => 'password',
                'role' => 'editor',
            ],
            [
                'name' => 'Siswa User',
                'email' => 'siswa@smkn-web.sch.id',
                'password' => 'password',
                'role' => 'siswa',
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
