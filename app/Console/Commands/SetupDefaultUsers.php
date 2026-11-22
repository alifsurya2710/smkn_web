<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class SetupDefaultUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup-users {--reset-passwords : Reset passwords if users exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup default Super Admin, Admin, and Guru users for RA AL-IKHWAN';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $roles = ['super_admin', 'admin', 'guru'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        $accounts = [
            [
                'name'     => 'Super Admin RA AL-IKHWAN',
                'email'    => 'superadmin@ra-alikhwan.id',
                'password' => 'Admin@12345',
                'role'     => 'super_admin',
            ],
            [
                'name'     => 'Admin RA AL-IKHWAN',
                'email'    => 'admin@ra-alikhwan.id',
                'password' => 'Admin@12345',
                'role'     => 'admin',
            ],
            [
                'name'     => 'Guru RA AL-IKHWAN',
                'email'    => 'guru@ra-alikhwan.id',
                'password' => 'Guru@12345',
                'role'     => 'guru',
            ],
        ];

        $this->info("Menyiapkan akun default RA AL-IKHWAN...");

        foreach ($accounts as $acc) {
            $user = User::where('email', $acc['email'])->first();

            if (!$user) {
                $user = User::create([
                    'name'     => $acc['name'],
                    'email'    => $acc['email'],
                    'password' => Hash::make($acc['password']),
                ]);
                $this->info("✓ Akun baru dibuat: {$acc['email']}");
            } else {
                $user->name = $acc['name'];
                $user->password = Hash::make($acc['password']);
                $user->save();
                $this->info("✓ Akun diperbarui / password direset: {$acc['email']}");
            }

            $user->syncRoles([$acc['role']]);
        }

        $this->newLine();
        $this->table(
            ['Role', 'Email Login', 'Password'],
            [
                ['Super Admin', 'superadmin@ra-alikhwan.id', 'Admin@12345'],
                ['Admin', 'admin@ra-alikhwan.id', 'Admin@12345'],
                ['Guru', 'guru@ra-alikhwan.id', 'Guru@12345'],
            ]
        );

        return Command::SUCCESS;
    }
}
