<?php

namespace App\Imports;

use App\Models\PpdbApplication;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class PpdbApplicationsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Normalisasi key header
        $normalized = [];
        foreach ($row as $k => $v) {
            $cleaned = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $k));
            $normalized[$cleaned] = $v;
        }

        $fullName = $normalized['namacalonmurid'] ?? $normalized['namamurid'] ?? $normalized['namalengkap'] ?? $normalized['fullname'] ?? null;
        if (!$fullName || empty(trim($fullName))) {
            return null;
        }

        $parentName = $normalized['namaorangtuawali'] ?? $normalized['namaorangtua'] ?? $normalized['namawali'] ?? $normalized['parentname'] ?? null;
        $phone = $normalized['nomorhpwhatsapp'] ?? $normalized['nomorhp'] ?? $normalized['nohp'] ?? $normalized['telepon'] ?? $normalized['phone'] ?? '-';
        $email = $normalized['alamatemail'] ?? $normalized['email'] ?? null;
        $nisn = $normalized['nisn'] ?? null;
        
        $paudVal = strtolower(trim((string)($normalized['pernahpaud'] ?? $normalized['paud'] ?? '')));
        $pernahPaud = in_array($paudVal, ['1', 'ya', 'yes', 'true', 'pernah', 'ya pernah']);

        $statusVal = strtolower(trim((string)($normalized['statuspendaftaran'] ?? $normalized['status'] ?? '')));
        if (str_contains($statusVal, 'terima') || str_contains($statusVal, 'approve')) {
            $status = 'approved';
        } elseif (str_contains($statusVal, 'tolak') || str_contains($statusVal, 'reject')) {
            $status = 'rejected';
        } else {
            $status = 'pending';
        }

        $catatan = $normalized['catatanalasanpenolakan'] ?? $normalized['catatan'] ?? $normalized['alasan'] ?? null;
        $regNumber = $normalized['nopendaftaran'] ?? $normalized['registrationnumber'] ?? ('SPMB-RA-' . date('Ymd') . '-' . strtoupper(Str::random(4)));

        // Cek jika nomor pendaftaran sudah ada, update atau skip
        $existing = PpdbApplication::where('registration_number', $regNumber)->first();
        if ($existing) {
            $existing->update([
                'full_name'   => $fullName,
                'parent_name' => $parentName,
                'phone'       => $phone,
                'email'       => $email ?? $existing->email,
                'nisn'        => $nisn,
                'pernah_paud' => $pernahPaud,
                'status'      => $status,
                'catatan'     => $catatan,
            ]);
            return null;
        }

        return new PpdbApplication([
            'registration_number' => $regNumber,
            'full_name'           => $fullName,
            'parent_name'         => $parentName,
            'phone'               => $phone,
            'email'               => $email ?? 'pendaftar_' . Str::random(5) . '@ra-alikhwan.id',
            'nisn'                => $nisn,
            'pernah_paud'         => $pernahPaud,
            'status'              => $status,
            'catatan'             => $catatan,
        ]);
    }
}
