<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class TeachersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Normalize the row keys to handle variations in slugification
        $normalizedRow = [];
        foreach ($row as $key => $value) {
            $slug = str_replace([' ', '_', '-'], '', strtolower($key));
            $normalizedRow[$slug] = $value;
        }

        // Mapping logic with multiple aliases
        $name = $normalizedRow['nama'] ?? $normalizedRow['name'] ?? $normalizedRow['namalengkap'] ?? $normalizedRow['fullname'] ?? null;
        
        if (!$name || empty(trim($name))) {
            return null;
        }

        $email = $normalizedRow['email'] ?? $normalizedRow['alamatemail'] ?? null;
        $nip = $normalizedRow['nip'] ?? $normalizedRow['nomorinduk'] ?? $normalizedRow['noinduk'] ?? $normalizedRow['n_i_p'] ?? null;
        $title = $normalizedRow['gelar'] ?? $normalizedRow['title'] ?? $normalizedRow['gelardepan'] ?? $normalizedRow['gelarbelakang'] ?? null;
        $rank = $normalizedRow['pangkat'] ?? $normalizedRow['rank'] ?? $normalizedRow['golongan'] ?? $normalizedRow['ruang'] ?? null;
        $position = $normalizedRow['jabatan'] ?? $normalizedRow['position'] ?? $normalizedRow['tugas'] ?? null;
        $subject = $normalizedRow['mapel'] ?? $normalizedRow['subject'] ?? $normalizedRow['matapelajaran'] ?? null;
        
        $isManagementValue = $normalizedRow['manajemen'] ?? $normalizedRow['ismanagement'] ?? $normalizedRow['staf'] ?? null;
        $isManagement = false;
        if ($isManagementValue) {
            $trueValues = ['1', 'yes', 'ya', 'true', 'ok'];
            $isManagement = in_array(strtolower(trim($isManagementValue)), $trueValues);
        }

        // Try to find existing user by email or NIP
        $user = null;
        if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $email)->first();
        }
        
        if (!$user && $nip) {
            $user = User::where('nip', $nip)->first();
        }

        $data = [
            'name'     => $name,
            'email'    => $email,
            'title'    => $title,
            'nip'      => $nip,
            'rank'     => $rank,
            'position' => $position,
            'subject'  => $subject,
            'is_management' => $isManagement,
        ];

        if ($user) {
            // Only update email if it's provided and valid
            if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                unset($data['email']);
            }
            $user->update($data);
        } else {
            // For new users, if email is missing or invalid, generate a dummy one based on NIP or Name
            if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $safeName = Str::slug($name);
                $data['email'] = ($nip ? $nip : $safeName) . '@smkn.local';
            }
            
            $data['password'] = Hash::make('password123');
            $user = User::create($data);
        }

        $user->syncRoles(['guru']);

        return $user;
    }
}
